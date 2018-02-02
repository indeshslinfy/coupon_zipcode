<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->load->library('Excel');
         $this->load->helper('cookie');
         
    }
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/home
	 *	- or -
	 * 		http://example.com/index.php/home/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->model(ADMIN_PREFIX . '/stores_model');

		$data['all_local_coupons'] = $this->stores_model->get_local_coupons(array("sort_by" => "c.created_at", "sort_order" => "DESC", "limit" => 3));
		$data['coupons_by_location'] = $this->fetch_deals('location', 'new-york', array('offset' => 0, 'limit' => 8));
		// $data['coupons_by_location'] = $this->fetch_deals('latlong', array('lat' => '30.20', 'long' => '-70.02'), array('offset' => 0, 'limit' => 8));
		
		$this->load->template('index', $data);
	}

	public function get_cities()
	{
		echo json_encode(array("cities" => get_cities($this->input->post('state_id'))));die();
	}

	public function get_zipcode_stores()
	{
		$stores = get_zipcode_stores($this->input->post('zipcode_id'));
		if (sizeof($stores) > 0)
		{
			echo json_encode(array("status" => 1, "stores" => $stores));die();
		}

		echo json_encode(array("status" => 0, "message" => "No stores found."));die();
	}

	public function save_new_zipcode()
	{
		$zipcode_details = save_zipcode($this->input->post('zipcode'));
		if (!$zipcode_details['status'])
		{
			echo json_encode(array("status" => $zipcode_details['status'], "message" => "Zipcode already exist. Try new one."));die();
		}

		echo json_encode(array("status" => $zipcode_details['status'], "zipcode" => $zipcode_details['data']));die();
	}

	public function fetch_deals($type, $type_val, $paginate)
	{
		$groupon_details = $this->settings_model->get_settings('groupon');
		$groupon_details['wid'] = urlencode(base_url());

		switch ($type)
		{
			case 'location':
				return @json_decode(utf8_encode(file_get_contents('https://partner-api.groupon.com/deals.json?tsToken=US_AFF_0_' . $groupon_details['groupon_id'] . '_' . $groupon_details['media_id'] . '_0&division_id=' . $type_val . '&wid=' . $groupon_details['wid'] . 'm&offset=' . $paginate['offset'] . '&limit=' . $paginate['limit'])));
				break;

			case 'latlong':
				return @json_decode(utf8_encode(file_get_contents('https://partner-api.groupon.com/deals.json?tsToken=US_AFF_0_' . $groupon_details['groupon_id'] . '_' . $groupon_details['media_id'] . '_0&lat=' . $type_val['lat'] . '&lng=' . $type_val['long'] . '&wid=' . $groupon_details['wid'] . 'm&offset=' . $paginate['offset'] . '&limit=' . $paginate['limit'])));
				break;
			
			case 'category':
				return @json_decode(utf8_encode(file_get_contents('https://partner-api.groupon.com/deals.json?tsToken=US_AFF_0_' . $groupon_details['groupon_id'] . '_' . $groupon_details['media_id'] . '_0&filters=category:' . $type_val . '&wid=' . $groupon_details['wid'] . 'm&offset=' . $paginate['offset'] . '&limit=' . $paginate['limit'])));
				break;
			
			default:
				return false;
				break;
		}
	}

	public function get_geo_location()
	{
		$cookie_expiry_time = '86400';
		$geolocation = $this->input->get('lat') . ',' . $this->input->get('long');
		$request = 'http://maps.googleapis.com/maps/api/geocode/json?latlng=' . $geolocation . '&sensor=false'; 
		$file_contents = file_get_contents($request);
		$json_decode = json_decode($file_contents);

		if (sizeof($json_decode->results) > 0)
		{
			$user_current_location['lat'] = $this->input->get('lat');
			$user_current_location['long'] = $this->input->get('long');

			foreach ($json_decode->results[0]->address_components as $keyAC => $valueAC)
			{
				switch ($valueAC->types[0])
				{
					case 'country':
						$user_current_location['country'] = $valueAC->long_name;
						break;

					case 'locality':
					case 'administrative_area_level_2':
						$user_current_location['city'] = $valueAC->long_name;
						break;

					case 'administrative_area_level_1':
						$user_current_location['state'] = $valueAC->long_name;
						break;

					case 'postal_code':
						$user_current_location['zipcode'] = $valueAC->long_name;
						break;
					
					default:
						# code...
						break;
				}
			}

			$this->input->set_cookie('user_current_location', json_encode($user_current_location), $cookie_expiry_time);
			echo json_encode(array("status" => 1, "data" => $user_current_location)); die;
		}
		else
		{
			echo json_encode(array("status" => 0, "message" => "Error occured while getting location.")); die;
		}
	}

	public function search_zipcode()
	{
		$zipcode_details = $this->db->select('countries.country_name as country,
									states.state_name as state,
									cities.city_name as city,
									zipcodes.zipcode,
									zipcodes.latitude as lat,
									zipcodes.longitude as long')
						->from('zipcodes')
						->where(array('zipcode' => $this->input->get('zipcode')))
						->join('cities', 'zipcodes.place_id=cities.id')
						->join('states', 'cities.state_id=states.id')
						->join('countries', 'countries.id=states.country_id')
						->get()
						->row_array();

		if (sizeof($zipcode_details) > 0)
		{
			$this->input->set_cookie('user_current_location', json_encode($zipcode_details), '86400');
			echo json_encode(array("status" => 1, "data" => $zipcode_details)); die;
		}
		else
		{
			echo json_encode(array("status" => 0, "message" => "Error occured while getting location.")); die;
		}
	}
}