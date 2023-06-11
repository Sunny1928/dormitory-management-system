<!--Student-->
<!--Title-->
<div class="card m-2 px-4 py-3">
  <div class="d-flex justify-content-between">
    <h4 class="mb-0">學生資料</h4>
    <?php
      if($_SESSION["account"] == 'root'){
        echo "<button class='btn ms-2 btn-primary btn-sm' data-mdb-toggle='modal' data-mdb-target='#addStudentModal'><i class='fa fa-add me-1'></i>新增</button>";
      }
    ?>
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
              <th scope="col">Email</th>
              <th scope="col">電話</th>
              <th scope="col">性別</th>
              <th scope="col">系所</th>
              <?php
                if($_SESSION["account"] == 'root'){
                  echo "<th scope='col'>操作</th>";
                }
              ?>
            </tr>
          </thead>
          <tbody class="datatable-body">
            <?php
              if($_SESSION['permission']==2){
                $result = border_read_roommate($conn , $_SESSION['student_account'] , $_SESSION['year']);
              }else if($_SESSION['permission']==4 || $_SESSION['permission']==5){
                $result = border_read_roommate($conn , $_SESSION['account'] , $_SESSION['year']);
              }else{
                $result = student_read_all($conn);
              }

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
                  $department = $info['department'];
                  
                  
                  echo "<tr>" .
                    "<td>" . $name . "</td>".
                    "<td>". $account ."</td> ".
                    "<td>" . $email . "</td>".
                    "<td>" . $phone . "</td>".
                    "<td>" . $genders[$gender] . "</td>".
                    "<td>" . $department . "</td>";
                    if($_SESSION["account"] == 'root'){
                      echo "<td>
                        <button class='call-btn btn btn-outline-primary btn-floating btn-sm ripple-surface' data-mdb-toggle='modal' data-mdb-target='#updateStudentModal$account'><i class='fa fa-pencil'></i></button>
                        <button class='message-btn btn ms-2 btn-primary btn-floating btn-sm' data-mdb-toggle='modal' data-mdb-target='#deleteStudentModal$account'><i class='fa fa-trash'></i></button>
                      </td>";
                    }
                  echo "</tr>";

                  // Update Modal
                  echo "
                  <div class='modal fade' id='updateStudentModal$account' tabindex='-1' aria-labelledby='updateStudentModalLabel' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered'>
                    <form method='post' action='./controller/user_controller.php'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <h5 class='modal-title' id='updateStudentModalLabel'>修改學生</h5>
                      </div>
                      <div class='modal-body'>
                          <div class='text-center mb-3'>
                            <div class='form-outline mb-4'>
                            <input value='$name' required type='text' name='name' class='form-control' />
                            <label class='form-label'>名稱</label>
                          </div>
                          <div class='form-outline mb-4'>
                            <input value='$account' readonly required type='text' name='account'  class='form-control' />
                            <label class='form-label'>帳號</label>
                          </div>
                          <div class='form-outline mb-4'>
                            <input value='$email' required type='email' name='email' class='form-control' />
                            <label class='form-label'>Email</label>
                          </div>
                          <div class='form-outline mb-4'>
                            <input value='$phone' required type='tel' name='phone' class='form-control' />
                            <label class='form-label'>電話</label>
                          </div>
                          <select class='form-select mb-4' name='gender' required>
                            <option value=''>性別</option>";
                            for($i = 0; $i<2; $i++){
                              echo "<option value=$i"; if($gender ==$i) echo " selected"; echo ">".$genders[$i]."</option>";
                            }
                          echo "</select>
                          <input value='$type'  required type='hidden' name='type' class='form-control' />
                          <div class='form-outline mb-4'>
                            <input value='$department' required type='tel' name='department' class='form-control' />
                            <label class='form-label'>系所</label>
                          </div>
                        </div>
                      </div>
                      <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
                        <button type='submit' class='btn btn-primary' name='student_update' value='student_update'>確認</button>
                      </div>
                    </div>
                    </form>
                    </div>
                  </div>";

                  // Delete  Modal
                  echo "
                  <div class='modal fade' id='deleteStudentModal$account' tabindex='-1' aria-labelledby='deleteStudentModalLabel' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered'>
                      <form method='post' action='./controller/user_controller.php'>
                        <div class='modal-content'>
                          <div class='modal-header'>
                            <h5 class='modal-title' id='deleteStudentModalLabel'>刪除學生</h5>
                          </div>
                          <div class='modal-body'>您確認要刪除此學生嗎？</div>
                          <div class='modal-footer'>
                            <input value='$account' required type='hidden' name='account' class='form-control' />
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

<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addSystemManagerModalLabel">新增學生</h5>
        </div>
        <form method="post" action="./controller/user_controller.php">
          <div class="modal-body">
            <div class="text-center mb-3">
              <div class="form-outline mb-4">
                <input required type="text" name="name" class="form-control" />
                <label class="form-label">名稱</label>
              </div>
              <div class="form-outline mb-4">
                <input required type="text" name="account" class="form-control" />
                <label class="form-label">帳號</label>
              </div>
              <div class="form-outline mb-4">
                <input required type="password" name="password" class="form-control" />
                <label class="form-label" >密碼</label>
              </div>
              <div class="form-outline mb-4">
                <input required type="email" name="email"  class="form-control" />
                <label class="form-label">Email</label>
              </div>
              <div class="form-outline mb-4">
                <input required type="tel" name="phone" class="form-control" />
                <label class="form-label">電話</label>
              </div>
              <select class='form-select mb-4' name=gender required>
                <option value=''>性別</option>
                <?php
                for($i = 0; $i<2; $i++){
                  echo "<option value=$i>".$genders[$i]."</option>";
                }
                ?>
              </select>
              <input value='3' required type='hidden' name='type' class='form-control' />
              <div class="form-outline mb-4">
                <input required type="text" name="department" class="form-control" />
                <label class="form-label">系所</label>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">取消</button>
            <button type="submit" class="btn btn-primary" name='student_create' value='student_create'>確認</button>
          </div>
        </form>
      </div>
    </div>
  </div>
