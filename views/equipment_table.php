<!-- Equipment -->
<!--Title-->
<div class="card m-2 px-4 py-3">
  <div class="d-flex justify-content-between">
    <h4 class="mb-0">宿舍設備資料</h4>
    <div class="d-flex">
      <select type="text" id="applyFixStateFilter" onchange="table_filter('applyFixStateFilter','equipmentTable',4)" class='form-select-sm'  required>
        <option value=''>報修紀錄</option>
        <?php
        for($i = 0; $i<count($apply_fix_states); $i++){
          echo "<option value=".$apply_fix_states[$i].">".$apply_fix_states[$i]."</option>";
        }?>
      </select>
      <?php 
        if( $_SESSION["permission"] == 0){
            echo "<button class='btn ms-2 btn-primary btn-sm' data-mdb-toggle='modal' data-mdb-target='#addEquipmentModal'><i class='fa fa-add me-1'></i>新增</button>";
        }
      ?>
    </div>
  
  </div>
</div>

<!-- Table -->
<div class="card m-2">
  <section class="border p-4">
    <div id="datatable-custom" data-mdb-hover="true" class="datatable datatable-hover">
      <div class="datatable-inner table-responsive ps" style="overflow: auto; position: relative;">
        <table id='equipmentTable' class="table datatable-table">
          <thead class="datatable-header">
            <tr>
              <th scope="col">宿舍</th> 
              <th scope="col">房號</th>
              <th scope="col">編號</th>
              <th scope="col">名稱</th>
              <th scope="col">報修紀錄</th>
              <th scope="col">年限</th>
              <th scope="col">購買日期</th>
              <?php
              if($_SESSION["permission"] != 2)
                echo "<th scope='col'>操作</th>";
              ?>
            </tr>
          </thead>
          <tbody class="datatable-body">
            <?php
              if($_SESSION["permission"] == 0 || $_SESSION["permission"] == 1){
                $result = equipment_read_all($conn);
              }else{ // parents
                $result = equipment_read_dormid_roomnum($conn , $_SESSION['dormitory_id'], $_SESSION['room_number']);
              }

              if (mysqli_num_rows($result) > 0) 
              {
                while ($info = mysqli_fetch_assoc($result)) 
                {
                  $id = $info['equipment_id'];
                  $name = $info['name'];
                  $expired_year = $info['expired_year'];
                  $datetime = $info['datetime'];
                  $apply_fix_state = $info['apply_fix_state'];
                  $dormitory_id = $info['dormitory_id'];
                  $dormitory_name = $info['dormitory_name'];
                  $room_number = $info['room_number'];
                  
                  echo "<tr>" .
                    "<td>" . $dormitory_name . "</td>".
                    "<td>" . $room_number . "</td>".
                    "<td>" . $id . "</td>".
                    "<td>" . $name . "</td>".
                    "<td class='".$state_classes_defaults[$apply_fix_state]."' >" . $apply_fix_states[$apply_fix_state] . "</td>".
                    "<td>" . $expired_year . "</td>".
                    "<td>" . $datetime . "</td>";

                  if($_SESSION["permission"] == 0 || $_SESSION["permission"] == 1)
                    echo  "<td>
                        <button class='call-btn btn btn-outline-primary btn-floating btn-sm ripple-surface' data-mdb-toggle='modal' data-mdb-target='#updateEquipmentModal$id'><i class='fa fa-pencil'></i></button>
                        <button class='message-btn btn ms-2 btn-primary btn-floating btn-sm' data-mdb-toggle='modal' data-mdb-target='#deleteEquipmentModal$id'><i class='fa fa-trash'></i></button>
                      </td>";
                  else if($_SESSION["permission"] != 2){
                    echo "<td> <button "; if($apply_cancel != 0) echo " disabled ";
                    echo  "class='message-btn btn ms-2 btn-outline-primary btn-floating btn-sm' data-mdb-toggle='modal' data-mdb-target='#confirmEquipmentModal$id'><i class='fa fa-circle-info'></i></button></td>";
                  }

                  // Update Modal
                  echo "
                  <div class='modal fade' id='updateEquipmentModal$id' tabindex='-1' aria-labelledby='updateEquipmentModalLabel' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered'>
                    <form method='post' action='./controller/equipment_controller.php'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <h5 class='modal-title' id='updateEquipmentModalLabel'>修改宿舍</h5>
                      </div>
                      <div class='modal-body'>
                        <div class='text-center mb-3'>
                          <div class='form-outline mb-4'>
                            <input value='$id' readonly required type='text' name='equipment_id' class='form-control' />
                            <label class='form-label'>設備編號</label>
                          </div>
                          <select class='form-select mb-4' name='dormitory_room' autocomplete='on' required>
                            <option value=''>房間</option>";
                            $res = room_read_all($conn);
                            if (mysqli_num_rows($res) > 0) {
                              while ($info = mysqli_fetch_assoc($res)){
                                echo "<option value=".$info['dormitory_id'].'-'.$info['room_number'];
                                if($dormitory_id ==$info['dormitory_id'] && $room_number ==$info['room_number']) echo " selected";
                                echo " >".$info['dormitory_id'].'-'.$info['room_number'].''."</option>";
                              }
                            }
                          echo "</select>
                          <div class='form-outline mb-4'>
                            <input value='$name' required type='text' name='name' class='form-control' />
                            <label class='form-label'>名稱</label>
                          </div>
                          <select class='form-select mb-4' name='apply_fix_state' autocomplete='on' required>
                            <option value=''>報修紀錄</option>";
                            for($i = 0; $i<4; $i++){
                              echo "<option value=$i"; if($apply_fix_state ==$i) echo " selected"; echo ">".$apply_fix_states[$i]."</option>";
                            }
                          echo "</select>
                          <div class='form-outline mb-4'>
                            <input value='$expired_year' required type='text' name='expired_year' class='form-control' />
                            <label class='form-label'>過期年限</label>
                          </div>
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
                  <div class='modal fade' id='deleteEquipmentModal$id' tabindex='-1' aria-labelledby='deleteEquipmentModalLabel' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered'>
                      <form method='post' action='./controller/equipment_controller.php'>
                        <div class='modal-content'>
                          <div class='modal-header'>
                            <h5 class='modal-title' id='deleteEquipmentModalLabel'>刪除宿舍</h5>
                          </div>
                          <div class='modal-body'>您確認要刪除此宿舍嗎？</div>
                          <div class='modal-footer'>
                            <input value='$id' required type='hidden' name='equipment_id' class='form-control' />
                            <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
                            <button type='submit' class='btn btn-primary' name='delete' value='delete'>確認</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>";

                  // Confirm  Modal

                  echo "
                  <div class='modal fade' id='confirmEquipmentModal$id' tabindex='-1' aria-labelledby='confirmEquipmentModalLabel' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered'>
                      <form method='post' action='./controller/violated_record_controller.php'>
                        <div class='modal-content'>
                          <div class='modal-header'>
                            <h5 class='modal-title' id='confirmEquipmentModalLabel'>申請宿舍設備報修</h5>
                          </div>
                          <div class='modal-body'>您確認要申請此宿舍設備報修嗎？</div>
                          <div class='modal-footer'>
                            <input value='$id' required type='hidden' name='equipment_id' class='form-control' />
                            <input value='$name' required type='hidden' name='name' class='form-control' />
                            <input value='1' required type='hidden' name='apply_fix_state' class='form-control' />
                            <input value='$room_number' required type='hidden' name='room_number' class='form-control' />
                            <input value='$dormitory_id' required type='hidden' name='dormitory_id' class='form-control' />
                            <input value='$expired_year' required type='hidden' name='expired_year' class='form-control' />
                            <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
                            <button type='submit' class='btn btn-primary' name='update' value='update'>確認</button>
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
<?php 
if( $_SESSION["permission"] == 0 || $_SESSION["permission"] == 1){
echo "<div class='modal fade' id='addEquipmentModal' tabindex='-1' aria-labelledby='addEquipmentModalLabel' aria-hidden='true'>
  <div class='modal-dialog modal-dialog-centered'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='addSystemManagerModalLabel'>新增宿舍</h5>
      </div>
      <form method='post' action='./controller/equipment_controller.php'>
        <div class='modal-body'>
          <div class='text-center mb-3'>
            <div class='form-outline mb-4'>
              <input required type='text' name='dormitory_id' id='dormitoryId' class='form-control' />
              <label class='form-label' for='dormitoryId'>宿舍大樓編號</label>
            </div>
            <div class='form-outline mb-4'>
              <input required type='text' name='room_number' id='roomNumber' class='form-control' />
              <label class='form-label' for='roomNumber'>房號</label>
            </div>
            <div class='form-outline mb-4'>
              <input required type='text' name='name' id='name' class='form-control' />
              <label class='form-label' for='name'>名稱</label>
            </div>
            <div class='form-outline mb-4'>
              <input required type='text' name='expired_year' id='expiredYear' class='form-control' />
              <label class='form-label' for='expiredYear'>過期年限</label>
            </div>
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

