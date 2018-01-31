<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/cron
	 *	- or -
	 * 		http://example.com/index.php/cron/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/cron/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function expire_old_coupons()
	{
		$current_date = date('Y-m-d H:i:s');

 		$previous_date = date('Y-m-d', (strtotime('-1 day', strtotime($current_date))));
 		$between_date_strt = $previous_date . " 00:00:00";
 		$between_date_end = $previous_date . " 23:59:59";

 		$this->db->where(array('status !=' => COUPON_STATUS_EXPIRED ,
 							'coupon_end_date >=' => $between_date_strt ,
 							'coupon_end_date <=' => $between_date_end));
 		
 		$this->db->update('coupons', array('status' => COUPON_STATUS_EXPIRED,
 											'updated_at' => $current_date));
 		return $this->db->affected_rows();
	}

	public function sync_ebay_categories()
	{
		$apicall = "http://open.api.ebay.com/Shopping?callname=GetCategoryInfo&appid=raghusin-ebaycurv-PRD-59f29112f-6ad6655b&version=967&siteid=0&CategoryID=-1&IncludeSelector=ChildCategories";
		$resp = simplexml_load_file($apicall);
		$json = json_encode($resp);

		$api_categories = json_decode($json, TRUE);
		if ($api_categories['Ack'] == "Success")
		{
    		unset($api_categories['CategoryArray']['Category'][0]);

    		$insert_arr = array();
    		$api_categories = $api_categories['CategoryArray']['Category'];
    		foreach($api_categories as $keyAC => $valueAC) 
    		{
    			$category_exist = $this->db->select('category_uid')
									->where(array('deleted_at' => NULL,
												'category_source' => CATEGORY_SRC_EBAY,
												'category_uid' => $valueAC['CategoryID']))
									->get('affiliate_categories')
									->row_array();

				if (sizeof($category_exist) < 1)
				{
					$insert_arr[] = array("category_name" => $valueAC['CategoryName'],
										"category_uid" => $valueAC['CategoryID'],
										"category_source" => CATEGORY_SRC_EBAY,
										"created_at" => date('Y-m-d H:i:s'));
				}
    		}

    		if (sizeof($insert_arr) > 0)
    		{
				$this->db->insert_batch('affiliate_categories', $insert_arr);
				echo "Sync Ebay Categories: " . $this->db->affected_rows() . " new categories added.";die();
    		}
    		else
    		{
    			echo "Sync Ebay Categories: No new category added.";
    		}
		}
		else
		{
			echo "Sync Ebay Categories: Error while synching.";die();
		}
	}
}
