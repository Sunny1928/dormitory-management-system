<!-- Apply Dorm -->
<!--Title-->
<div class="card m-2 px-4 py-3">
  <div class="d-flex justify-content-between">
    <h4 class="mb-0">申請宿舍資料</h4>
    <div class="d-flex">
      <select type="text" id="applyDormStateFilter" onchange="apply_dorm_state_filter()" class='form-select-sm'  required>
        <option value=''>申請宿舍狀態</option>
        <?php
        for($i = 0; $i<count($apply_dorm_states); $i++){
          echo "<option value=".$apply_dorm_states[$i].">".$apply_dorm_states[$i]."</option>";
        }?>
      </select>
      <button class='btn ms-2 btn-primary btn-sm' data-mdb-toggle='modal' data-mdb-target='#addApplyDormModal'><i class='fa fa-add me-1'></i>新增</button>
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
              <th scope="col">帳號</th>
              <th scope="col">狀態</th>
              <th scope="col">操作</th>
            </tr>
          </thead>
          <tbody class="datatable-body">
            <?php
              $result = apply_dorm_read_all($conn);

              if (mysqli_num_rows($result) > 0) 
              {
                while ($info = mysqli_fetch_assoc($result)) 
                {
                  $id = $info['apply_dorm_id'];
                  $account = $info['account'];
                  $state = $info['state'];
                  
                  echo "<tr>" .
                    "<td>" . $id . "</td>".
                    "<td>" . $account . "</td>".
                    "<td>" . $apply_dorm_states[$state] . "</td>".
                    "<td>
                      <button class='call-btn btn btn-outline-primary btn-floating btn-sm ripple-surface' data-mdb-toggle='modal' data-mdb-target='#updateApplyDormModal$id'><i class='fa fa-pencil'></i></button>
                      <button class='message-btn btn ms-2 btn-primary btn-floating btn-sm' data-mdb-toggle='modal' data-mdb-target='#deleteApplyDormModal$id'><i class='fa fa-trash'></i></button>
                    </td>".
                    "</tr>";

                  // Update Modal
                  echo "
                  <div class='modal fade' id='updateApplyDormModal$id' tabindex='-1' aria-labelledby='updateApplyDormModalLabel' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered'>
                    <form method='post' action='./controller/apply_dorm_controller.php'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <h5 class='modal-title' id='updateApplyDormModalLabel'>修改申請宿舍</h5>
                      </div>
                      <div class='modal-body'>
                        <div class='text-center mb-3'>
                          <div class='form-outline mb-4'>
                            <input value='$id' readonly required type='text' name='apply_dorm_id' class='form-control' />
                            <label class='form-label'>申請宿舍編號</label>
                          </div>
                          <select class='form-select mb-4' name='state' required>
                            <option value=''>狀態</option>";
                            for($i = 0; $i<4; $i++){
                              echo "<option value=$i"; if($state ==$i) echo " selected"; echo ">".$apply_dorm_states[$i]."</option>";
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
                  <div class='modal fade' id='deleteApplyDormModal$id' tabindex='-1' aria-labelledby='deleteApplyDormModalLabel' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered'>
                      <form method='post' action='./controller/apply_dorm_controller.php'>
                        <div class='modal-content'>
                          <div class='modal-header'>
                            <h5 class='modal-title' id='deleteApplyDormModalLabel'>刪除申請宿舍</h5>
                          </div>
                          <div class='modal-body'>您確認要刪除此申請宿舍嗎？</div>
                          <div class='modal-footer'>
                            <input value='$id' required type='hidden' name='apply_dorm_id' class='form-control' />
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

<script>

function apply_dorm_state_filter() {
  var filter, tr, td, i;
  filter = document.getElementById("applyDormStateFilter").value;
  tr = document.getElementById("applyDormTable").getElementsByTagName("tr");

  for (i = 1; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2].innerText;
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