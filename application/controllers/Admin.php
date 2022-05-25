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
		$user = $this->session->user_id;
		
		$query = $this->db->query("SELECT ah_from, ah_to FROM active_hours WHERE user_id=?", array($user));
		foreach($query->result() as $row){
			$from = $row->ah_from;
			$to = $row->ah_to;
		}
		if(date("H:i:s") > $from && date("H:i:s") < $to){
			$data['camera_access'] = true;
		}else{
			$data['camera_access'] = false;
		}
		if(!exec("sudo screen -ls | grep camera")){
			$data['camera_status'] = false;
		} else {
			$data['camera_status'] = true;
		}
		if(!$data['camera_status'] && $data['camera_access']){
			exec("sudo screen -AdmS camera python3 camera.py");
			$data['camera_status'] = true;
			sleep(1);
		}else if($data['camera_status'] && !$data['camera_access']){
			$data['camera_status'] = false;
		}
		$this->load->view('headerView');
		$this->load->view('adminView', $data);
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

		if(!exec("sudo screen -ls | grep camera")){
			$data['camera_status'] = false;
		} else {
			$data['camera_status'] = true;
		}
		$data['user'] = $this->session->user_name;
		$data['users'] = array();
		$sql =  'SELECT user_id, user_name FROM user;';
		$query = $this->db->query($sql);
		if($query->result()){
			foreach($query->result() as $row){
				array_push($data['users'], array(
					'user_name' => $row->user_name,
					'user_id' => $row->user_id
				));
			}
		}
		$this->load->view('headerView');
		$this->load->view('settingsView', $data);
        $this->load->view('footerView');
	}
	public function changeCameraState()
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
		if(!exec("sudo screen -ls | grep camera")){
			exec("sudo screen -AdmS camera python3 camera.py");
		} else {
			exec("sudo screen -X -S camera quit");
		}
		header("Location: ".base_url()."admin/settings");
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



	public function changeActiveHours()
	{
		$user = $this->input->post('user');
		$from = $this->input->post('from');
		$to = $this->input->post('to');

		$sql = "SELECT * FROM active_hours WHERE user_id=?";
		$query = $this->db->query($sql, array($user));
		if($query->result()){
			$sql = "UPDATE active_hours SET ah_from=?, ah_to=? WHERE user_id=?;";
			$query = $this->db->query($sql, array($from, $to, $user));
			echo "1";
			die();
		} else{
			$sql = "INSERT INTO active_hours(ah_from, ah_to, user_id) VALUES (?, ?,?);";
			$query = $this->db->query($sql, array($from, $to, $user));
			echo "1";
			die();
		}
	}
}
