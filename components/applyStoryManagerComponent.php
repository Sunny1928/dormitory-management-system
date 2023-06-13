<div class="card m-2 px-4 py-3">
    <div class="d-flex justify-content-between">
        <h4 class="mb-0">樓長申請</h4>
    </div>
</div>

<?php
    //輸出申請住宿資料
    $result = border_read_student_year($conn, $_SESSION['account'], $_SESSION['year']);
    if (mysqli_num_rows($result) > 0) {
        $info=mysqli_fetch_array($result);
        $account = $info['account'];
        $type = $info['type'];
        $state = $info['apply_story_manager_state'];
        $year = $info['year'];
        $room_number = $info['room_number'];
        $dormitory_id = $info['dormitory_id'];
        $dormitory_name = $info['dormitory_name'];
    } else{
        $state = -1;
    }
?>
<div class='row row-eq-height m-1 py-2'>
    <div class='col-md-6'>
        <div class='card h-100'>
            <div class='card-body'>
                <h4 class='card-title mx-3'>樓長申請進度</h4>
                <div>
                    <ol class='c-stepper px-2'>
                        <li class=<?php if($state == 0){echo "c-stepper__item_a";} else{echo "c-stepper__item";} ;?>>
                            <div class='c-stepper__content'>
                                <h3 class='c-stepper__title'>步驟一：申請</h3>
                                <p>提出樓長申請</p>
                            </div>
                        </li>
                        <li class=<?php if($state == 1){echo "c-stepper__item_a";} else{echo "c-stepper__item";} ;?>>
                            <div class='c-stepper__content'>
                                <h3 class='c-stepper__title'>步驟二：審核並分發</h3>
                                <p>審核後，公布樓長名單</p>
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
            <h4 class='card-title mb-4'>樓長申請</h4>
            <?php if($type >= 2){
                echo "<div class='p-3 mb-2' style='border-radius:10px; background:#eee'>
                <p class='fs-5 my-2'><strong>申請狀態：</strong><span class='font-monospace'>"."分發為樓長"."</span></p>
                </div>";
            }
            else if($state == 1){
                echo "<div class='p-3 mb-2' style='border-radius:10px; background:#eee'>
                        <p class='fs-5 my-2'><strong>申請狀態：</strong><span class='font-monospace'>".$border_apply_story_manager_states[$state]."</span></p>
                    </div>
                    <form method='post' action='./controller/border_controller.php'>
                        <input value='$account' required type='hidden' name='account' class='form-control' />
                        <input value='$type' required type='hidden' name='type' class='form-control' />
                        <input value='0' required type='hidden' name='apply_story_manager_state' class='form-control' />
                        <input value='$year' required type='hidden' name='year' class='form-control' />
                        <input value='$room_number' required type='hidden' name='room_number' class='form-control' />
                        <input value='$dormitory_id' required readonly type='hidden' name='dormitory_id' class='form-control' />
                        <button type='submit' class='btn btn-secondary btn-block' name='update' value='update'>刪除</button>
                    </form>";
            }else{
                echo "
                    <div class='m-2'>
                        <form method='post' action='./controller/border_controller.php'>
                            <div class='modal-body'>
                                <div class='form-outline mb-4'>
                                    <div class='text-center mb-3'>
                                    <input readonly value=".($default_year)." readonly required type='text' name='year' class='form-control' />
                                    <label class='form-label'>年度</label>
                                    </div>
                                </div>
                                <div class='form-outline mb-4'>
                                    <div class='text-center mb-3'>
                                    <input readonly value=".$_SESSION['account']." readonly required type='text' name='account' class='form-control' />
                                    <label class='form-label'>帳號</label>
                                    </div>
                                </div>
                                    
                                <input value='$type' required type='hidden' name='type' class='form-control' />
                                <input value='1' required type='hidden' name='apply_story_manager_state' class='form-control' />
                                <input value='$room_number' required type='hidden' name='room_number' class='form-control' />
                                <input value='$dormitory_id' required readonly type='hidden' name='dormitory_id' class='form-control' />
                            </div>
        
                            <div class='modal-footer'>
                                <button type='submit' class='btn btn-primary btn-block mb-4' name='update' value='apply'>申請</button>
                            </div>
                        </form>
                    </div> ";
            }
            ?>

            </div>
        </div>
    </div>
</div>
    