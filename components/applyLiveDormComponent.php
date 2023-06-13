<div class="card m-2 px-4 py-3">
    <div class="d-flex justify-content-between">
        <h4 class="mb-0">住宿申請</h4>
    </div>
</div>

<?php
    //輸出申請住宿資料
    $result = apply_dorm_read_account_year($conn , $_SESSION['account'] , $default_year);
    
    if (mysqli_num_rows($result) > 0) {
        $result=mysqli_fetch_array($result);
        $id = $result['apply_dorm_id'];
        $account = $result['account'];
        $state = $result['state'];  // 1
        $year = $result['year']; 
        $datetime = $result['datetime'];  
    } else{
        $state = -1;
    }
?>
<div class='row row-eq-height m-1 py-2'>
    <div class='col-md-6'>
        <div class='card h-100'>
            <div class='card-body'>
            <h4 class='card-title mx-3'>宿舍申請進度</h4>
            <div>
                <ol class='c-stepper px-2'>
                    <li class=<?php if($state == -1){echo "c-stepper__item_a";} else{echo "c-stepper__item";} ;?>>
                        <div class='c-stepper__content'>
                            <h3 class='c-stepper__title'>步驟一：申請</h3>
                            <p>對下學期的住宿提出申請</p>
                        </div>
                    </li>
                    <li class=<?php if($state == 0){echo "c-stepper__item_a";} else{echo "c-stepper__item";} ;?>>
                        <div class='c-stepper__content'>
                            <h3 class='c-stepper__title'>步驟二：審核</h3>
                            <p>會依照你的違規紀錄，分配宿舍，若你扣分的幾點越多，越難抽到</p>
                        </div>
                    </li>
                    <li class=<?php if($state == 1 || $state == 2){echo "c-stepper__item_a";} else{echo "c-stepper__item";} ;?>>
                        <div class='c-stepper__content'>
                            <h3 class='c-stepper__title'>步驟三：分發</h3>
                            <p>公布抽到宿舍名單</p>
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
            <h4 class='card-title mb-4'>宿舍申請</h4>
            <?php if($state == 0){
                echo "<div class='p-3 mb-2' style='border-radius:10px; background:#eee'>
                        <p class='fs-5 my-2'><strong>申請日期：</strong><span class='font-monospace'>$datetime</span></p>
                        <p class='fs-5 my-2'><strong>申請年度：</strong><span class='font-monospace'>$year</span></p>
                        <p class='fs-5 my-2'><strong>申請狀態：</strong><span class='font-monospace'>".$apply_dorm_states[$state]."</span></p>
                    </div>
                    <form method='post' action='./controller/apply_dorm_controller.php'>
                        <input value='$id' required type='hidden' name='apply_dorm_id' class='form-control' />
                        <button type='submit' class='btn btn-secondary btn-block' name='delete' value='delete'>刪除</button>
                    </form>";
            }else if($state == -1){
                echo "
                    <div class='m-2'>
                        <form method='post' action='./controller/apply_dorm_controller.php'>
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
                                <select class='form-select mb-4' name='first_priority_dorm' required>
                                    <option value=''>宿舍第一選擇</option>";
                                    if($_SESSION['gender']==0){
                                        echo "<option value=0>學一男</option>";
                                        echo "<option value=2>學二男</option>";
                                    }else{
                                        echo "<option value=1>學一女</option>";
                                        echo "<option value=3>學二女</option>";
                                    }
                                echo "</select>
                                <select class='form-select mb-4' name='second_priority_dorm' required>
                                    <option value=''>宿舍第二選擇</option>";
                                    if($_SESSION['gender']==0){
                                        echo "<option value=0>學一男</option>";
                                        echo "<option value=2>學二男</option>";
                                    }else{
                                        echo "<option value=1>學一女</option>";
                                        echo "<option value=3>學二女</option>";
                                    }
                                echo "</select>
                            </div>
        
                            <div class='modal-footer'>
                                <button type='submit' class='btn btn-primary btn-block mb-4' name='create' value='create'>申請</button>
                            </div>
                        </form>
                    </div> ";
            }else if($state == 1 || $state == 2){
                echo "<div class='p-3 mb-2' style='border-radius:10px; background:#eee'>
                        <p class='fs-5 my-2'><strong>申請日期：</strong><span class='font-monospace'>$datetime</span></p>
                        <p class='fs-5 my-2'><strong>申請年度：</strong><span class='font-monospace'>$year</span></p>
                        <p class='fs-5 my-2'><strong>申請狀態：</strong><span class='font-monospace ".$state_classes[$state]."'>".$apply_dorm_states[$state]."</span></p>
                    </div>";
                }
            ?>

            </div>
        </div>
    </div>
</div>
    