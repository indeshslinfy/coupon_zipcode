<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->load->library('Excel');
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
		// print_r(get_user_default_zipcode()); die;
		$location_arr = get_user_location_data();

		// LOCAL COUPONS
		$this->load->model(ADMIN_PREFIX . '/stores_model');
		$data['all_local_coupons'] = $this->stores_model->get_local_coupons(array('zipcode_id' => $location_arr['zipcode_id'], "sort_by" => "c.created_at", "sort_order" => "DESC", "paginate" => array("limit" => 10, "offset" => 0)));
		if (sizeof($data['all_local_coupons']) == 0) 
		{
			$data['all_local_coupons'] = $this->stores_model->get_local_coupons(array("sort_by" => "c.created_at", "sort_order" => "DESC", "paginate" => array("limit" => 10, "offset" => 0)));
		}

		// FEATURED STORES
		$data['featured_stores'] = get_featured_stores(4, $location_arr['zipcode_id']);
		if (sizeof($data['featured_stores']) == 0) 
		{
			$data['featured_stores'] = get_featured_stores(4);
		}

		$this->load->library('affiliates');

		// RESTAURANT.COM
		$rdc_keywords = array('Restaurant', 'Hotel', 'Spa');
		$data['restaurant_dot_com_keyword'] = $rdc_keywords[rand(1, sizeof($rdc_keywords)-1)];
		$data['coupons']['restaurant_dot_com'] = $this->affiliates->get_deals('restaurant_dot_com',
																	array('keyword' => $data['restaurant_dot_com_keyword'],
																		'paginate' => array('page' => 1, 'limit' => 4)));

		// GROUPON
		$_GET['type'] = 'ip';
		$_GET['channel_id'] = 'hotels';
		$data['coupons']['groupon'] = $this->affiliates->get_deals('groupon',
																	array('type' => 'ip',
																		'channel_id' => 'hotels',
																		'paginate' => array('offset' => 0, 'limit' => 4)));

		// $data['coupons']['groupon'] = $this->affiliates->get_deals('groupon',
		// 															array('type' => 'latlong',
		// 																'zipcode_id' => $location_arr['zipcode_id'],
		// 																'type_val' => array('lat' => $location_arr['lat'], 'long' => $location_arr['long']),
		// 																'paginate' => array('offset' => 0, 'limit' => 4)));

		// EBAY 1
		$data['coupons']['ebay']['items'] = array('via_keyword' => array(), 'trending' => array());

		// $ebay_keywords = array('iPhone X', 'Google Pixel 2 XL', 'OnePlus 5T');
		// $keyword = $ebay_keywords[rand(1, sizeof($ebay_keywords)-1)];
		// $ebay_deals = $this->affiliates->get_deals('ebay', array('type' => 'zipcode',
		// 														'type_val' => NY_ZIPCODE,
		// 														'currency' => 'USD',
		// 														'paginate' => array('offset' => 0, 'limit' => 4),
		// 														'keyword' => $keyword));
		// $data['coupons']['ebay']['items']['via_keyword'] = $ebay_deals['ack'] == 'Success' ? $ebay_deals['searchResult']['item'] : array();
		// $data['coupons']['ebay']['keyword'] = $keyword;

		// EBAY 2
		$ebay_keywords = array('gifts for her', 'gifts', 'love');
		$valentine_keyword = $ebay_keywords[rand(1, sizeof($ebay_keywords)-1)];
		$ebay_deals = $this->affiliates->get_deals('ebay', array('type' => 'zipcode',
																'type_val' => NY_ZIPCODE,
																'currency' => 'USD',
																'paginate' => array('offset' => 0, 'limit' => 10),
																'keyword' => $valentine_keyword));
		$data['coupons']['ebay']['items']['trending'] = $ebay_deals['ack'] == 'Success' ? $ebay_deals['searchResult']['item'] : array();
		$data['coupons']['ebay']['valentine_keyword'] = $valentine_keyword;

		// AMAZON
		$data['coupons']['amazon'] = $this->affiliates->get_deals('amazon', array('keyword' => 'gifts for her', 'type_val' => 'All', 'paginate' => array('limit' => 10, 'page' => 1)));

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

	public function get_geo_location()
	{
		$geolocation = $this->input->get('lat') . ',' . $this->input->get('long');
		$locn_data = array("lat" => $this->input->get('lat'), "long" => $this->input->get('long'));
		
		$request = 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyC1-Jvfh71t0Wi05t8jh2hASRSrjmvaE6Y&latlng=' . $geolocation . '&sensor=false'; 
		$file_contents = file_get_contents($request);

		$json_decode = json_decode($file_contents);
		if (sizeof($json_decode->results) > 0)
		{
			$zipcode_details['lat'] = $locn_data['lat'];
			$zipcode_details['long'] = $locn_data['long'];

			foreach ($json_decode->results[0]->address_components as $keyAC => $valueAC)
			{
				switch ($valueAC->types[0])
				{
					case 'country':
						$zipcode_details['country'] = $valueAC->long_name;
						break;

					case 'locality':
					case 'administrative_area_level_2':
						$zipcode_details['city'] = $valueAC->long_name;
						break;

					case 'administrative_area_level_1':
						$zipcode_details['state'] = $valueAC->long_name;
						break;

					case 'postal_code':
						$zipcode_details['zipcode'] = $valueAC->long_name;
						break;
					
					default:
						# code...
						break;
				}
			}
		}
		else
		{
			$user_logged_in = $this->session->userdata('logged_in');
			if ($user_logged_in)
			{
				$login_data = $this->session->userdata('user_access');
				$zip_dets = get_zipcode_details($login_data['zipcode_id']);
				if ($zip_dets)
				{
					$zipcode_arr = zipcode_data_for_cookie($zip_dets['zipcode']);
				}
				else
				{
					$zipcode_arr = zipcode_data_for_cookie(NY_ZIPCODE);
				}
			}
			else
			{
				$zipcode_details = zipcode_data_for_cookie(NY_ZIPCODE);
			}
		}

		set_location_cookie($zipcode_details);
		echo json_encode(array("status" => 1, "data" => $zipcode_details)); die;
	}

	public function search_zipcode()
	{
		$zipcode_details = zipcode_data_for_cookie($this->input->get('zipcode'));
		set_location_cookie($zipcode_details);

		echo json_encode(array("status" => 1, "data" => $zipcode_details)); die;
	}
}