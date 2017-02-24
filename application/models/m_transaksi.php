<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class M_transaksi extends CI_Model {
 
    public function __construct(){
        $this->load->database();
    }

    function data_produk(){
        $query=$this->db->query("SELECT * FROM produk ORDER BY nama_produk ASC");
        return $query->result();
    }

    function data_customer(){
        $query=$this->db->query("SELECT * FROM customer ORDER BY nama_pelanggan ASC");
        return $query->result();
    }
    function get_data_produk($nama_produk){
    	$query = $this->db->get_where('produk', array('nama_produk'=> $nama_produk));
    	return $query->result();
    }
    function add_transaksi($data){
			$this->db->insert('transaksi',$data);
	}







 }
 ?>