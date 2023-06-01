<!-- Equipment -->
<!--Title-->
<div class="card m-2 px-4 py-3">
  <div class="d-flex justify-content-between">
    <h4 class="mb-0">宿舍公共設備資料</h4>
    <button class='btn ms-2 btn-primary btn-sm' data-mdb-toggle='modal' data-mdb-target='#addPublicEquipmentModal'><i class='fa fa-add me-1'></i>新增</button>
  </div>
</div>

<!-- Table -->
<div class="card m-2">
  <section class="border p-4">
    <div id="datatable-custom" data-mdb-hover="true" class="datatable datatable-hover">
      <div class="datatable-inner table-responsive ps" style="overflow: auto; position: relative;">
        <table class="table datatable-table">
          <thead class="datatable-header">
            <tr>
              <th scope="col">大樓編號</th> 
              <th scope="col">公共設備編號</th>
              <th scope="col">名稱</th>
              <th scope="col">報修紀錄</th>
              <th scope="col">過期年限</th>
              <th scope="col">購買日期</th>
              <th scope="col">操作</th>
            </tr>
          </thead>
          <tbody class="datatable-body">
            <?php
              $apply_fix_states = array("未申請報修", "申請報修");
            
              $result = public_equipment_read_all($conn);

              if (mysqli_num_rows($result) > 0) 
              {
                while ($info = mysqli_fetch_assoc($result)) 
                {
                  $id = $info['public_equipment_id'];
                  $ename = $info['name'];
                  $expired_year = $info['expired_year'];
                  $datetime = $info['datetime'];
                  $apply_fix_state = $info['apply_fix_state'];
                  $dormitory_id = $info['dormitory_id'];
                  
                  echo "<tr>" .
                    "<td> " . $dormitory_id . "</td>".
                    "<td> " . $id . "</td>".
                    "<td> " . $ename . "</td>".
                    "<td> " . $apply_fix_states[$apply_fix_state] . "</td>".
                    "<td> " . $expired_year . "</td>".
                    "<td> " . $datetime . "</td>".
                    "<td>
                      <button class='call-btn btn btn-outline-primary btn-floating btn-sm ripple-surface' data-mdb-toggle='modal' data-mdb-target='#updatePublicEquipmentModal$id'><i class='fa fa-pencil'></i></button>
                      <button class='message-btn btn ms-2 btn-primary btn-floating btn-sm' data-mdb-toggle='modal' data-mdb-target='#deletePublicEquipmentModal$id'><i class='fa fa-trash'></i></button>
                    </td>".
                    "</tr>";

                  // Update Modal
                  echo "
                  <div class='modal fade' id='updatePublicEquipmentModal$id' tabindex='-1' aria-labelledby='updatePublicEquipmentModalLabel' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered'>
                    <form method='post' action='./controller/public_equipment_controller.php'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <h5 class='modal-title' id='updatePublicEquipmentModalLabel'>修改宿舍</h5>
                      </div>
                      <div class='modal-body'>
                        <div class='text-center mb-3'>
                          <div class='form-outline mb-4'>
                            <input required type='text' name='dormitory_id' class='form-control' />
                            <label class='form-label'>宿舍大樓編號</label>
                          </div>
                          <div class='form-outline mb-4'>
                            <input required type='text' name='room_number'class='form-control' />
                            <label class='form-label'>房號</label>
                          </div>
                          <div class='form-outline mb-4'>
                            <input required type='text' name='name' class='form-control' />
                            <label class='form-label'>名稱</label>
                          </div>
                          <div class='form-outline mb-4'>
                            <input required type='text' name='expired_year' class='form-control' />
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
                  <div class='modal fade' id='deletePublicEquipmentModal$id' tabindex='-1' aria-labelledby='deletePublicEquipmentModalLabel' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered'>
                      <form method='post' action='./controller/public_equipment_controller.php'>
                        <div class='modal-content'>
                          <div class='modal-header'>
                            <h5 class='modal-title' id='deletePublicEquipmentModalLabel'>刪除宿舍</h5>
                          </div>
                          <div class='modal-body'>您確認要刪除此宿舍嗎？</div>
                          <div class='modal-footer'>
                            <input value='$id' required type='hidden' name='public_equipment_id' class='form-control' />
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
<div class='modal fade' id='addPublicEquipmentModal' tabindex='-1' aria-labelledby='addPublicEquipmentModalLabel' aria-hidden='true'>
  <div class='modal-dialog modal-dialog-centered'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='addSystemManagerModalLabel'>新增宿舍</h5>
      </div>
      <form method='post' action='./controller/public_equipment_controller.php'>
        <div class='modal-body'>
          <div class='text-center mb-3'>
            <div class='form-outline mb-4'>
              <input required type='text' name='dormitory_id' id='dormitoryId' class='form-control' />
              <label class='form-label' for='dormitoryId'>宿舍大樓編號</label>
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
</div>

