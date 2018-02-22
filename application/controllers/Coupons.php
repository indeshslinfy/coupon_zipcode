<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH . 'libraries' . DS . 'dompdf' . DS . 'autoload.inc.php');
use Dompdf\Dompdf;

class Coupons extends CI_Controller
{
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/coupons
	 *	- or -
	 * 		http://example.com/index.php/coupons/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();
		$this->load->model('/coupons_model');
	}

	public function list_deals()
	{
		$this->load->library('affiliates');

		$data['title'] = 'Deals';
		$total_coupons_fetched = 0;

		$this->load->model(ADMIN_PREFIX . '/stores_category_model');
		$data['all_categories']['local'] = $this->stores_category_model->all_records();
		$data['all_categories']['groupon'] = affiliate_categories(CATEGORY_SRC_GROUPON);
		$data['all_categories']['ebay'] = affiliate_categories(CATEGORY_SRC_EBAY);
		$data['all_categories']['amazon'] = affiliate_categories(CATEGORY_SRC_AMAZON);

		// 'CATEGORY PAGE' SEARCH
		if ($this->uri->segment(1) == 'category')
		{
			$data['title'] = slug_to_readable($this->uri->segment(2));
			$_GET['cat'] = array($this->uri->segment(2));
			$data['category_name'] = $data['title'];
		}

		// 'HEADER' PAGE SEARCH
		if (array_key_exists('cat_name', $_GET) && $_GET['cat_name'] != '')
		{
			$cat_slugs = $this->stores_category_model->get_store_category_slugs_by_keyword($_GET['cat_name']);
			$_GET['cat'] = $cat_slugs;
			unset($_GET['cat_name']);
		}

		if (array_key_exists('city_name', $_GET) && $_GET['city_name'] != '')
		{
			$_GET['city'] = get_cities_ids_by_keyword($_GET['city_name']);
		}
		else
		{
			$_GET['city'] = '';
		}
		
		if (array_key_exists('store_zipcode', $_GET) && $_GET['store_zipcode'] != '')
		{
			$_GET['store_zipcode'] = $_GET['store_zipcode'];
		}
		else
		{
			$_GET['store_zipcode'] = '';
		}

		if (array_key_exists('sort_distance', $_GET) && $_GET['sort_distance'] != '')
		{
			$_GET['sort_distance'] = $_GET['sort_distance'];
		}
		else
		{
			$_GET['sort_distance'] = '';
		}

		if (!array_key_exists('src', $_GET))
		{
			$_GET['src'] = 'local';
		}

		if (!array_key_exists('cat', $_GET))
		{
			$_GET['cat'] = array();
		}

		if (!isset($_GET['paginate']['page']))
		{
			$_GET['paginate']['page'] = 1;
		}

		$_GET['location_arr'] = array('lat' => '40.71',
									'long' => '-73.99',
									'zipcode' => '10002',
									'zipcode_id' => @get_zipcode_by_name('10002'));
		$cookie_data = json_decode(get_cookie('user_current_location'));
		if($cookie_data)
		{
			$zip_dets = get_zipcode_by_name($cookie_data->zipcode);
			if ($zip_dets)
			{
				$_GET['location_arr'] = array('lat' => $zip_dets['latitude'],
											'long' => $zip_dets['longitude'],
											'zipcode' => $zip_dets['zipcode'],
											'zipcode_id' => $zip_dets['id']);
			}
		}

		$pagination_setting = get_settings('deals_pagination');
		$_GET['paginate']['limit'] = $pagination_setting['limit'];
		$_GET['paginate']['offset'] = max(0, ($_GET['paginate']['page'] - 1) * $_GET['paginate']['limit']);

		unset($_GET['search_src']);
		if ($_GET['src'] == 'groupon')
		{
			if (isset($_GET['cat']) && $_GET['cat'] != '')
			{
				if (!is_array($_GET['cat']))
				{
					$_GET['cat'] = (array)$_GET['cat'];
				}

				if (sizeof($_GET['cat']) > 0)
				{
					$groupon_deals = array();
					foreach ($_GET['cat'] as $keyCAT => $valueCAT)
					{
						$_GET['type'] = 'category';
						$_GET['type_val'] = $valueCAT;
						$deals = $this->affiliates->get_deals($_GET['src'], $_GET);
						if (sizeof($deals) > 0)
						{
							$groupon_deals = array_merge($groupon_deals, $deals->deals);
						}
					}

					$data['coupons']['groupon'] = $groupon_deals;
					$total_coupons_fetched = sizeof($data['coupons']['groupon']);
				}
			}
		}
		else if ($_GET['src'] == 'ebay')
		{
			if (isset($_GET['cat']) && $_GET['cat'] != '')
			{
				$_GET['currency'] = 'USD';
				if (!is_array($_GET['cat']))
				{
					$_GET['cat'] = (array)$_GET['cat'];
				}

				$ebay_deals = array();
				if ((sizeof($_GET['cat']) > 0) && (array_key_exists('keyword', $_GET) && $_GET['keyword'] != ''))
				{
					$_GET['type'] = 'advanced';
					$_GET['type_val'] = $_GET['keyword'];

					// ADVANCED SEARCH - both category and keyword
					$deals = $this->affiliates->get_deals($_GET['src'], $_GET);
					if ($deals['ack'] == 'Success')
					{
						$ebay_deals = $deals['searchResult']['item'];
					}
				}
				elseif (sizeof($_GET['cat']) > 0)
				{
					$_GET['type'] = 'category';
					foreach ($_GET['cat'] as $keyCAT => $valueCAT)
					{
						$_GET['type_val'] = $valueCAT;
						$deals = $this->affiliates->get_deals($_GET['src'], $_GET);
						if ($deals['ack'] == 'Success')
						{
							$ebay_deals = array_merge($ebay_deals, $deals['searchResult']['item']);
						}
					}
				}
				elseif (array_key_exists('keyword', $_GET) && $_GET['keyword'] != '')
				{
					$_GET['type'] = 'keyword';
					$_GET['type_val'] = $_GET['keyword'];
					$deals = $this->affiliates->get_deals($_GET['src'], $_GET);
					if ($deals['ack'] == 'Success')
					{
						$ebay_deals = $deals['searchResult']['item'];
					}
				}
				else
				{
					$_GET['type'] = '';
					$_GET['type_val'] = '';
					$deals = $this->affiliates->get_deals($_GET['src'], $_GET);
					if ($deals['ack'] == 'Success')
					{
						$ebay_deals = $deals['searchResult']['item'];
					}
				}
				
				$data['coupons']['ebay'] = $ebay_deals;
				$total_coupons_fetched = sizeof($data['coupons']['ebay']);
			}
		}
		else if ($_GET['src'] == 'amazon')
		{
			$_GET['type'] = 'category';
			$_GET['MinimumPrice'] = $_GET['price_range'][0];
			$_GET['MaximumPrice'] = $_GET['price_range'][1];
			
			$amazon_deals = array();
			if (sizeof($_GET['cat']) > 0)
			{
				foreach ($_GET['cat'] as $keyCAT => $valueCAT)
				{
					$_GET['type_val'] = $valueCAT;
					$deals = $this->affiliates->get_deals($_GET['src'], $_GET);
					if (sizeof($deals) > 0)
					{
						$amazon_deals = array_merge($amazon_deals, $deals);
					}
				}
			}
			else
			{
				$_GET['type_val'] = 'All';
				$deals = $this->affiliates->get_deals($_GET['src'], $_GET);
				if (sizeof($deals) > 0)
				{
					$amazon_deals = array_merge($amazon_deals, $deals);
				}
			}

			$data['coupons']['amazon'] = $amazon_deals;
			$total_coupons_fetched = sizeof($data['coupons']['amazon']);
		}
		else
		{
			$_GET['zipcode_id'] = $_GET['location_arr']['zipcode_id'];
			$this->load->model(ADMIN_PREFIX . '/stores_model');
			$data['coupons']['local'] = $this->stores_model->get_local_coupons($_GET);
			$total_coupons_fetched = sizeof($data['coupons']['local']);
		}

		$data['total_coupons_fetched'] = $total_coupons_fetched;
		if (array_key_exists('is_ajax', $_GET))
		{
			echo json_encode($this->load->view('deals_listing', $data, true));
		}
		else
		{
			$this->load->template('category_deals', $data);
		}
	}

	public function coupon_details()
	{
		if ($this->uri->segment(2))
		{
			$data['coupon_details'] = $this->coupons_model->coupon_details($this->uri->segment(2));
			if (sizeof($data['coupon_details']) == 0)
			{
				redirect('404');
			}

			$data['title'] = $data['coupon_details']['coupon_title'];
			$data['coupon_details']['store_menus'] = $this->coupons_model->store_menus($data['coupon_details']['coupon_store_id']);

			$data['coupon_details']['is_liked'] = 0;
			$data['coupon_details']['is_unliked'] = 0;
			$data['coupon_details']['is_reviewed'] = 0;
			if (user_login_data('id'))
			{
				$user_store = $this->coupons_model->user_store_records(user_login_data('id'), $data['coupon_details']['coupon_store_id']);
				$data['coupon_details']['is_liked'] = $user_store['is_liked'];
				$data['coupon_details']['is_unliked'] = $user_store['is_unliked'];
				$data['coupon_details']['is_reviewed'] = $user_store['is_reviewed'];
			}
			
			$data['coupon_details']['store_reviews'] = $this->coupons_model->store_reviews($data['coupon_details']['coupon_store_id'], 5);
			$data['coupon_details']['store_coupons'] = $this->coupons_model->store_coupons($data['coupon_details']['coupon_store_id'], array("except" => $this->uri->segment(2)));
			$data['coupon_details']['store_timetable'] = $this->coupons_model->store_timetable($data['coupon_details']['coupon_store_id']);

			$this->load->template('coupon_details', $data);
		}
		else
		{
			redirect('404');
		}
	}

	public function like_unlike_store()
	{
		if (user_login_data('id'))
		{
			echo json_encode($this->coupons_model->like_unlike_store(array("status" => $this->input->post('act'), "store_id" => $this->input->post('strid'), "user_id" => user_login_data('id'))));die();
		}

		echo json_encode(array('status' => 2, 'message' => 'Please login to continue.'));die();
	}

	public function coupon_print()
	{
		if ($this->uri->segment(2))
		{
			$coupon_details = $this->coupons_model->coupon_details($this->uri->segment(2));
			if (sizeof($coupon_details) > 0)
			{
				$pdf_view = $this->load->view('templates/print_coupon', $coupon_details, true);

				$dompdf = new DOMPDF();
				$dompdf->loadHtml($pdf_view);
				$dompdf->setPaper('A4');
				$dompdf->render();
				
				$dompdf->stream($coupon_details['coupon_title'], array("Attachment" => false));
				exit(0);
			}
		}

		redirect('404');
	}

	public function submit_store_review()
	{
		if (intval($this->input->post('strid')) > 0)
		{
			$params['rating'] = $this->input->post('rvr_rtng');
			if ($this->input->post('rvr_rtng') < 0.5)
			{
				$params['rating'] = 0.5;
			}
			
			$params['review_text'] = $this->input->post('rvr_txt');
			$params['reviewer_id'] = user_login_data('id');
			$params['reviewer_name'] = $this->input->post('rvr_nm');
			$params['review_type'] = REVIEW_TYPE_STORE;
			$params['receiver_id'] = $this->input->post('strid');

			$review = $this->coupons_model->submit_store_review($params);
			$review['data']['review_date'] = date("F jS, Y", strtotime($review['data']['created_at']));
			
			echo json_encode($review);die;
		}

		echo json_encode(array("status" => 0, "message" => "Something went wrong. Please try again."));die();
	}

	public function list_categories()
	{
		$data['title'] = 'Categories';
		$data['popular_stores'] = popular_stores();

		$this->load->model(ADMIN_PREFIX . '/stores_category_model');
		$all_categories = $this->stores_category_model->all_records();

		$data['all_categories'] = array();
		foreach ($all_categories as $keyAC => $valueAC)
		{
			$alpha_key = strtoupper($valueAC['store_category_name'][0]);
			$data['all_categories'][strtoupper($valueAC['store_category_name'][0])][] = $valueAC;
		}

		$this->load->template('categories', $data);
	}
}