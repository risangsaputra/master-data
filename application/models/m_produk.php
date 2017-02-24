<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
//This is the Book Model for CodeIgniter CRUD using Ajax Application.
class M_produk extends CI_Model
{
 
    var $table = 'produk';
 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
 
    public function get_all_produk()
    {
    $this->db->from('produk');
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
 
    public function produk_add($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
 
    public function produk_update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }
 
    public function delete_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }
    function getkodeunik() { 
        $q = $this->db->query("SELECT MAX(RIGHT(id,4)) AS idmax FROM produk ");
        $kd = ""; //kode awal
        if($q->num_rows()>0){ //jika data ada
            foreach($q->result() as $k){
                $tmp = ((int)$k->idmax)+1; //string kode diset ke integer dan ditambahkan 1 dari kode terakhir
                $kd = sprintf("%04s", $tmp); //kode ambil 4 karakter terakhir
            }
        }else{ //jika data kosong diset ke kode awal
            $kd = "0001";
        }
        $kar = "P-"; //karakter depan kodenya
        //gabungkan string dengan kode yang telah dibuat tadi
        return $kar.$kd;
   }
 
 
}