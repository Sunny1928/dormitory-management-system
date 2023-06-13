<!-- check roll call -->
<?php
  if(isset($_GET['status']) && $_GET['status'] == 'success'){
    echo "<div class='alert alert-dismissible fade show alert-success' role='alert' data-mdb-color='success'>
    <strong>操作成功</strong> 
    <button type='button' class='btn-close' data-mdb-dismiss='alert' aria-label='Close'></button>
  </div>";
  }
?>

