<!-- Entry And Exit Dormitory Record -->
<!--Title-->
<div class="card m-2 px-4 py-3">
  <div class="d-flex justify-content-between">
    <h4 class="mb-0">進出紀錄</h4>
    <div class="d-flex">
      <select type="text" id="entryExitYearFilter" onchange="table_filter('entryExitYearFilter','entryExitTable',1)" class='form-select-sm ms-2'  required>
        <option value=''>年</option>
        <?php
        for($i = 0; $i<count($years); $i++){
          echo "<option value=".$years[$i].">".$years[$i]."</option>";
        }?>
      </select>
      <select type="text" id="entryExitStateFilter" onchange="table_filter('entryExitStateFilter', 'entryExitTable', 3)" class='form-select-sm ms-2'  required>
        <option value=''>申請狀態</option>
        <?php
        for($i = 0; $i<count($entry_exit_states); $i++){
          echo "<option value=".$entry_exit_states[$i].">".$entry_exit_states[$i]."</option>";
        }?>
      </select>
      <?php 
        if( $_SESSION["permission"] == 0 || $_SESSION["permission"] == 1)
          echo "<button class='btn ms-2 btn-primary btn-sm' data-mdb-toggle='modal' data-mdb-target='#addEntryandexitdormitoryrecordModal'><i class='fa fa-add me-1'></i>新增</button>";
      ?>
    </div>
  </div>
</div>


<!-- Table -->
<div class="card m-2">
  <section class="border p-4">
    <div data-mdb-hover="true" class="datatable datatable-hover">
      <div class="datatable-inner table-responsive ps" style="overflow: auto; position: relative;">
        <table id="entryExitTable" class="table datatable-table">
          <thead class="datatable-header">
            <tr>
              <th scope="col">編號</th> 
              <th scope="col">年</th>
              <th scope="col">帳號</th>
              <th scope="col">進出狀態</th>
              <th scope="col">時間</th>
              <?php 
              if( $_SESSION["permission"] == 0 || $_SESSION["permission"] == 1)
                echo "<th scope='col'>操作</th>"
              ?>
            </tr>
          </thead>
          <tbody class="datatable-body">
            <?php
                // $result = entry_and_exit_read_all($conn);

              if($_SESSION["permission"] == 0 || $_SESSION["permission"] == 1){
                $result = entry_and_exit_read_all($conn);
              }else if( $_SESSION["permission"] == 2){ // parents
                $result = entry_and_exit_read_by_account($conn, $_SESSION['student_account']);
              }else{ // students
                $result = entry_and_exit_read_by_account($conn, $_SESSION['account']);
              }

              if (mysqli_num_rows($result) > 0) 
              {
                while ($info = mysqli_fetch_assoc($result)) 
                {
                  $id = $info['entry_and_exit_dormitory_record_id']; // 不要改
                  $year = $info['year'];
                  $account = $info['account'];
                  $state = $info['state'];
                  $datetime	 = $info['datetime'];
                  
                  echo "<tr>" .
                    "<td>" . $id . "</td>".
                    "<td>" . $year . "</td>".
                    "<td>" . $account . "</td>".
                    "<td>" . $entry_exit_states[$state] . "</td>".
                    "<td>" . $datetime . "</td>";
                    if( $_SESSION["permission"] == 0 || $_SESSION["permission"] == 1){
                      echo "<td>
                        <button onclick=\"put_entry_and_exit('$id','$state')\" class='call-btn btn btn-outline-primary btn-floating btn-sm ripple-surface' data-mdb-toggle='modal' data-mdb-target='#updateEntryRecordModal'><i class='fa fa-pencil'></i></button>
                        <button onclick=\"put_entry_and_exit('$id','$state')\" class='message-btn btn ms-2 btn-primary btn-floating btn-sm' data-mdb-toggle='modal' data-mdb-target='#deleteEntryRecordModal'><i class='fa fa-trash'></i></button>
                      </td>";
                    }
                    echo "</tr>";
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
  if( $_SESSION["permission"] == 0 || $_SESSION["permission"] == 1){
        
  echo "<div class='modal fade' id='addEntryandexitdormitoryrecordModal' tabindex='-1' aria-labelledby='addEntryandexitdormitoryrecordModalLabel' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered'>
      <div class='modal-content'>
        <div class='modal-header'>
          <h5 class='modal-title' id='addSystemManagerModalLabel'>新增進出宿舍紀錄</h5>
        </div>

        <form method='post' action='./controller/entry_and_exit_controller.php'>
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
                  echo "<option value=$i>".$entry_exit_states[$i]."</option>";
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

// Update Modal
echo "
<div class='modal fade' id='updateEntryRecordModal' tabindex='-1' aria-labelledby='updateEntryandexitRecordModalLabel' aria-hidden='true'>
  <div class='modal-dialog modal-dialog-centered'>
  <div class='modal-content'>
  <form method='post' action='./controller/entry_and_exit_controller.php'>
    <div class='modal-header'>
      <h5 class='modal-title' id='updateEntryandexitRecordModalLabel'>修改紀錄</h5>
    </div>
    <div class='modal-body'>
      <div class='text-center mb-3'>
        <div class='form-outline mb-4'>
          <input id='id' readonly required type='text' name='entry_and_exit_dormitory_record_id' class='form-control' />
          <label class='form-label'>進出紀錄編號</label>
        </div>
        <select id='state' class='form-select mb-4' name='state' required>
          <option value=''>進出狀態</option>";
          for($i = 0; $i<2; $i++){
            echo "<option value=$i"; if($state ==$i) echo " selected"; echo ">".$entry_exit_states[$i]."</option>";
          }
        echo "</select>
      </div>
    </div>
    <div class='modal-footer'>
      <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
      <button type='submit' class='btn btn-primary' name='update' value='update'>確認</button>
    </div>
  </form>
  </div>
  </div>
</div>";



?>
<div class='modal fade' id='deleteEntryRecordModal' tabindex='-1' aria-labelledby='deleteEntryandexitRecordModalLabel' aria-hidden='true'>
  <div class='modal-dialog modal-dialog-centered'>
    <div class='modal-content'>
      <form method='post' action='./controller/entry_and_exit_controller.php'>
        <div class='modal-header'>
          <h5 class='modal-title' id='deleteEntryandexitRecordModalLabel'>刪除紀錄</h5>
        </div>
        <div class='modal-body'>您確認要刪除此紀錄嗎？</div>
        <div class='modal-footer'>
          <input id='id' required type='hidden' name='entry_and_exit_dormitory_record_id' class='form-control' />
          <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
          <button type='submit' class='btn btn-primary' name='delete' value='delete'>確認</button>
        </div>
      </form>
    </div>
  </div>
</div>


<script>
function put_entry_and_exit(a, b){
  var elms = document.querySelectorAll("[id='id']");
  for(var i = 0; i < elms.length; i++) 
    elms[i].value=a

  var elms = document.querySelectorAll("[id='state']");
  for(var i = 0; i < elms.length; i++) 
    elms[i].value=b
  
}
</script>

