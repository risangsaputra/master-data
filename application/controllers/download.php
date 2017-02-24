<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Download extends CI_Controller{
	function __construct(){
		parent::__construct(); 
			$this->load->library(array('form_validation','session'));
			$this->load->model('loginModel');
			$this->load->model('db_forum');		
	}
	function index(){
		$data['topic'] = $this->db_forum->topic();
		$session = $this->session->userdata('isLogin');
		if($session==FALSE){
			redirect('dashboard/signin');
		}else{
			$data['session'] = $this->session->userdata('isLogin');
			$username = $this->session->userdata('username');
			$data['user'] = $this->db_forum->get_user($username);
			$this->load->view('main/header');
			$this->load->view('user/download',$data);
			$this->load->view('main/footer');
	
		}
	}
}