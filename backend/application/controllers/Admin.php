<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function index()
	{
		if(!isset($this->session->loggedIn)){
            header("Location: ".base_url());
        } else {
			if(!$this->session->loggedIn){
				header("Location: ".base_url());
			}
		}
		$this->load->view('headerView');
		$this->load->view('adminView');
        $this->load->view('footerView');
	}
    public function settings()
	{
		if(!isset($this->session->loggedIn)){
            header("Location: ".base_url());
        } else {
			if(!$this->session->loggedIn){
				header("Location: ".base_url());
			}
		}
		$this->load->view('headerView');
		$this->load->view('settingsView');
        $this->load->view('footerView');
	}
}
