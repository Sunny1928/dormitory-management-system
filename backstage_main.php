<?php
  // session_start();
  // if (!isset($_SESSION["permission"]) || $_SESSION['permission']!="system_manager" || $_SESSION["account"] != "root"){
          
  //   Header("Location: ./backstage_index.php" , 301);
  //   die();
  // }		

  require_once('./service/mainpage_require_all.php');

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
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" data-purpose="Layout StyleSheet" title="Web Awesome" href="/css/app-wa-5457803….css?vsn=d">
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/all.css">
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/sharp-solid.css">
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/sharp-light.css">
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/sharp-regular.css">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"></script>
  <title>Database Final Project</title>
</head>

<body>
  <!-- Sidebar -->
  <header>
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white p-0">
      <div class="sidebar-sticky position-sticky ">
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
          <a class="list-group-item list-group-item-action py-2 ripple active" id="tab-system-admin" data-mdb-toggle="pill" href="#pills-system-admin" role="tab" aria-controls="pills-system-admin" aria-selected="true">
            <i class="fas fa-user-gear pe-3"></i>系統管理員
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-dorm-manager" data-mdb-toggle="pill" href="#pills-dorm-manager" role="tab" aria-controls="pills-dorm-manager" aria-selected="true">
            <i class="fas fa-house-person-return pe-3"></i>宿舍管理員
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-parents" data-mdb-toggle="pill" href="#pills-parents" role="tab" aria-controls="pills-parents" aria-selected="true">
            <i class="fas fa-people-simple pe-3"></i>家長
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-student" data-mdb-toggle="pill" href="#pills-student" role="tab" aria-controls="pills-student" aria-selected="true">
            <i class="fas fa-user-graduate pe-3"></i>學生
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-border" data-mdb-toggle="pill" href="#pills-border" role="tab" aria-controls="pills-border" aria-selected="true">
            <i class="fas fa-person-shelter pe-3"></i>住宿生
          </a>
          <!-- <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-story-manager" data-mdb-toggle="pill" href="#pills-story-manager" role="tab" aria-controls="pills-story-manager" aria-selected="true">
            <i class="fas fa-school pe-3"></i>樓長
          </a> -->

          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-dormitory" data-mdb-toggle="pill" href="#pills-dormitory" role="tab" aria-controls="pills-dormitory" aria-selected="false">
            <i class="fas fa-house-chimney pe-3"></i>宿舍大樓
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-room" data-mdb-toggle="pill" href="#pills-room" role="tab" aria-controls="pills-room" aria-selected="false">
            <i class="fas fa-door-open pe-3"></i>宿舍房間
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-equipment" data-mdb-toggle="pill" href="#pills-equipment" role="tab" aria-controls="pills-equipment" aria-selected="false">
            <i class="fas fa-bed pe-3"></i>宿舍設備
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-rule" data-mdb-toggle="pill" href="#pills-rule" role="tab" aria-controls="pills-rule" aria-selected="false">
            <i class="fas fa-scroll pe-3"></i>宿舍規範
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-public-equipment" data-mdb-toggle="pill" href="#pills-public-equipment" role="tab" aria-controls="pills-public-equipment" aria-selected="false">
            <i class="fas fa-washing-machine pe-3"></i>公共設施 
          </a>
          
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-violated-record" data-mdb-toggle="pill" href="#pills-violated-record" role="tab" aria-controls="pills-violated-record" aria-selected="false">
            <i class="fas fa-book pe-3"></i>違規紀錄
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-entry-and-exit" data-mdb-toggle="pill" href="#pills-entry-and-exit" role="tab" aria-controls="pills-entry-and-exit" aria-selected="false">
            <i class="fas fa-note pe-3"></i>進出紀錄
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-roll-call" data-mdb-toggle="pill" href="#pills-roll-call" role="tab" aria-controls="pills-roll-call" aria-selected="false">
            <i class="fas fa-clipboard-list-check pe-3"></i>點名紀錄 
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-bill" data-mdb-toggle="pill" href="#pills-bill" role="tab" aria-controls="pills-bill" aria-selected="false">
            <i class="fas fa-money-bills pe-3"></i>帳單紀錄 
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-access-card" data-mdb-toggle="pill" href="#pills-access-card" role="tab" aria-controls="pills-access-card" aria-selected="false">
            <i class="fas fa-address-card pe-3"></i>出入卡紀錄 
          </a>
          
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-announcement" data-mdb-toggle="pill" href="#pills-announcement" role="tab" aria-controls="pills-announcement" aria-selected="false">
            <i class="fas fa-volume-low pe-3"></i>公告 
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-message" data-mdb-toggle="pill" href="#pills-message" role="tab" aria-controls="pills-message" aria-selected="false">
            <i class="fas fa-comment pe-3"></i>訊息 
          </a>

          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-apply-dorm" data-mdb-toggle="pill" href="#pills-apply-dorm" role="tab" aria-controls="pills-apply-dorm" aria-selected="false">
            <i class="fas fa-building-circle-check pe-3"></i>申請住宿 
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-parking-permit" data-mdb-toggle="pill" href="#pills-parking-permit" role="tab" aria-controls="pills-parking-permit" aria-selected="false">
            <i class="fas fa-car pe-3"></i>停車許可
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

    <!--system admin-->
      <div class="tab-pane fade show active" id="pills-system-admin" role="tabpanel" aria-labelledby="tab-system-admin">
        <?php
          require("./views/system_admin_table.php") 
        ?>
      </div>

      <!--dorm manager-->
      <div class="tab-pane fade" id="pills-dorm-manager" role="tabpanel" aria-labelledby="tab-dorm-manager">
        <?php
          require("./views/dorm_manager_table.php") 
        ?>
      </div>

      <!--parents-->
      <div class="tab-pane fade" id="pills-parents" role="tabpanel" aria-labelledby="tab-parents">
        <?php
          require("./views/parents_table.php") 
        ?>
      </div>

      <!--student-->
      <div class="tab-pane fade" id="pills-student" role="tabpanel" aria-labelledby="tab-student">
        <?php
          require("./views/student_table.php") 
        ?>
      </div>

      <!--border-->
      <div class="tab-pane fade" id="pills-border" role="tabpanel" aria-labelledby="tab-border">
        <?php
          require("./views/border_table.php") 
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
          require("./views/equipment_table.php")
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

      <!--announcement-->
      <div class="tab-pane fade" id="pills-announcement" role="tabpanel" aria-labelledby="tab-announcement">
        <?php
          require("./views/announcement_table.php")
        ?>
      </div>

      <!--message-->
      <div class="tab-pane fade" id="pills-message" role="tabpanel" aria-labelledby="tab-message">
        <?php
          require("./views/message_table.php")
        ?>
      </div> 

      <!--apply dorm-->
      <div class="tab-pane fade" id="pills-apply-dorm" role="tabpanel" aria-labelledby="tab-apply-dorm">
        <?php
          require("./views/apply_dorm_table.php")
        ?>
      </div> 

      <!--parking permit-->
      <div class="tab-pane fade" id="pills-parking-permit" role="tabpanel" aria-labelledby="tab-parking-permit">
        <?php
          require("./views/parking_permit_table.php")
        ?>
      </div> 

    </div>

  </main>

  <script>
    document.querySelectorAll('.form-outline').forEach((formOutline) => {
      new mdb.Input(formOutline).init();
    });

    if (location.hash === "#pills-system-admin") {
      const triggerEl = document.querySelector('a[href="#pills-system-admin"]');
      if (triggerEl) {
        let instance = mdb.Tab.getInstance(triggerEl)
        if (!instance) {
          instance = new mdb.Tab(triggerEl);
        }
        instance.show();
      }
    } else if (location.hash === "#pills-dorm-manager") {
      const triggerEl = document.querySelector('a[href="#pills-dorm-manager"]');
      if (triggerEl) {
        let instance = mdb.Tab.getInstance(triggerEl)
        if (!instance) {
          instance = new mdb.Tab(triggerEl);
        }
        instance.show();
      }
    } else if (location.hash === "#pills-parents") {
      const triggerEl = document.querySelector('a[href="#pills-parents"]');
      if (triggerEl) {
        let instance = mdb.Tab.getInstance(triggerEl)
        if (!instance) {
          instance = new mdb.Tab(triggerEl);
        }
        instance.show();
      }
    } else if (location.hash === "#pills-student") {
      const triggerEl = document.querySelector('a[href="#pills-student"]');
      if (triggerEl) {
        let instance = mdb.Tab.getInstance(triggerEl)
        if (!instance) {
          instance = new mdb.Tab(triggerEl);
        }
        instance.show();
      }
    } else if (location.hash === "#pills-border") {
      const triggerEl = document.querySelector('a[href="#pills-border"]');
      if (triggerEl) {
        let instance = mdb.Tab.getInstance(triggerEl)
        if (!instance) {
          instance = new mdb.Tab(triggerEl);
        }
        instance.show();
      }
    } else if (location.hash === "#pills-story-manager") {
      const triggerEl = document.querySelector('a[href="#pills-story-manager"]');
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
    } else if (location.hash === "#pills-announcement") {
      const triggerEl = document.querySelector('a[href="#pills-announcement"]');
      if (triggerEl) {
        let instance = mdb.Tab.getInstance(triggerEl)
        if (!instance) {
          instance = new mdb.Tab(triggerEl);
        }
        instance.show();
      }
    } else if (location.hash === "#pills-message") {
      const triggerEl = document.querySelector('a[href="#pills-message"]');
      if (triggerEl) {
        let instance = mdb.Tab.getInstance(triggerEl)
        if (!instance) {
          instance = new mdb.Tab(triggerEl);
        }
        instance.show();
      }
    } else if (location.hash === "#pills-apply-dorm") {
      const triggerEl = document.querySelector('a[href="#pills-apply-dorm"]');
      if (triggerEl) {
        let instance = mdb.Tab.getInstance(triggerEl)
        if (!instance) {
          instance = new mdb.Tab(triggerEl);
        }
        instance.show();
      }
    } else if (location.hash === "#pills-parking-permit") {
      const triggerEl = document.querySelector('a[href="#pills-parking-permit"]');
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