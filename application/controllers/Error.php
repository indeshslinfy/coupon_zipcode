<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error extends CI_Controller {
	function __construct() 
	{
		parent::__construct();
	}

	public function show_404()
	{
		$this->load->template('errors/html/error_404', array('title' => '404 Not Found'));
	}
}