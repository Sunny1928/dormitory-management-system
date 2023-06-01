<!-- Rule -->
<!--Title-->
<div class="card m-2 px-4 py-3">
  <div class="d-flex justify-content-between">
    <h4 class="mb-0">宿舍規範資料</h4>
    <button class='btn ms-2 btn-primary btn-sm' data-mdb-toggle='modal' data-mdb-target='#addRuleModal'><i class='fa fa-add me-1'></i>新增</button>
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
              <th scope="col">規範編號</th> 
              <th scope="col">內容</th>
              <th scope="col">點數</th>
              <th scope="col">操作</th>
            </tr>
          </thead>
          <tbody class="datatable-body">
            <?php
            
              require_once('service/dormitory_data_operation/rule_crud.php');

              $result = rule_read_all($conn);

              if (mysqli_num_rows($result) > 0) 
              {
                while ($info = mysqli_fetch_assoc($result)) 
                {
                  $id = $info['rule_id'];
                  $content = $info['content'];
                  $point = $info['point'];
                  
                  echo "<tr>" .
                    "<td> " . $id . "</td>".
                    "<td> " . $content . "</td>".
                    "<td> " . $point . "</td>".
                    "<td>
                      <button class='call-btn btn btn-outline-primary btn-floating btn-sm ripple-surface' data-mdb-toggle='modal' data-mdb-target='#updateRuleModal$id'><i class='fa fa-pencil'></i></button>
                      <button class='message-btn btn ms-2 btn-primary btn-floating btn-sm' data-mdb-toggle='modal' data-mdb-target='#deleteRuleModal$id'><i class='fa fa-trash'></i></button>
                    </td>".
                    "</tr>";

                  // Update Modal
                  echo "
                  <div class='modal fade' id='updateRuleModal$id' tabindex='-1' aria-labelledby='updateRuleModalLabel' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered'>
                    <form method='post' action='./controller/rule_controller.php'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <h5 class='modal-title' id='updateRuleModalLabel'>修改宿舍</h5>
                      </div>
                      <div class='modal-body'>
                        <div class='text-center mb-3'>
                          
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
                  <div class='modal fade' id='deleteRuleModal$id' tabindex='-1' aria-labelledby='deleteRuleModalLabel' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered'>
                      <form method='post' action='./controller/rule_controller.php'>
                        <div class='modal-content'>
                          <div class='modal-header'>
                            <h5 class='modal-title' id='deleteRuleModalLabel'>刪除宿舍</h5>
                          </div>
                          <div class='modal-body'>您確認要刪除此宿舍嗎？</div>
                          <div class='modal-footer'>
                            <input value='$id' required type='hidden' name='rule_id' class='form-control' />
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
<div class='modal fade' id='addRuleModal' tabindex='-1' aria-labelledby='addRuleModalLabel' aria-hidden='true'>
  <div class='modal-dialog modal-dialog-centered'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title'>新增宿舍</h5>
      </div>
      <form method='post' action='./controller/rule_controller.php'>
        <div class='modal-body'>
          <div class='text-center mb-3'>
            <div class='form-outline mb-4'>
              <input required type='text' name='content' id='content' class='form-control' />
              <label class='form-label' for='content'>內容</label>
            </div>
            <div class='form-outline mb-4'>
              <input required type='text' name='point' id='point' class='form-control' />
              <label class='form-label' for='point'>點數</label>
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

