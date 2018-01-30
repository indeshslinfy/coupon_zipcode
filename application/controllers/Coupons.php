<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting('ERROR');

require_once(APPPATH . 'libraries' . DS . 'dompdf' . DS . 'autoload.inc.php');
use Dompdf\Dompdf;

class Coupons extends CI_Controller {
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

	public function list_categories()
	{
		$data['title'] = 'Categories';

		$this->load->model(ADMIN_PREFIX . '/stores_category_model');
		$all_categories = $this->stores_category_model->all_records();

		$data['all_categories'] = array();
		foreach ($all_categories as $keyAC => $valueAC)
		{
			$alpha_key = strtoupper($valueAC['store_category_name'][0]);
			$data['all_categories'][strtoupper($valueAC['store_category_name'][0])][] = $valueAC;
		}

		$data['popular_coupons'] = $this->coupons_model->popular_coupons();

		$this->load->template('categories', $data);
	}

	public function list_deals()
	{
		$data['title'] = 'Deals';
		$total_coupons_fetched = 0;

		$this->load->model(ADMIN_PREFIX . '/stores_category_model');
		$data['all_categories'] = $this->stores_category_model->all_records();

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
			$_GET['store_zipcode'] = '';
		}
		else
		{
			$_GET['store_zipcode'] = '';
		}

		if (!array_key_exists('src', $_GET))
		{
			$_GET['src'] = 'local';
		}

		if (!array_key_exists('cat', $_GET))
		{
			$_GET['cat'] = array();
		}

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
						$deals = $this->fetch_deals('category', $valueCAT, array('offset' => 0, 'limit' => 5));
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
		else
		{
			$this->load->model(ADMIN_PREFIX . '/stores_model');
			$data['coupons']['local'] = $this->stores_model->get_local_coupons($_GET);
			$total_coupons_fetched = sizeof($data['coupons']['local']);
		}

		$data['total_coupons_fetched'] = $total_coupons_fetched;
		$this->load->template('category_deals', $data);
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
				// $dompdf->stream(); // download
				$dompdf->stream($coupon_details['coupon_title'], array("Attachment" => false)); // view in browser
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
			echo json_encode($review);die();
		}

		echo json_encode(array("status" => 0, "message" => "Something went wrong. Please try again."));die();
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