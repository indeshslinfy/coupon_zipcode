<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
* Common Helper for CodeIgniter
*
*
*/
if (!function_exists('get_settings'))
{
	function get_settings($settings)
	{
		$CI =& get_instance();
		$select_str = 'setting_key, setting_value';
		if(!$settings)
		{
			return $CI->db->select($select_str)
						->get('settings')
						->result_array();
		}
		else if(is_array($settings) && sizeof($settings) > 0)
		{
			return $CI->db->select($select_str)
							->where_in('setting_key', $settings)
							->get('settings')
							->result_array();
		}
		else if($settings != '')
		{
			$setting = $CI->db->select($select_str)
							->where(array('setting_key' => $settings))
							->get('settings')
							->row_array();
							
			return $setting ? unserialize($setting['setting_value']) : '';
		}
	}
}

if (!function_exists('get_countries'))
{
	function get_countries()
	{
		$CI =& get_instance();
		return $CI->db->get('countries')->result_array();
	}
}

if (!function_exists('get_states'))
{
	function get_states($country_id=1)
	{
		$CI =& get_instance();
		return $CI->db->get_where('states', array("country_id", $country_id))->result_array();
	}
}

if (!function_exists('get_cities'))
{
	function get_cities($state_id)
	{
		$CI =& get_instance();
		return $CI->db->where(array("state_id" => $state_id))->get('cities')->result_array();
	}
}

if (!function_exists('get_cities_ids_by_keyword'))
{
	function get_cities_ids_by_keyword($keyword)
	{
		$CI =& get_instance();
		$cities = $CI->db->select('id')->like(array("city_name" => $keyword))->get('cities')->result_array();
		$ct_ids = array();
		foreach ($cities as $keyC => $valueC)
		{
			$ct_ids[] = $valueC['id'];
		}

		return $ct_ids;
	}
}

if (!function_exists('get_zipcodes'))
{
	function get_zipcodes()
	{
		$CI =& get_instance();
		return $CI->db->get('zipcodes')->result_array();
	}
}

if (!function_exists('get_stores_categories'))
{
	function get_stores_categories()
	{
		$CI =& get_instance();
		return $CI->db->where(array('deleted_at' => NULL))
		              ->order_by('store_category_name', 'ASC')
		              ->get('stores_category')
		              ->result_array();
	}
}

if (!function_exists('get_zipcode_stores'))
{
	function get_zipcode_stores($zipcode_id)
	{
		$CI =& get_instance();
		return $CI->db->where(array('store_zipcode_id' => $zipcode_id, 'deleted_at' => NULL, 'status' => STORE_STATUS_ACTIVE))
					->get('stores')
					->result_array();
	}
}

if (!function_exists('get_zipcode_by_city'))
{
	function get_zipcode_by_city($city_id)
	{
		$CI =& get_instance();
		return $CI->db->where(array('place_id' => $city_id))
					->get('zipcodes')
					->result_array();
	}
}

if (!function_exists('save_zipcode'))
{
	function save_zipcode($zipcode)
	{
		$CI =& get_instance();
		$zipcode_exist = $CI->db->where(array('zipcode' => $zipcode))
					->get('zipcodes')
					->row_array();
		if ($zipcode_exist)
		{
			return array("status" => 0, "zipcode" => $zipcode_exist);
		}

		$data = array("zipcode" => $zipcode, "created_at" => date('Y-m-d H:i:s'));
		$CI->db->insert('zipcodes', $data);

		$data['status'] = 1;
		$data['id'] = $CI->db->insert_id();

		return array("status" => 1, "zipcode" => $data);
	}
}

if (!function_exists('get_zipcode_by_name'))
{
	function get_zipcode_by_name($zipcode)
	{
		$CI =& get_instance();
		return $CI->db->where(array('zipcode' => $zipcode))
								->get('zipcodes')
								->row_array();
	}
}

if (!function_exists('get_zipcode_name'))
{
	function get_zipcode_name($zipcode_id)
	{
		$CI =& get_instance();
		$zipcode_exist = $CI->db->where(array('id' => $zipcode_id))
								->get('zipcodes')
								->row_array();
		if ($zipcode_exist)
		{
			return $zipcode_exist['zipcode'];
		}
	}
}

if (!function_exists('get_zipcode_details'))
{
	function get_zipcode_details($zipcode_id)
	{
		$CI =& get_instance();
		$zipcode_exist = $CI->db->where(array('id' => $zipcode_id))
					->get('zipcodes')
					->row_array();
		if ($zipcode_exist)
		{
			return $zipcode_exist;
		}
	}
}

if (!function_exists('user_login_data'))
{
	function user_login_data($index=false)
	{
		$CI =& get_instance();
		$login_data = $CI->session->userdata('user_access');
		if ($index)
		{
			return @$login_data[$index];
		}

		return $login_data;
	}
}

if (!function_exists('slug_to_readable'))
{
	function slug_to_readable($slug)
	{
		return ucwords(str_replace("-", " ", $slug));
	}
}

if (!function_exists('slugify'))
{
	function slugify($text)
	{
		// replace non letter or digits by -
		$text = preg_replace('~[^\pL\d]+~u', '-', $text);

		// transliterate
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

		// remove unwanted characters
		$text = preg_replace('~[^-\w]+~', '', $text);

		// trim
		$text = trim($text, '-');

		// remove duplicated - symbols
		$text = preg_replace('~-+~', '-', $text);

		// lowercase
		$text = strtolower($text);

		if(empty($text))
		{
			return 'n-a';
		}

		return $text;
	}
}

if (!function_exists('xss_clean'))
{
    function xss_clean($data)
    {
        // Fix &entity\n;
        $data = str_replace(array('&amp;', '&lt;', '&gt;'), array('&amp;amp;', '&amp;lt;', '&amp;gt;'), $data);
        $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
        $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
        $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

        // Remove any attribute starting with "on" or xmlns
        $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

        // Remove javascript: and vbscript: protocols
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

        // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

        // Remove namespaced elements (we do not need them)
        $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

        do
        {
            // Remove really unwanted tags
            $old_data = $data;
            $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
        }
        while ($old_data !== $data);

        return $data;
    }
}

if (!function_exists('debug'))
{
    function debug($data = array())
    {
        print '<pre>';
        print_r($data);
        print '</pre>';
    }
}

if (!function_exists('limit_string'))
{
    function limit_string($string, $limit)
    {
        return strlen($string) >$limit ? substr($string, 0, $limit) . '...' : $string;
    }
}

if (!function_exists('affiliate_categories'))
{
    function affiliate_categories($source=false)
    {
    	$CI =& get_instance();
    	$where_arr = array('deleted_at' => NULL);
    	if ($source)
    	{
    		$where_arr['category_source'] = $source;
    	}

		return $CI->db->select('*, category_name as store_category_name, category_slug as store_category_slug')
								->where($where_arr)
								->order_by('category_name', 'ASC')
								->get('affiliate_categories')
								->result_array();
    }
}

if (!function_exists('popular_stores'))
{
	function popular_stores($limit=5)
	{
		$CI =& get_instance();
		$CI->load->model(ADMIN_PREFIX . '/stores_model');
		return $CI->stores_model->popular_stores($limit);
	}
}

if (!function_exists('get_featured_stores'))
{
	function get_featured_stores($limit=false, $zipcode_id=false)
	{
		$CI =& get_instance();

		$where_arr = array('s.is_featured' => 1,
						's.deleted_at' => NULL,
						'cpn.deleted_at' => NULL,
						'cpn.status' => COUPON_STATUS_ACTIVE);
		if ($zipcode_id)
		{
			$where_arr['s.store_zipcode_id'] = $zipcode_id;
		}

		$featured_stores = $CI->db->select('s.*, cpn.id as coupon_id')
								->where($where_arr)
								->join('coupons as cpn', 's.id=cpn.coupon_store_id');

		if ($limit)
		{
			$featured_stores = $featured_stores->limit($limit);
		}

		return $featured_stores->group_by('s.id')->get('stores as s')->result_array();
	}
}

if (!function_exists('get_nearby_zipcodes'))
{
	function get_nearby_zipcodes($zipcode_id, $distance=false)
	{
		$CI =& get_instance();
		$zipcode_detail = $CI->db->where(array('id' => $zipcode_id))->get('zipcodes')->row_array();

		$locations = array();
		if ($zipcode_detail)
		{
			$sql = "SELECT *, ( 3959 * acos( cos( radians(" . $zipcode_detail['latitude'] . ") ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(" . $zipcode_detail['longitude'] . ") ) + sin( radians(" . $zipcode_detail['latitude'] . ") ) * sin( radians( latitude ) ) ) ) AS distance FROM zipcodes ";
			if ($distance)
			{
				$sql .= "HAVING distance < $distance ORDER BY distance";
			}

			$locations = $CI->db->query($sql)->result_array();
		}

		return $locations;
	}
}

/*
	Method will return user's current location data stored in cookie.
	Expected result = array('lat' => 123.45, 'long' => 123.45, 'zipcode' => 123, 'zipcode_id' => 123)
	
	The method will return data for NEW YORK CITY IF IN CASE NO LOCATION IS FETCHED FROM COOKIE.
*/
if (!function_exists('get_user_location_data'))
{
	function get_user_location_data()
	{
		// NEW YORK BY DEFAULT
		$zip_dets = get_zipcode_by_name(NY_ZIPCODE);
		$location_arr = array('lat' => NY_LAT,
							'long' => NY_LONG,
							'zipcode' => NY_ZIPCODE);
		$location_arr['zipcode_id'] =  $zip_dets['id'];
		
		$cookie_data = json_decode(get_cookie('user_current_location'));
		if($cookie_data)
		{
			$zip_dets = get_zipcode_by_name($cookie_data->zipcode);
			if ($zip_dets)
			{
				$location_arr = array('lat' => $zip_dets['latitude'],
									'long' => $zip_dets['longitude'],
									'zipcode' => $zip_dets['zipcode'],
									'zipcode_id' => $zip_dets['id']);
			}
		}

		return $location_arr;
	}
}