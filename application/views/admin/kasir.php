<!DOCTYPE html>
<html lang="en">
<head>
  	<link rel="stylesheet" href="<?= base_url('assets/datatables/media/css/dataTables.bootstrap.css') ?>">

  	<script src="<?= base_url('assets/plugins/jQuery/jquery-2.2.3.min.js') ?>"></script>
  	<script src="<?= base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
	<script src="<?= base_url('assets/datatables/media/js/jquery.dataTables.min.js') ?>"></script>
	<script src="<?= base_url('assets/datatables/media/js/dataTables.bootstrap.js') ?>"></script>
  	<script src="<?= base_url('assets/maskMoney/jquery.maskMoney.min.js') ?>"></script>
</head>
<body>
	<div class="col-md-12">
		<div class="panel panel-default">
		 <div class="panel-body">
		 	
		 	<form id="form_transaksi" class="form-horizontal" role="form"   method="POST" >
	      	<div class="col-md-6">
			    <div class="form-group">
			      <label for="id">ID Produk :</label>
			        <input list="list_barang" class="form-control reset" 
			        	placeholder="Isi id..." name="id" id="id" 
			        	autocomplete="off" onchange="showBarang(this.value)">
	                  <datalist id="list_barang" name="id">
	                  	<?php foreach ($barang as $barang): ?>
	                  		<option value="<?= $barang->id ?>"><?= $barang->nama_produk ?></option>
	                  	<?php endforeach ?>
	                  </datalist>
			    </div>
			    <div id="barang">
				    <div class="form-group">
				      <label for="nama_produk">Nama Produk :</label>
				        <input type="text" class="form-control reset" 
				        	name="nama_produk" id="nama_produk" 
				        	readonly="readonly">
				    </div>
				    <div class="form-group">
                  		<label for="bahan_baku">Bahan Baku</label>
                  		<textarea class="form-control reset" rows="3" readonly="" name="b_baku"></textarea>
                	</div>
				    <div class="form-group">
				      <label for="harga">Harga (Rp) :</label>
				        <input type="text" class="form-control reset" 
				        	name="harga_produk" id="harga" 
				        	readonly="readonly">
				    </div>
				    <div class="form-group">
				      <label for="qty">Quantity :</label>
				        <input type="number" class="form-control reset" 
				        	autocomplete="off" onchange="subTotal(this.value)" 
				        	onkeyup="subTotal(this.value)" id="qty" min="0" 
				        	name="qty" placeholder="Isi qty...">
				    </div>
				    <!-- <div class="form-group">
                  		<label>Nama Pelanggan</label>
		                <select class="form-control reset" name="customer_id" id="pelanggan" required="">
		                	<option value="">Pilih Pelanggan</option>
		                	<?php foreach($a as $a){ ?>
		                	<option value="<?php echo $a->id; ?> "><?php echo $a->nama_pelanggan; ?>  
		                    </option>
		                    <?php } ?>
		                </select>
                	</div> -->
			    </div><!-- end id barang -->
			    
			      <!-- </div>
			    </div> --><!-- end panel-->
	      	</div><!-- end col-md-8 -->
	      	<div class="col-md-6">
				<div class="col-md-12">
					<div class="form-group">
				     	<label for="sub_total">Sub-Total (Rp):</label>
				        <input type="text" class="form-control reset" 
			        	name="sub_total" id="sub_total" 
			        	readonly="readonly">
			    	</div>
			    	
			   		<div class="form-group">
			      		<button type="submit" class="btn btn-primary" 
			      		id="tambah" onclick="addbarang()">
			      		  <i class="fa fa-cart-plus"></i> Tambah</button>
			    	</div>
				  	<div class="form-group">
				      <label for="total" class="besar">Total (Rp) :</label>
				      	<input type="text" class="form-control" 
			        	name="total" id="total" placeholder="0"
			        	readonly="readonly"  value="<?= number_format( 
                    	$this->cart->total(), 0 , '' , '.' ); ?>">
				    </div>
			   		
				    <!-- <div class="form-group">
			      		<button type="submit" class="btn btn-primary">
			      		  <i class="fa fa-cart-plus"></i> Selesai</button>
			      		  
			    	</div> -->
				    
				</div>
	      	</div><!-- end col-md-4 -->
	      	</form>
	      	<table id="table_transaksi" class="table table-striped 
	      		table-bordered">
				<thead>
				 	<tr>
					   	<th>No</th>
					   	<th>Id Barang</th>
					   	<th>Nama Barang</th>
					   	<th>Bahan Baku</th>
					   	<th>Harga</th>
					   	<th>Quantity</th>
					   	<th>Sub-Total</th>
					   	<th>pelanggan</th>
					   	<th>Aksi</th>
				 	</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
			<button onclick="window.location.href='http://localhost:8888/pinguin2/kasir/orders'">Continue</button>
			<button onclick="window.location.href='http://localhost:8888/pinguin2/kasir/resetcart'">Reset</button>
	      </div>
	    </div>
	</div><!-- end col-md-9 -->

	<script type="text/javascript">

	function showBarang(str) 
	{

	    if (str == "") {
	        $('#nama_produk').val('');
	        $('#harga').val('');
	        $('#qty').val('');
	        $('#sub_total').val('');
	        $('#b_baku').val('');
	        $('#customer_id').val('');
	        $('#reset').hide();
	        return;
	    } else { 
	      if (window.XMLHttpRequest) {
	          // code for IE7+, Firefox, Chrome, Opera, Safari
	           xmlhttp = new XMLHttpRequest();
	      } else {
	          // code for IE6, IE5
	          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	      }
	      xmlhttp.onreadystatechange = function() {
	           if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	              document.getElementById("barang").innerHTML = 
	              xmlhttp.responseText;
	          }
	      }
	      xmlhttp.open("GET", "<?= base_url(
	        'index.php/kasir/getbarang') ?>/"+str,true);
	      xmlhttp.send();
	    }
	}

	function subTotal(qty)
	{

		var harga = $('#harga').val().replace(".", "").replace(".", "");

		$('#sub_total').val(convertToRupiah(harga*qty));
	}

	function convertToRupiah(angka)
	{

	    var rupiah = '';    
	    var angkarev = angka.toString().split('').reverse().join('');
	    
	    for(var i = 0; i < angkarev.length; i++) 
	      if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
	    
	    return rupiah.split('',rupiah.length-1).reverse().join('');
	
	}

	var table;
    $(document).ready(function() {

      table = $('#table_transaksi').DataTable({ 
        paging: false,
        "info": false,
        "searching": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' 
        // server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?= site_url('kasir/ajax_list_transaksi')?>",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
          "targets": [ 0,1,2,3,4,5,6,7 ], //last column
          "orderable": false, //set not orderable
        },
        ],

      });
    });

    function reload_table()
    {

      table.ajax.reload(null,false); //reload datatable ajax 
    
    }

    function addbarang()
    {
        var id = $('#id').val();
        var qty = $('#qty').val();
        var pelanggan = $('#pelanggan').val();
        if (id == '') {
          $('#id').focus();
        }else if(qty == ''){
          $('#qty').focus();
        }else if(pelanggan == ''){
          $('#pelanggan').focus();
        }else{
       // ajax adding data to database
          $.ajax({
            url : "<?= site_url('kasir/addbarang')?>",
            type: "POST",
            data: $('#form_transaksi').serialize(),
            dataType: "JSON",
            success: function(data)
            {
               //reload ajax table
               reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding data');
            }
        });

          showTotal();
          // showKembali($('#bayar').val());
          //mereset semua value setelah btn tambah ditekan
          $('.reset').val('');
        };
    }

    function deletebarang(id,sub_total)
    {
        // ajax delete data to database
          $.ajax({
            url : "<?= site_url('kasir/deletebarang')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
               reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

          var ttl = $('#total').val().replace(".", "");

          $('#total').val(convertToRupiah(ttl-sub_total));

          // showKembali($('#bayar').val());
    }

    function showTotal()
    {

    	var total = $('#total').val().replace(".", "").replace(".", "");

    	var sub_total = $('#sub_total').val().replace(".", "").replace(".", "");

    	$('#total').val(convertToRupiah((Number(total)+Number(sub_total))));

  	}

  	//maskMoney
	$('.uang').maskMoney({
		thousands:'.', 
		decimal:',', 
		precision:0
	});

	

	</script>
</body>
</html>