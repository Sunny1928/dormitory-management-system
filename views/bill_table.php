<?php

$year = 110;
$bill_types = array("住宿費", "電費", "水費", "網路費", "修繕費");
$bill_states = array("未繳費", "已繳費");
?>

<!--Bill-->
<!--Title-->
<div class="card m-2 px-4 py-3">
  <div class="d-flex justify-content-between">
    <h4 class="mb-0">帳單資料</h4>
    <button class='btn ms-2 btn-primary btn-sm' data-mdb-toggle='modal' data-mdb-target='#addBillModal'><i class='fa fa-add me-1'></i>新增</button>
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
              <th scope="col">帳單編號</th> 
              <th scope="col">年</th>
              <th scope="col">帳號</th>
              <th scope="col">標題</th>
              <th scope="col">類別</th>
              <th scope="col">費用</th>
              <th scope="col">狀態</th>
              <th scope="col">操作</th>
            </tr>
          </thead>
          <tbody class="datatable-body">
            <?php
              
              $result = bill_read_all($conn);

              if (mysqli_num_rows($result) > 0) 
              {
                while ($info = mysqli_fetch_assoc($result)) 
                {
                  $id = $info['bill_id'];
                  $fee = $info['fee'];
                  $type = $info['type'];
                  $title = $info['title'];
                  $state = $info['state'];
                  $account = $info['account'];
                  $year = $info['year'];

                  
                  echo "<tr>" .
                    "<td> " . $id . "</td>".
                    "<td> " . $year . "</td>".
                    "<td> " . $account . "</td>".
                    "<td> " . $title . "</td>".
                    "<td> " . $bill_types[$type] . "</td>".
                    "<td> " . $fee . "</td>".
                    "<td> " . $bill_states[$state] . "</td>".
                    "<td>
                      <button class='call-btn btn btn-outline-primary btn-floating btn-sm ripple-surface' data-mdb-toggle='modal' data-mdb-target='#updateBillModal$id'><i class='fa fa-pencil'></i></button>
                      <button class='message-btn btn ms-2 btn-primary btn-floating btn-sm' data-mdb-toggle='modal' data-mdb-target='#deleteBillModal$id'><i class='fa fa-trash'></i></button>
                    </td>".
                    "</tr>";

                  // Update Modal
        // bill_update($conn , $_POST['bill_id'], $_POST['fee'], $_POST['type'], $_POST['title'] , $_POST['state']);

                  echo "
                  <div class='modal fade' id='updateBillModal$id' tabindex='-1' aria-labelledby='updateBillModalLabel' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered'>
                    <form method='post' action='./controller/bill_controller.php'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <h5 class='modal-title' id='updateBillModalLabel'>修改宿舍</h5>
                      </div>
                      <div class='modal-body'>
                        <div class='text-center mb-3'>
                          <div class='form-outline mb-4'>
                            <input value='$id' required readonly type='text' name='bill_id' class='form-control' />
                            <label class='form-label'>帳單編號</label>
                          </div>
                          <div class='form-outline mb-4'>
                            <input value='$year' required readonly type='text' name='year' class='form-control' />
                            <label class='form-label'>年</label>
                          </div>
                          <div class='form-outline mb-4'>
                            <input value='$account' required readonly type='text' name='account' class='form-control' />
                            <label class='form-label'>帳號</label>
                          </div>
                          
                          <select class='form-select mb-4' name='type' required>
                            <option value=''>類別</option>";

                            for($i = 0; $i<5; $i++){

                              echo "<option value=$i"; 
                              if($type == $i) echo " selected"; 
                              echo ">".$bill_types[$i]."</option>";
                            }
                          echo "</select>
                          <div class='form-outline mb-4'>
                            <input value='$title' required type='text' name='title'' class='form-control' />
                            <label class='form-label'>名稱</label>
                          </div>
                          <div class='form-outline mb-4'>
                            <input value='$fee' required type='text' name='fee' id='fee' class='form-control' />
                            <label class='form-label' for='fee'>費用</label>
                          </div>
                          <select class='form-select mb-4' name='state' required>
                            <option value=''>狀態</option>";
                            for($i = 0; $i<2; $i++){
                              echo "<option value=$i"; if($state ==$i) echo " selected"; echo ">".$bill_states[$i]."</option>";
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
                  <div class='modal fade' id='deleteBillModal$id' tabindex='-1' aria-labelledby='deleteBillModalLabel' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered'>
                      <form method='post' action='./controller/bill_controller.php'>
                        <div class='modal-content'>
                          <div class='modal-header'>
                            <h5 class='modal-title' id='deleteBillModalLabel'>刪除宿舍</h5>
                          </div>
                          <div class='modal-body'>您確認要刪除此宿舍嗎？</div>
                          <div class='modal-footer'>
                            <input value='$id' required type='hidden' name='bill_id' class='form-control' />
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
<div class='modal fade' id='addBillModal' tabindex='-1' aria-labelledby='addBillModalLabel' aria-hidden='true'>
  <div class='modal-dialog modal-dialog-centered'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='addSystemManagerModalLabel'>新增宿舍</h5>
      </div>
      <form method='post' action='./controller/bill_controller.php'>
        <div class='modal-body'>
          <div class='text-center mb-3'>
            <select class='form-select mb-4' name='year_account' required>
              <option value=''>年度-帳號</option>
              <?php
                $res = border_read_all($conn);
                if (mysqli_num_rows($res) > 0) {
                  while ($info = mysqli_fetch_assoc($res)){
                    echo "<option value=".$info['year'].'-'.$info['account'].">".$info['year'].'-'.$info['account'].''."</option>";
                  }
                }
              ?>
            </select>
            <select class='form-select mb-4' name=type required>
              <option value=''>類別</option>
              <?php
              for($i = 0; $i<5; $i++){
                echo "<option value=$i>".$bill_types[$i]."</option>";
              }
              ?>
            </select>
            <div class='form-outline mb-4'>
              <input required type='text' name='title' id='title' class='form-control' />
              <label class='form-label' for='title'>名稱</label>
            </div>
            <div class='form-outline mb-4'>
              <input required type='text' name='fee' id='fee' class='form-control' />
              <label class='form-label' for='fee'>費用</label>
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

