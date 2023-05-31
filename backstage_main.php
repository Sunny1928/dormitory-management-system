<?php
  // session_start();
  // if (!isset($_SESSION["permission"]) || $_SESSION['permission']!="system_manager" || $_SESSION["account"] != "root"){
          
  //   Header("Location: ./backstage_index.php" , 301);
  //   die();
  // }		
  require_once('./service/connect_db.php');
  $genders = array("男", "女");
  $types = array("系統管理員", "舍監", "家長", "學生");
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
              <img src="./image/baby.jpg" alt="avatar" class="rounded-circle img-fluid mb-3 m-auto"
                style="max-width: 100px;">
            </div>
            <h4 class="text-center">
              <span style="white-space: nowrap;">Sunny</span>
            </h4>
            <p class="text-center">sunny@gmail</p>
          </div>
          <hr class="mb-0">
        </div>
        <div class="align-items-end list-group list-group-flush mx-3 mt-4">
          <a class="list-group-item list-group-item-action py-2 ripple active " id="tab-student" data-mdb-toggle="pill"
            href="#pills-student" role="tab" aria-controls="pills-student" aria-selected="true">
            <i class="fas fa-school pe-3"></i>使用者
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
            <h4 class="mb-0">使用者資料</h4>
            <button class='btn ms-2 btn-primary btn-sm' data-mdb-toggle='modal' data-mdb-target='#addStudentModal'><i
                class='fa fa-add me-1'></i>新增</button>
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
                      require_once('service/user_operation/user_crud.php');

                      $result = user_read_all($conn);

                      if (mysqli_num_rows($result) > 0) 
                      {
                        while ($userinfo = mysqli_fetch_assoc($result)) 
                        {
                          $name = $userinfo['name'];
                          $account = $userinfo['account'];
                          $password = $userinfo['password'];
                          $email = $userinfo['email'];
                          $phone = $userinfo['phone'];
                          $gender = $userinfo['gender'];
                          $type = $userinfo['type'];
                          
                          
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
                                    <input value='$name' required type='text' name='name' id='registerName' class='form-control' />
                                    <label class='form-label' for='registerName'>名稱</label>
                                    <div class='form-notch'>
                                      <div class='form-notch-leading' style='width: 9px;'></div>
                                      <div class='form-notch-middle' style='width: 114.4px;'></div>
                                      <div class='form-notch-trailing'></div>
                                    </div>
                                  </div>
                                  <div class='form-outline mb-4'>
                                    <input value='$account' readonly required type='text' name='account' id='registerAccount' class='form-control' />
                                    <label class='form-label' for='registerAccount'>使用者</label>
                                    <div class='form-notch'>
                                      <div class='form-notch-leading' style='width: 9px;'></div>
                                      <div class='form-notch-middle' style='width: 114.4px;'></div>
                                      <div class='form-notch-trailing'></div>
                                    </div>
                                  </div>
                                  <div class='form-outline mb-4'>
                                    <input value='$password' required type='text' name='name' id='registerName' class='form-control' />
                                    <label class='form-label' for='registerName'>密碼</label>
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

        <!-- Add Modal -->
        
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