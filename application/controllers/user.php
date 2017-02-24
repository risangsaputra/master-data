<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library(array('form_validation','session'));
		$this->load->helper('url');
	 	$this->load->model('m_user');
	 	$this->load->model('loginModel');
	}
	public function index()
	{
 		$session = $this->session->userdata('isLogin');
        if($session==FALSE){

            redirect('loginControl/login');

            
        }else{
            $data['session'] = $this->session->userdata('isLogin');
            $username = $this->session->userdata('username');
            $data['user'] = $this->loginModel->get_users($username);
            
            $data['users']=$this->m_user->get_all_user();
		
			$this->load->view('admin/header'); 
	        $this->load->view('admin/side_menu',$data);
	        $this->load->view('admin/user',$data);
	        $this->load->view('admin/footer'); 
            
        }
		
	}

	function registration(){
		$this->form_validation->set_rules('username','Username','required|trim|xss_clean'); 
		$this->form_validation->set_rules('password','Password','required|trim|xss_clean');
		$this->form_validation->set_rules('email','Email','required|trim|xss_clean'); 
		$this->form_validation->set_rules('fullname','Fullname','required|trim|xss_clean');	
		$this->form_validation->set_rules('level','Level','required|trim|xss_clean');	
		$this->form_validation->set_rules('status','Status','required|trim|xss_clean');	
		if($this->form_validation->run()==FALSE){
				
			$data['session'] = $this->session->userdata('isLogin');
            $username = $this->session->userdata('username');
            $data['user'] = $this->loginModel->get_users($username);
            
            $data['users']=$this->m_user->get_all_user();
		
			$this->load->view('admin/header'); 
	        $this->load->view('admin/side_menu',$data);
	        $this->load->view('admin/user',$data);
	        $this->load->view('admin/footer');
				
		
		}else{		
			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));
			$nama = $this->input->post('fullname');
			$email = $this->input->post('email');
			$level = $this->input->post('level');
			$status = $this->input->post('status');

			$count = $this->m_user->cek_username($username);

			if($count==0){
			$data = array(
					'username' =>$username,
					'password' =>$password,
					'email' =>$email,
					'nama' => $nama,
					'level' => $level,
					'status' =>$status
				);
			$this->m_user->insert_user($data);
			redirect('user');
			}else{
				echo"<script>
								alert('Username Sudah ada');
								history.go(-1);
								</script>";
			}
		}	
	}
	public function ajax_edit($id)
		{
			$data = $this->m_user->get_by_id($id);
			echo json_encode($data);
		}
	
	public function user_update()
		{
			$data = array(
					'id' => $this->input->post('id'),
					'username' => $this->input->post('username'),
					'nama' => $this->input->post('nama'),
					'email' => $this->input->post('email'),
					'level' => $this->input->post('level'),
					'status' => $this->input->post('status'),
					'password' => md5($this->input->post('password')),
				);
			$this->m_user->user_update(array('id' => $this->input->post('id')), $data);
			echo json_encode(array("status" => TRUE));
		}	

	public function user_delete($id)
		{
			$this->m_user->delete_by_id($id);
			echo json_encode(array("status" => TRUE));
		}
}	