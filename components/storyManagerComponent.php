<div class="card m-2 px-4 py-3">
    <div class="d-flex justify-content-between">
        <h4 class="mb-0">樓長聯絡資訊</h4>
    </div>
    </div>
    <div class="card m-2 px-4 py-3">
    <div>
        <?php
            $result = story_manager_read_dorm_year($conn , $_SESSION['dormitory_id']+2 , $_SESSION['year']);
            $info = mysqli_fetch_assoc($result);
        ?>
        <div>
          <p class="m-1"><b>名稱：</b><?php echo $info['name'];?></p>
          <p class="m-1"><b>帳號：</b><?php echo $info['account'];?></p>
          <p class="m-1"><b>Email：</b><?php echo $info['email'];?></p>
          <p class="m-1"><b>電話：</b><?php echo $info['phone'];?></p>
          <p class="m-1"><b>種類：</b><?php echo $border_types[$info['type']];?></p>
          <p class="m-1"><b>性別：</b><?php echo $genders[$info['gender']];?></p>
          <p class="m-1"><b>科系：</b><?php echo $info['department'];?></p>
          <p class="m-1"><b>宿舍：</b><?php echo $info['dormitory_id'];?></p>
          <p class="m-1"><b>房號：</b><?php echo $info['room_number'];?></p>
          <p class="m-1"><b>年度：</b><?php echo $info['year'];?></p>
        </div>
    </div>
</div>