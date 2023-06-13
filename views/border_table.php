
<!--Border-->
<!--Title-->
<div class="card m-2 px-4 py-3">
  <div class="d-flex justify-content-between">
    <h4 class="mb-0">住宿生資料</h4>
    <div class='d-flex'>
      <select type="text" id="borderYearFilter" onchange="table_filter('borderYearFilter','borderTable',0)" class='form-select-sm'  required>
        <option value=''>年度</option>
        <?php
        for($i = 0; $i<count($years); $i++){
          echo "<option value=".$years[$i].">".$years[$i]."</option>";
        }?>
      </select>
      <select type="text" id="borderTypeFilter" onchange="table_filter('borderTypeFilter','borderTable',2)" class='form-select-sm ms-2'  required>
        <option value=''>住宿生類別</option>
        <?php
        for($i = 0; $i<count($border_types); $i++){
          echo "<option value=".$border_types[$i].">".$border_types[$i]."</option>";
        }?>
      </select>
      <select type="text" id="borderApplyFilter" onchange="table_filter('borderApplyFilter','borderTable',3)" class='form-select-sm ms-2'  required>
        <option value=''>申請樓長狀態</option>
        <?php
        for($i = 0; $i<count($border_apply_story_manager_states); $i++){
          echo "<option value=".$border_apply_story_manager_states[$i].">".$border_apply_story_manager_states[$i]."</option>";
        }?>
      </select>
      <button class='btn ms-2 btn-primary btn-sm' data-mdb-toggle='modal' data-mdb-target='#addBorderModal'><i class='fa fa-add me-1'></i>新增</button>
    </div>
  </div>
</div>

<!-- Table -->
<div class="card m-2">
  <section class="border p-4">
    <div data-mdb-hover="true" class="datatable datatable-hover">
      <div class="datatable-inner table-responsive ps" style="overflow: auto; position: relative;">
        <table id="borderTable" class="table datatable-table">
          <thead class="datatable-header">
            <tr>
              <th scope="col">年</th>
              <th scope="col">帳號</th>
              <th scope="col">類別</th>
              <th scope="col">申請樓長</th>
              <th scope="col">宿舍</th>
              <th scope="col">房號</th>
              <th scope="col">操作</th>
            </tr>
          </thead>
          <tbody class="datatable-body">
            <?php
              if($_SESSION['account'] == 'root')
                $result = border_read_all($conn);
              else if($_SESSION['permission'] == 0 || $_SESSION['permission'] == 1)
                $result = border_read_year($conn, $default_year);

              if (mysqli_num_rows($result) > 0) 
              {
                while ($info = mysqli_fetch_assoc($result)) 
                {
                  $account = $info['account'];
                  $type = $info['type'];
                  $state = $info['apply_story_manager_state'];
                  $year = $info['year'];
                  $room_number = $info['room_number'];
                  $dormitory_id = $info['dormitory_id'];
                  $dormitory_name = $info['dormitory_name'];

                  
                  echo "<tr>" .
                    "<td>" . $year . "</td>".
                    "<td>" . $account . "</td>".
                    "<td>" . $border_types[$type] . "</td>".
                    "<td>" . $border_apply_story_manager_states[$state] . "</td>".
                    "<td>" . $dormitory_name . "</td>".
                    "<td>" . $room_number . "</td>".
                    "<td>
                      <button onclick=\"put_border('$account','$year','$type','$state','$dormitory_id-$room_number')\" class='call-btn btn btn-outline-primary btn-floating btn-sm ripple-surface' data-mdb-toggle='modal' data-mdb-target='#updateBorderModal' ><i class='fa fa-pencil'></i></button>
                      <button onclick=\"put_border('$account','$year','$type','$state','$dormitory_id-$room_number')\" class='message-btn btn ms-2 btn-primary btn-floating btn-sm' data-mdb-toggle='modal' data-mdb-target='#deleteBorderModal'><i class='fa fa-trash'></i></button>
                    </td>".
                    "</tr>";

                  
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
<div class='modal fade' id='addBorderModal' tabindex='-1' aria-labelledby='addBorderModalLabel' aria-hidden='true'>
  <div class='modal-dialog modal-dialog-centered'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='addSystemManagerModalLabel'>新增住宿生</h5>
      </div>
      <form method='post' action='./controller/border_controller.php'>
        <div class='modal-body'>
          <div class='text-center mb-3'>
            <select class='form-select mb-4' name='account' required>
              <option value=''>帳號</option>
              <?php
                $res = student_read_not_border($conn, $default_year);
                if (mysqli_num_rows($res) > 0) {
                  while ($info = mysqli_fetch_assoc($res)){
                    echo "<option value=".$info['account'].">".$info['account']."</option>";
                  }
                }
              ?>
            </select>
              <input value= '<?php echo $default_year;?>' required type='hidden' name='year'  class='form-control' />
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

<?php
// Update Modal
echo "
<div class='modal fade' id='updateBorderModal' tabindex='-1' aria-labelledby='updateBorderModalLabel' aria-hidden='true'>
  <div class='modal-dialog modal-dialog-centered'>
  <div class='modal-content'>
  <form method='post' action='./controller/border_controller.php'>
    <div class='modal-header'>
      <h5 class='modal-title' id='updateBorderModalLabel'>修改住宿生</h5>
    </div>
    <div class='modal-body'>
      <div class='text-center mb-3'>
        <div class='form-outline mb-4'>
          <input id='account' required readonly type='text' name='account' class='form-control' />
          <label class='form-label'>住宿生編號</label>
        </div>
        <div class='form-outline mb-4'>
          <input id='year' required readonly type='text' name='year' class='form-control' />
          <label class='form-label'>年</label>
        </div> 
        <select id='type' class='form-select mb-4' name='type' required>
          <option value=''>類別</option>";
          for($i = 0; $i<6; $i++){
            echo "<option value=$i"; 
            if($type == $i) echo " selected"; 
            echo ">".$border_types[$i]."</option>";
          }
        echo "</select>
        <select id='apply_story_manager_state' class='form-select mb-4' name='apply_story_manager_state' required>
          <option value=''>狀態</option>";
          for($i = 0; $i<2; $i++){
            echo "<option value=$i"; if($state ==$i) echo " selected"; echo ">".$border_apply_story_manager_states[$i]."</option>";
          }
        echo "</select>
        <select id='dorm_room' class='form-select mb-4' name='dorm_room' required>
          <option value=''>宿舍-房號</option>";
            $res = room_read_all($conn);
            if (mysqli_num_rows($res) > 0) {
              while ($info = mysqli_fetch_assoc($res)){
                echo "<option value=".$info['dormitory_id'].'-'.$info['room_number'];
                if($dormitory_id == $info['dormitory_id'] && $room_number == $info['room_number']) echo " selected";
                echo ">".$info['name'].'-'.$info['room_number'].''."</option>";
              }
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

<div class='modal fade' id='deleteBorderModal' tabindex='-1' aria-labelledby='deleteBorderModalLabel' aria-hidden='true'>
  <div class='modal-dialog modal-dialog-centered'>
    <div class='modal-content'>
      <form method='post' action='./controller/border_controller.php'>
        <div class='modal-header'>
          <h5 class='modal-title' id='deleteBorderModalLabel'>刪除住宿生</h5>
        </div>
        <div class='modal-body'>您確認要刪除此住宿生嗎？</div>
        <div class='modal-footer'>
          <input id='account' required type='hidden' name='account' class='form-control' />
          <input id='year' required type='hidden' name='year' class='form-control' />
          <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
          <button type='submit' class='btn btn-primary' name='delete' value='delete'>確認</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>

function put_border(a, b, c, d, e){ 
  var elms = document.querySelectorAll("[id='account']");
  for(var i = 0; i < elms.length; i++) 
    elms[i].value=a

  var elms = document.querySelectorAll("[id='year']");
  for(var i = 0; i < elms.length; i++) 
    elms[i].value=b

  var elms = document.querySelectorAll("[id='type']");
  for(var i = 0; i < elms.length; i++) {
    if(d != 1) elms[i].value=c
    else elms[i].value=(parseInt(e[0]) + 2).toString()
    // console.log(e)
  }

  var elms = document.querySelectorAll("[id='apply_story_manager_state']");
  for(var i = 0; i < elms.length; i++) 
    elms[i].value=d

  var elms = document.querySelectorAll("[id='dorm_room']");
  for(var i = 0; i < elms.length; i++) 
    elms[i].value=e

}


</script>