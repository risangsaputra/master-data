<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_barang extends CI_Model{

	private $primary_key = 'id';
	private $table_name	= 'produk';

	public function __construct()
	{
	
		parent::__construct();
	
	}

	public function get() 
	{
	  	
	  	$this->db->select('id,nama_produk');

		return $this->db->get($this->table_name)->result();
	
	}

	public function get_by_id($id)
	{
	  
	  	$this->db->where($this->primary_key,$id); 
	  
	  	return $this->db->get($this->table_name)->row();
	
	}
	function add_transaksi($data){
			$this->db->insert('transaksi',$data);
	}
	public function delete_by_id($id)
	{
		$this->db->where('kd_transaksi', $id);
		$this->db->delete($this->table);
	}
	function process(){
		$invoice = array(
			 'date'		=> date('Y-m-d H:i:s'),
			 'due_date'		=> date('Y-m-d H:i:s', mktime(date('H'),date('i'),date('s'),date('m'),date('d') +1,date('Y'))),
			 );
		$this->db->insert('invoice',$invoice);
		$invoice_id = $this->db->insert_id();

		foreach ($this->cart->contents() as $item){
			$data = array(
				'invoice_id'	=> $invoice_id,
				'produk_id'		=> $item['id'],
				'nama_produk'	=> $item['name'],
				'qty'			=> $item['qty'],
				'price'			=> $item['price'],
				'customer_id'	=> $item['customer_id'],
				);
			$this->db->insert('transaksis',$data);
		}
		return TRUE;
	}

}