<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class stores_category_model extends CI_model
{
	function __construct()
	{
		parent::__construct();
	}

	public function all_records()
	{
		return $this->db->where(array('deleted_at' => NULL))
						->order_by('store_category_name', 'ASC')
						->get('stores_category')
						->result_array();
	}

	public function stores_cat_edit($store_category_id)
	{
		return $this->db->where(array('deleted_at' => NULL, 'id' => $store_category_id))
						->get('stores_category')
						->row_array();
	}

	public function stores_cat_update($data, $id=false)
	{
		if ($id)
		{
			$data['updated_at'] = date("Y-m-d H:i:s");
			$this->db->where(array('id' => $id))->update('stores_category', $data);
			return $id;
		}

		$data['created_at'] = date("Y-m-d H:i:s");
		$this->db->insert('stores_category', $data);
		return $this->db->insert_id();
	}

	public function store_cat_slug_exist($slug)
	{
		return $this->db->where(array('store_category_slug' => $slug))
						->get('stores_category')
						->row_array();
	}

	public function store_category_names($cat_ids)
	{
		return $this->db->select('id, store_category_name')
						->where_in('id', $cat_ids)
						->get('stores_category')
						->result_array();
	}

	public function get_store_category_slugs_by_keyword($keyword)
	{
		$cats = $this->db->select('store_category_slug')
						->like('store_category_name', $keyword)
						->or_like('store_category_slug', $keyword)
						->or_like('store_category_keywords', $keyword)
						->or_like('store_category_description', $keyword)
						->get('stores_category')
						->result_array();

		$cat_ids = array();
		foreach ($cats as $keyC => $valueC)
		{
			$cat_ids[] = $valueC['store_category_slug'];
		}

		return $cat_ids;
	}
}