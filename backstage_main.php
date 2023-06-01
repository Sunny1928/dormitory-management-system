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
          <a class="list-group-item list-group-item-action py-2 ripple active" id="tab-student" data-mdb-toggle="pill" href="#pills-student" role="tab" aria-controls="pills-student" aria-selected="true">
            <i class="fas fa-school pe-3"></i>使用者
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-dormitory" data-mdb-toggle="pill" href="#pills-dormitory" role="tab" aria-controls="pills-dormitory" aria-selected="false">
            <i class="fas fa-house-chimney pe-3"></i>宿舍大樓
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-room" data-mdb-toggle="pill" href="#pills-room" role="tab" aria-controls="pills-room" aria-selected="false">
            <i class="fas fa-door-open pe-3"></i>宿舍房間
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-equipment" data-mdb-toggle="pill" href="#pills-equipment" role="tab" aria-controls="pills-equipment" aria-selected="false">
            <i class="fas fa-door-open pe-3"></i>宿舍設備
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-rule" data-mdb-toggle="pill" href="#pills-rule" role="tab" aria-controls="pills-rule" aria-selected="false">
            <i class="fas fa-door-open pe-3"></i>宿舍規範
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-public-equipment" data-mdb-toggle="pill" href="#pills-public-equipment" role="tab" aria-controls="pills-public-equipment" aria-selected="false">
            <i class="fas fa-door-open pe-3"></i>公共設施 
          </a>
          
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-violated-record" data-mdb-toggle="pill" href="#pills-violated-record" role="tab" aria-controls="pills-violated-record" aria-selected="false">
            <i class="fas fa-door-open pe-3"></i>違規紀錄
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-entry-and-exit" data-mdb-toggle="pill" href="#pills-entry-and-exit" role="tab" aria-controls="pills-entry-and-exit" aria-selected="false">
            <i class="fas fa-door-open pe-3"></i>進出紀錄紀錄 
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-roll-call" data-mdb-toggle="pill" href="#pills-roll-call" role="tab" aria-controls="pills-roll-call" aria-selected="false">
            <i class="fas fa-door-open pe-3"></i>點名紀錄 
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-bill" data-mdb-toggle="pill" href="#pills-bill" role="tab" aria-controls="pills-bill" aria-selected="false">
            <i class="fas fa-door-open pe-3"></i>帳單紀錄 
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-access-card" data-mdb-toggle="pill" href="#pills-access-card" role="tab" aria-controls="pills-access-card" aria-selected="false">
            <i class="fas fa-door-open pe-3"></i>出入卡紀錄 
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
        <?php
          require("./views/user_table.php") 
        ?>
      </div>

      <!--dormitory-->
      <div class="tab-pane fade" id="pills-dormitory" role="tabpanel" aria-labelledby="tab-dormitory">
        <?php
          require("./views/dormitory_table.php")
        ?>
      </div>

      <!--room-->
      <div class="tab-pane fade" id="pills-room" role="tabpanel" aria-labelledby="tab-room">
        <?php
          require("./views/room_table.php")
        ?>
      </div>

      <!--equipment-->
      <div class="tab-pane fade" id="pills-equipment" role="tabpanel" aria-labelledby="tab-equipment">
        <?php
          //require("./views/equipment_table.php")
        ?>
      </div>

      <!--rule-->
      <div class="tab-pane fade" id="pills-rule" role="tabpanel" aria-labelledby="tab-rule">
        <?php
          require("./views/rule_table.php")
        ?>
      </div>

      <!--public equipment-->
      <div class="tab-pane fade" id="pills-public-equipment" role="tabpanel" aria-labelledby="tab-public-equipment">
        <?php
          require("./views/public_equipment_table.php")
        ?>
      </div>

      <!--violated record-->
      <div class="tab-pane fade" id="pills-violated-record" role="tabpanel" aria-labelledby="tab-violated-record">
        <?php
          require("./views/violated_record_table.php")
        ?>
      </div>

      <!--entry and exit-->
      <div class="tab-pane fade" id="pills-entry-and-exit" role="tabpanel" aria-labelledby="tab-entry-and-exit">
        <?php
          //require("./views/entry_and_exit_table.php")
        ?>
      </div>

      <!--roll call-->
      <div class="tab-pane fade" id="pills-roll-call" role="tabpanel" aria-labelledby="tab-roll-call">
        <?php
          //require("./views/roll_call_table.php")
        ?>
      </div>

      <!--bill-->
      <div class="tab-pane fade" id="pills-bill" role="tabpanel" aria-labelledby="tab-bill">
        <?php
          require("./views/bill_table.php")
        ?>
      </div>

      <!--access card-->
      <div class="tab-pane fade" id="pills-access-card" role="tabpanel" aria-labelledby="tab-access-card">
        <?php
          //require("./views/access_card_table.php")
        ?>
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
    } else if (location.hash === "#pills-rule") {
      const triggerEl = document.querySelector('a[href="#pills-rule"]');
      if (triggerEl) {
        let instance = mdb.Tab.getInstance(triggerEl)
        if (!instance) {
          instance = new mdb.Tab(triggerEl);
        }
        instance.show();
      }      
    } else if (location.hash === "#pills-public-equipment") {
      const triggerEl = document.querySelector('a[href="#pills-public-equipment"]');
      if (triggerEl) {
        let instance = mdb.Tab.getInstance(triggerEl)
        if (!instance) {
          instance = new mdb.Tab(triggerEl);
        }
        instance.show();
      }
    } else if (location.hash === "#pills-violated-record") {
      const triggerEl = document.querySelector('a[href="#pills-violated-record"]');
      if (triggerEl) {
        let instance = mdb.Tab.getInstance(triggerEl)
        if (!instance) {
          instance = new mdb.Tab(triggerEl);
        }
        instance.show();
      }
    } else if (location.hash === "#pills-entry-and-exit") {
      const triggerEl = document.querySelector('a[href="#pills-entry-and-exit"]');
      if (triggerEl) {
        let instance = mdb.Tab.getInstance(triggerEl)
        if (!instance) {
          instance = new mdb.Tab(triggerEl);
        }
        instance.show();
      }
    } else if (location.hash === "#pills-roll-call") {
      const triggerEl = document.querySelector('a[href="#pills-roll-call"]');
      if (triggerEl) {
        let instance = mdb.Tab.getInstance(triggerEl)
        if (!instance) {
          instance = new mdb.Tab(triggerEl);
        }
        instance.show();
      }
    } else if (location.hash === "#pills-bill") {
      const triggerEl = document.querySelector('a[href="#pills-bill"]');
      if (triggerEl) {
        let instance = mdb.Tab.getInstance(triggerEl)
        if (!instance) {
          instance = new mdb.Tab(triggerEl);
        }
        instance.show();
      }
    } else if (location.hash === "#pills-access-card") {
      const triggerEl = document.querySelector('a[href="#pills-access-card"]');
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