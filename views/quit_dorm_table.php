<!-- Quit Dorm Record -->
<!--Title-->
<div class="card m-2 px-4 py-3">
  <div class="d-flex justify-content-between">
    <h4 class="mb-0">退宿申請紀錄</h4>
    <?php
      if($_SESSION["permission"] == 0 || $_SESSION["permission"] == 1){
       echo "<button class='btn ms-2 btn-primary btn-sm' data-mdb-toggle='modal' data-mdb-target='#addQuitDormRecordModal'><i class='fa fa-add me-1'></i>新增</button>";
      }
    ?>
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
              <th scope="col">申請狀態</th>
              <th scope="col">時間</th>
              <?php
              if($_SESSION["permission"] == 0 || $_SESSION["permission"] == 1){
              echo " <th scope='col'>操作</th>";
              }
            ?>
            </tr>
          </thead>
          <tbody class="datatable-body">
            <?php
    
              //$result = quit_dorm_read_all($conn);
              $quit_dorm_states = array("審核中", "通過","未通過");

              if($_SESSION["permission"] == 0 || $_SESSION["permission"] == 1){
                $result = quit_dorm_read_all($conn);
              }else if($_SESSION["permission"] == 2){
                $result = quit_dorm_read_account($conn , $_SESSION['student_account']);
              }else{
                $result = quit_dorm_read_account($conn , $_SESSION['account']);
              }


              if (mysqli_num_rows($result) > 0) 
              {
                while ($info = mysqli_fetch_assoc($result)) 
                {
                  $id = $info['apply_quit_dorm_id']; // 不要改
                  $year = $info['year'];
                  $account = $info['account'];
                  $state = $info['state'];
                  $datetime	 = $info['datetime'];
                  
                  
                  echo "<tr>" .
                    "<td>" . $id . "</td>".
                    "<td>" . $year . "</td>".
                    "<td>" . $account . "</td>".
                    "<td class='".$state_classes[$state]."'>" . $quit_dorm_states[$state] . "</td>".
                    "<td>" . $datetime . "</td>";
                  if($_SESSION["permission"] == 0 || $_SESSION["permission"] == 1){
                    echo  "<td>
                    <button onclick=\"put_apply_dorm('$id','$state')\" class='call-btn btn btn-outline-primary btn-floating btn-sm ripple-surface' data-mdb-toggle='modal' data-mdb-target='#updateQuitDormModal'><i class='fa fa-pencil'></i></button>
                    <button onclick=\"put_apply_dorm('$id','$state')\" class='message-btn btn ms-2 btn-primary btn-floating btn-sm' data-mdb-toggle='modal' data-mdb-target='#deleteQuitDormModal'><i class='fa fa-trash'></i></button>
                  </td>";
                     }  
                  
                  echo   "</tr>";

                  // Update Modal 
                  echo "
                  <div class='modal fade' id='updateQuitDormRecordModal$id' tabindex='-1' aria-labelledby='updateQuitDormRecordModalLabel' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered'>
                    <form method='post' action='./controller/quit_dorm_controller.php'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <h5 class='modal-title' id='updateQuitDormRecordModalLabel'>修改狀態</h5>
                      </div>
                      <div class='modal-body'>
                        <div class='text-center mb-3'>
                          <div class='form-outline mb-4'>
                            <input value='$id' readonly required type='text' name='apply_quit_dorm_id' class='form-control' />
                            <label class='form-label'>申請退宿編號</label>
                          </div>
                          <select class='form-select mb-4' name='state' required>
                            <option value=''>申請狀態</option>";
                            for($i = 0; $i<3; $i++){
                              echo "<option value=$i"; if($state ==$i) echo " selected"; echo ">".$quit_dorm_states[$i]."</option>";
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
                  <div class='modal fade' id='deleteQuitDormRecordModal$id' tabindex='-1' aria-labelledby='deleteQuitDormRecordModalLabel' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered'>
                      <form method='post' action='./controller/quit_dorm_controller.php'>
                        <div class='modal-content'>
                          <div class='modal-header'>
                            <h5 class='modal-title' id='deleteQuitDormRecordModalLabel'>刪除紀錄</h5>
                          </div>
                          <div class='modal-body'>您確認要刪除此紀錄嗎？</div>
                          <div class='modal-footer'>
                            <input value='$id' required type='hidden' name='apply_quit_dorm_id' class='form-control' />
                            <input value='$state' required type='hidden' name='state' class='form-control' />
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
<div class='modal fade' id='addQuitDormRecordModal' tabindex='-1' aria-labelledby='addQuitDormRecordModalLabel' aria-hidden='true'>
  <div class='modal-dialog modal-dialog-centered'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='addSystemManagerModalLabel'>新增退宿紀錄</h5>
      </div>

      <form method='post' action='./controller/quit_dorm_controller.php'>
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

