<div class="card m-2 px-4 py-3">
    <div class="d-flex justify-content-between">
        <h4 class="mb-0">樓長聯絡資訊</h4>
    </div>
    </div>
    <div class="card m-2 px-4 py-3">
    <div>
        <?php
            $result = story_manager_read_dorm_year($conn , $_SESSION['dormitory_id']+2 , $default_year);
            if (mysqli_num_rows($result) > 0) {
                $info = mysqli_fetch_assoc($result);
                echo "<div>
                <p class='m-1'><b>名稱：</b>".$info['name']."</p>
                <p class='m-1'><b>帳號：</b>".$info['account']."</p>
                <p class='m-1'><b>Email：</b>".$info['email']."</p>
                <p class='m-1'><b>電話：</b>".$info['phone']."</p>
                <p class='m-1'><b>種類：</b>".$border_types[$info['type']]."</p>
                <p class='m-1'><b>性別：</b>".$genders[$info['gender']]."</p>
                <p class='m-1'><b>科系：</b>".$info['department']."</p>
                <p class='m-1'><b>宿舍：</b>".$info['dormitory_id']."</p>
                <p class='m-1'><b>房號：</b>".$info['room_number']."</p>
                <p class='m-1'><b>年度：</b>".$info['year']."</p>
              </div>";
            }else{
                echo "尚未選出";
            }
            
        ?>
        
    </div>
</div>