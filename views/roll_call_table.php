<!-- Roll Call Record -->
<!--Title-->
<div class="card m-2 px-4 py-3">
  <div class="d-flex justify-content-between">
    <h4 class="mb-0">點名紀錄</h4>
    <div class="d-flex">
      <select type="text" id="rollCallYearFilter" onchange="table_filter('rollCallYearFilter','rollCallTable',1)" class='form-select-sm ms-2'  required>
        <option value=''>年</option>
        <?php
        for($i = 0; $i<count($years); $i++){
          echo "<option value=".$years[$i].">".$years[$i]."</option>";
        }?>
      </select>
      <select type="text" id="rollCallStateFilter" onchange="table_filter('rollCallStateFilter', 'rollCallTable', 3)" class='form-select-sm ms-2'  required>
        <option value=''>點名狀態</option>
        <?php
        for($i = 0; $i<count($roll_call_states); $i++){
          echo "<option value=".$roll_call_states[$i].">".$roll_call_states[$i]."</option>";
        }?>
      </select>
      <?php 
        if( $_SESSION["permission"] == 0 || story_manager_check($conn , $_SESSION['account'] , $_SESSION['year']))
          echo "<button class='btn ms-2 btn-primary btn-sm' data-mdb-toggle='modal' data-mdb-target='#addRollCallRecordModal'><i class='fa fa-add me-1'></i>新增</button>";
      ?>
    </div>
      
  </div>
</div>


<!-- Table -->
<div class="card m-2">
  <section class="border p-4">
    <div data-mdb-hover="true" class="datatable datatable-hover">
      <div class="datatable-inner table-responsive ps" style="overflow: auto; position: relative;">
        <table id="rollCallTable" class="table datatable-table">
          <thead class="datatable-header">
            <tr>
              <th scope="col">編號</th> 
              <th scope="col">年</th>
              <th scope="col">帳號</th>
              <th scope="col">點名狀態</th>
              <th scope="col">時間</th>
              <?php 
                if( $_SESSION["permission"] == 0 || story_manager_check($conn , $_SESSION['account'] , $_SESSION['year']))
                  echo "<th scope='col'>操作</th>";
              ?>
            </tr>
          </thead>
          <tbody class="datatable-body">
            <?php
              if( $_SESSION["permission"] == 0 ){
                $result = roll_call_read_all($conn);
              }else if (story_manager_check($conn, $_SESSION['account'], $_SESSION['year'])){ // story manager
                $result = roll_call_read_all($conn);
              }else if( $_SESSION["permission"] == 2){ // parents
                $result = roll_call_read_account($conn, $_SESSION['student_account']);
              }else{ // students
                $result = roll_call_read_account($conn, $_SESSION['account']);
              }

              if (mysqli_num_rows($result) > 0) 
              {
                while ($info = mysqli_fetch_assoc($result)) 
                {
                  $id = $info['roll_call_state_record_id']; 
                  $year = $info['year'];
                  $account = $info['account'];
                  $state = $info['state'];
                  $datetime	 = $info['datetime'];
                  
                  echo "<tr>" .
                    "<td>" . $id . "</td>".
                    "<td>" . $year . "</td>".
                    "<td>" . $account . "</td>".
                    "<td class='".$state_classes[$state]."'>" . $roll_call_states[$state] . "</td>".
                    "<td>" . $datetime . "</td>";
                  if( $_SESSION["permission"] == 0 || story_manager_check($conn , $_SESSION['account'] , $_SESSION['year'])){
                    echo "<td>
                      <button class='call-btn btn btn-outline-primary btn-floating btn-sm ripple-surface' data-mdb-toggle='modal' data-mdb-target='#updateRollCallRecordModal$id'><i class='fa fa-pencil'></i></button>
                      <button class='message-btn btn ms-2 btn-primary btn-floating btn-sm' data-mdb-toggle='modal' data-mdb-target='#deleteRollCallRecordModal$id'><i class='fa fa-trash'></i></button>
                    </td>";
                  }  
                  echo "</tr>";

                  // Update Modal
                  echo "
                  <div class='modal fade' id='updateRollCallRecordModal$id' tabindex='-1' aria-labelledby='updateRollCallRecordModalLabel' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered'>
                    <form method='post' action='./controller/roll_call_controller.php'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <h5 class='modal-title' id='updateRollCallRecordModalLabel'>修改紀錄</h5>
                      </div>
                      <div class='modal-body'>
                        <div class='text-center mb-3'>
                          <div class='form-outline mb-4'>
                            <input value='$id' readonly required type='text' name='roll_call_state_record_id' class='form-control' />
                            <label class='form-label'>點名紀錄編號</label>
                          </div>
                          <select class='form-select mb-4' name='state' required>
                            <option value=''>點名狀態</option>";
                            for($i = 0; $i<2; $i++){
                              echo "<option value=$i"; if($state ==$i) echo " selected"; echo ">".$roll_call_states[$i]."</option>";
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
                  <div class='modal fade' id='deleteRollCallRecordModal$id' tabindex='-1' aria-labelledby='deleteRollCallRecordModalLabel' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered'>
                      <form method='post' action='./controller/roll_call_controller.php'>
                        <div class='modal-content'>
                          <div class='modal-header'>
                            <h5 class='modal-title' id='deleteRollCallRecordModalLabel'>刪除紀錄</h5>
                          </div>
                          <div class='modal-body'>您確認要刪除此紀錄嗎？</div>
                          <div class='modal-footer'>
                            <input value='$id' required type='hidden' name='roll_call_state_record_id' class='form-control' />
                            <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
                            <button type='submit' class='btn btn-primary' name='delete' value='delete'>確認</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>";
                }
              }else{
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
<?php

if( $_SESSION["permission"] == 0 || story_manager_check($conn , $_SESSION['account'] , $_SESSION['year'])){

echo "<div class='modal fade' id='addRollCallRecordModal' tabindex='-1' aria-labelledby='addRollCallRecordModalLabel' aria-hidden='true'>
  <div class='modal-dialog modal-dialog-centered'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='addSystemManagerModalLabel'>新增點名紀錄</h5>
      </div>

      <form method='post' action='./controller/roll_call_controller.php'>
        <div class='modal-body'>
          <div class='text-center mb-3'>
          <select class='form-select mb-4' name='year_account' required>
              <option value=''>年度-帳號</option>";
                $res = border_read_all($conn);
                if (mysqli_num_rows($res) > 0) {
                  while ($info = mysqli_fetch_assoc($res)){
                    echo "<option value=".$info['year'].'-'.$info['account'].">".$info['year'].'-'.$info['account'].''."</option>";
                  }
                }
            echo "</select>
            <select class='form-select mb-4' name='state' required>
              <option value=''>狀態</option>";
              for($i = 0; $i<2; $i++){
                echo "<option value=$i>".$roll_call_states[$i]."</option>";
              }
            echo "</select>
          </div>
        </div>
        
        <div class='modal-footer'>
          <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
          <button type='submit' class='btn btn-primary' name='create' value='create'>確認</button>
        </div>
      </form>
      
    </div>
  </div>
</div>";
}
?>
