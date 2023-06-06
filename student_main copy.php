<?php
  require_once('./service/mainpage_require_all.php');
	session_start();
  if (!isset($_SESSION["permission"])){
		Header("Location: ./index.php" , 301);
		die();
	}		
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.css" rel="stylesheet" />
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
              <img src="./image/baby.jpg"
                alt="avatar" class="rounded-circle img-fluid mb-3 m-auto" style="max-width: 100px;">
            </div>
            <h4 class="text-center">
              <span style="white-space: nowrap;"><?php echo $_SESSION['name']?></span>
            </h4>
            <p class="text-center"><?php echo $_SESSION['email']?></p>
          </div>
          <hr class="mb-0">
        </div>
        <div class="list-group list-group-flush mx-3 mt-4">
          <a class="list-group-item list-group-item-action py-2 ripple pb-2 active" id="tab-dashboard" data-mdb-toggle="pill" href="#pills-dashboard" role="tab" aria-controls="pills-dashboard" aria-selected="true">
            <i class="fas fa-house pe-3"></i>主畫面
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-announcement" data-mdb-toggle="pill" href="#pills-announcement" role="tab" aria-controls="pills-announcement" aria-selected="false">
            <i class="fas fa-envelope pe-3"></i>公告
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-message" data-mdb-toggle="pill" href="#pills-message" role="tab" aria-controls="pills-message" aria-selected="false">
            <i class="fas fa-comment pe-3"></i>留言板
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-violate-record" data-mdb-toggle="pill" href="#pills-violate-record" role="tab" aria-controls="pills-violate-record" aria-selected="false">
            <i class="fas fa-book pe-3"></i>違規紀錄
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-all" data-mdb-toggle="pill" href="#pills-all" role="tab" aria-controls="pills-all" aria-selected="false">
            <i class="fas fa-house-chimney pe-3"></i>宿舍資料
          </a>
        </div>
        <div class="list-group list-group-flush mx-3">
          <a href="./index.php" class="list-group-item py-2 ripple pb-2">
            <i class="fas fa-right-from-bracket pe-3"></i>登出
          </a>
        </div>
        <div class=" text-center text-reset mt-5">
          <em><small>Copyright © 2023 - PYSY</small></em>
        </div>
    </nav>
  </header>

  <!--Main layout-->
  <main>
  <?php
        echo $_SESSION['account'].' ';
        echo $_SESSION['permission'].' ';
        echo $_SESSION['email'].' ';
        echo $_SESSION['phone'].' ';
        echo $_SESSION['gender'].' ';
        echo $_SESSION['department'].' ';
        echo $_SESSION['student_account'].' ';
        echo $_SESSION['dormitory_id'].' ';
        echo $_SESSION['room_number'].' ';
        ?>
    <div class="tab-content" style="max-height: 100vh;">
    
      <!--announcement-->
      <div class="tab-pane fade" id="pills-announcement" role="tabpanel" aria-labelledby="tab-announcement">
        <?php
          require("./components/announcementComponent.php")
        ?>
      </div>

      <!--message-->
      <div class="tab-pane fade" id="pills-message" role="tabpanel" aria-labelledby="tab-message">
        <?php
          require("./components/messageComponent.php")
        ?>
      </div>

    </div>
  </main>

  <script>
    document.querySelectorAll('.form-outline').forEach((formOutline) => {
      new mdb.Input(formOutline).init();
    });

    if (location.hash === "#pills-announcement") {
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
    } else if (location.hash === "#pills-violate-record") {
      const triggerEl = document.querySelector('a[href="#pills-violate-record"]');
      if (triggerEl) {
        let instance = mdb.Tab.getInstance(triggerEl)
        if (!instance) {
          instance = new mdb.Tab(triggerEl);
        }
        instance.show();
      }
    } else if (location.hash === "#pills-all") {
      const triggerEl = document.querySelector('a[href="#pills-all"]');
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


    .c-stepper__item:before {
      --size: 3rem;
      content: "";
      position: relative;
      z-index: 1;
      flex: 0 0 var(--size);
      height: var(--size);
      border-radius: 50%;
      background-color: lightgrey;
    }

    .c-stepper__item {
      position: relative;
      display: flex;
      gap: 1rem;
      padding-bottom: 1rem;
    }

    .c-stepper__item_a:before {
      --size: 3rem;
      content: "";
      position: relative;
      z-index: 1;
      flex: 0 0 var(--size);
      height: var(--size);
      border-radius: 50%;
      background-color: #3B71CA;
    }

    .c-stepper__item_a {
      position: relative;
      display: flex;
      gap: 1rem;
      padding-bottom: 1rem;
    }

    dl,
    ol,
    ul {
      margin-top: 0;
      margin-bottom: 0rem;
      margin-top: 2rem;
      padding-left: 2rem;
      padding-right: 2rem;
    }

    .c-stepper {
      --size: 3rem;
      --spacing: 0.5rem;
    }

    .c-stepper__item:not(:last-child):after {
      top: calc(var(--size) + var(--spacing));
      transform: translateX(calc(var(--size) / 2));
      bottom: var(--spacing);
      content: "";
      position: absolute;
      left: 0;
      top: 0;
      bottom: 0;
      transform: translateX(1.5rem);
      width: 2px;
      background-color: #e0e0e0;
    }

    .c-stepper__item_a:not(:last-child):after {
      top: calc(var(--size) + var(--spacing));
      transform: translateX(calc(var(--size) / 2));
      bottom: var(--spacing);
      content: "";
      position: absolute;
      left: 0;
      top: 0;
      bottom: 0;
      transform: translateX(1.5rem);
      width: 2px;
      background-color: #e0e0e0;
    }
  </style>
</body>

</html>

