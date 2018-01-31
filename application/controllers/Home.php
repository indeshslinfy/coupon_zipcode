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
		// (array)json_decode($this->input->cookie('user_current_location'));

		$cookie_expiry_time = '86400';
		$geolocation = $this->input->get('lat') . ',' . $this->input->get('long');
		$request = 'http://maps.googleapis.com/maps/api/geocode/json?latlng=' . $geolocation . '&sensor=false'; 
		$file_contents = file_get_contents($request);
		$json_decode = json_decode($file_contents);
		
		if (sizeof($json_decode->results) > 0)
		{
			$user_current_location['lat'] = $this->input->get('lat');
			$user_current_location['long'] = $this->input->get('long');
			$user_current_location['country'] = @$json_decode->results[0]->address_components[6]->long_name;
			$user_current_location['state'] = @$json_decode->results[0]->address_components[5]->long_name;
			$user_current_location['city'] = @$json_decode->results[0]->address_components[4]->long_name;
			$user_current_location['zipcode'] = @$json_decode->results[0]->address_components[7]->long_name;

			$this->input->set_cookie('user_current_location', json_encode($user_current_location), $cookie_expiry_time);
			echo json_encode(array("status" => 1, "data" => $user_current_location)); die;
		}
		else
		{
			echo json_encode(array("status" => 0, "message" => "Error occured while getting location.")); die;
		}
	}
}