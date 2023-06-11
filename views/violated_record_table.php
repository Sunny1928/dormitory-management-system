<!-- Violated Record -->
<!--Title-->
<div class="card m-2 px-4 py-3">
  <div class="d-flex justify-content-between">
    <h4 class="mb-0">違規紀錄資料</h4>
    <div class="d-flex">
      <select type="text" id="violatedRecordAccountFilter" onchange="table_filter('violatedRecordAccountFilter','violatedRecordTable',2)" class='form-select-sm ms-2'  required>
        <option value=''>帳號</option>
        <?php
        for($i = 0; $i<count($border_apply_story_manager_states); $i++){
          echo "<option value=".$border_apply_story_manager_states[$i].">".$border_apply_story_manager_states[$i]."</option>";
        }?>
      </select>
      <select type="text" id="violatedRecordStateFilter" onchange="table_filter('violatedRecordStateFilter','violatedRecordTable',4)" class='form-select-sm ms-2'  required>
        <option value=''>申請取消狀態</option>
        <?php
        for($i = 0; $i<count($apply_cancel_states); $i++){
          echo "<option value=".$apply_cancel_states[$i].">".$apply_cancel_states[$i]."</option>";
        }?>
      </select>
      <?php 
        if($_SESSION["permission"] == 0 || $_SESSION["permission"] == 1){
          echo "<button class='btn ms-2 btn-primary btn-sm' data-mdb-toggle='modal' data-mdb-target='#addViolatedRecordModal'><i class='fa fa-add me-1'></i>新增</button>";
        }
      ?>
    </div>
  </div>
</div>

<!-- Table -->
<div class="card m-2">
  <section class="border p-4">
    <div data-mdb-hover="true" class="datatable datatable-hover">
      <div class="datatable-inner table-responsive ps" style="overflow: auto; position: relative;">
        <table id='violatedRecordTable' class="table datatable-table">
          <thead class="datatable-header">
            <tr>
              <th scope="col">編號</th> 
              <th scope="col">年</th>
              <th scope="col">帳號</th>
              <th scope="col">規範</th>
              <th scope="col">申請取消</th>
              <th scope="col">時間</th>
              <?php
                if($_SESSION["permission"] != 2){
                  echo "<th scope='col'>操作</th>";
                }
              ?>
            </tr>
          </thead>
          <tbody class="datatable-body">
            <?php
              if($_SESSION["permission"] == 0 || $_SESSION["permission"] == 1){
                $result = violated_record_read_all($conn);
              }else if($_SESSION["permission"] == 2) {
                $result = violated_record_read_account($conn , $_SESSION['student_account']);
              }else{
                $result = violated_record_read_account($conn , $_SESSION['account']);
              }

              if (mysqli_num_rows($result) > 0) 
              {
                while ($info = mysqli_fetch_assoc($result)) 
                {
                  $id = $info['violated_record_id']; // 不要改
                  $year = $info['year'];
                  $account = $info['account'];
                  $rule_id = $info['rule_id'];
                  $content = $info['content'];
                  $apply_cancel = $info['apply_cancel'];
                  $datetime	 = $info['datetime'];
                  
                  echo "<tr>" .
                    "<td>" . $id . "</td>".
                    "<td>" . $year . "</td>".
                    "<td>" . $account . "</td>".
                    "<td>" . $content . "</td>".
                    "<td>" . $apply_cancel_states[$apply_cancel] . "</td>".
                    "<td>" . $datetime . "</td>";
                  if($_SESSION["permission"] == 0 || $_SESSION["permission"] == 1){
                    echo "<td>
                      <button class='call-btn btn btn-outline-primary btn-floating btn-sm ripple-surface' data-mdb-toggle='modal' data-mdb-target='#updateViolatedRecordModal$id'><i class='fa fa-pencil'></i></button>
                      <button class='message-btn btn ms-2 btn-primary btn-floating btn-sm' data-mdb-toggle='modal' data-mdb-target='#deleteViolatedRecordModal$id'><i class='fa fa-trash'></i></button>
                    </td>";
                  } else if($_SESSION["permission"] != 2){
                    echo "<td> <button "; if($apply_cancel != 0) echo " disabled ";
                    echo  "class='message-btn btn ms-2 btn-outline-primary btn-floating btn-sm' data-mdb-toggle='modal' data-mdb-target='#confirmViolatedRecordModal$id'><i class='fa fa-circle-info'></i></button></td>";
                  }
                  echo  "</tr>";

                  // Update Modal
                  echo "
                  <div class='modal fade' id='updateViolatedRecordModal$id' tabindex='-1' aria-labelledby='updateViolatedRecordModalLabel' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered'>
                    <form method='post' action='./controller/violated_record_controller.php'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <h5 class='modal-title' id='updateViolatedRecordModalLabel'>修改違規紀錄</h5>
                      </div>
                      <div class='modal-body'>
                        <div class='text-center mb-3'>
                          <div class='form-outline mb-4'>
                            <input value='$id' readonly required type='text' name='violated_record_id' class='form-control' />
                            <label class='form-label'>違規紀錄編號</label>
                          </div>
                          <select class='form-select mb-4' name='rule_id' required>
                            <option value=''>規範</option>";
                            $res = rule_read_all($conn);
                            if (mysqli_num_rows($res) > 0) {
                              while ($info = mysqli_fetch_assoc($res)){
                                echo "<option value=".$info['rule_id'];
                                if($rule_id ==$info['rule_id']) echo " selected";
                                echo " >".$info['content']."</option>";
                              }
                            }
                          echo "</select>
                          <select class='form-select mb-4' name='apply_cancel' required>
                            <option value=''>申請取消狀態</option>";
                            for($i = 0; $i<4; $i++){
                              echo "<option value=$i"; if($apply_cancel ==$i) echo " selected"; echo ">".$apply_cancel_states[$i]."</option>";
                            }
                          echo "</select>
                        </div>
                      </div>
                      <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
                        <button type='submit' class='btn btn-primary' name='update' value='update'>確認</button>
                      </div>
                    </div>
                    </form>
                    </div>
                  </div>";
                  

                  // Delete  Modal
                  echo "
                  <div class='modal fade' id='deleteViolatedRecordModal$id' tabindex='-1' aria-labelledby='deleteViolatedRecordModalLabel' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered'>
                      <form method='post' action='./controller/violated_record_controller.php'>
                        <div class='modal-content'>
                          <div class='modal-header'>
                            <h5 class='modal-title' id='deleteViolatedRecordModalLabel'>刪除違規紀錄</h5>
                          </div>
                          <div class='modal-body'>您確認要刪除此違規紀錄嗎？</div>
                          <div class='modal-footer'>
                            <input value='$id' required type='hidden' name='violated_record_id' class='form-control' />
                            <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
                            <button type='submit' class='btn btn-primary' name='delete' value='delete'>確認</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>";

                  // Confirm  Modal
                  echo "
                  <div class='modal fade' id='confirmViolatedRecordModal$id' tabindex='-1' aria-labelledby='confirmViolatedRecordModalLabel' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered'>
                      <form method='post' action='./controller/violated_record_controller.php'>
                        <div class='modal-content'>
                          <div class='modal-header'>
                            <h5 class='modal-title' id='confirmViolatedRecordModalLabel'>申請違規紀錄取消</h5>
                          </div>
                          <div class='modal-body'>您確認要申請此違規紀錄取消嗎？</div>
                          <div class='modal-footer'>
                            <input value='$id' required type='hidden' name='violated_record_id' class='form-control' />
                            <input value='$rule_id' required type='hidden' name='rule_id' class='form-control' />
                            <input value='1' required type='hidden' name='apply_cancel' class='form-control' />
                            <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
                            <button type='submit' class='btn btn-primary' name='update' value='update'>確認</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>";
                }
              } else{
                echo "<td class='text-center' colspan='100%'>無</td>";
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>



<!-- Add Modal -->
<div class='modal fade' id='addViolatedRecordModal' tabindex='-1' aria-labelledby='addViolatedRecordModalLabel' aria-hidden='true'>
  <div class='modal-dialog modal-dialog-centered'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='addSystemManagerModalLabel'>新增違規紀錄</h5>
      </div>

      <form method='post' action='./controller/violated_record_controller.php'>
        <div class='modal-body'>
          <div class='text-center mb-3'>
            <select class='form-select mb-4' name='year_account' required>
              <option value=''>年度-帳號</option>
              <?php
                $res = border_read_all($conn);
                if (mysqli_num_rows($res) > 0) {
                  while ($info = mysqli_fetch_assoc($res)){
                    echo "<option value=".$info['year'].'-'.$info['account'].">".$info['year'].'-'.$info['account'].''."</option>";
                  }
                }
              ?>
            </select>
            <select class='form-select mb-4' name='rule_id' required>
              <option value=''>規範編號</option>
              <?php
                $res = rule_read_all($conn);
                if (mysqli_num_rows($res) > 0) {
                  while ($info = mysqli_fetch_assoc($res)){
                    echo "<option value=".$info['rule_id'].">".$info['content'].''."</option>";
                  }
                }
              ?>
            </select>
          </div>
        </div>
        
        <div class='modal-footer'>
          <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
          <button type='submit' class='btn btn-primary' name='create' value='create'>確認</button>
        </div>
      </form>
      
    </div>
  </div>
</div>

