<!-- Room -->
<!--Title-->
<div class="card m-2 px-4 py-3">
  <div class="d-flex justify-content-between">
    <h4 class="mb-0">宿舍房間資料</h4>
    <button class='btn ms-2 btn-primary btn-sm' data-mdb-toggle='modal' data-mdb-target='#addRoomModal'><i class='fa fa-add me-1'></i>新增</button>
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
              <th scope="col">房號</th>
              <th scope="col">費用</th>
              <th scope="col">人數</th>
              <th scope="col">清潔狀態</th>
              <th scope="col">操作</th>
            </tr>
          </thead>
          <tbody class="datatable-body">
            <?php
              $clean_states = array("未整理", "整理完");
              $result = room_read_all($conn);

              if (mysqli_num_rows($result) > 0) 
              {
                while ($info = mysqli_fetch_assoc($result)) 
                {
                  $id = $info['room_number'];
                  $fee = $info['fee'];
                  $num_of_people = $info['num_of_people'];
                  $clean_state = $info['clean_state'];
                  $dormitory_id = $info['dormitory_id'];
                  $dormitory_name = $info['name'];
                  
                  echo "<tr>" .
                    "<td>" . $dormitory_name . "</td>".
                    "<td>" . $id . "</td>".
                    "<td>" . $fee . "</td>".
                    "<td>" . $num_of_people . "</td>".
                    "<td>" . $clean_states[$clean_state] . "</td>".
                    "<td>
                      <button class='call-btn btn btn-outline-primary btn-floating btn-sm ripple-surface' data-mdb-toggle='modal' data-mdb-target='#updateRoomModal$id'><i class='fa fa-pencil'></i></button>
                      <button class='message-btn btn ms-2 btn-primary btn-floating btn-sm' data-mdb-toggle='modal' data-mdb-target='#deleteRoomModal$id'><i class='fa fa-trash'></i></button>
                    </td>".
                    "</tr>";

                  // Update Modal

                  echo "
                  <div class='modal fade' id='updateRoomModal$id' tabindex='-1' aria-labelledby='updateRoomModalLabel' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered'>
                    <form method='post' action='./controller/room_controller.php'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <h5 class='modal-title' id='updateRoomModalLabel'>修改宿舍</h5>
                      </div>
                      <div class='modal-body'>
                        <div class='text-center mb-3'>
                          <div class='form-outline mb-4'>
                            <input value='$dormitory_id' required type='hidden' name='dormitory_id' class='form-control' />
                            <input value='$dormitory_name' readonly required type='text' name='name' class='form-control' />
                            <label class='form-label' >宿舍大樓編號</label>
                          </div>
                          <div class='form-outline mb-4'>
                            <input value='$id' readonly required type='text' name='room_number' class='form-control' />
                            <label class='form-label'>房號</label>
                          </div>
                          <div class='form-outline mb-4'>
                            <input value='$fee' required type='text' name='fee' class='form-control' />
                            <label class='form-label'>費用</label>
                          </div>
                          <div class='form-outline mb-4'>
                            <input value='$num_of_people' required type='text' name='num_of_people' class='form-control' />
                            <label class='form-label'>人數</label>
                          </div>
                          <select class='form-select mb-4' name='clean_state' required>
                            <option value=''>申請取消狀態</option>";
                            for($i = 0; $i<2; $i++){
                              echo "<option value=$i"; if($clean_state ==$i) echo " selected"; echo ">".$clean_states[$i]."</option>";
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
                  <div class='modal fade' id='deleteRoomModal$id' tabindex='-1' aria-labelledby='deleteRoomModalLabel' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered'>
                      <form method='post' action='./controller/room_controller.php'>
                        <div class='modal-content'>
                          <div class='modal-header'>
                            <h5 class='modal-title' id='deleteRoomModalLabel'>刪除宿舍</h5>
                          </div>
                          <div class='modal-body'>您確認要刪除此宿舍嗎？</div>
                          <div class='modal-footer'>
                            <input value='$id' required type='hidden' name='room_number' class='form-control' />
                            <input value='$dormitory_id' required type='hidden' name='dormitory_id' class='form-control' />
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
<div class='modal fade' id='addRoomModal' tabindex='-1' aria-labelledby='addRoomModalLabel' aria-hidden='true'>
  <div class='modal-dialog modal-dialog-centered'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='addSystemManagerModalLabel'>新增宿舍</h5>
      </div>
      <form method='post' action='./controller/room_controller.php'>
        <div class='modal-body'>
          <div class='text-center mb-3'>
            <select class='form-select mb-4' name='dormitory_id' required>
              <option value=''>宿舍大樓編號</option>
              <?php
                $res = dormitory_read_all($conn);
                if (mysqli_num_rows($res) > 0) {
                  while ($info = mysqli_fetch_assoc($res)){
                    echo "<option value=".$info['dormitor_id'].">".$info['name'].''."</option>";
                  }
                }
              ?>
            </select>
            <div class='form-outline mb-4'>
              <input required type='text' name='room_number' id='roomNumber' class='form-control' />
              <label class='form-label' for='roomNumber'>房號</label>
            </div>
            <div class='form-outline mb-4'>
              <input required type='text' name='fee' id='fee' class='form-control' />
              <label class='form-label' for='fee'>費用</label>
            </div>
            <div class='form-outline mb-4'>
              <input required type='text' name='num_of_people' id='numOfPeople' class='form-control' />
              <label class='form-label' for='numOfPeople'>人數</label>
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
</div>

