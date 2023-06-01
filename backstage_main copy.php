<?php
  // session_start();
  // if (!isset($_SESSION["permission"]) || $_SESSION['permission']!="system_manager" || $_SESSION["account"] != "root"){
          
  //   Header("Location: ./backstage_index.php" , 301);
  //   die();
  // }		
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.css" rel="stylesheet" />
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"></script>
  <title>Database Final Project</title>
</head>

<body>
  <!-- Sidebar -->
  <header>
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white p-0">
      <div class="position-sticky">
        <div class="mt-4">
          <div id="header-content" class="w-auto">
            <div class="d-flex justify-content-center">
              <img src="./image/man.png" alt="avatar" class="rounded-circle img-fluid mb-3 m-auto"
                style="max-width: 100px;">
            </div>
            <h4 class="text-center">
              <span style="white-space: nowrap;"><?php echo $_SESSION['name']?></span>
            </h4>
            <p class="text-center"><?php echo $_SESSION['email']?></p>
          </div>
          <hr class="mb-0">
        </div>
        <div class="align-items-end list-group list-group-flush mx-3 mt-4">

          <a class="list-group-item list-group-item-action py-2 ripple active " id="tab-student" data-mdb-toggle="pill"
            href="#pills-student" role="tab" aria-controls="pills-student" aria-selected="true">
            <i class="fas fa-school pe-3"></i>學生
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple" id="tab-system-manager" data-mdb-toggle="pill"
            href="#pills-system-manager" role="tab" aria-controls="pills-system-manager" aria-selected="false">
            <i class="fas fa-briefcase pe-3"></i>系統管理員
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-dormitory-supervisor"
            data-mdb-toggle="pill" href="#pills-dormitory-supervisor" role="tab"
            aria-controls="pills-dormitory-supervisor" aria-selected="false">
            <i class="fas fa-building pe-3"></i>舍監
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-dormitory" data-mdb-toggle="pill"
            href="#pills-dormitory" role="tab" aria-controls="pills-dormitory" aria-selected="false">
            <i class="fas fa-house-chimney pe-3"></i>宿舍大樓
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-room" data-mdb-toggle="pill"
            href="#pills-room" role="tab" aria-controls="pills-room" aria-selected="false">
            <i class="fas fa-door-open pe-3"></i>宿舍房間
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-equipment" data-mdb-toggle="pill"
            href="#pills-equipment" role="tab" aria-controls="pills-equipment" aria-selected="false">
            <i class="fas fa-bed pe-3"></i>宿舍房間設備
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-live-in" data-mdb-toggle="pill"
            href="#pills-live-in" role="tab" aria-controls="pills-live-in" aria-selected="false">
            <i class="fas fa-list pe-3"></i>學生住宿資料
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-rule" data-mdb-toggle="pill"
            href="#pills-rule" role="tab" aria-controls="pills-rule" aria-selected="false">
            <i class="fas fa-ruler pe-3"></i>規範
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-" data-mdb-toggle="pill"
            href="#pills-violate-record" role="tab" aria-controls="pills-violate-record" aria-selected="false">
            <i class="fas fa-book pe-3"></i>學生違規紀錄
          </a>
        </div>
        <div class="list-group list-group-flush mx-3">
          <a href="./backstage_index.php" class="list-group-item py-2 ripple pb-2">
            <i class="fas fa-right-from-bracket pe-3"></i>登出
          </a>
        </div>
        <div class=" text-center text-reset mt-5">
          <em><small>Copyright © 2023 - PYSY</small></em>
        </div>
    </nav>
    <!-- Sidebar -->
  </header>
  <main>
    <div class="tab-content h-100">

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



      <!-- System Manager -->
      <div class="tab-pane fade h-100" id="pills-system-manager" role="tabpanel" aria-labelledby="tab-system-manager">

        <!--Title-->
        <div class="card m-2 px-4 py-3">
          <div class="d-flex justify-content-between">
            <h4 class="mb-0">系統管理員資料</h4>
            <button class='btn ms-2 btn-primary btn-sm' data-mdb-toggle='modal'
              data-mdb-target='#addSystemManagerModal'><i class='fa fa-add me-1'></i> 新增</button>
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
                      <th scope="col">操作</th>
                    </tr>
                  </thead>
                  <tbody class="datatable-body">
                    <?php
                      $sql = "SELECT * FROM System_Manager JOIN User ON User.account = System_Manager.account";
                      $result = $conn->query($sql);

                      if (mysqli_num_rows($result) > 0) 
                      {
                        while ($userinfo = mysqli_fetch_assoc($result)) 
                        {
                          $account = $userinfo['account'];
                          $name = $userinfo['name'];
                          $email = $userinfo['email'];
                          $phone = $userinfo['phone'];
                          
                          echo "<tr>" .
                            "<td> ". $account ."</td> ".
                            "<td> " . $name . "</td>".
                            "<td> " . $email . "</td>".
                            "<td> " . $phone . "</td>".
                            "<td>
                              <button class='call-btn btn btn-outline-primary btn-floating btn-sm ripple-surface' data-mdb-toggle='modal' data-mdb-target='#updateSystemManagerModal$account'><i class='fa fa-pencil'></i></button>
                              <button class='message-btn btn ms-2 btn-primary btn-floating btn-sm' data-mdb-toggle='modal' data-mdb-target='#deleteSystemManagerModal$account'><i class='fa fa-trash'></i></button>
                            </td>".
                            "</tr>";

                          // Update Modal
                          echo "
                          <div class='modal fade' id='updateSystemManagerModal$account' tabindex='-1' aria-labelledby='updateSystemManagerModalLabel' aria-hidden='true'>
                            <div class='modal-dialog modal-dialog-centered'>
                            <form method='post' action='./service/system_manager_update.php'>
                            <div class='modal-content'>
                              <div class='modal-header'>
                                <h5 class='modal-title' id='updateSystemManagerModalLabel'>修改系統管理員</h5>
                                <button type='button' class='btn-close' data-mdb-dismiss='modal' aria-label='Close'></button>
                              </div>
                              <div class='modal-body'>
                                <div class='modal-body'>
                                <div class='text-center mb-3'>
                                  <div class='form-outline mb-4'>
                                    <input value='$account' readonly type='text' name='account' id='systemManagerAccount' class='form-control' />
                                    <label class='form-label' for='systemManagerAccount'>帳號</label>
                                    <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                                  </div>
                                  <div class='form-outline mb-4'>
                                    <input value='$name' required type='text' name='name' id='systemManagerName' class='form-control' />
                                    <label class='form-label' for='systemManagerName'>姓名</label>
                                    <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                                  </div>
                                  <div class='form-outline mb-4'>
                                    <input value='$email' required type='text' name='email' id='systemManagerEmail' class='form-control' />
                                    <label class='form-label' for='systemManagerEmail'>Email</label>
                                    <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                                  </div>
                                  <div class='form-outline mb-4'>
                                    <input value='$phone' required type='tel' name='phone' id='systemManagerPhone' class='form-control' />
                                    <label class='form-label' for='systemManagerPhone'>電話</label>
                                    <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                                  </div>
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

                          // Delete System Manager Modal
                          echo "
                          <div class='modal fade' id='deleteSystemManagerModal$account' tabindex='-1' aria-labelledby='deleteSystemManagerModalLabel' aria-hidden='true'>
                            <div class='modal-dialog modal-dialog-centered'>
                              <div class='modal-content'>
                                <div class='modal-header'>
                                  <h5 class='modal-title' id='deleteSystemManagerModalLabel'>刪除系統管理員</h5>
                                </div>
                                <div class='modal-body'>您確認要刪除系統管理員嗎？</div>
                                <div class='modal-footer'>
                                  <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
                                  <button type='button' class='btn btn-primary' onclick='location.href=\"./service/system_manager_delete.php?account=$account\"'>確認</button>
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
        <div class="modal fade" id="addSystemManagerModal" tabindex="-1" aria-labelledby="addSystemManagerModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addSystemManagerModalLabel">新增系統管理員</h5>

              </div>
              <div class="modal-body">
                <form method="post" action="./service/system_manager_add.php">
                  <div class="modal-body">
                    <div class="text-center mb-3">
                      <div class="form-outline mb-4">
                        <input required type="text" name="account" id="systemManagerAccount" class="form-control" />
                        <label class="form-label" for="systemManagerAccount">帳號</label>
                        <div class="form-notch">
                          <div class="form-notch-leading" style="width: 9px;"></div>
                          <div class="form-notch-middle" style="width: 114.4px;"></div>
                          <div class="form-notch-trailing"></div>
                        </div>
                      </div>
                      <div class="form-outline mb-4">
                        <input required type="text" name="password" id="systemManagerPassword" class="form-control" />
                        <label class="form-label" for="systemManagerPassword">密碼</label>
                        <div class="form-notch">
                          <div class="form-notch-leading" style="width: 9px;"></div>
                          <div class="form-notch-middle" style="width: 114.4px;"></div>
                          <div class="form-notch-trailing"></div>
                        </div>
                      </div>
                      <div class="form-outline mb-4">
                        <input required type="text" name="name" id="systemManagerName" class="form-control" />
                        <label class="form-label" for="systemManagerName">姓名</label>
                        <div class="form-notch">
                          <div class="form-notch-leading" style="width: 9px;"></div>
                          <div class="form-notch-middle" style="width: 114.4px;"></div>
                          <div class="form-notch-trailing"></div>
                        </div>
                      </div>
                      <div class="form-outline mb-4">
                        <input required type="text" name="email" id="systemManagerEmail" class="form-control" />
                        <label class="form-label" for="systemManagerEmail">Email</label>
                        <div class="form-notch">
                          <div class="form-notch-leading" style="width: 9px;"></div>
                          <div class="form-notch-middle" style="width: 114.4px;"></div>
                          <div class="form-notch-trailing"></div>
                        </div>
                      </div>
                      <div class="form-outline mb-4">
                        <input required type="tel" name="phone" id="systemManagerPhone" class="form-control" />
                        <label class="form-label" for="systemManagerPhone">電話</label>
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
      </div>


      <!-- Dormitory Supervisor -->
      <div class="tab-pane fade h-100" id="pills-dormitory-supervisor" role="tabpanel"
        aria-labelledby="tab-dormitory-supervisor">

        <!--Title-->
        <div class="card m-2 px-4 py-3">
          <div class="d-flex justify-content-between">
            <h4 class="mb-0">舍監資料</h4>
            <button class='btn ms-2 btn-primary btn-sm' data-mdb-toggle='modal'
              data-mdb-target='#addDomitorySupervisorModal'><i class='fa fa-add me-1'></i> 新增</button>
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
                      <th scope="col">宿舍大樓</th>
                      <th scope="col">操作</th>
                    </tr>
                  </thead>
                  <tbody class="datatable-body">
                    <?php
                      $sql = "SELECT * FROM Dormitory_Supervisor JOIN User ON User.account = Dormitory_Supervisor.account JOIN Dormitory ON Dormitory.dormitory_id = Dormitory_Supervisor.dormitory_id";
                      $result = $conn->query($sql);

                      if (mysqli_num_rows($result) > 0) 
                      {
                        while ($userinfo = mysqli_fetch_assoc($result)) 
                        {
                          $account = $userinfo['account'];
                          $name = $userinfo['name'];
                          $email = $userinfo['email'];
                          $phone = $userinfo['phone'];
                          $dormitory_id = $userinfo['dormitory_id'];
                          $dormitory_name = $userinfo['name'];
                          
                          echo "<tr>" .
                            "<td> ". $account ."</td> ".
                            "<td> " . $name . "</td>".
                            "<td> " . $email . "</td>".
                            "<td> " . $phone . "</td>".
                            "<td> " . $dormitory_name . "</td>".
                            "<td>
                              <button class='call-btn btn btn-outline-primary btn-floating btn-sm ripple-surface' data-mdb-toggle='modal' data-mdb-target='#updateDomitorySupervisorModal$account'><i class='fa fa-pencil'></i></button>
                              <button class='message-btn btn ms-2 btn-primary btn-floating btn-sm' data-mdb-toggle='modal' data-mdb-target='#deleteDomitorySupervisorModal$account'><i class='fa fa-trash'></i></button>
                            </td>".
                            "</tr>";

                          // Update Modal
                          echo "
                          <div class='modal fade' id='updateDomitorySupervisorModal$account' tabindex='-1' aria-labelledby='updateDomitorySupervisorModalLabel' aria-hidden='true'>
                          <div class='modal-dialog modal-dialog-centered'>
                          <form method='post' action='./service/dormitory_supervisor_update.php'>
                          <div class='modal-content'>
                              <div class='modal-header'>
                                <h5 class='modal-title' id='updateDomitorySupervisorModalLabel'>修改舍監</h5>
                                <button type='button' class='btn-close' data-mdb-dismiss='modal' aria-label='Close'></button>
                              </div>
                              <div class='modal-body'>
                                <div class='text-center mb-3'>
                                  <div class='form-outline mb-4'>
                                    <input value='$account' readonly type='text' name='account' id='DomitorySupervisorAccount' class='form-control' />
                                    <label class='form-label' for='DomitorySupervisorAccount'>帳號</label>
                                    <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                                  </div>
                                  <div class='form-outline mb-4'>
                                    <input value='$name' required type='text' name='name' id='DomitorySupervisorName' class='form-control' />
                                    <label class='form-label' for='DomitorySupervisorName'>姓名</label>
                                    <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                                  </div>
                                  <div class='form-outline mb-4'>
                                    <input value='$email' required type='text' name='email' id='DomitorySupervisorEmail' class='form-control' />
                                    <label class='form-label' for='DomitorySupervisorEmail'>Email</label>
                                    <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                                  </div>
                                  <div class='form-outline mb-4'>
                                    <input value='$phone' required type='tel' name='phone' id='DomitorySupervisorPhone' class='form-control' />
                                    <label class='form-label' for='DomitorySupervisorPhone'>電話</label>
                                    <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                                  </div>
                                  <div class='mb-4'>
                                    <select class='form-select' name='dormitory_id' required>
                                      <option value=''>宿舍大樓</option>";
                                      $sql = "SELECT * FROM Dormitory ORDER BY dormitory_id";
                                      foreach ($conn->query($sql) as $row) { 
                                        if($row['dormitory_id'] == $dormitory_id) echo "<option value=$row[dormitory_id] selected>$row[name]</option>";
                                        else echo "<option value=$row[dormitory_id]>$row[name]</option>";
                                      }
                              echo "</select>
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

                          // Delete System Manager Modal
                          echo "
                          <div class='modal fade' id='deleteDomitorySupervisorModal$account' tabindex='-1' aria-labelledby='deleteDomitorySupervisorModalLabel' aria-hidden='true'>
                            <div class='modal-dialog modal-dialog-centered'>
                              <div class='modal-content'>
                                <div class='modal-header'>
                                  <h5 class='modal-title' id='deleteDomitorySupervisorModalLabel'>刪除舍監</h5>
                                </div>
                                <div class='modal-body'>您確認要刪除舍監嗎？</div>
                                <div class='modal-footer'>
                                  <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
                                  <button type='button' class='btn btn-primary' onclick='location.href=\"./service/dormitory_supervisor_delete.php?account=$account\"'>確認</button>
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
        <div class="modal fade" id="addDomitorySupervisorModal" tabindex="-1"
          aria-labelledby="addDomitorySupervisorModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addDomitorySupervisorModalLabel">新增舍監</h5>
              </div>
              <div class="modal-body">
                <form method="post" action="./service/dormitory_supervisor_add.php">
                  <div class="modal-body">
                    <div class="text-center mb-3">
                      <div class="form-outline mb-4">
                        <input required type="text" name="account" id="DomitorySupervisorAccount"
                          class="form-control" />
                        <label class="form-label" for="DomitorySupervisorAccount">帳號</label>
                        <div class="form-notch">
                          <div class="form-notch-leading" style="width: 9px;"></div>
                          <div class="form-notch-middle" style="width: 114.4px;"></div>
                          <div class="form-notch-trailing"></div>
                        </div>
                      </div>
                      <div class="form-outline mb-4">
                        <input required type="text" name="password" id="DomitorySupervisorPassword"
                          class="form-control" />
                        <label class="form-label" for="DomitorySupervisorPassword">密碼</label>
                        <div class="form-notch">
                          <div class="form-notch-leading" style="width: 9px;"></div>
                          <div class="form-notch-middle" style="width: 114.4px;"></div>
                          <div class="form-notch-trailing"></div>
                        </div>
                      </div>
                      <div class="form-outline mb-4">
                        <input required type="text" name="name" id="DomitorySupervisorName" class="form-control" />
                        <label class="form-label" for="DomitorySupervisorName">姓名</label>
                        <div class="form-notch">
                          <div class="form-notch-leading" style="width: 9px;"></div>
                          <div class="form-notch-middle" style="width: 114.4px;"></div>
                          <div class="form-notch-trailing"></div>
                        </div>
                      </div>
                      <div class="form-outline mb-4">
                        <input required type="text" name="email" id="DomitorySupervisorEmail" class="form-control" />
                        <label class="form-label" for="DomitorySupervisorEmail">Email</label>
                        <div class="form-notch">
                          <div class="form-notch-leading" style="width: 9px;"></div>
                          <div class="form-notch-middle" style="width: 114.4px;"></div>
                          <div class="form-notch-trailing"></div>
                        </div>
                      </div>
                      <div class="form-outline mb-4">
                        <input required type="tel" name="phone" id="DomitorySupervisorPhone" class="form-control" />
                        <label class="form-label" for="DomitorySupervisorPhone">電話</label>
                        <div class="form-notch">
                          <div class="form-notch-leading" style="width: 9px;"></div>
                          <div class="form-notch-middle" style="width: 114.4px;"></div>
                          <div class="form-notch-trailing"></div>
                        </div>
                      </div>
                      <div class='mb-4'>
                        <select class="form-select" name='dormitory_id' required>
                          <option value="">宿舍大樓</option>
                          <?php
                          $sql = "SELECT * FROM Dormitory ORDER BY dormitory_id";
                          foreach ($conn->query($sql) as $row) { 
                            echo "<option value=$row[dormitory_id]>$row[name]</option>";
                          }?>
                        </select>
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
      </div>


      <!-- Domitory -->
      <div class="tab-pane fade h-100" id="pills-dormitory" role="tabpanel" aria-labelledby="tab-dormitory">

        <!--Title-->
        <div class="card m-2 px-4 py-3">
          <div class="d-flex justify-content-between">
            <h4 class="mb-0">宿舍大樓資料</h4>
            <button class='btn ms-2 btn-primary btn-sm' data-mdb-toggle='modal' data-mdb-target='#addDomitoryModal'><i
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
                      <th scope="col">名字</th>
                      <!-- <th scope="col">宿舍大樓ID</th> -->
                      <th scope="col">操作</th>
                    </tr>
                  </thead>
                  <tbody class="datatable-body">
                    <?php
                      $sql = "SELECT * FROM Dormitory";
                      $result = $conn->query($sql);

                      if (mysqli_num_rows($result) > 0) 
                      {
                        while ($userinfo = mysqli_fetch_assoc($result)) 
                        {
                          $name = $userinfo['name'];
                          $dormitory_id = $userinfo['dormitory_id'];
                          
                          echo "<tr>" .
                            "<td> " . $name . "</td>".
                            // "<td> " . $dormitory_id . "</td>".
                            "<td>
                              <button class='call-btn btn btn-outline-primary btn-floating btn-sm ripple-surface' data-mdb-toggle='modal' data-mdb-target='#updateDomitoryModal$dormitory_id'><i class='fa fa-pencil'></i></button>
                              <button class='message-btn btn ms-2 btn-primary btn-floating btn-sm' data-mdb-toggle='modal' data-mdb-target='#deleteDomitoryModal$dormitory_id'><i class='fa fa-trash'></i></button>
                            </td>".
                            "</tr>";

                          // Update Modal
                          echo "
                          <div class='modal fade' id='updateDomitoryModal$dormitory_id' tabindex='-1' aria-labelledby='updateDomitoryModalLabel' aria-hidden='true'>
                          <div class='modal-dialog modal-dialog-centered'>
                          <form method='post' action='./service/dormitory_update.php'>
                          <div class='modal-content'>
                              <div class='modal-header'>
                                <h5 class='modal-title' id='updateDomitoryModalLabel'>修改宿舍大樓</h5>
                                <button type='button' class='btn-close' data-mdb-dismiss='modal' aria-label='Close'></button>
                              </div>
                              <div class='modal-body'>
                                <div class='text-center mb-3'>
                                  <div class='form-outline mb-4'>
                                    <input value='$name' required type='text' name='name' id='DomitoryName' class='form-control' />
                                    <label class='form-label' for='DomitoryName'>姓名</label>
                                    <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                                  </div>
                                  <div class='form-outline mb-4'>
                                    <input value='$dormitory_id' readonly name='dormitory_id' id='DomitoryId' class='form-control' />
                                    <label class='form-label' for='DomitoryId'>姓名</label>
                                    <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
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

                          // Delete System Manager Modal
                          echo "
                          <div class='modal fade' id='deleteDomitoryModal$dormitory_id' tabindex='-1' aria-labelledby='deleteDomitoryModalLabel' aria-hidden='true'>
                            <div class='modal-dialog modal-dialog-centered'>
                              <div class='modal-content'>
                                <div class='modal-header'>
                                  <h5 class='modal-title' id='deleteDomitoryModalLabel'>刪除宿舍大樓</h5>
                                </div>
                                <div class='modal-body'>您確認要刪除宿舍大樓嗎？</div>
                                <div class='modal-footer'>
                                  <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
                                  <button type='button' class='btn btn-primary' onclick='location.href=\"./service/dormitory_delete.php?dormitory_id=$dormitory_id\"'>確認</button>
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
        <div class="modal fade" id="addDomitoryModal" tabindex="-1" aria-labelledby="addDomitoryModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addDomitoryModalLabel">新增宿舍大樓</h5>

              </div>
              <div class="modal-body">
                <form method="post" action="./service/dormitory_add.php">
                  <div class="modal-body">
                    <div class="text-center mb-3">
                      <div class="form-outline mb-4">
                        <input required type="text" name="name" id="dormitoryName" class="form-control" />
                        <label class="form-label" for="dormitoryName">名稱</label>
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
      </div>

      <!-- Room -->
      <div class="tab-pane fade h-100" id="pills-room" role="tabpanel" aria-labelledby="tab-room">

        <!--Title-->
        <div class="card m-2 px-4 py-3">
          <div class="d-flex justify-content-between">
            <h4 class="mb-0">宿舍房間資料</h4>
            <button class='btn ms-2 btn-primary btn-sm' data-mdb-toggle='modal' data-mdb-target='#addRoomModal'><i
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
                      <th scope="col">房號</th>
                      <th scope="col">住宿人數</th>
                      <th scope="col">價錢</th>
                      <th scope="col">宿舍大樓</th>
                      <th scope="col">操作</th>
                    </tr>
                  </thead>
                  <tbody class="datatable-body">
                    <?php
                      $sql = "SELECT * FROM Room JOIN Dormitory ON Dormitory.dormitory_id = Room.dormitory_id";
                      $result = $conn->query($sql);

                      if (mysqli_num_rows($result) > 0) 
                      {
                        while ($userinfo = mysqli_fetch_assoc($result)) 
                        {
                          $room_number = $userinfo['room_number'];
                          $num_of_people = $userinfo['num_of_people'];
                          $fee = $userinfo['fee'];
                          $dormitory_id = $userinfo['dormitory_id'];
                          $dormitory_name = $userinfo['name'];
                          
                          echo "<tr>" .
                            "<td> " . $room_number . "</td>".
                            "<td> " . $num_of_people . "</td>".
                            "<td> " . $fee . "</td>".
                            "<td> " . $dormitory_name . "</td>".
                            "<td>
                              <button class='call-btn btn btn-outline-primary btn-floating btn-sm ripple-surface' data-mdb-toggle='modal' data-mdb-target='#updateRoomModal$room_number'><i class='fa fa-pencil'></i></button>
                              <button class='message-btn btn ms-2 btn-primary btn-floating btn-sm' data-mdb-toggle='modal' data-mdb-target='#deleteRoomModal$room_number'><i class='fa fa-trash'></i></button>
                            </td>".
                            "</tr>";

                          // Update Modal
                          echo "
                          <div class='modal fade' id='updateRoomModal$room_number' tabindex='-1' aria-labelledby='updateRoomModalLabel' aria-hidden='true'>
                          <div class='modal-dialog modal-dialog-centered'>
                          <form method='post' action='./service/room_update.php'>
                          <div class='modal-content'>
                              <div class='modal-header'>
                                <h5 class='modal-title' id='updateRoomModalLabel'>修改宿舍房間</h5>
                                <button type='button' class='btn-close' data-mdb-dismiss='modal' aria-label='Close'></button>
                              </div>
                              <div class='modal-body'>
                                <div class='text-center mb-3'>
                                  <div class='form-outline mb-4'>
                                    <input value='$room_number' readonly type='text' name='room_number' id='RoomNumber' class='form-control' />
                                    <label class='form-label' for='RoomNumber'>房號</label>
                                    <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                                  </div>
                                  <div class='form-outline mb-4'>
                                    <input value='$num_of_people' required type='text' name='num_of_people' id='RoomNumber' class='form-control' />
                                    <label class='form-label' for='RoomNumber'>住宿人數</label>
                                    <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                                  </div>
                                  <div class='form-outline mb-4'>
                                    <input value='$fee' required type='text' name='fee' id='RoomNumber' class='form-control' />
                                    <label class='form-label' for='RoomNumber'>價錢</label>
                                    <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                                  </div>
                                  <div class='mb-4'>
                                    <select class='form-select' name='dormitory_id' aria-label='規範ID' required>
                                      <option value=''>宿舍大樓</option>";
                                      $sql = "SELECT * FROM Dormitory ORDER BY dormitory_id";
                                      foreach ($conn->query($sql) as $row) { 
                                        if($row['dormitory_id'] == $dormitory_id) echo "<option value=$row[dormitory_id] selected>$row[name]</option>";
                                        else echo "<option value=$row[dormitory_id]>$row[name]</option>";
                                      }
                              echo "</select>
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

                          // Delete Modal
                          echo "
                          <div class='modal fade' id='deleteRoomModal$room_number' tabindex='-1' aria-labelledby='deleteRoomModalLabel' aria-hidden='true'>
                            <div class='modal-dialog modal-dialog-centered'>
                              <div class='modal-content'>
                                <div class='modal-header'>
                                  <h5 class='modal-title' id='deleteRoomModalLabel'>刪除宿舍房間</h5>
                                </div>
                                <div class='modal-body'>您確認要刪除宿舍房間嗎？</div>
                                <div class='modal-footer'>
                                  <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
                                  <button type='button' class='btn btn-primary' onclick='location.href=\"./service/room_delete.php?room_number=$room_number\"'>確認</button>
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
        <div class="modal fade" id="addRoomModal" tabindex="-1" aria-labelledby="addRoomModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addRoomModalLabel">新增宿舍房間</h5>
              </div>
              <div class="modal-body">
                <form method="post" action="./service/room_add.php">
                  <div class="modal-body">
                    <div class="text-center mb-3">
                      <div class='form-outline mb-4'>
                        <input required type='text' name='room_number' id='RoomNumber' class='form-control' />
                        <label class='form-label' for='RoomNumber'>房號</label>
                        <div class='form-notch'>
                          <div class='form-notch-leading' style='width: 9px;'></div>
                          <div class='form-notch-middle' style='width: 114.4px;'></div>
                          <div class='form-notch-trailing'></div>
                        </div>
                      </div>
                      <div class='form-outline mb-4'>
                        <input required type='text' name='num_of_people' id='RoomNumber' class='form-control' />
                        <label class='form-label' for='RoomNumber'>住宿人數</label>
                        <div class='form-notch'>
                          <div class='form-notch-leading' style='width: 9px;'></div>
                          <div class='form-notch-middle' style='width: 114.4px;'></div>
                          <div class='form-notch-trailing'></div>
                        </div>
                      </div>
                      <div class='form-outline mb-4'>
                        <input required type='text' name='fee' id='RoomNumber' class='form-control' />
                        <label class='form-label' for='RoomNumber'>價錢</label>
                        <div class='form-notch'>
                          <div class='form-notch-leading' style='width: 9px;'></div>
                          <div class='form-notch-middle' style='width: 114.4px;'></div>
                          <div class='form-notch-trailing'></div>
                        </div>
                      </div>
                      <div class='mb-4'>
                        <select class="form-select" name='dormitory_id' aria-label="規範ID" required>
                          <option value="">宿舍大樓</option>
                          <?php
                          $sql = "SELECT * FROM Dormitory ORDER BY dormitory_id";
                          foreach ($conn->query($sql) as $row) { 
                            echo "<option value=$row[dormitory_id]>$row[name]</option>";
                          }?>
                        </select>
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
      </div>

      <!-- Equipment -->
      <div class="tab-pane fade h-100" id="pills-equipment" role="tabpanel" aria-labelledby="tab-equipment">

        <!--Title-->
        <div class="card m-2 px-4 py-3">
          <div class="d-flex justify-content-between">
            <h4 class="mb-0">宿舍設備資料</h4>
            <button class='btn ms-2 btn-primary btn-sm' data-mdb-toggle='modal' data-mdb-target='#addEquipmentModal'><i
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
                      <th scope="col">名稱</th>
                      <th scope="col">購買日期</th>
                      <th scope="col">使用年限</th>
                      <th scope="col">設備狀況</th>
                      <th scope="col">宿舍大樓</th>
                      <th scope="col">宿舍房間</th>
                      <th scope="col">登記帳號</th>
                      <th scope="col">操作</th>
                    </tr>
                  </thead>
                  <tbody class="datatable-body">
                    <?php
                      $sql = "SELECT *, Dormitory.name as 'dormitory_name' FROM Equipment 
                      JOIN Room ON Equipment.room_number = Room.room_number 
                      JOIN Dormitory ON Dormitory.dormitory_id = Room.dormitory_id 
                      ORDER BY Dormitory.dormitory_id, Room.room_number";
                      $result = $conn->query($sql);

                      if (mysqli_num_rows($result) > 0) 
                      {
                        while ($userinfo = mysqli_fetch_assoc($result)) 
                        {
                          $name = $userinfo['name'];
                          $purchase_date = $userinfo['purchase_date'];
                          $expired_year = $userinfo['expired_year'];
                          $equipment_id = $userinfo['equipment_id'];
                          $state = $userinfo['state'];
                          $room_number = $userinfo['room_number'];
                          $dormitory_name = $userinfo['dormitory_name'];
                          $account = $userinfo['account'];
                          
                          echo "<tr>" .
                            "<td> " . $name . "</td>".
                            "<td> " . $purchase_date . "</td>".
                            "<td> " . $expired_year . "</td>".
                            "<td> " . $state . "</td>".
                            "<td> " . $dormitory_name . "</td>".
                            "<td> " . $room_number . "</td>".
                            "<td> " . $account . "</td>".
                            "<td>
                              <button class='call-btn btn btn-outline-primary btn-floating btn-sm ripple-surface' data-mdb-toggle='modal' data-mdb-target='#updateEquipmentModal$equipment_id'><i class='fa fa-pencil'></i></button>
                              <button class='message-btn btn ms-2 btn-primary btn-floating btn-sm' data-mdb-toggle='modal' data-mdb-target='#deleteEquipmentModal$equipment_id'><i class='fa fa-trash'></i></button>
                            </td>".
                            "</tr>";

                          // Update Modal
                          echo "
                          <div class='modal fade' id='updateEquipmentModal$equipment_id' tabindex='-1' aria-labelledby='updateEquipmentModalLabel' aria-hidden='true'>
                          <div class='modal-dialog modal-dialog-centered'>
                          <form method='post' action='./service/equipment_update.php'>
                          <div class='modal-content'>
                              <div class='modal-header'>
                                <h5 class='modal-title' id='updateEquipmentModalLabel'>修改宿舍設備</h5>
                                <button type='button' class='btn-close' data-mdb-dismiss='modal' aria-label='Close'></button>
                              </div>
                              <div class='modal-body'>
                                <div class='text-center mb-3'>
                                  <div class='form-outline mb-4'>
                                    <input value='$name' required type='text' name='name' id='EquipmentName' class='form-control' />
                                    <label class='form-label' for='EquipmentName'>名稱</label>
                                    <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                                  </div>
                                  <div class='form-outline mb-4'>
                                    <input value='$expired_year' required type='text' name='expired_year' id='Equipmentexpired_year' class='form-control' />
                                    <label class='form-label' for='Equipmentexpired_year'>使用年限</label>
                                    <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                                  </div>
                                  <div class='form-outline mb-4'>
                                    <input value='$state' required type='text' name='state' id='Equipmentstate' class='form-control' />
                                    <label class='form-label' for='Equipmentstate'>設備狀態</label>
                                    <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                                  </div>
                                  <div class='mb-4'>
                                    <select class='form-select' name='room_number' aria-label='規範ID' required>
                                      <option value=''>房號</option>";
                                      $sql = "SELECT * FROM Room ORDER BY room_number";
                                      foreach ($conn->query($sql) as $row) { 
                                        if($row['room_number'] == $room_number) echo "<option value=$row[room_number] selected>$row[room_number]</option>";
                                        else echo "<option value=$row[room_number]>$row[room_number]</option>";
                                      }
                              echo "</select>
                                  </div>
                                  <input value='root' hidden name='account' />
                                  <input value='$equipment_id' hidden name='equipment_id' />
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

                          // Delete Modal
                          echo "
                          <div class='modal fade' id='deleteEquipmentModal$equipment_id' tabindex='-1' aria-labelledby='deleteEquipmentModalLabel' aria-hidden='true'>
                            <div class='modal-dialog modal-dialog-centered'>
                              <div class='modal-content'>
                                <div class='modal-header'>
                                  <h5 class='modal-title' id='deleteEquipmentModalLabel'>刪除宿舍設備</h5>
                                </div>
                                <div class='modal-body'>您確認要刪除宿舍設備嗎？</div>
                                <div class='modal-footer'>
                                  <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
                                  <button type='button' class='btn btn-primary' onclick='location.href=\"./service/equipment_delete.php?equipment_id=$equipment_id\"'>確認</button>
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
        <div class="modal fade" id="addEquipmentModal" tabindex="-1" aria-labelledby="addEquipmentModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addEquipmentModalLabel">新增宿舍設備</h5>
              </div>
              <div class="modal-body">
                <form method="post" action="./service/equipment_add.php">
                  <div class="modal-body">
                    <div class="text-center mb-3">
                      <div class='form-outline mb-4'>
                        <input required type='text' name='name' id='EquipmentName' class='form-control' />
                        <label class='form-label' for='EquipmentName'>名稱</label>
                        <div class='form-notch'>
                          <div class='form-notch-leading' style='width: 9px;'></div>
                          <div class='form-notch-middle' style='width: 114.4px;'></div>
                          <div class='form-notch-trailing'></div>
                        </div>
                      </div>
                      <div class='form-outline mb-4'>
                        <input required type='text' name='expired_year' id='Equipmentexpired_year'
                          class='form-control' />
                        <label class='form-label' for='Equipmentexpired_year'>使用年限</label>
                        <div class='form-notch'>
                          <div class='form-notch-leading' style='width: 9px;'></div>
                          <div class='form-notch-middle' style='width: 114.4px;'></div>
                          <div class='form-notch-trailing'></div>
                        </div>
                      </div>
                      <div class='form-outline mb-4'>
                        <input required type='text' name='state' id='Equipmentstate' class='form-control' />
                        <label class='form-label' for='Equipmentstate'>設備狀態</label>
                        <div class='form-notch'>
                          <div class='form-notch-leading' style='width: 9px;'></div>
                          <div class='form-notch-middle' style='width: 114.4px;'></div>
                          <div class='form-notch-trailing'></div>
                        </div>
                      </div>
                      <div class='mb-4'>
                        <select class="form-select" name='room_number' required>
                          <option value="">房號</option>
                          <?php
                          $sql = "SELECT * FROM Room ORDER BY room_number";
                          foreach ($conn->query($sql) as $row) { 
                            echo "<option value=$row[room_number]>$row[room_number]</option>";
                          }?>
                        </select>
                      </div>
                      <input value='root' hidden name='account' />
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
      </div>
      <!-- Rule -->
      <div class="tab-pane fade h-100" id="pills-rule" role="tabpanel" aria-labelledby="tab-rule">

        <!--Title-->
        <div class="card m-2 px-4 py-3">
          <div class="d-flex justify-content-between">
            <h4 class="mb-0">規範資料</h4>
            <button class='btn ms-2 btn-primary btn-sm' data-mdb-toggle='modal' data-mdb-target='#addRuleModal'><i
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
                      <th scope="col">內容</th>
                      <th scope="col">操作</th>
                    </tr>
                  </thead>
                  <tbody class="datatable-body">
                    <?php
                      $sql = "SELECT * FROM Rule";
                      $result = $conn->query($sql);

                      if (mysqli_num_rows($result) > 0) 
                      {
                        while ($userinfo = mysqli_fetch_assoc($result)) 
                        {
                          $content = $userinfo['content'];
                          $rule_id = $userinfo['rule_id'];
                          
                          echo "<tr>" .
                            "<td> " . $content . "</td>".
                            "<td>
                              <button class='call-btn btn btn-outline-primary btn-floating btn-sm ripple-surface' data-mdb-toggle='modal' data-mdb-target='#updateRuleModal$rule_id'><i class='fa fa-pencil'></i></button>
                              <button class='message-btn btn ms-2 btn-primary btn-floating btn-sm' data-mdb-toggle='modal' data-mdb-target='#deleteRuleModal$rule_id'><i class='fa fa-trash'></i></button>
                            </td>".
                            "</tr>";

                          // Update Modal
                          echo "
                          <div class='modal fade' id='updateRuleModal$rule_id' tabindex='-1' aria-labelledby='updateRuleModalLabel' aria-hidden='true'>
                          <div class='modal-dialog modal-dialog-centered'>
                          <form method='post' action='./service/rule_update.php'>
                          <div class='modal-content'>
                              <div class='modal-header'>
                                <h5 class='modal-title' id='updateRuleModalLabel'>修改規範</h5>
                                <button type='button' class='btn-close' data-mdb-dismiss='modal' aria-label='Close'></button>
                              </div>
                              <div class='modal-body'>
                                <div class='text-center mb-3'>
                                  <div class='form-outline mb-4'>
                                    <input value='$content' required type='text' name='content' id='RuleContent' class='form-control' />
                                    <label class='form-label' for='RuleContent'>內容</label>
                                    <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                                  </div>
                                  <input hidden value='$rule_id' readonly name='rule_id' class='form-control' />
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

                          // Delete System Manager Modal
                          echo "
                          <div class='modal fade' id='deleteRuleModal$rule_id' tabindex='-1' aria-labelledby='deleteRuleModalLabel' aria-hidden='true'>
                            <div class='modal-dialog modal-dialog-centered'>
                              <div class='modal-content'>
                                <div class='modal-header'>
                                  <h5 class='modal-title' id='deleteRuleModalLabel'>刪除規範</h5>
                                </div>
                                <div class='modal-body'>您確認要刪除規範嗎？</div>
                                <div class='modal-footer'>
                                  <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
                                  <button type='button' class='btn btn-primary' onclick='location.href=\"./service/rule_delete.php?rule_id=$rule_id\"'>確認</button>
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
        <div class="modal fade" id="addRuleModal" tabindex="-1" aria-labelledby="addRuleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addRuleModalLabel">新增規範</h5>

              </div>
              <div class="modal-body">
                <form method="post" action="./service/rule_add.php">
                  <div class="modal-body">
                    <div class="text-center mb-3">
                      <div class="form-outline mb-4">
                        <input required type="text" name="content" id="ruleContent" class="form-control" />
                        <label class="form-label" for="ruleContent">內容</label>
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
      </div>




      <!-- Live In -->
      <div class="tab-pane fade h-100" id="pills-live-in" role="tabpanel" aria-labelledby="tab-live-in">

        <!--Title-->
        <div class="card m-2 px-4 py-3">
          <div class="d-flex justify-content-between">
            <h4 class="mb-0">學生住宿資料</h4>
            <button class='btn ms-2 btn-primary btn-sm' data-mdb-toggle='modal' data-mdb-target='#addLiveInModal'><i
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
                      <th scope="col">學年</th>
                      <th scope="col">學期</th>
                      <th scope="col">學生帳號</th>
                      <th scope="col">房號</th>
                      <th scope="col">登記帳號</th>
                      <th scope="col">操作</th>
                    </tr>
                  </thead>
                  <tbody class="datatable-body">
                    <?php
                      $sql = "SELECT * FROM live_in ORDER BY academic_year DESC, semester DESC";
                      $result = $conn->query($sql);

                      if (mysqli_num_rows($result) > 0) 
                      {
                        while ($userinfo = mysqli_fetch_assoc($result)) 
                        {
                          $semester = $userinfo['semester'];
                          $academic_year = $userinfo['academic_year'];
                          $room_number = $userinfo['room_number'];
                          $student_account	 = $userinfo['student_account'];
                          $system_manager_account = $userinfo['system_manager_account'];
                          $account = $_SESSION['account'];
                          
                          echo "<tr>" .
                            "<td> " . $academic_year . "</td>".
                            "<td> " . $semester . "</td>".
                            "<td> " . $student_account	 . "</td>".
                            "<td> " . $room_number . "</td>".
                            "<td> " . $system_manager_account . "</td>".
                            "<td>
                              <button class='call-btn btn btn-outline-primary btn-floating btn-sm ripple-surface' data-mdb-toggle='modal' data-mdb-target='#updateLiveInModal$semester$academic_year$room_number$student_account'><i class='fa fa-pencil'></i></button>
                              <button class='message-btn btn ms-2 btn-primary btn-floating btn-sm' data-mdb-toggle='modal' data-mdb-target='#deleteLiveInModal$semester$academic_year$room_number$student_account'><i class='fa fa-trash'></i></button>
                            </td>".
                            "</tr>";

                          // Update Modal
                          echo "
                          <div class='modal fade' id='updateLiveInModal$semester$academic_year$room_number$student_account' tabindex='-1' aria-labelledby='updateLiveInModalLabel' aria-hidden='true'>
                            <div class='modal-dialog modal-dialog-centered'>
                            <form method='post' action='./service/live_in_update.php'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                  <h5 class='modal-title' id='updateLiveInModalLabel'>修改學生住宿</h5>
                                  <button type='button' class='btn-close' data-mdb-dismiss='modal' aria-label='Close'></button>
                                </div>
                                <div class='modal-body'>
                                  <div class='text-center mb-3'>
                                    <div class='form-outline mb-4'>
                                      <input value='$academic_year' readonly required type='text' name='academic_year' id='liveinacademic_year' class='form-control' />
                                      <label class='form-label' for='liveinacademic_year'>學年</label>
                                      <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                                    </div>
                                    <div class='form-outline mb-4'>
                                      <input value='$semester' readonly required type='text' name='semester' id='liveinsemester' class='form-control' />
                                      <label class='form-label' for='liveinsemester'>學期</label>
                                      <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                                    </div>
                                    
                                    <div class='form-outline mb-4'>
                                      <input value='$student_account' readonly required type='text' name='student_account' id='liveinstudent_account' class='form-control' />
                                      <label class='form-label' for='liveinstudent_account'>學生帳號</label>
                                      <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                                    </div>
                                    <div class='mb-4'>
                                      <select class='form-select' name='room_number' required>
                                        <option value=''>房號</option>";
                                        $sql = "SELECT * FROM Room ORDER BY room_number";
                                        foreach ($conn->query($sql) as $row) { 
                                          if($row['room_number'] == $room_number) echo "<option value=$row[room_number] selected>$row[room_number]</option>";
                                          else echo "<option value=$row[room_number]>$row[room_number]</option>";
                                        }
                                echo "</select>
                                    </div>
                                    <input value='$account' hidden required name='system_manager_account' />
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

                          // Delete Modal
                          echo "
                          <div class='modal fade' id='deleteLiveInModal$semester$academic_year$room_number$student_account' tabindex='-1' aria-labelledby='deleteLiveInModalLabel' aria-hidden='true'>
                            <div class='modal-dialog modal-dialog-centered'>
                              <div class='modal-content'>
                                <div class='modal-header'>
                                  <h5 class='modal-title' id='deleteLiveInModalLabel'>刪除學生住宿</h5>
                                </div>
                                <div class='modal-body'>您確認要刪除學生住宿嗎？</div>
                                <div class='modal-footer'>
                                  <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
                                  <button type='button' class='btn btn-primary' onclick='location.href=\"./service/live_in_delete.php?semester=$semester&academic_year=$academic_year&room_number=$room_number&student_account=$student_account\"'>確認</button>
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
        <div class="modal fade" id="addLiveInModal" tabindex="-1" aria-labelledby="addLiveInModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addLiveInModalLabel">新增學生住宿</h5>

              </div>
              <div class="modal-body">
                <form method="post" action="./service/live_in_add.php">
                  <div class="modal-body">
                    <div class='text-center mb-3'>
                      <div class='form-outline mb-4'>
                        <input required type='text' name='academic_year' id='liveinacademic_year'
                          class='form-control' />
                        <label class='form-label' for='liveinacademic_year'>學年</label>
                        <div class='form-notch'>
                          <div class='form-notch-leading' style='width: 9px;'></div>
                          <div class='form-notch-middle' style='width: 114.4px;'></div>
                          <div class='form-notch-trailing'></div>
                        </div>
                      </div>
                      <div class='form-outline mb-4'>
                        <input required type='text' name='semester' id='liveinsemester' class='form-control' />
                        <label class='form-label' for='liveinsemester'>學期</label>
                        <div class='form-notch'>
                          <div class='form-notch-leading' style='width: 9px;'></div>
                          <div class='form-notch-middle' style='width: 114.4px;'></div>
                          <div class='form-notch-trailing'></div>
                        </div>
                      </div>

                      <div class='form-outline mb-4'>
                        <input required type='text' name='student_account' id='liveinstudent_account'
                          class='form-control' />
                        <label class='form-label' for='liveinstudent_account'>學生帳號</label>
                        <div class='form-notch'>
                          <div class='form-notch-leading' style='width: 9px;'></div>
                          <div class='form-notch-middle' style='width: 114.4px;'></div>
                          <div class='form-notch-trailing'></div>
                        </div>
                      </div>
                      <div class='mb-4'>
                        <select class="form-select" name='room_number' required>
                          <option value="">房號</option>
                          <?php
                          $sql = "SELECT * FROM Room ORDER BY room_number";
                          foreach ($conn->query($sql) as $row) { 
                            echo "<option value=$row[room_number]>$row[room_number]</option>";
                          }?>
                        </select>
                      </div>
                      <input value='<?php echo $account?>' hidden required name='system_manager_account' />
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
      </div>






      <!-- Violate Record -->
      <div class="tab-pane fade h-100" id="pills-violate-record" role="tabpanel" aria-labelledby="tab-violate-record">

        <!--Title-->
        <div class="card m-2 px-4 py-3">
          <div class="d-flex justify-content-between">
            <h4 class="mb-0">學生違規紀錄資料</h4>
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
                      <th scope="col">日期</th>
                      <th scope="col">規範ID</th>
                      <th scope="col">規範內容</th>
                      <th scope="col">學生帳號</th>
                      <th scope="col">扣點</th>
                      <th scope="col">登記帳號</th>
                      <th scope='col'>操作</th>
                    </tr>
                  </thead>
                  <tbody class="datatable-body">
                    <?php
                      $sql = "SELECT * FROM Violate_Record JOIN Rule ON Violate_Record.rule_id = Rule.rule_id";
                    
                      $result = $conn->query($sql);

                      if (mysqli_num_rows($result) > 0) 
                      {
                        while ($userinfo = mysqli_fetch_assoc($result)) 
                        {
                          $date = $userinfo['date'];
                          $rule_id = $userinfo['rule_id'];
                          $content = $userinfo['content'];
                          $student_account = $userinfo['student_account'];
                          $point = $userinfo['point'];
                          $dormitory_supervisor_account = $userinfo['dormitory_supervisor_account'];
                          $account = $_SESSION['account'];
                          $violate_record_id = $userinfo['violate_record_id'];

                          echo "<tr>" .
                            "<td> " . $date . "</td>".
                            "<td> " . $rule_id . "</td>".
                            "<td> " . $content . "</td>".
                            "<td> " . $student_account . "</td>".
                            "<td> " . $point . "</td>".
                            "<td> " . $dormitory_supervisor_account . "</td>".
                            "<td>
                              <button class='call-btn btn btn-outline-primary btn-floating btn-sm ripple-surface' data-mdb-toggle='modal' data-mdb-target='#updateViolateRecordModal$violate_record_id'><i class='fa fa-pencil'></i></button>
                              <button class='message-btn btn ms-2 btn-primary btn-floating btn-sm' data-mdb-toggle='modal' data-mdb-target='#deleteViolateRecordModal$violate_record_id'><i class='fa fa-trash'></i></button>
                            </td>".
                          "</tr>";

                          // Update Modal
                          echo "
                          <div class='modal fade' id='updateViolateRecordModal$violate_record_id' tabindex='-1' aria-labelledby='updateViolateRecordModalLabel' aria-hidden='true'>
                            <div class='modal-dialog modal-dialog-centered'>
                            <form method='post' action='./service/violate_record_update.php'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                  <h5 class='modal-title' id='updateViolateRecordModalLabel'>修改學生違規紀錄</h5>
                                  <button type='button' class='btn-close' data-mdb-dismiss='modal' aria-label='Close'></button>
                                </div>
                                <div class='modal-body'>
                                  <div class='text-center mb-3'>
                                    <div class='mb-4'>
                                      <select class='form-select' name='rule_id' required>
                                        <option value=''>規範</option>";
                                        $sql = "SELECT * FROM Rule ORDER BY rule_id";
                                        foreach ($conn->query($sql) as $row) { 
                                          if($row['rule_id'] == $rule_id) echo "<option value=$row[rule_id] selected>$row[content]</option>";
                                          else echo "<option value=$row[rule_id]>$row[content]</option>";
                                        }
                                echo "</select>
                                    </div>
                                    <div class='form-outline mb-4'>
                                      <input value='$student_account' required name='student_account' id='studentaccount' class='form-control' />
                                      <label class='form-label' for='studentaccount'>學生帳號</label>
                                      <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                                    </div>
                                    <div class='form-outline mb-4'>
                                      <input value='$point' required name='point' id='point' class='form-control' />
                                      <label class='form-label' for='point'>扣點</label>
                                      <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                                    </div>
                                    <input value='$dormitory_supervisor_account'hidden name='dormitory_supervisor_account'/>
                                    <input value='$violate_record_id'hidden name='violate_record_id'/>
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

                          // Delete Modal
                          echo "
                          <div class='modal fade' id='deleteViolateRecordModal$violate_record_id' tabindex='-1' aria-labelledby='deleteViolateRecordModalLabel' aria-hidden='true'>
                            <div class='modal-dialog modal-dialog-centered'>
                              <div class='modal-content'>
                                <div class='modal-header'>
                                  <h5 class='modal-title' id='deleteViolateRecordModalLabel'>刪除學生違規紀錄</h5>
                                </div>
                                <div class='modal-body'>您確認要刪除學生違規紀錄嗎？</div>
                                <div class='modal-footer'>
                                  <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
                                  <button type='button' class='btn btn-primary' onclick='location.href=\"./service/violate_record_delete.php?violate_record_id=$violate_record_id\"'>確認</button>
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
      </div>

    </div>

  </main>

  <script>
    document.querySelectorAll('.form-outline').forEach((formOutline) => {
      new mdb.Input(formOutline).init();
    });

    if (location.hash === "#pills-student") {
      const triggerEl = document.querySelector('a[href="#pills-student"]');
      if (triggerEl) {
        let instance = mdb.Tab.getInstance(triggerEl)
        if (!instance) {
          instance = new mdb.Tab(triggerEl);
        }
        instance.show();
      }
    } else if (location.hash === "#pills-system-manager") {
      const triggerEl = document.querySelector('a[href="#pills-system-manager"]');
      if (triggerEl) {
        let instance = mdb.Tab.getInstance(triggerEl)
        if (!instance) {
          instance = new mdb.Tab(triggerEl);
        }
        instance.show();
      }
    } else if (location.hash === "#pills-dormitory-supervisor") {
      const triggerEl = document.querySelector('a[href="#pills-dormitory-supervisor"]');
      if (triggerEl) {
        let instance = mdb.Tab.getInstance(triggerEl)
        if (!instance) {
          instance = new mdb.Tab(triggerEl);
        }
        instance.show();
      }
    } else if (location.hash === "#pills-dormitory") {
      const triggerEl = document.querySelector('a[href="#pills-dormitory"]');
      if (triggerEl) {
        let instance = mdb.Tab.getInstance(triggerEl)
        if (!instance) {
          instance = new mdb.Tab(triggerEl);
        }
        instance.show();
      }
    } else if (location.hash === "#pills-room") {
      const triggerEl = document.querySelector('a[href="#pills-room"]');
      if (triggerEl) {
        let instance = mdb.Tab.getInstance(triggerEl)
        if (!instance) {
          instance = new mdb.Tab(triggerEl);
        }
        instance.show();
      }
    } else if (location.hash === "#pills-equipment") {
      const triggerEl = document.querySelector('a[href="#pills-equipment"]');
      if (triggerEl) {
        let instance = mdb.Tab.getInstance(triggerEl)
        if (!instance) {
          instance = new mdb.Tab(triggerEl);
        }
        instance.show();
      }
    } else if (location.hash === "#pills-live-in") {
      const triggerEl = document.querySelector('a[href="#pills-live-in"]');
      if (triggerEl) {
        let instance = mdb.Tab.getInstance(triggerEl)
        if (!instance) {
          instance = new mdb.Tab(triggerEl);
        }
        instance.show();
      }
    } else if (location.hash === "#pills-rule") {
      const triggerEl = document.querySelector('a[href="#pills-rule"]');
      if (triggerEl) {
        let instance = mdb.Tab.getInstance(triggerEl)
        if (!instance) {
          instance = new mdb.Tab(triggerEl);
        }
        instance.show();
      }
    } else if (location.hash === "#pills-violate-record") {
      const triggerEl = document.querySelector('a[href="#pills-violate-record"]');
      if (triggerEl) {
        let instance = mdb.Tab.getInstance(triggerEl)
        if (!instance) {
          instance = new mdb.Tab(triggerEl);
        }
        instance.show();
      }
    }
  </script>


  <style>
    html,
    body,
    .intro {
      height: 100%;
    }

    table td,
    table th {
      text-overflow: ellipsis;
      white-space: nowrap;
      overflow: hidden;
    }

    .card {
      border-radius: .5rem;
    }

    .mask-custom {
      background: rgba(24, 24, 16, .2);
      border-radius: 2em;
      backdrop-filter: blur(25px);
      border: 2px solid rgba(255, 255, 255, 0.05);
      background-clip: padding-box;
      box-shadow: 10px 10px 10px rgba(46, 54, 68, 0.03);
    }

    body {
      background-color: #fbfbfb;
    }

    @media (min-width: 800px) {
      main {
        padding-left: 280px;
      }
    }

    /* Sidebar */
    .sidebar {
      position: fixed;
      top: 0;
      bottom: 0;
      left: 0;
      padding: 58px 0 0;
      /* Height of navbar */
      box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
      width: 280px;
      z-index: 600;
    }

    @media (max-width: 800px) {
      .sidebar {
        width: 100%;
      }
    }

    .sidebar .active {
      border-radius: 5px;
      box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
    }

    .sidebar-sticky {
      position: relative;
      top: 0;
      height: calc(100vh - 48px);
      padding-top: 0.5rem;
      overflow-x: hidden;
      overflow-y: auto;
      /* Scrollable contents if viewport is shorter than content. */
    }

    #chat2 .form-control {
      border-color: transparent;
    }

    #chat2 .form-control:focus {
      border-color: transparent;
      box-shadow: inset 0px 0px 0px 1px transparent;
    }

    .divider:after,
    .divider:before {
      content: "";
      flex: 1;
      height: 1px;
      background: #eee;
    }
  </style>
</body>

</html>