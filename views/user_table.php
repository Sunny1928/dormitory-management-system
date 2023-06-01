<?php
  $genders = array("男", "女");
  $types = array("系統管理員", "舍監", "家長", "學生");
?>

<!--Title-->
<div class="card m-2 px-4 py-3">
  <div class="d-flex justify-content-between">
    <h4 class="mb-0">使用者資料</h4>
    <button class='btn ms-2 btn-primary btn-sm' data-mdb-toggle='modal' data-mdb-target='#addStudentModal'><i class='fa fa-add me-1'></i>新增</button>
  </div>
</div>

<!-- Table -->
<div class="card m-2">
  <section class="border p-4">
    <div  data-mdb-hover="true" class="datatable datatable-hover">
      <div class="datatable-inner table-responsive ps" style="overflow: auto; position: relative;">
        <table class="table datatable-table">
          <thead class="datatable-header">
            <tr>
              <th scope="col">名字</th>
              <th scope="col">帳號</th>
              <th scope="col">密碼</th>
              <th scope="col">Email</th>
              <th scope="col">電話</th>
              <th scope="col">性別</th>
              <th scope="col">類別</th>
              <th scope="col">操作</th>
            </tr>
          </thead>
          <tbody class="datatable-body">
            <?php

              $result = user_read_all($conn);

              if (mysqli_num_rows($result) > 0) 
              {
                while ($info = mysqli_fetch_assoc($result)) 
                {
                  $name = $info['name'];
                  $account = $info['account'];
                  $password = $info['password'];
                  $email = $info['email'];
                  $phone = $info['phone'];
                  $gender = $info['gender'];
                  $type = $info['type'];
                  
                  
                  echo "<tr>" .
                    "<td> " . $name . "</td>".
                    "<td> ". $account ."</td> ".
                    "<td> " . $password . "</td>".
                    "<td> " . $email . "</td>".
                    "<td> " . $phone . "</td>".
                    "<td> " . $genders[$gender] . "</td>".
                    "<td> " . $types[$type] . "</td>".
                    "<td>
                      <button class='call-btn btn btn-outline-primary btn-floating btn-sm ripple-surface' data-mdb-toggle='modal' data-mdb-target='#updateStudentModal$account'><i class='fa fa-pencil'></i></button>
                      <button class='message-btn btn ms-2 btn-primary btn-floating btn-sm' data-mdb-toggle='modal' data-mdb-target='#deleteStudentModal$account'><i class='fa fa-trash'></i></button>
                    </td>".
                    "</tr>";

                  // Update Modal
                  echo "
                  <div class='modal fade' id='updateStudentModal$account' tabindex='-1' aria-labelledby='updateStudentModalLabel' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered'>
                    <form method='post' action='./service/student_update.php'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <h5 class='modal-title' id='updateStudentModalLabel'>修改使用者</h5>
                      </div>
                      <div class='modal-body'>
                          <div class='text-center mb-3'>
                            <div class='form-outline mb-4'>
                            <input value='$name' required type='text' name='name' class='form-control' />
                            <label class='form-label'>名稱</label>
                            <div class='form-notch'>
                              <div class='form-notch-leading' style='width: 9px;'></div>
                              <div class='form-notch-middle' style='width: 114.4px;'></div>
                              <div class='form-notch-trailing'></div>
                            </div>
                          </div>
                          <div class='form-outline mb-4'>
                            <input value='$account' readonly required type='text' name='account'  class='form-control' />
                            <label class='form-label'>使用者</label>
                            <div class='form-notch'>
                              <div class='form-notch-leading' style='width: 9px;'></div>
                              <div class='form-notch-middle' style='width: 114.4px;'></div>
                              <div class='form-notch-trailing'></div>
                            </div>
                          </div>
                          <div class='form-outline mb-4'>
                            <input value='$password' required type='text' name='name' class='form-control' />
                            <label class='form-label'>密碼</label>
                            <div class='form-notch'>
                              <div class='form-notch-leading' style='width: 9px;'></div>
                              <div class='form-notch-middle' style='width: 114.4px;'></div>
                              <div class='form-notch-trailing'></div>
                            </div>
                          </div>
                          <div class='form-outline mb-4'>
                            <input value='$email' required type='email' name='email' class='form-control' />
                            <label class='form-label'>Email</label>
                            <div class='form-notch'>
                              <div class='form-notch-leading' style='width: 9px;'></div>
                              <div class='form-notch-middle' style='width: 114.4px;'></div>
                              <div class='form-notch-trailing'></div>
                            </div>
                          </div>
                          <div class='form-outline mb-4'>
                            <input value='$phone' required type='tel' name='phone' class='form-control' />
                            <label class='form-label'>電話</label>
                            <div class='form-notch'>
                              <div class='form-notch-leading' style='width: 9px;'></div>
                              <div class='form-notch-middle' style='width: 114.4px;'></div>
                              <div class='form-notch-trailing'></div>
                            </div>
                          </div>
                          
                          <select class='form-select mb-4' name=gender required>
                            <option value=''>狀態</option>
                            <option value=0"; if($gender ==0) echo "selected"; echo">$genders[0]</option>
                            <option value=1"; if($gender ==1) echo "selected"; echo">$genders[1]</option>
                          </select>
                          <select class='form-select mb-4' name=gender required>
                            <option value=''>狀態</option>
                            <option value=0"; if($type ==0) echo "selected"; echo">$types[0]</option>
                            <option value=1"; if($type ==1) echo "selected"; echo">$types[1]</option>
                            <option value=2"; if($type ==2) echo "selected"; echo">$types[2]</option>
                            <option value=3"; if($type ==3) echo "selected"; echo">$types[3]</option>
                          </select>
                        </div>
                      </div>
                      <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
                        <button type='submit' class='btn btn-primary'>確認</button>
                      </div>
                    </div>
                    </form>
                    </div>
                  </div>";

                  // Delete  Modal
                  echo "
                  <div class='modal fade' id='deleteStudentModal$account' tabindex='-1' aria-labelledby='deleteStudentModalLabel' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered'>
                      <div class='modal-content'>
                        <div class='modal-header'>
                          <h5 class='modal-title' id='deleteStudentModalLabel'>刪除使用者</h5>
                        </div>
                        <div class='modal-body'>您確認要刪除此使用者嗎？</div>
                        <div class='modal-footer'>
                          <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
                          <button type='button' class='btn btn-primary' onclick='location.href=\"./service/student_delete.php?account=$account\"'>確認</button>
                        </div>
                      </div>
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
  <!-- Add Modal -->
  <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addSystemManagerModalLabel">新增使用者</h5>
        </div>
        <form method="post" action="./service/student_add.php">
          <div class="modal-body">
            <div class="text-center mb-3">
              <div class="form-outline mb-4">
                <input required type="text" name="name" id="registerName" class="form-control" />
                <label class="form-label" for="registerName">名稱</label>
                <div class="form-notch">
                  <div class="form-notch-leading" style="width: 9px;"></div>
                  <div class="form-notch-middle" style="width: 114.4px;"></div>
                  <div class="form-notch-trailing"></div>
                </div>
              </div>
              <div class="form-outline mb-4">
                <input required type="text" name="account" id="registerAccount" class="form-control" />
                <label class="form-label" for="registerAccount">帳號</label>
                <div class="form-notch">
                  <div class="form-notch-leading" style="width: 9px;"></div>
                  <div class="form-notch-middle" style="width: 114.4px;"></div>
                  <div class="form-notch-trailing"></div>
                </div>
              </div>
              <div class="form-outline mb-4">
                <input required type="password" name="password" id="registerPassword" class="form-control" />
                <label class="form-label" for="registerPassword">密碼</label>
                <div class="form-notch">
                  <div class="form-notch-leading" style="width: 9px;"></div>
                  <div class="form-notch-middle" style="width: 114.4px;"></div>
                  <div class="form-notch-trailing"></div>
                </div>
              </div>
              <div class="form-outline mb-4">
                <input required type="email" name="email" id="registerEmail" class="form-control" />
                <label class="form-label" for="registerEmail">Email</label>
                <div class="form-notch">
                  <div class="form-notch-leading" style="width: 9px;"></div>
                  <div class="form-notch-middle" style="width: 114.4px;"></div>
                  <div class="form-notch-trailing"></div>
                </div>
              </div>
              <div class="form-outline mb-4">
                <input required type="tel" name="phone" id="registerPhone" class="form-control" />
                <label class="form-label" for="registerPhone">電話</label>
                <div class="form-notch">
                  <div class="form-notch-leading" style="width: 9px;"></div>
                  <div class="form-notch-middle" style="width: 114.4px;"></div>
                  <div class="form-notch-trailing"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">取消</button>
            <button type="submit" class="btn btn-primary">確認</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

