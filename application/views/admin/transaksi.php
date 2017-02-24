<div class="row">
	<div class="col-md-6">
          <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Form Pemesanan</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?php echo base_url()?>transaksi/add_transaksi_action" method="POST">
            	<div class="box-body">
            		<div class="form-group">
                  		<label>Nama Pelanggan</label>
		                <select class="form-control" name="customer_id" required="">
		                	<option value="">Pilih Pelanggan</option>
		                	<?php foreach($data as $data){ ?>
		                	<option value="<?php echo $data->id; ?> "><?php echo $data->nama_pelanggan; ?>  
		                    </option>
		                    <?php } ?>
		                </select>
                	</div>

                	<div class="form-group">
                  		<label>Produk</label>
		                <select class="form-control" name="nama_produk" id="produk" required="">
		                	<option value="">Pilih Produk</option>
		                	<?php foreach($produk as $produk){ ?>
                    		<option value="<?php echo $produk->nama_produk; ?> "><?php echo $produk->nama_produk; ?>  
                    		</option>
                    		<?php } ?>
		                </select>
                	</div> 

                	<div class="form-group">
                  		<label>Bahan Baku</label>
                  		<textarea class="form-control" readonly="" name="bahan" id="bahan" rows="3" placeholder="Enter ..."></textarea>
                	</div>
                	<div class="form-group">
                  		<label>Harga</label>
		                <select class="form-control" readonly="" name="harga_produk" id="harga">
		                	
		                </select>
                	</div> 
                	<div class="form-group">
                		<label>Tanggal</label>
                		<div class="input-group date">
	                  		<div class="input-group-addon">
	                    		<i class="fa fa-calendar"></i>
	                  		</div>
                  			<input type="text" name="tgl_transaksi" class="form-control pull-right datepicker" required="">
                		</div>
              		</div>  
            	<div class="box-footer">
	            	<button type="submit" class="btn btn-primary">Submit</button>
	            	<button type="reset" class="btn btn-danger">Reset</button>
            	</div>
        	</form>
    	</div>
         
    </div>
</div>

<script src="<?php echo base_url('assets/jquery/jquery-3.1.1.min.js')?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('assets/DataTables/media/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/DataTables/media/js/dataTables.bootstrap.js')?>"></script>
<script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#produk').on('change', function(){
			var id = $(this).val();
			if(id == ''){
				$('#bahan').prop('readonly',true);
			}
			else{
				$('#bahan').prop('readonly',true);
				$.ajax({
					url:"transaksi/get_bahan",
					type: "POST",
					data: {'id' : id},
					dataType: 'json',
					success: function(data){
						$('#bahan').html(data);
					},
					errot:function(){
						alert ('Error occur...');
					}
				})
			}
		});
		$('#produk').on('change', function(){
			var id = $(this).val();
			if(id == ''){
				$('#harga').prop('readonly',true);
			}
			else{
				$('#harga').prop('readonly',true);
				$.ajax({
					url:"transaksi/get_harga",
					type: "POST",
					data: {'id' : id},
					dataType: 'json',
					success: function(data){
						$('#harga').html(data);
					},
					errot:function(){
						alert ('Error occur...');
					}
				})
			}
		});
		//datepicker
    $('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
    });

});

</script>
