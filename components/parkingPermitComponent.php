

<?php
    //輸出申請住宿資料
    $result = access_card_read_account_year($conn, $_SESSION['account'], $_SESSION['year']);
    if (mysqli_num_rows($result) > 0) {
        $info=mysqli_fetch_array($result);
        $id = $info['temporary_access_card_record_id']; // 不要改
        $year = $info['year'];
        $account = $info['account'];
        $state = $info['state'];
        $datetime= $info['datetime'];
    } else{
        $state = -1;
    }
?>
<div class='row row-eq-height m-1 py-2'>
    <div class='col-md-6'>
        <div class='card h-100'>
            <div class='card-body'>
            <h4 class='card-title mx-3'>汽車准許證申請進度</h4>
            <div>
                <ol class='c-stepper px-2'>
                    <li class=<?php if($state == -1){echo "c-stepper__item_a";} else{echo "c-stepper__item";} ;?>>
                        <div class='c-stepper__content'>
                            <h3 class='c-stepper__title'>步驟一：申請</h3>
                            <p>提出汽車准許證申請</p>
                        </div>
                    </li>
                    <li class=<?php if($state == 0){echo "c-stepper__item_a";} else{echo "c-stepper__item";} ;?>>
                        <div class='c-stepper__content'>
                            <h3 class='c-stepper__title'>步驟二：審核</h3>
                            <p>審核是否分配汽車准許證</p>
                        </div>
                    </li>
                    <li class=<?php if($state == 1 || $state == 2){echo "c-stepper__item_a";} else{echo "c-stepper__item";} ;?>>
                        <div class='c-stepper__content'>
                            <h3 class='c-stepper__title'>步驟三：分發</h3>
                            <p>審核通過或未通過，通過發放 QR Code</p>
                        </div>
                    </li>
                </ol>
            </div>
            </div>
        </div>
    </div>
    <div class='col-md-6 '>
        <div class='card h-100'>
            <div class='card-body'>
            <h4 class='card-title mb-4'>汽車准許證申請</h4>
            <?php if($state == 0){
                echo "<div class='p-3 mb-2' style='border-radius:10px; background:#eee'>
                        <p class='fs-5 my-2'><strong>申請日期：</strong><span class='font-monospace'>$datetime</span></p>
                        <p class='fs-5 my-2'><strong>申請狀態：</strong><span class='font-monospace'>".$apply_dorm_states[$state]."</span></p>
                    </div>
                    <form method='post' action='./controller/access_card_controller.php'>
                        <input value='$id' required type='hidden' name='temporary_access_card_record_id' class='form-control' />
                        <button type='submit' class='btn btn-secondary btn-block' name='delete' value='delete'>刪除</button>
                    </form>";
            }else if($state == -1){
                echo "
                    <div class='m-2'>
                        <form method='post' action='./controller/access_card_controller.php'>
                            <div class='modal-body'>
                                <div class='form-outline mb-4'>
                                    <div class='text-center mb-3'>
                                        <input readonly value="$_SESSION['account']." readonly required type='text' name='account' class='form-control' />
                                        <label class='form-label'>帳號</label>
                                    </div>
                                </div>
                            </div>
        
                            <div class='modal-footer'>
                                <button type='submit' class='btn btn-primary btn-block mb-4' name='create' value='create'>申請</button>
                            </div>
                        </form>
                    </div> ";
            }else{
                $cipgher = access_card_qrcode_data($conn , $id);
                $access_card_url = "https://chart.googleapis.com/chart?cht=qr&chs=512x512&chl=".$cipgher;
                
                echo "
                <div class='p-3 mb-2' style='border-radius:10px; background:#eee'>
                    <p class='fs-5 my-2'>申請成功，可以利用 QR Code 進出宿舍</p>
                    <p >$access_card_url</p>
                    <div class='d-flex justify-content-center'>
                        <img id='barcode' src='$access_card_url' width='256' height='256' />
                    </div>
                </div>
                
                <button type='submit' class='btn btn-primary btn-block'  onclick='location.href=\"$access_card_url\"' >生成 QR Code</button>
                ";
            }
            ?>

            </div>
        </div>
    </div>
</div>
    