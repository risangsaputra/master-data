<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kasir extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library(array('form_validation','session'));
			// $this->load->model('db_forum');		
		$this->load->model('m_barang');
		$this->load->model('loginModel');
		$this->load->model('m_transaksi');
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
			$data['barang'] = $this->m_barang->get();
			$data['a'] = $this->m_transaksi->data_customer();
			$this->load->view('admin/header'); 
	        $this->load->view('admin/side_menu',$data);
	        $this->load->view('admin/kasir',$data);
	        $this->load->view('admin/footer'); 
            
        }
	}

	public function getbarang($id)
	{
		$s= $this->m_transaksi->data_customer();
		
		$this->load->model('M_barang');
		$barang = $this->M_barang->get_by_id($id);
		if ($barang) {
				
			echo '	
					<div class="form-group">
                		<label for="nama_produk">Nama Produk</label>
                		<input type="text" class="form-control reset" id="nama_produk" readonly="" name="nama_produk" value="'.$barang->nama_produk.'" >
                	</div>
                	<div class="form-group">
                  		<label for="bahan_baku">Bahan Baku</label>
                  		<textarea class="form-control reset" rows="3" readonly="" name="b_baku">'.$barang->b_baku.'</textarea>
                	</div>
				    <div class="form-group">
                		<label for="harga">Harga </label>
                		<input type="text" class="form-control reset" id="harga" readonly="" name="harga" ut type="text" class="form-control reset" id="harga" name="harga" 
				        	value="'.number_format( $barang->harga, 0 ,
				        	 '' , '.' ).'">
                	</div>
					<div class="form-group">
                		<label for="qty">Quantity </label>
                		<input type="number" class="form-control reset" autocomplete="off" onchange="subTotal(this.value)" 
				        	onkeyup="subTotal(this.value)" id="qty" min="0" 
				        	name="qty" placeholder="Isi qty...">
                	</div>
                	'

                	?>
                	<div class="form-group">
                  		<label>Nama Pelanggan</label>
		                <select class="form-control reset" name="customer_id" id="pelanggan" required="">
		                	<option value="">Pilih Pelanggan</option>
		                	<?php foreach($s as $a){ ?>
		                	<option value="<?php echo $a->id; ?> "><?php echo $a->nama_pelanggan; ?>  
		                    </option>
		                    <?php } ?>
		                </select>
                	</div>
                	<?php ;
					    
	    }else{

	    	echo '	<div class="form-group">
                		<label for="nama_produk">Nama Produk</label>
                		<input type="text" class="form-control reset" id="nama_produk" readonly="" name="nama_produk">
                	</div>
				    <div class="form-group">
                		<label for="harga">Harga </label>
                		<input type="text" class="form-control reset" id="harga" readonly="" name="harga" ut type="text" class="form-control reset" id="harga" name="harga">
                	</div>
				    <div class="form-group">
                		<label for="qty">Quantity </label>
                		<input type="number" class="form-control reset" autocomplete="off" onchange="subTotal(this.value)" 
				        	onkeyup="subTotal(this.value)" id="qty" min="0" 
				        	name="qty" placeholder="Isi qty...">
                	</div>
                	';
	    }
	

	}

	public function ajax_list_transaksi()
	{

		$data = array();

		$no = 1; 
        
        foreach ($this->cart->contents() as $items){
        	
			$row = array();
			$row[] = $no;
			$row[] = $items["id"];
			$row[] = $items["name"];
			$row[] = $items["b_baku"];
			$row[] = number_format( $items['price'], 
                    0 , '' , '.' ) . ',-';
			$row[] = $items["qty"];
			$row[] = number_format( $items['subtotal'], 
					0 , '' , '.' ) . ',-';

			$row[] = $items["customer_id"];

			//add html for action
			$row[] = '<a 
				href="javascript:void()" style="color:rgb(255,128,128);
				text-decoration:none" onclick="deletebarang('
					."'".$items["rowid"]."'".','."'".$items['subtotal'].
					"'".')"> <i class="fa fa-close"></i> Delete</a>';
		
			$data[] = $row;
			$no++;
        }

		$output = array(
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function addbarang()
	{
		// $data=array(
		// 		'kd_transaksi' => NULL,
		// 		'kd_produk' => $this->input->post('id'), 
		// 		'tgl_transaksi' => $this->input->post('tgl_transaksi'),
		// 		'total_harga' => $this->input->post('sub_total'),
		// 		'qty' => $this->input->post('qty'),
		// 		'customer_id' => $this->input->post('customer_id'),
		// 	); 
		// $this->m_barang->add_transaksi($data);
		$data = array(
				'id' => $this->input->post('id'),
				'name' => $this->input->post('nama_produk'),
				'b_baku' => $this->input->post('b_baku'),
				'price' => str_replace('.', '', $this->input->post(
					'harga')),
				'qty' => $this->input->post('qty'),
				'customer_id' => $this->input->post('customer_id')
			);
		$insert = $this->cart->insert($data);
		echo json_encode(array("status" => TRUE));


	}

	public function deletebarang($rowid) 
	{

		$this->cart->update(array(
				'rowid'=>$rowid,
				'qty'=>0,));
		echo json_encode(array("status" => TRUE));
		 
	}
	public function orders(){
				$this->load->model('M_barang');
		$is_processed = $this->M_barang->process();

		if($is_processed){
			$this->cart->destroy();
		}else{
			$this->session->set_flashdata('error','failde to process');
		}
		redirect ('kasir');	
	}
	function resetcart(){
		$this->cart->destroy();
		redirect ('kasir');	
	}
	// function add_transaksi_action(){
	// 	$data=array(
	// 			'kd_transaksi' => NULL,
	// 			'kd_produk' => $this->input->post('id'), 
	// 			'tgl_transaksi' => $this->input->post('tgl_transaksi'),
	// 			'total_harga' => $this->input->post('sub_total'),
	// 			'qty' => $this->input->post('qty'),
	// 			'customer_id' => $this->input->post('customer_id'),
	// 		); 
	// 	$this->m_barang->add_transaksi($data); 
	// }
}