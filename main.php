<?php
  require_once('./service/mainpage_require_all.php');
	session_start();
  if (!isset($_SESSION["permission"]) || $_SESSION["permission"] == "Error"){
		Header("Location: ./login.php" , 301);
		die();
	}		
  $genders = array("男", "女");
  $types = array("系統管理員", "舍監", "家長", "學生");
  $apply_fix_states = array("未申請報修", "申請報修", "通過", "未通過");
  $apply_dorm_states = array("申請等待核准", "通過", "沒通過");
  $apply_cancel_states = array("未申請", "已申請", "通過", "未通過");
  $access_card_states = array("審核中", "通過","未通過");
  $border_types = array("住宿生", "無效", "學一男OA樓長", "學一女OB樓長", "學二男OE樓長", "學二女OF樓長");
  $border_apply_story_manager_states = array("未申請", "已申請");
  $quit_dorm_states = array("審核中","通過","未通過");
  $change_dorm_states = array("等待換宿對象審核","等待系統管理員審核","通過","未通過");
  $bill_types = array("住宿費", "電費", "水費", "網路費", "修繕費");
  $bill_states = array("未繳費", "已繳費");
  $state_classes = array("text-warning", "text-success", "text-danger");
  $state_classes_defaults = array("","text-warning", "text-success", "text-danger");
  $state_classes_clean = array("text-danger", "text-success");
  $roll_call_states = array("缺席", "出席");
  $entry_exit_states = array("進", "出");
  $parking_permit_states = array("審核中", "通過", "未通過");
  $clean_states = array("未整理", "整理完");
  $years = array(108,107,109,110,111,112);
  $default_year = 110;

  user_reload_session($conn , $_SESSION['account'], $default_year);

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
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" data-purpose="Layout StyleSheet" title="Web Awesome" href="/css/app-wa-5457803….css?vsn=d">
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/all.css">
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/sharp-solid.css">
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/sharp-light.css">
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/sharp-regular.css">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"></script>
  <script
  src="https://code.jquery.com/jquery-3.7.0.js"
  integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
  crossorigin="anonymous"></script>
  <title>Database Final Project</title>
</head>

<body>
  <?php

    if($_SESSION['account'] == 'root'){
      require('./backstage_main.php');

    } else if($_SESSION['permission'] == 0){
      require('./system_admin_main.php');

    } else if($_SESSION['permission'] == 1){
      require('./dorm_manager_main.php');

    } else if($_SESSION['permission'] == 2){
      require('./parent_main.php');

    } else if($_SESSION['permission'] == 3){
      require('./border_main.php');

    } else if($_SESSION['permission'] == 4){
      require('./border_main.php');

    } else if($_SESSION['permission'] == 5){
      require('./border_main.php');

    } 
  
  ?>

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
  <script>

    function searchFunction(input, table, index) {
      // Declare variables
      var filter, tr, td, i, txtValue;
      filter = document.getElementById(input).value.toUpperCase();
      tr = document.getElementById(table).getElementsByTagName("tr");

      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[index];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }

    function modifyState(where) {
      stateObj={}
      console.log(window.location.hostname+window.location.pathname)
      window.history.replaceState(stateObj,where, '#'+where);
    }

    function table_filter(idFilter, idTable, index) {
      var filter, tr, td, i;
      filter = document.getElementById(idFilter).value;
      tr = document.getElementById(idTable).getElementsByTagName("tr");
      // console.log(filter)
      // console.log("jijji")
      for (i = 1; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[index].innerText;
      // console.log(td)

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

    var idleTime;
    $(document).ready(function () {
            reloadPage();
            $('html').bind('mousemove click mouseup mousedown keydown keypress keyup submit change mouseenter scroll resize dblclick', function () {
                clearTimeout(idleTime);
                reloadPage();
            });
    });
    function reloadPage() {
        clearTimeout(idleTime);
        idleTime = setTimeout(function () {
            location.reload();
        }, 10000);
    }
  </script>
</body>

</html>

