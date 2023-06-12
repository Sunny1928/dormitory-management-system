<!-- check roll call -->
<?php
$cipgher = $_SERVER["QUERY_STRING"];
if ($cipgher!='' && $cipgher!='status=success'){
  $iiid = roll_call_check_qrcode_data($conn , $cipgher);
  $info = roll_call_read_id($conn , $iiid);
  
  $info=mysqli_fetch_array($info);
  $record_name=$info['name'];
  if($iiid==-1){
    echo "<div class='alert alert-dismissible fade show alert-danger' role='alert' data-mdb-color='danger'>
    <strong>點名失敗</strong> 
    <button type='button' class='btn-close' data-mdb-dismiss='alert' aria-label='Close'></button>
  </div>";
  }else{
  echo "<div class='alert alert-dismissible fade show alert-success' role='alert' data-mdb-color='success'>
  <strong>$record_name 點名成功</strong> 
  <button type='button' class='btn-close' data-mdb-dismiss='alert' aria-label='Close'></button>
</div>";
  }
}
?>