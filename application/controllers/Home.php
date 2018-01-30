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
}