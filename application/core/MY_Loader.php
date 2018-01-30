<?php

/**
 * /application/core/MY_Loader.php
 *
 */
class MY_Loader extends CI_Loader {
    public function template($template_name, $vars=array(), $head_foot=true)
    {
        if($head_foot)
        {
	        $this->view('includes/header', $vars);
	        $this->view($template_name, $vars);
	        $this->view('includes/footer', $vars);
        }
	    else
	    {
	        $this->view($template_name, $vars);
	    }
    }

    public function admin_template($template_name, $vars=array(), $head_foot=true)
    {
        if($head_foot)
        {
			$this->view(ADMIN_PREFIX . '/includes/header', $vars);
			$this->view(ADMIN_PREFIX . '/' . $template_name, $vars);
			$this->view(ADMIN_PREFIX . '/includes/footer', $vars);
        }
	    else
	    {
	        $this->view(ADMIN_PREFIX . '/' . $template_name, $vars);
	    }
    }
}