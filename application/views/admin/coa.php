
    <button class="btn btn-success" onclick="add_coa()"></i> Tambah Akun</button>
    <br />
    <br />
    <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
                    <th>NO</th>
                    <th>ID</th>
                    <th>NAMA AKUN</th>
                    <th style="width:125px;">ACTION</p></th>
        </tr>
      </thead>
      <tbody>
                <?php 
                $i=1;
                foreach($coa as $coa){?>
                     <tr>
                         <td><?php echo $i++;?></td>
                         <td><?php echo $coa->id;?></td>
                         <td><?php echo $coa->nama_akun;?></td>
                                <td>
                                    <button class="btn btn-warning" onclick="edit_coa('<?php echo $coa->id;?>')"><i class="glyphicon glyphicon-pencil"></i></button>
                                    <button class="btn btn-danger" onclick="delete_coa('<?php echo $coa->id;?>')"><i class="glyphicon glyphicon-remove"></i></button>
 
 
                                </td>
                      </tr>
                     <?php }?>
 
 
 
      </tbody>
 
      <tfoot>
        <tr>
                    <th>NO</th>
                    <th>ID</th>
                    <th>NAMA AKUN</th>
                    <th style="width:125px;">ACTION</p></th>
         
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
 
 
    function add_coa()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
    //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
    }
 
    function edit_coa(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals
 
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo base_url('coa/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
 
            $('[name="id"]').val(data.id);
            $('[name="nama_akun"]').val(data.nama_akun);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit produk'); // Set title to Bootstrap modal title
 
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
          url = "<?php echo site_url('coa/coa_add')?>";
      }
      else
      {
        url = "<?php echo site_url('coa/coa_update')?>";
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
 
    function delete_coa(id)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('coa/coa_delete')?>/"+id,
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
        <h3 class="modal-title">Bahan Baku Form</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">ID Akun</label>
              <div class="col-md-9">
               <input name="id" placeholder="Id Akun" class="form-control" type="text" required="" >
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Nama Akun</label>
              <div class="col-md-9">
                <input name="nama_akun" placeholder="Nama Akun" class="form-control" type="text" required="">
              </div>
            </div>
           
                       <!--  <div class="form-group">
                            <label class="control-label col-md-3">Tanggal</label>
                            <div class="col-md-9">
                                <input name="tanggal" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div> -->
 
          </div>
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    