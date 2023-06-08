<!--Bill-->
<!--Title-->
<div class="card m-2 px-4 py-3">
  <div class="d-flex justify-content-between">
    <h4 class="mb-0">帳單資料</h4>
    <div class="d-flex">
      <select type="text" id="billTypeFilter" onchange="bill_type_filter()" class='form-select-sm ms-2'  required>
        <option value=''>帳單類別</option>
        <?php
        for($i = 0; $i<count($bill_types); $i++){
          echo "<option value=".$bill_types[$i].">".$bill_types[$i]."</option>";
        }?>
      </select>
      <select type="text" id="billStateFilter" onchange="bill_state_filter()" class='form-select-sm ms-2'  required>
        <option value=''>帳單狀態</option>
        <?php
        for($i = 0; $i<count($bill_states); $i++){
          echo "<option value=".$bill_states[$i].">".$bill_states[$i]."</option>";
        }?>
      </select>
      <?php 
        if( $_SESSION["permission"] == 0){
            echo "<button class='btn ms-2 btn-primary btn-sm' data-mdb-toggle='modal' data-mdb-target='#addBillModal'><i class='fa fa-add me-1'></i>新增</button>";
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
        <table id="billTable" class="table datatable-table">
          <thead class="datatable-header">
            <tr>
              <th scope="col">編號</th>
              <th scope="col">年</th>
              <th scope="col">帳號</th>
              <th scope="col">標題</th>
              <th scope="col">類別</th>
              <th scope="col">費用</th>
              <th scope="col">狀態</th>
              <?php
                if( $_SESSION["permission"] == 0){
                  echo "<th scope='col'>操作</th>";
                }
              ?>
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
                    "<td>" . $id . "</td>".
                    "<td>" . $year . "</td>".
                    "<td>" . $account . "</td>".
                    "<td>" . $title . "</td>".
                    "<td>" . $bill_types[$type] . "</td>".
                    "<td>" . $fee . "</td>".
                    "<td>" . $bill_states[$state] . "</td>";
                  if( $_SESSION["permission"] == 0){
                    echo "<td>
                      <button class='call-btn btn btn-outline-primary btn-floating btn-sm ripple-surface' data-mdb-toggle='modal' data-mdb-target='#updateBillModal$id'><i class='fa fa-pencil'></i></button>
                      <button class='message-btn btn ms-2 btn-primary btn-floating btn-sm' data-mdb-toggle='modal' data-mdb-target='#deleteBillModal$id'><i class='fa fa-trash'></i></button>
                    </td>";
                  }
                  echo  "</tr>";

                  // Update Modal
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
                            <input value='$fee' required type='text' name='fee' class='form-control' />
                            <label class='form-label' >費用</label>
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
              <input required type='text' name='fee' class='form-control' />
              <label class='form-label'>費用</label>
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

<script>
function bill_type_filter() {
  var filter, tr, td, i;
  filter = document.getElementById("billTypeFilter").value;
  tr = document.getElementById("billTable").getElementsByTagName("tr");

  for (i = 1; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[4].innerText;
    if (td) {
      if (filter == '') {
        tr[i].style.display = "";
      } else if (td == filter) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

function bill_state_filter() {
  var filter, tr, td, i;
  filter = document.getElementById("billStateFilter").value;
  tr = document.getElementById("billTable").getElementsByTagName("tr");

  for (i = 1; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[6].innerText;
    if (td) {
      if (filter == '') {
        tr[i].style.display = "";
      } else if (td == filter) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>