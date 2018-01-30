<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class settings_model extends CI_model
{
	function __construct()
	{
		parent::__construct();
	}
	
	/*
	* get_settings method -  fetch settings 
	* @params string|array $key
	* @return array
	*/
	function get_settings($settings=null)
	{
		$select_str = 'setting_key, setting_value';
		if(!$settings)
		{
			return $this->db->select($select_str)
						->get('settings')
						->result_array();
		}
		else if(is_array($settings) && sizeof($settings) > 0)
		{
			return $this->db->select($select_str)
							->where_in('setting_key', $settings)
							->get('settings')
							->result_array();
		}
		else if($settings != '')
		{
			$setting = $this->db->select($select_str)
							->where(array('setting_key' => $settings))
							->get('settings')
							->row_array();
							
			return $setting ? unserialize($setting['setting_value']) : '';
		}
	}
	
	/*
	* set_settings method -  Update settings
	* @params array $settings 
	* @return int $count - no. of records updated
	*/
	function save_settings($settings = array())
	{
		if(sizeof($settings) > 0)
		{
			foreach($settings as $keyS => $valueS)
			{
				$key_exist = $this->db->select('id')
							->get_where('settings', array('setting_key' => $keyS))
							->row_array();
				if ($key_exist)
				{
					$this->db->set('setting_value', serialize($valueS))->where('setting_key', $keyS)
																		->update('settings');
				}
				else
				{
					$this->db->insert('settings', array("setting_key" => $keyS, "setting_value" => serialize($valueS)));
				}
			}

			return $count;						
		}

		return false;
	}
}