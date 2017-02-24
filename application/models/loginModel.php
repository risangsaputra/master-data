<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class loginModel extends CI_Model {

	function cek_level($username,$password){
		return $this->db->query("select id_level,user_level.level from user,user_level where user.level=user_level.id_level and user.username='$username' and user.password=MD5('$password') and status='1'")->row();
	}
	function hitung_user($username,$password){
		return $this->db->query("select username,password,level from user where username='$username' and password=MD5('$password') and status='1' limit 1")->num_rows();
	}
	function get_user($username,$password){
		return $this->db->query("select id,username,password from user where username='$username' and password=MD5('$password')")->row(); 
	}
	function get_users($username){
		return $this->db->query("select*from user join user_level on user.level=user_level.id_level where username='$username'")->row();
	}

}	





?>
