<!--News-->
<!--Title-->
<div class="card m-2 px-4 py-3">
    <div class="d-flex justify-content-between">
        <h4 class="mb-0">個人資料</h4>
    </div>
    <div class="mt-4">
        <p>帳號：<?php echo $_SESSION['name'];?></p>
        <p>帳號：<?php echo $_SESSION['account'];?></p>
        <p>email：<?php echo $_SESSION['email'];?></p>
        <p>電話<?php echo $_SESSION['phone'];?></p>
        <p>種類：<?php echo $_SESSION['type：'];?></p>
        <p>性別：<?php echo $_SESSION['gender'];?></p>
        <p>科系：<?php echo $_SESSION['department'];?></p>
        <p>學生帳號：<?php echo $_SESSION['student_account'];?></p>
        <p>宿舍：<?php echo $_SESSION['dormitory_id'];?></p>
        <p>房號：<?php echo $_SESSION['room_number'];?></p>


    </div>
</div>

