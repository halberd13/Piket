<div class="alert alert-block alert-success" id="success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Success!</strong> Data has been changed.
</div>
<div class="alert alert-block alert-error" id="error">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Failed!</strong> Data failed to change.
</div>
<div class="container-fluid">
    <table id="data" class="table table-condensed table-striped">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>CSC_B_ID</th>
                        <th>CSC_B_NAME</th>
                        <th>CSC_B_REGISTERED</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $i=1;
                    foreach($model as $val){ ?>
                <tr>
                    <td><?php echo $i?></td>
                    <td><?php echo $val['CSC_B_ID'];?></td>
                    <td><?php echo $val['CSC_B_NAME'];?></td>
                    <td><?php echo $val['CSC_B_REGISTERED'];?></td>
                    <td>
                        <a class="btn btn-warning" title="Edit">Edit</a>
                        <a class="btn btn-danger" onclick='doDelete("<?php echo $val['CSC_B_ID'];?>")' title="delete">Delete</a>
                    </td>
                </tr>
                <?php $i++;} ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5"><a class="btn btn-primary" href="<?php echo Yii::app()->request->baseUrl;?>/index.php?r=bank/add">Add New Bank</a></td>
                    </tr>
                </tfoot>
            </table>
    
</div>
<div class="modal fade bs-update" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Update Informasi</h4>
      </div>
      <div class="modal-body">
          <div class="form-group" id="form-update"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="do-update" type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript" language="javascript">
    $(document).ready(function (){
        $('#data').dataTable();
        $('#success').hide();
        $('#error').hide();
        $('.bs-update').hide();
        $('.btn-warning').click(function (){
            $('.bs-update').modal('show');
        })
        
    });
    
    function doDelete(tId){
        if (!confirm('Anda yakin ingin menghapus data ?'))
        return false;
        
        $.post("<?php echo Yii::app()->homeUrl; ?>/?r=bank/delete", { id: tId })
            .done(function (data){
                if(data=="1"){
                    $("#success").slideDown(500,function (){
                         $(this).fadeOut(3000, function (){
                             location.reload();
                         });
                    });
                }else{
                    $("#error").slideDown(500,function (){
                         $(this).fadeOut(4000, function (){
                         });
                    });
                }
            });
    }
    
    
    function doUpdate(){
            $.post("<?php echo Yii::app()->homeUrl; ?>/?r=bank/update", { 
                    update : true ,
                    dt_id  : $('#dt-id').val(),
                    dt_column  : $('#dt-column').val(),
                    dt_information  : $('#dt-info').val()
                })
                .done(function (data){
                    if(data=="1"){
                        $("#success").slideDown(500,function (){
                             $(this).fadeOut(4000, function (){
                                 location.reload();
                             });
                        });
                    }else{
                        $("#error").slideDown(500,function (){
                             $(this).fadeOut(4000, function (){
                             });
                        });
                    }
            });     
    }

</script>