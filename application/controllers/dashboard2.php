<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->library(array('form_validation','session'));
		$this->load->model('loginModel');
		$this->load->model('db_forum');	
		$this->load->library('template');	
	}

	

	function index(){
		$session = $this->session->userdata('isLogin');
		$data['topic'] = $this->db_forum->topic();
		if($session==FALSE){

			$this->template->display('main/welcome',$data);

			
		}else{
			$data['session'] = $this->session->userdata('isLogin');
			$username = $this->session->userdata('username');
			$data['user'] = $this->db_forum->get_user($username);
			
			$this->template->display('main/welcome',$data);
			
		}
	}
	
	
	function signin(){
		$session = $this->session->userdata('isLogin');
		if($session==FALSE){
			$this->template->display('user/login');
		}else{
			redirect('dashboard');

		}
	}

	function signup(){
		$session = $this->session->userdata('isLogin');	
			if($session==FALSE){
				
				$this->template->display('user/signup');
			
			}else{
				redirect('dashboard');
			}
	}

	function registration(){
		$this->form_validation->set_rules('username','Username','required|trim|xss_clean'); 
		$this->form_validation->set_rules('password','Password','required|trim|xss_clean');
		$this->form_validation->set_rules('email','Email','required|trim|xss_clean'); 
		$this->form_validation->set_rules('fullname','Fullname','required|trim|xss_clean');	
		if($this->form_validation->run()==FALSE){
				
				$this->template->display('user/signup');
				
		
		}else{		
			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));
			$nama = $this->input->post('fullname');
			$email = $this->input->post('email');

			$count = $this->db_forum->cek_username($username);

			if($count==0){
			$data = array(
					'username' =>$username,
					'password' =>$password,
					'email' =>$email,
					'nama' => $nama,
					'level' => '4',
					'status' =>'0'
				);
			$this->db_forum->insert_user($data);
			redirect('dashboard/signin');
			}else{
				echo"<script>
								alert('Username Sudah ada');
								history.go(-1);
								</script>";
			}
		}	
	}

	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */