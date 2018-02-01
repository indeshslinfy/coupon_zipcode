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
		$store_details = $this->db->select('zip.zipcode as store_zipcode, s.*')
								->where(array('s.deleted_at' => NULL, 's.id' => $store_id))
								->join('zipcodes as zip', 'zip.id = s.store_zipcode_id', 'left')
								->get('stores as s')
								->row_array();

		if ($store_details)
		{
			$store_details['address'] = $this->db->where(array('id' => $store_details['store_address_id']))
												->get('address')
												->row_array();
		}

		return $store_details;
	}

	public function store_save($data, $id=false)
	{
		try
		{
			if ($data['basic']['store_zipcode_id'] != '')
			{
				$zipcode = save_zipcode($data['basic']['store_zipcode_id']);
				$data['basic']['store_zipcode_id'] = $zipcode['zipcode']['id'];
			}

			if ($id)
			{
				// UPDATE ADDRESS
				$data['address']['updated_at'] = date('Y-m-d H:i:s');
				$store_address_id = $this->db->select('store_address_id')->where(array('id' => $id))->get('stores')->row_array();
				$update_address = $this->db->where(array('id' => $store_address_id['store_address_id']))->update('address', $data['address']);
				
				// SAVE BASIC DETAILS
				$data['basic']['updated_at'] = date('Y-m-d H:i:s');
				$this->db->where(array('id' => $id))->update('stores', $data['basic']);
			}
			else
			{
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

		$file_name = time() . "_" .str_replace(array(" ", "(", ")"), "_", $data['name'][$index]);
		$dest = DS . $folder_name . DS . $file_name;
		$file_temp_name = $data['tmp_name'][$index];

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
		$select_str = 'c.id, c.coupon_title, c.coupon_description, s.store_name, store_atch.store_id, store_atch.attachment_path as store_image';
		$where_arr = array('c.coupon_publish' => 1,
							'c.deleted_at' => NULL,
							's.status' => STORE_STATUS_ACTIVE,
							's.deleted_at' => NULL);

		if (array_key_exists("cat", $filters))
		{
			$select_str .= ', store_cat.id as store_cat_id, store_cat.store_category_name';
		}

		$records = $this->db->select($select_str)->where($where_arr);

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

		$records = $records->join('stores as s', 's.id = c.coupon_store_id')
						->join('(SELECT atch.store_id, atch.attachment_path FROM stores_attachment as atch WHERE atch.attachment_type = ' . STORE_ATCH_IMAGE . ' AND atch.deleted_at IS NULL ORDER BY atch.created_at DESC) as store_atch', 's.id = store_atch.store_id', 'left');

		if (array_key_exists("cat", $filters))
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
					
					break;
				
				default:
					# code...
					break;
			}

		}

		// if (isset($filters['limit']))
		// {
		// 	$records = $records->limit($filters['limit']);
		// }
		
		$records = $records->group_by('c.id');
		return $records->get('coupons as c')->result_array();
	}

	public function popular_stores($limit)
	{
		return $this->db->select('stores.id, stores.store_name, stores.store_rating, img.attachment_path as store_image, cpn.id as coupon_id')
					->from('stores')
					->order_by("store_rating", "DESC")
					->limit($limit)
					->join('stores_attachment as img', 'stores.id=img.store_id')
					->join('coupons as cpn', 'stores.id=cpn.coupon_store_id')
					->where(array('img.attachment_type' => STORE_ATCH_IMAGE))
					->get()
					->result_array();
	}
}