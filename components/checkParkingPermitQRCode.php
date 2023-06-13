<!-- check parking permit -->

<?php
    $cipgher = $_SERVER["QUERY_STRING"];
    if ($cipgher!='' && $cipgher!='status=success'){
        $iiid = parking_permit_check_qrcode_data($conn , $cipgher);
        if($iiid==-1){
            echo "<div class='alert alert-dismissible fade show alert-danger' role='alert' data-mdb-color='danger'>
            <strong>停車證驗證失敗</strong> 
            <button type='button' class='btn-close' data-mdb-dismiss='alert' aria-label='Close'></button>
            </div>";
        }else{
            $info = parking_permit_read_id($conn , $iiid);
            
            $info=mysqli_fetch_array($info);
            $record_name=$info['name'];
            echo "<div class='alert alert-dismissible fade show alert-success' role='alert' data-mdb-color='success'>
            <strong>$record_name 停車證驗證成功</strong> 
            <button type='button' class='btn-close' data-mdb-dismiss='alert' aria-label='Close'></button>
            </div>";
        }
    }
?>