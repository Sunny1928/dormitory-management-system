<!-- Change Dorm Record -->
<!--Title-->
<div class="card m-2 px-4 py-3">
  <div class="d-flex justify-content-between">
    <h4 class="mb-0">換宿申請紀錄</h4>
    <button class='btn ms-2 btn-primary btn-sm' data-mdb-toggle='modal' data-mdb-target='#addChangeDormRecordModal'><i class='fa fa-add me-1'></i>新增</button>
  </div>
</div>


<!-- Table -->
<div class="card m-2">
  <section class="border p-4">
    <div data-mdb-hover="true" class="datatable datatable-hover">
      <div class="datatable-inner table-responsive ps" style="overflow: auto; position: relative;">
        <table class="table datatable-table">
          <thead class="datatable-header">
            <tr>
              <th scope="col">編號</th> 
              <th scope="col">年</th>
              <th scope="col">帳號</th>
              <th scope="col">大樓ID</th>
              <th scope="col">房間號碼</th>
              <th scope="col">另一方學生之帳號</th>
              <th scope="col">學生同意狀態</th>
              <th scope="col">最終審核狀態</th>
              <th scope="col">時間</th>
              <th scope="col">操作</th>
            </tr>
          </thead>
          <tbody class="datatable-body">
            <?php
    
              $result = change_dorm_read_all($conn);
              $student_states = array("學生未同意", "學生同意");
              $final_states  = array("等待同意", "兩位學生同意","舍監通過","未通過");
              	
              if (mysqli_num_rows($result) > 0) 
              {
                while ($info = mysqli_fetch_assoc($result)) 
                {
                  $id = $info['apply_change_dorm_id'];
                  $year = $info['year'];
                  $account = $info['account'];
                  $change_dorm_id = $info['change_dorm_id'];
                  $change_room_number = $info['change_room_number'];
                  $another_border = $info['another_border'];
                  $student_state = $info['student_state'];
                  $final_state = $info['final_state'];
                  $datetime	 = $info['datetime'];
                  
                  
                  echo "<tr>" .
                    "<td>" . $id . "</td>".
                    "<td>" . $year . "</td>".
                    "<td>" . $account . "</td>".
                    "<td>" . $change_dorm_id . "</td>".
                    "<td>" . $change_room_number . "</td>".
                    "<td>" . $another_border . "</td>".
                    "<td class='".$state_classes[$student_state]."'>" . $student_states[$student_state] . "</td>".
                    "<td class='".$state_classes[$final_state]."'>" . $final_states[$final_state] . "</td>".
                    "<td>" . $datetime . "</td>".
                    "<td>
                      <button class='call-btn btn btn-outline-primary btn-floating btn-sm ripple-surface' data-mdb-toggle='modal' data-mdb-target='#updateChangeDormRecordModal$id'><i class='fa fa-pencil'></i></button>
                      <button class='message-btn btn ms-2 btn-primary btn-floating btn-sm' data-mdb-toggle='modal' data-mdb-target='#deleteChangeDormRecordModal$id'><i class='fa fa-trash'></i></button>
                    </td>".
                    "</tr>";

                  // Update Modal 
                  echo "
                  <div class='modal fade' id='updateChangeDormRecordModal$id' tabindex='-1' aria-labelledby='updateChangeDormRecordModalLabel' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered'>
                    <form method='post' action='./controller/change_dorm_controller.php'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <h5 class='modal-title' id='updateChangeDormRecordModalLabel'>修改狀態</h5>
                      </div>
                      <div class='modal-body'>
                        <div class='text-center mb-3'>
                          <div class='form-outline mb-4'>
                            <input value='$id' readonly required type='text' name='apply_change_dorm_id' class='form-control' />
                            <label class='form-label'>申請換宿編號</label>
                          </div>
                          <div class='form-outline mb-4'>
                            <input value='$year' readonly required type='text' name='year' class='form-control' />
                            <label class='form-label'>年</label>
                          </div>

                          <select class='form-select mb-4' name='student_state' required>
                            <option value=''>學生同意狀態</option>";
                            for($i = 0; $i<2; $i++){
                              echo "<option value=$i"; if($student_state ==$i) echo " selected"; echo ">".$student_states[$i]."</option>";
                            }
                          echo "</select>

                          <select class='form-select mb-4' name='final_state' required>
                            <option value=''>最終審核狀態</option>";
                            for($i = 0; $i<4; $i++){
                              echo "<option value=$i"; if($final_state ==$i) echo " selected"; echo ">".$final_states[$i]."</option>";
                            }
                          echo "</select>
                          <select class='form-select mb-4' name='another_border' required>
                          <option value=''>另一方學生之帳號</option>";
                          
                              $res = border_read_year($conn, $year);
                              echo mysqli_num_rows($res);
                              if (mysqli_num_rows($res) > 0) {
                                        while ($info = mysqli_fetch_assoc($res)){
                                          echo "<option value=".$info['account']; if($another_border ==$info['account']) echo " selected"; echo ">".$info['account'].''."</option>";
                                        }
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
                  <div class='modal fade' id='deleteChangeDormRecordModal$id' tabindex='-1'  aria-labelledby='deleteChangeDormRecordModalLabel' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered'>
                      <form method='post' action='./controller/change_dorm_controller.php'>
                        <div class='modal-content'>
                          <div class='modal-header'>
                            <h5 class='modal-title' id='deleteChangeDormRecordModalLabel'>刪除紀錄</h5>
                          </div>
                          <div class='modal-body'>您確認要刪除此紀錄嗎？</div>
                          <div class='modal-footer'> 
                              <input value='$account' required type='hidden' name='account' class='form-control' />
                              <input value='$year' required type='hidden' name='year' class='form-control' />
                              <input value='$another_border' required type='hidden' name='another_border' class='form-control' />
                            <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
                            <button type='submit' class='btn btn-primary' name='delete' value='delete'>確認</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>";
                }
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>



<!-- Add Modal -->
<div class='modal fade' id='addChangeDormRecordModal' tabindex='-1' aria-labelledby='addChangeDormRecordModalLabel' aria-hidden='true'>
  <div class='modal-dialog modal-dialog-centered'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='addSystemManagerModalLabel'>新增換宿紀錄</h5>
      </div>

      <form method='post' action='./controller/change_dorm_controller.php'>
        <div class='modal-body'>
          <div class='text-center mb-3'>
          <select class='form-select mb-4' name='year_account' required>
              <option value=''>年度-帳號</option>
              <?php
                $res = border_read_all($conn);
                if (mysqli_num_rows($res) > 0) {
                  while ($info = mysqli_fetch_assoc($res)){
                    echo "<option value=".$default_year.'-'.$info['account'].">".$default_year.'-'.$info['account'].''."</option>";
                  }
                }
              ?>
          </select>

          <select class='form-select mb-4' name='another_border' required>
              <option value=''>另一方學生之帳號</option>
              <?php
                $res = border_read_all($conn);
                if (mysqli_num_rows($res) > 0) {
                  while ($info = mysqli_fetch_assoc($res)){
                    echo "<option value=".$info['account'].">".$info['account']."</option>";
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

