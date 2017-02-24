<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LoginControl extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->library(array('form_validation','session'));
		$this->load->model('loginModel');	
	}

	function login(){
		$session = $this->session->userdata('isLogin');
		if($session==FALSE){
			$this->load->view('admin/login');
		}else{
			$level = $this->session->userdata('level');
				if($level=='admin'){
					redirect('dashboard');
				}else{
					redirect('dashboard');
				}
		}
	}

	function index(){
			// $session = $this->session->userdata('isLogin');
			// if($session == FALSE){
				redirect('dashboard');
			// }else{
			// 	$level = $this->session->userdata('level');
			// 	if($level=='admin'){
			// 		redirect('dashboard');
			// 	}else{
			// 		redirect('dashboard');
			// 	}
			// }	
	}
	

	function aksi_login(){
			$this->form_validation->set_rules('username','Username','required|trim|xss_clean'); 
			$this->form_validation->set_rules('password','Password','required|trim|xss_clean');
			
			if($this->form_validation->run()==FALSE){

				// $this->load->view('main/header');
				$this->load->view('admin/login');
				// $this->load->view('main/footer');
			}else{	
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				$bersih_username = $this->security->xss_clean($username);
				$bersih_password = $this->security->xss_clean($password);

				$hitung_user = $this->loginModel->hitung_user($username,$password); 
				if($hitung_user==1){
						$cek_user= $this->loginModel->get_user($username,$password); 
						$cek_level = $this->loginModel->cek_level($username,$password);
						$level = $cek_level->level;
						$id= $cek_user->id; 
						$this->session->set_userdata('isLogin',TRUE);
						$this->session->set_userdata('user_id',$id); 
						$this->session->set_userdata('username',$username);
						$this->session->set_userdata('password',$password);
						$this->session->set_userdata('level',$level);
						redirect('loginControl/login');
					
				}else{		
							echo"<script>
							alert('Gagal Login cek username');
							history.go(-1);
							</script>";
				}

			}
	}


	function logout(){
		$this->session->sess_destroy();
		redirect('dashboard');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */