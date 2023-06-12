<?php
    session_start();
?>

<div class="card m-2 px-4 py-3">
    <div class="d-flex justify-content-between">
        <h4 class="mb-0">換宿申請</h4>
    </div>
</div>

<?php
    //輸出換宿資料

    $result = change_dorm_read_self_account_year($conn , $_SESSION['account'], $_SESSION['year']);

    if (mysqli_num_rows($result) > 0) {
        $info=mysqli_fetch_array($result);
        $id = $info['apply_change_dorm_id']; 
        $year = $info['year'];
        $account = $info['account'];
        $change_dorm_id	= $info['change_dorm_id'];
        $change_room_number = $info['change_room_number'];
        $another_border = $info['another_border'];
        $student_state = $info['student_state'];
        $final_state = $info['final_state'];
        $datetime= $info['datetime'];
        $_SESSION['dormitory_id'] = $info['dormitory_id'];
        $_SESSION['room_number'] = $info['room_number'];
    } else{
        $final_state = -1;
    }
?>
<div class='row row-eq-height m-1 py-2'>
    <div class='col-md-6'>
        <div class='card h-100'>
            <div class='card-body'>
            <h4 class='card-title mx-3'>換宿申請進度</h4>
            <div>
                <ol class='c-stepper px-2'>
                    <li class=<?php if($final_state == -1){echo "c-stepper__item_a";} else{echo "c-stepper__item";} ;?>>
                        <div class='c-stepper__content'>
                            <h3 class='c-stepper__title'>步驟一：申請</h3>
                            <p>提出換宿申請</p>
                        </div>
                    </li>
                    <li class=<?php if($final_state == 0){echo "c-stepper__item_a";} else{echo "c-stepper__item";} ;?>>
                        <div class='c-stepper__content'>
                            <h3 class='c-stepper__title'>步驟二：等待學生審核</h3>
                            <p>換宿對象是否同意換宿</p>
                        </div>
                    </li>
                    <li class=<?php if($final_state==1){echo "c-stepper__item_a";} else{echo "c-stepper__item";} ;?>>
                        <div class='c-stepper__content'>
                            <h3 class='c-stepper__title'>步驟三：等待舍監審核</h3>
                            <p>舍監是否同意換宿</p>
                        </div>
                    </li>
                    <li class=<?php if($final_state==2 || $final_state==3){echo "c-stepper__item_a";} else{echo "c-stepper__item";} ;?>>
                        <div class='c-stepper__content'>
                            <h3 class='c-stepper__title'>步驟四：查看結果</h3>
                            <p>審核結果為通過或未通過，通過即可換宿</p>
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
            <h4 class='card-title mb-4'>換宿申請</h4>
            <?php if($final_state == 1){
                    echo "<div class='p-3 mb-2' style='border-radius:10px; background:#eee'>
                            <p class='fs-5 my-2'><strong>申請日期：</strong><span class='font-monospace'>$datetime</span></p>
                            <p class='fs-5 my-2'><strong>申請年度：</strong><span class='font-monospace'>$year</span></p>
                            <p class='fs-5 my-2'><strong>換宿對象：</strong><span class='font-monospace'>$another_border</span></p>
                            <p class='fs-5 my-2'><strong>申請狀態：</strong><span class='font-monospace'>".$change_dorm_states[$final_state]."</span></p>
                        </div>
                        <form method='post' action='./controller/change_dorm_controller.php'>
                            <input value='$id' required type='hidden' name='apply_change_dorm_id' class='form-control' />
                            <button type='submit' class='btn btn-secondary btn-block' name='delete' value='delete'>刪除</button>
                        </form>";
                
            }else if($final_state == 0){
                echo "<div class='p-3 mb-2' style='border-radius:10px; background:#eee'>
                        <p class='fs-5 my-2'><strong>申請日期：</strong><span class='font-monospace'>$datetime</span></p>
                        <p class='fs-5 my-2'><strong>申請年度：</strong><span class='font-monospace'>$year</span></p>
                        <p class='fs-5 my-2'><strong>換宿對象：</strong><span class='font-monospace'>$another_border</span></p>
                        <p class='fs-5 my-2'><strong>申請狀態：</strong><span class='font-monospace'>".$change_dorm_states[$final_state]."</span></p>
                    </div>";
          if($student_state ==0) 
                echo "
                <form method='post' action='./controller/change_dorm_controller.php'>
                    <input value='$id' required type='hidden' name='apply_change_dorm_id' class='form-control' />
                    <input value='1' required type='hidden' name='student_state' class='form-control' />
                    <input value='$another_border' required type='hidden' name='another_border' class='form-control' />
                    <input value='$year' required type='hidden' name='year' class='form-control' />
                    <input value='1' required type='hidden' name='final_state' class='form-control' />
                    <button type='submit' class='mb-2 btn btn-primary btn-block' name='update' value='update'>同意</button>
                </form>";

                echo "<form method='post' action='./controller/change_dorm_controller.php'>
                    <input value=".$_SESSION['account']." required type='hidden' name='account' class='form-control' />
                    <input value='$year' required type='hidden' name='year' class='form-control' />
                    <input value='$another_border' required type='hidden' name='another_border' class='form-control' />
                    <button type='submit' class='btn btn-secondary btn-block' name='delete' value='delete'>刪除</button>
                </form>";
            }else if($final_state == -1){
                echo "
                    <div class='m-2'>
                        <form method='post' action='./controller/change_dorm_controller.php'>
                            <div class='modal-body'>
                                <div class='form-outline mb-4'>
                                    <div class='text-center mb-3'>
                                        <input readonly value=".$_SESSION['year'].'-'.$_SESSION['account']." readonly required type='text' name='year_account' class='form-control' />
                                        <label class='form-label'>年度-帳號</label>
                                    </div>
                                </div>
                                <select class='form-select mb-4' name='another_border' required>
                                    <option value=''>另一方學生之帳號</option>";
                                        $res = border_read_year($conn, $year);
                                        if (mysqli_num_rows($res) > 0) {
                                            while ($info = mysqli_fetch_assoc($res)){
                                            echo "<option value=".$info['account'].">".$info['account'].''."</option>";
                                            }
                                        }
                                echo "</select>
                            </div>
        
                            <div class='modal-footer'>
                                <button type='submit' class='btn btn-primary btn-block mb-4' name='create' value='create'>申請</button>
                            </div>
                        </form>
                    </div> ";
            }else{

                echo "<div class='p-3 mb-2' style='border-radius:10px; background:#eee'>
                    <p class='fs-5 my-2'><strong>申請日期：</strong><span class='font-monospace'>$datetime</span></p>
                    <p class='fs-5 my-2'><strong>學年：</strong><span class='font-monospace'>$year</span></p>
                    <p class='fs-5 my-2'><strong>換宿對象：</strong><span class='font-monospace'>$another_border</span></p>
                    <p class='fs-5 my-2'><strong>申請狀態：</strong><span class='font-monospace ".$state_classes_defaults[$final_state]."'>".$change_dorm_states[$final_state]."</span></p>
                </div>";
            }
            ?>

            </div>
        </div>
    </div>
</div>

