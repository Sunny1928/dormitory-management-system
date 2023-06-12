<?php
  session_start();
?>

<div class="card m-2 px-4 py-3">
    <div class="d-flex justify-content-between">
        <h4 class="mb-0">點名 QR Code</h4>
    </div>
</div>

<?php
    //輸出申請住宿資料
    $result = roll_call_read_account_year($conn, $_SESSION['account'], $_SESSION['year']);
    if (mysqli_num_rows($result) > 0) {
        $info=mysqli_fetch_array($result);
        $id = $info['roll_call_state_record_id']; // 不要改
        $year = $info['year'];
        $account = $info['account'];
        $state = $info['state'];
        $datetime= $info['datetime'];
    } else{
        $state = -1;
    }
?>

<div class='row row-eq-height m-1 py-2'>
    <div class='col-md-6 '>
        <div class='card h-100'>
            <div class='card-body'>
                <h4 class='card-title mb-4'>點名編號</h4>
                <p class="m-1"><b>編號：</b><?php echo $id;?></p>
                <p class="m-1"><b>年度：</b><?php echo $year;?></p>
                <p class="m-1"><b>帳號：</b><?php echo $account;?></p>
                <p class="m-1"><b>狀態：</b><?php echo $roll_call_states[$state];?></p>
                <p class="m-1"><b>時間：</b><?php echo $datetime;?></p>
            </div>
        </div>
    </div>
    <div class='col-md-6 '>
        <div class='card h-100'>
            <div class='card-body'>
            <h4 class='card-title mb-4'>點名 QR Code</h4>
            <?php 
                $cipgher = roll_call_gen_qrcode_data($conn , $id);
                $access_card_url = "https://chart.googleapis.com/chart?cht=qr&chs=512x512&chl=".$cipgher;
                
                echo "
                <div class='p-3 mb-2 ' style='border-radius:10px; background:#eee'>
                    <p>$access_card_url</p>
                    <div class='d-flex hover-overlay justify-content-center ripple' data-mdb-ripple-color='light'>
                        <a href='$access_card_url'>
                            <img id='barcode' src='$access_card_url' width='256' height='256' />
                        </a>
                    </div>
                </div>";
            ?>
            </div>
        </div>
    </div>
</div>

<!-- <button type='submit' class='btn btn-primary btn-block'  onclick='location.href=\"$access_card_url\"' >生成 QR Code</button> -->
