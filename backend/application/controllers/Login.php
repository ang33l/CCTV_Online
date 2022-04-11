<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function index($id = 0)
	{
        if(isset($this->session->loggedIn)){
            if($this->session->loggedIn){
                header("Location: ".base_url().'admin');
            }
        }
        
        $this->load->view('headerView');
        if($id){
            $data = array('id' => $id);
            $this->load->view('loginView', $data);    
        }else{
            $this->load->view('loginView');
        }
		
        $this->load->view('footerView');
	}
    public function verifyLogin()
    {
        if($this->input->post("login") && $this->input->post("pass")){
            $sql =  'SELECT user_id, user_name, user_pass FROM user WHERE user_name=?;';
            $query = $this->db->query($sql, array($this->input->post("login")));
            if($query->result()){
                foreach($query->result() as $row){
                    if(password_verify($this->input->post("pass"), $row->user_pass)){
                        $this->session->set_userdata(array(
                            'loggedIn' => true,
                            'user_id' => $row->user_id,
                            'user_name' => $row->user_name
                        ));
                        //return $this->output->set_content_type('application/json')->set_status_header(200)->set_output(json_encode(array('errno' => true,)));
                        header("Location: ".base_url().'admin');
                    }else {
                        header("Location: ".base_url()."login/index/1");
                    }
                }
            } else {
                header("Location: ".base_url()."login/index/1");
            }
        }else{
            header("Location: ".base_url()."login/index/1");
        }
    }
    public function logout()
    {
        $this->session->sess_destroy();
        header("Location: ".base_url());
    }
}
