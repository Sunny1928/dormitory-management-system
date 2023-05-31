<!--student-->
<div class="tab-pane fade show active" id="pills-student" role="tabpanel" aria-labelledby="tab-student">

<!--Title-->
<div class="card m-2 px-4 py-3">
  <div class="d-flex justify-content-between">
    <h4 class="mb-0">學生資料</h4>
    <button class='btn ms-2 btn-primary btn-sm' data-mdb-toggle='modal' data-mdb-target='#addStudentModal'><i
        class='fa fa-add me-1'></i> 新增</button>
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
              <th scope="col">帳號</th>
              <th scope="col">名字</th>
              <th scope="col">Email</th>
              <th scope="col">電話</th>
              <th scope="col">學號</th>
              <th scope="col">學年</th>
              <th scope="col">系級</th>
              <th scope="col">性別</th>
              <th scope="col">操作</th>
            </tr>
          </thead>
          <tbody class="datatable-body">
            <?php
              require('./service/connect_db.php');
              $conn = connect_db();

              $sql = "SELECT * FROM Student JOIN User ON User.account = Student.account";
              $result = $conn->query($sql);

              if (mysqli_num_rows($result) > 0) 
              {
                while ($userinfo = mysqli_fetch_assoc($result)) 
                {
                  $account = $userinfo['account'];
                  $name = $userinfo['name'];
                  $email = $userinfo['email'];
                  $phone = $userinfo['phone'];
                  $student_id = $userinfo['student_id'];
                  $academic_year = $userinfo['academic_year'];
                  $major_year = $userinfo['major_year'];
                  $gender = $userinfo['gender'];
                  
                  echo "<tr>" .
                    "<td> ". $account ."</td> ".
                    "<td> " . $name . "</td>".
                    "<td> " . $email . "</td>".
                    "<td> " . $phone . "</td>".
                    "<td> " . $student_id . "</td>".
                    "<td> " . $academic_year . "</td>".
                    "<td> " . $major_year . "</td>".
                    "<td> " . $gender . "</td>".
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
                        <h5 class='modal-title' id='updateStudentModalLabel'>修改學生</h5>
                        <button type='button' class='btn-close' data-mdb-dismiss='modal' aria-label='Close'></button>
                      </div>
                      <div class='modal-body'>
                        <div class='text-center mb-3'>
                          <div class='form-outline mb-4'>
                            <input value='$account' readonly required type='text' name='account' id='registerAccount' class='form-control' />
                            <label class='form-label' for='registerAccount'>帳號</label>
                            <div class='form-notch'>
                              <div class='form-notch-leading' style='width: 9px;'></div>
                              <div class='form-notch-middle' style='width: 114.4px;'></div>
                              <div class='form-notch-trailing'></div>
                            </div>
                          </div>
                          <div class='form-outline mb-4'>
                            <input value='$name' required type='text' name='name' id='registerName' class='form-control' />
                            <label class='form-label' for='registerName'>名稱</label>
                            <div class='form-notch'>
                              <div class='form-notch-leading' style='width: 9px;'></div>
                              <div class='form-notch-middle' style='width: 114.4px;'></div>
                              <div class='form-notch-trailing'></div>
                            </div>
                          </div>
                          <div class='form-outline mb-4'>
                            <input value='$email' required type='email' name='email' id='registerEmail' class='form-control' />
                            <label class='form-label' for='registerEmail'>Email</label>
                            <div class='form-notch'>
                              <div class='form-notch-leading' style='width: 9px;'></div>
                              <div class='form-notch-middle' style='width: 114.4px;'></div>
                              <div class='form-notch-trailing'></div>
                            </div>
                          </div>
                          <div class='form-outline mb-4'>
                            <input value='$phone' required type='tel' name='phone' id='registerPhone' class='form-control' />
                            <label class='form-label' for='registerPhone'>電話</label>
                            <div class='form-notch'>
                              <div class='form-notch-leading' style='width: 9px;'></div>
                              <div class='form-notch-middle' style='width: 114.4px;'></div>
                              <div class='form-notch-trailing'></div>
                            </div>
                          </div>
                          <div class='form-outline mb-4'>
                            <input value='$academic_year' required type='number' name='academic_year' id='registerAcademicYear'
                              class='form-control' />
                            <label class='form-label' for='registerAcademicYear'>學年</label>
                            <div class='form-notch'>
                              <div class='form-notch-leading' style='width: 9px;'></div>
                              <div class='form-notch-middle' style='width: 114.4px;'></div>
                              <div class='form-notch-trailing'></div>
                            </div>
                          </div>
                          <div class='form-outline mb-4'>
                            <input value='$major_year' required type='number' name='major_year' id='registerMajorYear' class='form-control' />
                            <label class='form-label' for='registerMajorYear'>系級</label>
                            <div class='form-notch'>
                              <div class='form-notch-leading' style='width: 9px;'></div>
                              <div class='form-notch-middle' style='width: 114.4px;'></div>
                              <div class='form-notch-trailing'></div>
                            </div>
                          </div>
                          <div class='form-outline mb-4'>
                            <input value='$student_id' required type='text' name='student_id' id='registerStudentNo' class='form-control' />
                            <label class='form-label' for='registerStudentNo'>學號</label>
                            <div class='form-notch'>
                              <div class='form-notch-leading' style='width: 9px;'></div>
                              <div class='form-notch-middle' style='width: 114.4px;'></div>
                              <div class='form-notch-trailing'></div>
                            </div>
                          </div>
                          <div class='form-check form-check-inline mb-4'>";
                          if($gender == 'male'){
                            echo "<input checked name='gender' value='male' class='form-check-input' type='radio' id='male' />";
                          }else{
                            echo "<input name='gender' value='male' class='form-check-input' type='radio' id='male' />";
                          }
                            echo "<label class='form-check-label' for='male'>男</label>
                          </div>
                          <div class='form-check form-check-inline mb-4'>";
                          if($gender == 'female'){
                            echo "<input checked name='gender' value='female' class='form-check-input' type='radio' id='female' />";
                          }else{
                            echo "<input name='gender' value='female' class='form-check-input' type='radio' id='female' />";
                          }
                            
                            echo "<label class='form-check-label' for='female'>女</label>
                          </div>
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
                          <h5 class='modal-title' id='deleteStudentModalLabel'>刪除學生</h5>
                        </div>
                        <div class='modal-body'>您確認要刪除學生嗎？</div>
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
        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
          <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; right: 0px;">
          <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
        </div>
      </div>

      <div class="datatable-pagination d-flex justify-content-end">
        <div class="datatable-pagination-buttons">
          <button data-mdb-ripple-color="dark"
            class="btn btn-link datatable-pagination-button datatable-pagination-left"><i
              class="fa fa-chevron-left"></i></button>
          <button data-mdb-ripple-color="dark"
            class="btn btn-link datatable-pagination-button datatable-pagination-right"><i
              class="fa fa-chevron-right"></i></button>
        </div>
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
      <form method="post" action="./service/student_add.php">
        <div class="modal-body">
          <div class="text-center mb-3">
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
              <input required type="text" name="name" id="registerName" class="form-control" />
              <label class="form-label" for="registerName">名稱</label>
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
            <div class="form-outline mb-4">
              <input required type="number" name="academic_year" id="registerAcademicYear"
                class="form-control" />
              <label class="form-label" for="registerAcademicYear">學年</label>
              <div class="form-notch">
                <div class="form-notch-leading" style="width: 9px;"></div>
                <div class="form-notch-middle" style="width: 114.4px;"></div>
                <div class="form-notch-trailing"></div>
              </div>
            </div>
            <div class="form-outline mb-4">
              <input required type="number" name="major_year" id="registerMajorYear" class="form-control" />
              <label class="form-label" for="registerMajorYear">系級</label>
              <div class="form-notch">
                <div class="form-notch-leading" style="width: 9px;"></div>
                <div class="form-notch-middle" style="width: 114.4px;"></div>
                <div class="form-notch-trailing"></div>
              </div>
            </div>
            <div class="form-outline mb-4">
              <input required type="text" name="student_id" id="registerStudentNo" class="form-control" />
              <label class="form-label" for="registerStudentNo">學號</label>
              <div class="form-notch">
                <div class="form-notch-leading" style="width: 9px;"></div>
                <div class="form-notch-middle" style="width: 114.4px;"></div>
                <div class="form-notch-trailing"></div>
              </div>
            </div>
            <div class="form-check form-check-inline mb-4">
              <input name="gender" value="male" class="form-check-input" type="radio" id="male" />
              <label class="form-check-label" for="male">男</label>
            </div>
            <div class="form-check form-check-inline mb-4">
              <input name="gender" value="female" class="form-check-input" type="radio" id="female" />
              <label class="form-check-label" for="female">女</label>
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