<!-- Parking Permit -->

<!--Title-->
<div class="card m-2 px-4 py-3">
  <div class="d-flex justify-content-between">
    <h4 class="mb-0">申請停車資料</h4>
    <div class="d-flex">
      <select type="text" id="parkingPermitStateFilter" onchange="table_filter('parkingPermitStateFilter', 'parkingPermitTable', 2)" class='form-select-sm ms-2'  required>
        <option value=''>申請狀態</option>
        <?php
        for($i = 0; $i<count($parking_permit_states); $i++){
          echo "<option value=".$parking_permit_states[$i].">".$parking_permit_states[$i]."</option>";
        }?>
      </select>
      <?php 
        if( $_SESSION["permission"] == 0 || $_SESSION["permission"] == 1)
          echo "<button class='btn ms-2 btn-primary btn-sm' data-mdb-toggle='modal' data-mdb-target='#addParkingPermitModal'><i class='fa fa-add me-1'></i>新增</button>";
      ?>
    </div>
  </div>
</div>

<!-- Table -->
<div class="card m-2">
  <section class="border p-4">
    <div data-mdb-hover="true" class="datatable datatable-hover">
      <div class="datatable-inner table-responsive ps" style="overflow: auto; position: relative;">
        <table id="parkingPermitTable" class="table datatable-table">
          <thead class="datatable-header">
            <tr>
              <th scope="col">編號</th> 
              <th scope="col">帳號</th>
              <th scope="col">狀態</th>
              <th scope="col">時間</th>
              <?php 
              if( $_SESSION["permission"] == 0 || $_SESSION["permission"] == 1)
                echo "<th scope='col'>操作</th>"
              ?>
            </tr>
          </thead>
          <tbody class="datatable-body">
            <?php
            if($_SESSION["permission"] == 0 || $_SESSION["permission"] == 1){
              $result = parking_permit_read_all($conn);
            }else if( $_SESSION["permission"] == 2){ // parents
              $result = parking_permit_read($conn, $_SESSION['account']);
            }

              if (mysqli_num_rows($result) > 0) 
              {
                while ($info = mysqli_fetch_assoc($result)) 
                {
                  $id = $info['parking_permit_record_id'];
                  $account = $info['account'];
                  $state = $info['state'];
                  $datetime = $info['datetime'];
                  
                  echo "<tr>" .
                    "<td>" . $id . "</td>".
                    "<td>" . $account . "</td>".
                    "<td class='".$state_classes[$state]."'>" . $parking_permit_states[$state] . "</td>".
                    "<td>" . $datetime . "</td>";
                    if( $_SESSION["permission"] == 0 || $_SESSION["permission"] == 1){
                      echo "<td>
                        <button class='call-btn btn btn-outline-primary btn-floating btn-sm ripple-surface' data-mdb-toggle='modal' data-mdb-target='#updateAccessCardRecordModal$id'><i class='fa fa-pencil'></i></button>
                        <button class='message-btn btn ms-2 btn-primary btn-floating btn-sm' data-mdb-toggle='modal' data-mdb-target='#deleteAccessCardRecordModal$id'><i class='fa fa-trash'></i></button>
                      </td>";
                    }
                  echo  "</tr>";

                  // Update Modal
                  echo "
                  <div class='modal fade' id='updateParkingPermitModal$id' tabindex='-1' aria-labelledby='updateParkingPermitModalLabel' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered'>
                    <form method='post' action='./controller/parking_permit_controller.php'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <h5 class='modal-title' id='updateParkingPermitModalLabel'>修改申請停車</h5>
                      </div>
                      <div class='modal-body'>
                        <div class='text-center mb-3'>
                          <div class='form-outline mb-4'>
                            <input value='$id' readonly required type='text' name='parking_permit_record_id' class='form-control' />
                            <label class='form-label'>申請停車編號</label>
                          </div>
                          <select class='form-select mb-4' name='state' required>
                            <option value=''>狀態</option>";
                            for($i = 0; $i<3; $i++){
                              echo "<option value=$i"; if($state ==$i) echo " selected"; echo ">".$parking_permit_states[$i]."</option>";
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
                  <div class='modal fade' id='deleteParkingPermitModal$id' tabindex='-1' aria-labelledby='deleteParkingPermitModalLabel' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered'>
                      <form method='post' action='./controller/parking_permit_controller.php'>
                        <div class='modal-content'>
                          <div class='modal-header'>
                            <h5 class='modal-title' id='deleteParkingPermitModalLabel'>刪除申請停車</h5>
                          </div>
                          <div class='modal-body'>您確認要刪除此申請停車嗎？</div>
                          <div class='modal-footer'>
                            <input value='$id' required type='hidden' name='parking_permit_record_id' class='form-control' />
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
<?php
if($_SESSION["permission"] == 0 || $_SESSION["permission"] == 1){
  echo "<div class='modal fade' id='addParkingPermitModal' tabindex='-1' aria-labelledby='addParkingPermitModalLabel' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered'>
      <div class='modal-content'>
        <div class='modal-header'>
          <h5 class='modal-title'>新增申請停車</h5>
        </div>
        <form method='post' action='./controller/parking_permit_controller.php'>
          <div class='modal-body'>
            <div class='text-center mb-3'>
              <select class='form-select mb-4' name='account' required>
                <option value=''>帳號</option>";
                  $res = parents_read_all($conn);
                  if (mysqli_num_rows($res) > 0) {
                    while ($info = mysqli_fetch_assoc($res)){
                      echo "<option value=".$info['account'].">".$info['account']."</option>";
                    }
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