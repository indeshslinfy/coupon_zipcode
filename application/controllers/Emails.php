<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emails extends CI_Controller
{
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/email
	 *	- or -
	 * 		http://example.com/index.php/email/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function send_email($template_name, $data=array())
	{
		die('sending........');
		$this->email->set_newline("\r\n");
		$this->email->from('your mail id', 'Anil Labs');
        $data = array('userName'=> 'Anil Kumar Panigrahi');
		$this->email->to($userEmail);  // replace it with receiver mail id
		$this->email->subject($subject); // replace it with relevant subject

		$body = $this->load->view('emails/anillabs.php',$data,TRUE);
		$this->email->message($body);  
		$this->email->send();
	}
}
