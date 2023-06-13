<!-- Apply Dorm -->
<!--Title-->
<div class="card m-2 px-4 py-3">
  <div class="d-flex justify-content-between">
    <h4 class="mb-0">申請宿舍資料</h4>
    <div class="d-flex">
      <select type="text" id="applyDormYearFilter" onchange="table_filter('applyDormYearFilter', 'applyDormTable', 1)" class='form-select-sm ms-2'  required>
        <option value=''>申請年度</option>
        <?php
        for($i = 0; $i<count($years); $i++){
          echo "<option value=".$years[$i].">".$years[$i]."</option>";
        }?>
      </select>
      <select type="text" id="applyDormStateFilter" onchange="table_filter('applyDormStateFilter', 'applyDormTable', 3)" class='form-select-sm ms-2'  required>
        <option value=''>申請宿舍狀態</option>
        <?php
        for($i = 0; $i<count($apply_dorm_states); $i++){
          echo "<option value=".$apply_dorm_states[$i].">".$apply_dorm_states[$i]."</option>";
        }?>
      </select>
      <?php
      if($_SESSION["permission"] == 0 || $_SESSION["permission"] == 1){
       echo "<button class='btn ms-2 btn-primary btn-sm' data-mdb-toggle='modal' data-mdb-target='#addApplyDormModal'><i class='fa fa-add me-1'></i>新增</button>
      <button class='message-btn btn ms-2 btn-primary btn-sm' data-mdb-toggle='modal' data-mdb-target='#allocationModal'><i class='fa fa-add me-1'></i>開始分配房間</button>";
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
        <table id="applyDormTable" class="table datatable-table">
          <thead class="datatable-header">
            <tr>
              <th scope="col">編號</th> 
              <th scope="col">年度</th>
              <th scope="col">帳號</th>
              <th scope="col">狀態</th>
              <th scope="col">時間</th>
              <?php
      if($_SESSION["permission"] == 0 || $_SESSION["permission"] == 1){
       echo "    <th scope='col'>操作</th>";
      }
    ?>
            </tr>
          </thead>
          <tbody class="datatable-body">
            <?php
              if($_SESSION["permission"] == 0 || $_SESSION["permission"] == 1){
                $result = apply_dorm_read_all($conn);
              }else if($_SESSION["permission"] == 2){
                $result = apply_dorm_read_account($conn , $_SESSION['student_account']);
              }else{
                $result = apply_dorm_read_account($conn , $_SESSION['account']);
              }
              // $result = apply_dorm_read_all($conn);

              if (mysqli_num_rows($result) > 0) 
              {
                while ($info = mysqli_fetch_assoc($result)) 
                {
                  $id = $info['apply_dorm_id'];
                  $account = $info['account'];
                  $year = $info['year'];
                  $state = $info['state'];
                  $datetime	 = $info['datetime'];
                  
                  echo "<tr>" .
                    "<td>" . $id . "</td>".
                    "<td>" . $year . "</td>".
                    "<td>" . $account . "</td>".
                    "<td class='".$state_classes[$state]."'>" . $apply_dorm_states[$state] . "</td>".
                    "<td>" . $datetime . "</td>";
                  if($_SESSION["permission"] == 0 || $_SESSION["permission"] == 1){
                    echo  "<td>
                    <button onclick=\"put_apply_dorm('$id','$state')\" class='call-btn btn btn-outline-primary btn-floating btn-sm ripple-surface' data-mdb-toggle='modal' data-mdb-target='#updateApplyDormModal'><i class='fa fa-pencil'></i></button>
                    <button onclick=\"put_apply_dorm('$id','$state')\" class='message-btn btn ms-2 btn-primary btn-floating btn-sm' data-mdb-toggle='modal' data-mdb-target='#deleteApplyDormModal'><i class='fa fa-trash'></i></button>
                  </td>";
                     }  
                  
                  echo   "</tr>";

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
<div class='modal fade' id='addApplyDormModal' tabindex='-1' aria-labelledby='addApplyDormModalLabel' aria-hidden='true'>
  <div class='modal-dialog modal-dialog-centered'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title'>新增申請宿舍</h5>
      </div>
      <form method='post' action='./controller/apply_dorm_controller.php'>
        <div class='modal-body'>
          <div class='text-center mb-3'>
            <select class='form-select mb-4' name='account' required>
              <option value=''>帳號</option>
              <?php
                $res = student_read_all($conn);
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

<!-- Allocate Room -->
<div class='modal fade' id='allocationModal' tabindex='-1' aria-labelledby='allocationModalLabel' aria-hidden='true'>
  <div class='modal-dialog modal-dialog-centered'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='allocationModalLabel'>開始分發房間</h5>
      </div>
      <form method='post' action='./controller/apply_dorm_controller.php'>
        <div class='modal-body'>您確認要開始分發房間嗎？</div>
        <div class='modal-footer'>
          <input value=<?php echo $default_year;?> required type='hidden' name='year' class='form-control' />
          <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
          <button type='submit' class='btn btn-primary' name='allocation-room' value='allocation-room'>確認</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
// Update Modal
echo "
<div class='modal fade' id='updateApplyDormModal' tabindex='-1' aria-labelledby='updateApplyDormModalLabel' aria-hidden='true'>
  <div class='modal-dialog modal-dialog-centered'>
  <div class='modal-content'>
    <form method='post' action='./controller/apply_dorm_controller.php'>
    <div class='modal-header'>
      <h5 class='modal-title' id='updateApplyDormModalLabel'>修改申請宿舍</h5>
    </div>
    <div class='modal-body'>
      <div class='text-center mb-3'>
        <div class='form-outline mb-4'>
          <input id='id' readonly required type='text' name='apply_dorm_id' class='form-control' />
          <label class='form-label'>申請宿舍編號</label>
        </div>
        <select id='state' class='form-select mb-4' name='state' required>
          <option value=''>狀態</option>";
          for($i = 0; $i<3; $i++){
            echo "<option value=$i"; if($state ==$i) echo " selected"; echo ">".$apply_dorm_states[$i]."</option>";
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


// Delete  Modal
echo "
<div class='modal fade' id='deleteApplyDormModal' tabindex='-1' aria-labelledby='deleteApplyDormModalLabel' aria-hidden='true'>
  <div class='modal-dialog modal-dialog-centered'>
    <div class='modal-content'>
      <form method='post' action='./controller/apply_dorm_controller.php'>
        <div class='modal-header'>
          <h5 class='modal-title' id='deleteApplyDormModalLabel'>刪除申請宿舍</h5>
        </div>
        <div class='modal-body'>您確認要刪除此申請宿舍嗎？</div>
        <div class='modal-footer'>
          <input id='id' required type='hidden' name='apply_dorm_id' class='form-control' />
          <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
          <button type='submit' class='btn btn-primary' name='delete' value='delete'>確認</button>
        </div>
      </div>
    </form>
  </div>
</div>";
?>

<script>
function put_apply_dorm(a, b){
  var elms = document.querySelectorAll("[id='id']");
  for(var i = 0; i < elms.length; i++) 
    elms[i].value=a

  var elms = document.querySelectorAll("[id='state']");
  for(var i = 0; i < elms.length; i++) 
    elms[i].value=b
}
</script>