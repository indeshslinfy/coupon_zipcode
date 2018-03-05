<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Menus_model extends CI_model
{
	function __construct()
	{
		parent::__construct();
	}

	public function unselected_categories($except=false)
	{
		$cats = $this->db->where(array('deleted_at' => NULL));
			if ($except && sizeof($except) > 0)
			{
				$cats = $cats->where_not_in('id', $except);
			}
		$cats = $cats->order_by('store_category_name', 'ASC')
				->get('stores_category')
				->result_array();

		return $cats;
	}
}