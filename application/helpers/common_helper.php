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
		$setting = $CI->db->select('setting_value')
								->where(array('setting_key' => $settings))
								->get('settings')
								->row_array();
								
		return $setting ? unserialize($setting['setting_value']) : '';
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

if (!function_exists('popular_stores'))
{
    function popular_stores($limit=5)
    {
    	$CI =& get_instance();
        $CI->load->model(ADMIN_PREFIX . '/stores_model');
		return $CI->stores_model->popular_stores($limit);
    }
}