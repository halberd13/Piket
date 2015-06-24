
<div class="container-fluid">
    <table id="data" class="table table-hover table-responsive">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>CSC_DC_ID</th>
                        <th>CSC_DC_NAME</th>
                        <th>CSC_DC_TYPE</th>
                        <th>CSC_DC_TERMINAL_TYPE</th>
                        <th>CSC_DC_REGISTERED</th>
                    </tr>
                </thead>
                <?php 
                    $i=1;
                    foreach($model as $val){ ?>
                    <tr>
                        <td><?php echo $i?></td>
                        <td><a href="#" id="detil-mitra"><?php echo $val['CSC_DC_ID'];?></a></td>
                        <td><a href="#"><?php echo $val['CSC_DC_NAME'];?></a></td>
                        <td><?php echo $val['CSC_DC_TYPE'];?></td>
                        <td><?php echo $val['CSC_DC_TERMINAL_TYPE'];?></td>
                        <td><?php echo $val['CSC_DC_REGISTERED'];?></td>
                    </tr>
                <?php $i++;} ?>
            </table>
    
</div>  
<script type="text/javascript" language="javascript">
 
        $('#data').dataTable();
//        $('.modal').hide();
        $('.detil-mitra').click(function (){
            $('.modal').modal('show');
            var cid = $(this).text();
            var dbRes = [];
            var url = "<?php echo Yii::app()->request->baseUrl;?>/index.php?r=mitra";
                $.post( url, { cid : cid })
                    .done(function( data ) {
                        alert(data);
//                        for(i=0;i<length.data;i++){
//                            alert(data[i].CSC_B_ID);
//                        }
                    });

            
        })

</script>