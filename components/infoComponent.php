
<div class="card m-2 px-4 py-3">
    <div class="d-flex justify-content-between">
        <h4 class="mb-0">個人資料</h4>
        <button class='btn ms-2 btn-outline-primary btn-sm' data-mdb-toggle='modal' data-mdb-target='#editInfoModal'><i class='fa fa-pencil me-1'></i>編輯密碼</button>
    </div>
    </div>
    <div class="card m-2 px-4 py-3">
    <div>
        <p class="m-1"><b>名稱：</b><?php echo $_SESSION['name'];?></p>
        <p class="m-1"><b>帳號：</b><?php echo $_SESSION['account'];?></p>
        <p class="m-1"><b>Email：</b><?php echo $_SESSION['email'];?></p>
        <p class="m-1"><b>電話：</b><?php echo $_SESSION['phone'];?></p>
        <p class="m-1"><b>種類：</b><?php echo $types[$_SESSION['type']];?></p>
        <p class="m-1"><b>性別：</b><?php echo $genders[$_SESSION['gender']];?></p>
        <?php
        if($_SESSION['permission']!=1 && $_SESSION['permission']!=0 && $_SESSION['permission']!=2){
          echo "<p class='m-1'><b>科系：</b>".$_SESSION['department']."</p>";
          if($_SESSION['permission']!=3)
          echo "<p class='m-1'><b>年度：</b>".$_SESSION['year']."</p>".
          "<p class='m-1'><b>宿舍：</b>".$_SESSION['dormitory_id']."</p>".
          "<p class='m-1'><b>房號：</b>".$_SESSION['room_number']."</p>";
        }
        ?>
        
    </div>
</div>


<div class='modal fade' id='editInfoModal' tabindex='-1' aria-labelledby='editInfoModalLabel' aria-hidden='true'>
  <div class='modal-dialog modal-dialog-centered'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='addSystemManagerModalLabel'>編輯密碼</h5>
      </div>
      <form method='post' action='./controller/user_controller.php'>
        <div class='modal-body'>
          <div class='text-center mb-3'>
          <input required value=<?php echo $_SESSION['account'];?> type='hidden' name='account'  class='form-control' />

            <div class='form-outline mb-4'>
              <input required type='text' name='password'  class='form-control' />
              <label class='form-label'>密碼</label>
            </div>
          </div>
        </div>
        
        <div class='modal-footer'>
          <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
          <button type='submit' class='btn btn-primary' name='edit_password' value='edit_password'>確認</button>
        </div>
      </form>
      
    </div>
  </div>
</div>