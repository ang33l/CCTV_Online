<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Camera extends CI_Controller {

	public function status()
	{
		if(!exec("sudo screen -ls | grep camera")){
			return false;
		} else {
			return true;
		}
	}
}
