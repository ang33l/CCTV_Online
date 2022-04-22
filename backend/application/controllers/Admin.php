<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function index()
	{
		if(!isset($this->session->loggedIn)){
            header("Location: ".base_url());
			die();
        } else {
			if(!$this->session->loggedIn){
				header("Location: ".base_url());
				die();
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
			die();
        } else {
			if(!$this->session->loggedIn){
				header("Location: ".base_url());
				die();
			}
		}
		$this->load->view('headerView');
		$this->load->view('settingsView');
        $this->load->view('footerView');
	}
	public function changePassword()
	{
		if(!isset($this->session->loggedIn)){
            header("Location: ".base_url());
			die();
        } else {
			if(!$this->session->loggedIn){
				header("Location: ".base_url());
				die();
			}
		}
		if($this->input->post("pass") && $this->input->post("newPass")){
			$actualPass = $this->input->post("pass");
			$newPass = $this->input->post("newPass");
			if($actualPass != $newPass){
				$sql =  'SELECT user_id, user_name, user_pass FROM user WHERE user_id=?;';
				$query = $this->db->query($sql, array($this->session->user_id));
				if($query->result()){
					foreach($query->result() as $row){
						if(password_verify($actualPass, $row->user_pass)){
							$hashedPass = password_hash($newPass, PASSWORD_BCRYPT);
							$sql = "UPDATE user SET user_pass=? WHERE user_id=?";
							$query = $this->db->query($sql, array($hashedPass, $this->session->user_id));
							echo "1";
							die();
						} else{
							echo "-3";
							die();
						}
					}
					
				} else {
					echo "-2";
					die();
				}
			} else{
				echo "-1";
				die();
			}
		} else {
			echo "0";
			die();
		}
		
	}

	public function changeCameraState()
	{

	}

	public function activeHours()
	{
		
	}
}
