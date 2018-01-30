<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Email Configurations
| -------------------------------------------------------------------------
| This file is used for default settings for Email class.
| Please see the user guide for info:
|
|	https://www.codeigniter.com/user_guide/libraries/email.html
|
*/

$config = array(
    'protocol' => 'smtp',
    'smtp_host' => 'smtp.gmail.com',
    'smtp_port' => 465,
    'smtp_crypto' => 'ssl',
    'smtp_user' => 'slinfydotcom@gmail.com',
    'smtp_pass' => 'khattra@007',
    'mailtype' => 'html',
    'charset' => 'iso-8859-1',
	'newline'=>"\r\n"
);