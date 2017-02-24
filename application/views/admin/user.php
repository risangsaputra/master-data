<div class="row">
	<div class="col-md-4">
          <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Register Users</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?php echo site_url('user/registration');?>" method="POST">
            	<div class="box-body">
            		<div class="form-group">
                  		<label>Nama</label>
		                <input type="text" class="form-control" name="fullname" value="<?php echo set_value('fullname');?>" placeholder="Nama"  data-toggle="tooltip" data-original-title="Nama asli" data-placement="right"><?php echo form_error('fullname'); ?>
                	</div>

                	<div class="form-group">
                  		<label>Username</label>
		               	<input type="text" class="form-control" name="username" value="<?php echo set_value('username');?>" placeholder="Username"  data-toggle="tooltip" data-original-title="Username" data-placement="right"><?php echo form_error('username'); ?>
                	</div>
                	<div class="form-group">
                  		<label>Email</label>
		               	<input type="email" class="form-control" name="email" value="<?php echo set_value('email');?>" placeholder="Email"  data-toggle="tooltip" data-original-title="Email" data-placement="right"><?php echo form_error('email'); ?>
                	</div>
                	<div class="form-group">
                  		<label>Password</label>
		               	<input type="password" class="form-control" name="password" value="<?php echo set_value('password');?>" placeholder="Password"  data-toggle="tooltip" data-original-title="Password" data-placement="right"><?php echo form_error('password'); ?>
                	</div>
                	<div class="form-group">
                  		<label>Level</label>
                  		<select name="level" class="form-control" data-toggle="tooltip" data-original-title="Level" data-placement="right">
                  			<option value="">Pilih Level</option>
                  			<option value="3">Admin</option>
                  			<option value="4">User</option>
                  		</select><?php echo form_error('level'); ?>
                	</div>
                	<div class="form-group">
                  		<label>Status</label>
                  		<select name="status" class="form-control" data-toggle="tooltip" data-original-title="Status" data-placement="right">
                  			<option value="">Pilih Status</option>
                  			<option value="1">Active</option>
                  			<option value="0">Non active</option>
                  		</select><?php echo form_error('status'); ?>
                	</div>


                	

                	
            	<div class="box-footer">
	            	<button type="submit" class="btn btn-primary">Submit</button>
	            	<button type="reset" class="btn btn-danger">Reset</button>
            	</div>
        	</form>
    	</div>
         
    </div>
</div>
<div class="row">
	<div class="col-md-7">
    <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>username</th>
                    <th>email</th>
                    <th>level</th>
                    <th>status</th>
                    
 
          <th style="width:125px;">Action
          </p></th>
        </tr>
      </thead>
      <tbody>
                <?php foreach($users as $user){?>
                     <tr>
                         <td><?php echo $user->id;?></td>
                         <td><?php echo $user->nama;?></td>
                         <td><?php echo $user->username;?></td>
                         <td><?php echo $user->email;?></td>
                         <td>
                         	<?php 
                         	
                         		if($user->level=='3'){
                         			echo "admin";
                         		}
                         		elseif($user->level=='4'){
                         			echo "user";
                         		}

                         	?>
                         	
                         </td>
                         <td>
                         	<?php 
                         	
                         		if($user->status=='1'){
                         			echo "active";
                         		}
                         		elseif($user->status=='0'){
                         			echo "non active";
                         		}

                         	?>
                         </td>
                         <td>
                            <button class="btn btn-warning" onclick="edit_user(<?php echo $user->id;?>)"><i class="glyphicon glyphicon-pencil"></i></button>
                            <button class="btn btn-danger" onclick="delete_user(<?php echo $user->id;?>)"><i class="glyphicon glyphicon-remove"></i></button>
 
 
                         </td>
                    </tr>
                <?php }?>
 
 
 
      </tbody>
 
      <tfoot>
        <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>username</th>
                    <th>email</th>
                    <th>level</th>
                    <th>status</th>
        </tr>
      </tfoot>
    </table>
 
  </div>
  
<script src="<?php echo base_url('assets/jquery/jquery-3.1.1.min.js')?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('assets/DataTables/media/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/DataTables/media/js/dataTables.bootstrap.js')?>"></script>
<script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>

  <script type="text/javascript">
  $(document).ready( function () {
      $('#table_id').DataTable();
      //datepicker
    $('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
    });
  } );
    var save_method; //for save method string
    var table;
 
 
    function add_user()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
    //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
    }
 
    function edit_user(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals
 
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo base_url('user/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
 
            $('[name="id"]').val(data.id);
            $('[name="nama"]').val(data.nama);
            $('[name="username"]').val(data.username);
            $('[name="email"]').val(data.email);
            $('[name="level"]').val(data.level);
            $('[name="status"]').val(data.status);
            $('[name="password"]').val(data.password);
 
 
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit user'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }
 
 
 
    function save()
    {
      var url;
      if(save_method == 'add')
      {
          url = "<?php echo site_url('user/user_add')?>";
      }
      else
      {
        url = "<?php echo site_url('user/user_update')?>";
      }
 
       // ajax adding data to database
          $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
               //if success close modal and reload ajax table
               $('#modal_form').modal('hide');
              location.reload();// for reload a page
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
    }
 
    function delete_user(id)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('user/user_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
               
               location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
 
      }
    }
 
  </script>
 
  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">user Form</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
          <input type="hidden" value="" name="id"/>
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">Nama</label>
              <div class="col-md-9">
                <input name="nama" placeholder="Nama" class="form-control" type="text" required="">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Username</label>
              <div class="col-md-9">
                <input name="username" placeholder=Username" class="form-control" type="text" required="">
              </div>
            </div>

            <div class="form-group">
            	<label class="control-label col-md-3">Email</label>
            	<div class="col-md-9">
             		<input name="email" placeholder="Email" class="form-control" type="email" required="">
 				</div>
            </div>
            <div class="form-group">
            	<label class="control-label col-md-3">Level</label>
            	<div class="col-md-9">
	              	<select name="level" class="form-control">
	               		<option value="">Pilih Level</option>
	               		<option value="3">Admin</option>
	               		<option value="4">User</option>
	               	</select>
 				</div>
 			</div>
 			<div class="form-group">
            	<label class="control-label col-md-3">Status</label>
            	<div class="col-md-9">
	              	<select name="status" class="form-control">
	               		<option value="">Pilih Status</option>
	               		<option value="1">Active</option>
	               		<option value="0">Non active</option>
	               	</select>
 				</div>
 			</div>
 			<div class="form-group">
              <label class="control-label col-md-3">Password</label>
              <div class="col-md-9">
               <input name="password" placeholder="Password" class="form-control" type="password" required="">
 			  </div>
            </div>
            
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
</div>
</div>
