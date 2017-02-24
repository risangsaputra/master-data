<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
//This is the Book Model for CodeIgniter CRUD using Ajax Application.
class M_user extends CI_Model
{
 
	var $table = 'user';
 
 
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
 
 
	public function get_all_user()
	{
	$this->db->from('user');
	$query=$this->db->get();
	return $query->result();
	}
 
 
	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();
 
		return $query->row();
	}
 
	public function user_add($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
 
	public function user_update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}
 
	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}
	function insert_user($data){
		$this->db->insert('user',$data);
	}
	function cek_username($username){
		return $this->db->query("select username from user where username='$username'")->num_rows();
	}
 
 
}