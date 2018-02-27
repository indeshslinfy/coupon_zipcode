<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class stores_model extends CI_model
{
	function __construct()
	{
		parent::__construct();
	}

	public function all_records()
	{
		return $this->db->where(array('deleted_at' => NULL, 'status' => 1))
						->get('stores')
						->result_array();
	}

	public function store_edit($store_id)
	{
		$store_details = $this->db->select('zip.zipcode as store_zipcode, zip.zipcode as store_zipcode, s.*')
								->where(array('s.deleted_at' => NULL, 's.id' => $store_id))
								->join('zipcodes as zip', 'zip.id = s.store_zipcode_id', 'left')
								->get('stores as s')
								->row_array();

		if ($store_details)
		{
			$store_details['address'] = $this->db->where(array('id' => $store_details['store_address_id']))
												->get('address')
												->row_array();

			$store_details['schedule'] = $this->db->where(array('store_id' => $store_id))
												->get('stores_timetable')
												->row_array();												
		}

		return $store_details;
	}

	public function store_save($data, $id=false)
	{
		try
		{
			$allowed_extensions = array('jpg', 'jpeg', 'png');
			if ($id)
			{
				$previous_zipcode_id = $data['basic']['previous_zipcode_id'];
				unset($data['basic']['previous_zipcode_id']);

				if ($previous_zipcode_id != $data['basic']['store_zipcode_id']) 
				{
					$coupons['updated_at'] = date('Y-m-d H:i:s');
					$coupons['coupon_zipcode_id'] = $data['basic']['store_zipcode_id'];
					$this->db->where(array('coupon_store_id' => $id))->update('coupons', $coupons);
				}
				// SAVE FEATURED IMAGE
				if (!$data['basic']['featured_image']['error'])
				{
					if (in_array(strtolower(pathinfo($data['basic']['featured_image']['name'], PATHINFO_EXTENSION)), $allowed_extensions))
					{
						$uploaded_path = $this->upload_attachment($data['basic']['featured_image'], false, 'featured_image');
						if ($uploaded_path)
						{
							$data['basic']['store_featured_image'] = $uploaded_path;
						}
					}
				}

				unset($data['basic']['featured_image']);

				// UPDATE ADDRESS
				$data['address']['updated_at'] = date('Y-m-d H:i:s');
				$store_address_id = $this->db->select('store_address_id')->where(array('id' => $id))->get('stores')->row_array();
				$update_address = $this->db->where(array('id' => $store_address_id['store_address_id']))->update('address', $data['address']);
				
				// SAVE BASIC DETAILS
				$data['basic']['updated_at'] = date('Y-m-d H:i:s');
				$this->db->where(array('id' => $id))->update('stores', $data['basic']);

				// UPDATE SCHEDULE DETAILS
				$data['schedule']['updated_at'] = date('Y-m-d H:i:s');
				$this->db->where(array('store_id' => $id))->update('stores_timetable', $data['schedule']);
			}
			else
			{
				// SAVE FEATURED IMAGE
				$data['basic']['store_featured_image'] = '\assets/img/local-coupon-no-image.jpg';
				if (!$data['basic']['featured_image']['error'])
				{
					if (in_array(pathinfo(strtolower($data['basic']['featured_image']['name'], PATHINFO_EXTENSION)), $allowed_extensions))
					{
						$uploaded_path = $this->upload_attachment($data, false, 'featured_image');
						if ($uploaded_path)
						{
							$data['basic']['store_featured_image'] = $uploaded_path;
						}
					}
				}

				// SAVE ADDRESS
				$data['address']['created_at'] = date('Y-m-d H:i:s');
				$save_address = $this->db->insert('address', $data['address']);
				$data['basic']['store_address_id'] = $this->db->insert_id();

				$data['basic']['created_at'] = date('Y-m-d H:i:s');
				$this->db->insert('stores', $data['basic']);
				$id = $this->db->insert_id();
				if (!$id)
				{
					return false;
				}

				// SAVE SCHEDULE DETAILS
				$data['schedule']['store_id'] = $id;
				$data['schedule']['created_at'] = date('Y-m-d H:i:s');
				$this->db->insert('stores_timetable', $data['schedule']);
			}
			
			// SAVE VIDEO
			if (sizeof($data['attachments']['video']) > 0)
			{
				$store_video = $this->db->where(array('store_id' => $id, 'deleted_at' => NULL))->get('stores_attachment')->row_array();
				if ($store_video)
				{
					// update existing
					$this->db->where(array('store_id' => $id, 'attachment_type' => STORE_ATCH_VIDEO))->update('stores_attachment', array('attachment_path' => $data['attachments']['video'][0], 'updated_at' => date('Y-m-d H:i:s')));
				}
				else
				{
					// save new
					$this->db->insert('stores_attachment', array('attachment_name' => 'Store_Video_' . $id,
																'attachment_path' => $data['attachments']['video'][0],
																'attachment_type' => STORE_ATCH_VIDEO,
																'store_id' => $id,
																'is_external' => 1,
																'created_at' => date('Y-m-d H:i:s')));
				}
			}

			// SAVE IMAGE & MENU
			$attachment_insert_arr = array();
			foreach ($data['attachments'] as $keyD => $valueD)
			{
				switch ($keyD)
				{
					case 'image':
						for ($i=0; $i <sizeof($valueD['tmp_name']) ; $i++)
						{
							if (!$valueD['error'][$i])
							{
								$uploaded_path = $this->upload_attachment($valueD, $i, $keyD);
								if ($uploaded_path)
								{
									$attachment_insert_arr[] = array('attachment_name' => $valueD['name'][$i],
																	'attachment_path' => $uploaded_path,
																	'attachment_type' => STORE_ATCH_IMAGE,
																	'store_id' => $id,
																	'created_at' => date('Y-m-d H:i:s'));
								}
							}
						}
						break;

					case 'menu':
						for ($i=0; $i <sizeof($valueD['tmp_name']) ; $i++)
						{
							if (!$valueD['error'][$i])
							{
								$uploaded_path = $this->upload_attachment($valueD, $i, $keyD);
								if ($uploaded_path)
								{
									$attachment_insert_arr[] = array('attachment_name' => $valueD['name'][$i],
																	'attachment_path' => $uploaded_path,
																	'attachment_type' => STORE_ATCH_MENU,
																	'store_id' => $id,
																	'created_at' => date('Y-m-d H:i:s'));
								}
							}
						}
						break;
					
					default:
						# code...
						break;
				}
			}

			if (sizeof($attachment_insert_arr) > 0)
			{
				$this->db->insert_batch('stores_attachment', $attachment_insert_arr);
			}

			return $id;
		}
		catch (Exception $e)
		{
			return false;
		}
	}

	public function store_delete($id, $update_arr)
	{
		return $this->db->where(array('id' => $id))->update('stores', $update_arr);
	}

	public function upload_attachment($data, $index, $type)
	{
		switch ($type)
		{
			case 'featured_image':
				$folder_name =  'uploads' . DS . 'store_featured_images';
				break;

			case 'image':
				$folder_name = STORE_ATCH_IMAGE_FOLDER;
				break;

			case 'menu':
				$folder_name = STORE_ATCH_MENU_FOLDER;
				break;
			
			default:
				$folder_name = '';
				break;
		}

		if ($index)
		{
			$file_name = time() . "_" .str_replace(array(" ", "(", ")"), "_", $data['name'][$index]);
			$dest = DS . $folder_name . DS . $file_name;
			$file_temp_name = $data['tmp_name'][$index];
		}
		else
		{
			$file_name = time() . "_" .str_replace(array(" ", "(", ")"), "_", $data['name']);
			$dest = DS . $folder_name . DS . $file_name;
			$file_temp_name = $data['tmp_name'];
		}

		$rp = realpath(getcwd());
		if (!is_dir($rp . DS . $folder_name))
		{
			mkdir($rp . DS. $folder_name, 0777, true);
		}

		if(move_uploaded_file($file_temp_name, $rp . $dest))
		{
			return $dest;
		}

		return false;
	}

	public function save_zipcode($zipcode)
	{
		$zipcode_exist = $this->db->select('id')
								->get_where('zipcodes', array('zipcode' => $zipcode))
								->row_array();
		if ($zipcode_exist)
		{
			$this->db->where(array('id' => $zipcode_exist['id']))->update('zipcodes', array('zipcode' => $zipcode));
			return $zipcode_exist['id'];
		}

		$insert_arr = array("zipcode" => $zipcode, "created_at" => date('Y-m-d H:i:s'));
		$save_address = $this->db->insert('zipcodes', $insert_arr);
		return $this->db->insert_id();
	}

	public function get_local_coupons($filters=false)
	{
		// print_r($filters); die;
		$select_str = 'c.id, c.coupon_title, c.coupon_description, c.coupon_zipcode_id, s.store_name, s.id as store_id, s.store_featured_image as store_image';
		$where_arr = array('c.coupon_publish' => 1,
							'c.deleted_at' => NULL,
							's.status' => STORE_STATUS_ACTIVE,
							's.deleted_at' => NULL);

		if (array_key_exists('zipcode_id', $filters))
		{
			$where_arr['c.coupon_zipcode_id'] = $filters['zipcode_id'];
		}

		if (array_key_exists("cat", $filters) && sizeof($filters['cat']) > 0)
		{
			$select_str .= ', store_cat.id as store_cat_id, store_cat.store_category_name';
		}

		if (isset($filters['sort_distance']) && intval($filters['sort_distance']) > 0)
		{
			$sort_distance = intval($filters['sort_distance']);
		}
		else
		{
			$sort_distance = get_settings('zipcode_search_radius');
		}

		$store_zipcode = 0;
		if (isset($filters['store_zipcode']) && intval($filters['store_zipcode']) > 0)
		{
			$store_zipcode = $filters['store_zipcode'];
		}

		$near_zips = array();
		// $nearby_stores = array();

		if ($store_zipcode > 0)
		{
			$nearby_zipcodes = get_nearby_zipcodes($store_zipcode, $sort_distance);
			foreach ($nearby_zipcodes as $keyNZ => $valueNZ)
			{
				$near_zips[] = $valueNZ['id'];
				// $zipcode_stores = get_zipcode_stores($valueNZ['id']);
				// foreach ($zipcode_stores as $keyZS => $valueZS)
				// {
				// 	$nearby_stores[] = $valueZS['id'];
				// }
			}
		}
		
		$records = $this->db->select($select_str)->where($where_arr);
		// if (sizeof($nearby_stores) > 0)
		// {
		// 	$records = $records->where_in('s.id', $nearby_stores);
		// }

		if (sizeof($near_zips) > 0)
		{
			$records = $records->where_in('c.coupon_zipcode_id', $near_zips);
		}

		if (array_key_exists('dt', $filters))
		{
			$crnt_dt = date('Y-m-d');
			switch ($filters['dt'])
			{
				case 'today':
					$records = $records->where('DATE(c.created_at)', $crnt_dt);
					break;

				case 'week':
					$week_start = date("Y-m-d", strtotime("last monday"));
					$records = $records->where(array('DATE(c.created_at) >=' => $week_start, 'DATE(c.created_at) <=' =>  $crnt_dt));
					break;
				
				default:
					# code...
					break;
			}
		}

		if (array_key_exists('rt', $filters))
		{
			switch ($filters['rt'])
			{
				case '5':
					$min_rating = 5;
					$max_rating = 5;
					break;

				case '4':
					$min_rating = 4;
					$max_rating = 4.5;
					break;

				case '3':
					$min_rating = 3;
					$max_rating = 3.5;
					break;
				
				default:
					$min_rating = 0;
					$max_rating = 5;
					break;
			}

			$records = $records->where('s.store_rating >=', $min_rating)->where('s.store_rating <=', $max_rating);
		}

		$records = $records->join('stores as s', 's.id = c.coupon_store_id');

		if (array_key_exists("cat", $filters) && sizeof($filters['cat']) > 0)
		{
			// $filters['cat'] should contain slugs of categories
			$cats = implode(",", $filters['cat']);
			$cats = str_replace(',', '","', $cats);
			$records = $records->join('(SELECT scat.id, scat.store_category_name FROM stores_category as scat WHERE scat.store_category_slug IN ("' . $cats . '") AND scat.deleted_at IS NULL AND scat.status = 1) as store_cat', 's.store_category_id = store_cat.id');
		}

		if (array_key_exists('city', $filters) && $filters['city'] != '')
		{
			// $records = $records->join('(SELECT scat.id, scat.store_category_name FROM address as scat WHERE scat.store_category_slug IN ("' . $cats . '") AND scat.deleted_at IS NULL AND scat.status = 1) as store_cat', 's.store_category_id = store_cat.id');
			// $records = $records->join('address as adr', 'adr.id = s.store_address_id');
		}

		if (isset($filters['sort_order']))
		{
			switch ($filters['sort_order'])
			{
				case 'az':
					$records = $records->order_by('s.store_name', 'ASC');
					break;

				case 'za':
					$records = $records->order_by('s.store_name', 'DESC');
					break;

				case 'distance':
					# code...
					break;
				
				default:
					# code...
					break;
			}
		}

		$records = $records->order_by('s.store_name', 'DESC');

		if (!isset($filters['paginate']['limit']))
		{
			$filters['paginate']['limit'] = 20;
		}
		
		if (!isset($filters['paginate']['offset']))
		{
			$filters['paginate']['offset'] = 0;
		}

		return $records->limit($filters['paginate']['limit'], $filters['paginate']['offset'])
							->group_by('c.id')
							->get('coupons as c')
							->result_array();
	}

	public function popular_stores($limit)
	{
		return $this->db->select('stores.id, stores.store_name, stores.store_rating, stores.store_featured_image, cpn.id as coupon_id')
					->order_by("store_rating", "DESC")
					->limit($limit)
					->join('coupons as cpn', 'stores.id=cpn.coupon_store_id')
					->where(array('cpn.deleted_at' => NULL, 'cpn.status' => COUPON_STATUS_ACTIVE))
					->group_by('stores.id')
					->get('stores')
					->result_array();
	}
}