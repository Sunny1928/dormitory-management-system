<!-- Sidebar -->
<header>
  <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white p-0">
    <div class="sidebar-sticky position-sticky">
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
        <a class="list-group-item list-group-item-action py-2 ripple pb-2 active" id="tab-main" data-mdb-toggle="pill" href="#pills-main" role="tab" aria-controls="pills-main" aria-selected="true">
          <i class="fas fa-house pe-3"></i>主畫面
        </a>
        <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-announcement" data-mdb-toggle="pill" href="#pills-announcement" role="tab" aria-controls="pills-announcement" aria-selected="false">
          <i class="fas fa-envelope pe-3"></i>公告
        </a>
        <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-message" data-mdb-toggle="pill" href="#pills-message" role="tab" aria-controls="pills-message" aria-selected="false">
          <i class="fas fa-comment pe-3"></i>留言板
        </a>
        <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-apply-dorm" data-mdb-toggle="pill" href="#pills-apply-dorm" role="tab" aria-controls="pills-apply-dorm" aria-selected="false">
          <i class="fas fa-building-circle-check pe-3"></i>申請住宿
        </a>
        <?php
          // border
          if($_SESSION['permission']== 4 || $_SESSION['permission']== 5){
            echo "
            <a class='list-group-item list-group-item-action py-2 ripple pb-2' id='tab-quit-dorm' data-mdb-toggle='pill' href='#pills-quit-dorm' role='tab' aria-controls='pills-quit-dorm' aria-selected='false'>
              <i class='fas fa-building-circle-xmark pe-3'></i>申請退宿
            </a>
            <a class='list-group-item list-group-item-action py-2 ripple pb-2' id='tab-change-dorm' data-mdb-toggle='pill' href='#pills-change-dorm' role='tab' aria-controls='pills-change-dorm' aria-selected='false'>
              <i class='fas fa-building-circle-arrow-right pe-3'></i>申請換宿
            </a>
            <a class='list-group-item list-group-item-action py-2 ripple pb-2' id='tab-roommate' data-mdb-toggle='pill' href='#pills-roommate' role='tab' aria-controls='pills-roommate' aria-selected='false'>
              <i class='fas fa-door-open pe-3'></i>室友
            </a>
            <a class='list-group-item list-group-item-action py-2 ripple pb-2' id='tab-equipment' data-mdb-toggle='pill' href='#pills-equipment' role='tab' aria-controls='pills-equipment' aria-selected='false'>
              <i class='fas fa-bed pe-3'></i>宿舍設備
            </a>
            <a class='list-group-item list-group-item-action py-2 ripple pb-2' id='tab-public-equipment' data-mdb-toggle='pill' href='#pills-public-equipment' role='tab' aria-controls='pills-public-equipment' aria-selected='false'>
              <i class='fas fa-washing-machine pe-3'></i>公共設施 
            </a>
            ";
          }
        ?>
        

        
        <a class='list-group-item list-group-item-action py-2 ripple pb-2' id='tab-rule' data-mdb-toggle='pill' href='#pills-rule' role='tab' aria-controls='pills-rule' aria-selected='false'>
          <i class='fas fa-scroll pe-3'></i>宿舍規範
        </a>
        <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-violated-record" data-mdb-toggle="pill" href="#pills-violated-record" role="tab" aria-controls="pills-violated-record" aria-selected="false">
          <i class="fas fa-book pe-3"></i>違規紀錄
        </a>
        <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-bill" data-mdb-toggle="pill" href="#pills-bill" role="tab" aria-controls="pills-bill" aria-selected="false">
          <i class="fas fa-money-bills pe-3"></i>帳單紀錄 
        </a>
        <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-roll-call" data-mdb-toggle="pill" href="#pills-roll-call" role="tab" aria-controls="pills-roll-call" aria-selected="false">
          <i class="fas fa-clipboard-list-check pe-3"></i>點名紀錄 
        </a>
        <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-access-card" data-mdb-toggle="pill" href="#pills-access-card" role="tab" aria-controls="pills-access-card" aria-selected="false">
          <i class="fas fa-address-card pe-3"></i>通行證紀錄 
        </a>
        <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-entry-and-exit" data-mdb-toggle="pill" href="#pills-entry-and-exit" role="tab" aria-controls="pills-entry-and-exit" aria-selected="false">
          <i class="fas fa-note pe-3"></i>進出紀錄
        </a>
        

        <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-help" data-mdb-toggle="pill" href="#pills-help" role="tab" aria-controls="pills-help" aria-selected="false">
          <i class="fas fa-square-info pe-3"></i>協助
        </a>
      </div>
      <div class="list-group list-group-flush mx-3">
        <a href="./index.php" class="list-group-item py-2 ripple pb-2">
          <i class="fas fa-right-from-bracket pe-3"></i>登出
        </a>
      </div>
      <div class=" text-center text-reset mt-5">
        <em><small>Copyright © 2023 </small></em>
      </div>
  </nav>
</header>

<!--Main layout-->
<main>

  <div class="tab-content" style="max-height: 100vh;">

    <?php
    if($_SESSION['permission']== 5){
      require("./components/checkRollCallQRCode.php");
    }
    ?>



    <!--main-->
    <div class="tab-pane fade show active" id="pills-main" role="tabpanel" aria-labelledby="tab-main">
      <?php
        require("./components/infoComponent.php");
      

      if($_SESSION['permission']== 4 || $_SESSION['permission']== 5){
        require("./components/rollCallComponent.php");
        require("./components/applyStoryManagerComponent.php");
      }
      ?>

    </div>
  
    <!--announcement-->
    <div class="tab-pane fade" id="pills-announcement" role="tabpanel" aria-labelledby="tab-announcement">
      <?php
        require("./components/announcementComponent.php");
      ?>
    </div>

    <!--message-->
    <div class="tab-pane fade" id="pills-message" role="tabpanel" aria-labelledby="tab-message">
      <?php
        require("./components/messageComponent.php");
      ?>
    </div>

    <!--apply live dorm-->
    <div class="tab-pane fade" id="pills-apply-dorm" role="tabpanel" aria-labelledby="tab-apply-dorm"> 
      <?php
        require("./components/applyLiveDormComponent.php");
        // require("./views/apply_dorm_table.php");
      ?>
    </div>

    <!--apply quit dorm-->
    <div class="tab-pane fade" id="pills-quit-dorm" role="tabpanel" aria-labelledby="tab-quit-dorm"> 
      <?php
        require("./components/applyQuitDormComponent.php");
      ?>
    </div>
    
    <!--apply change dorm-->
    <div class="tab-pane fade" id="pills-change-dorm" role="tabpanel" aria-labelledby="tab-change-dorm"> 
      <?php
        require("./components/applyChangeDormComponent.php");
      ?>
    </div>

    <!-- roommate -->
    <div class="tab-pane fade" id="pills-roommate" role="tabpanel" aria-labelledby="tab-roommate">
      <?php
        require("./views/student_table.php");
      ?>
    </div>

    <!--bill-->
    <div class="tab-pane fade" id="pills-bill" role="tabpanel" aria-labelledby="tab-bill">
      <?php
        require("./views/bill_table.php");
      ?>
    </div>

    <!--rule-->
    <div class="tab-pane fade" id="pills-rule" role="tabpanel" aria-labelledby="tab-rule">
      <?php
        require("./views/rule_table.php")
      ?>
    </div>

    <!--violated record-->
    <div class="tab-pane fade" id="pills-violated-record" role="tabpanel" aria-labelledby="tab-violated-record">
      <?php
        require("./views/violated_record_table.php")
      ?>
    </div>

    <!--equipment-->
    <div class="tab-pane fade" id="pills-equipment" role="tabpanel" aria-labelledby="tab-equipment">
      <?php
        require("./views/equipment_table.php")
      ?>
    </div>

    <!--public equipment-->
    <div class="tab-pane fade" id="pills-public-equipment" role="tabpanel" aria-labelledby="tab-public-equipment">
      <?php
        require("./views/public_equipment_table.php")
      ?>
    </div>

    <!--entry and exit-->
    <div class="tab-pane fade" id="pills-entry-and-exit" role="tabpanel" aria-labelledby="tab-entry-and-exit">
      <?php
        require("./views/entry_and_exit_table.php")
      ?>
    </div>

    <!--roll call-->
    <div class="tab-pane fade" id="pills-roll-call" role="tabpanel" aria-labelledby="tab-roll-call">
      <?php
        require("./views/roll_call_table.php")
      ?>
    </div>

    <!--access card-->
    <div class="tab-pane fade" id="pills-access-card" role="tabpanel" aria-labelledby="tab-access-card">
      
      <?php
        if($_SESSION['permission']== 4 || $_SESSION['permission']== 5)
          require("./components/applyAccessCardComponent.php");
        require("./views/access_card_table.php");
      ?>
    </div>

     <!--announcement-->
     <div class="tab-pane fade" id="pills-announcement" role="tabpanel" aria-labelledby="tab-announcement">
      <?php
        require("./views/announcement_table.php");
      ?>
    </div>

    <!--help-->
    <div class="tab-pane fade" id="pills-help" role="tabpanel" aria-labelledby="tab-help">
      <?php
        require("./components/helpComponent.php");
        if($_SESSION['permission']== 4 || $_SESSION['permission']== 5)
          require("./components/storyManagerComponent.php");
      ?>
    </div>

  </div>
</main>

<script>
  document.querySelectorAll('.form-outline').forEach((formOutline) => {
    new mdb.Input(formOutline).init();
  });

  if (location.hash === "#pills-main") {
    const triggerEl = document.querySelector('a[href="#pills-main"]');
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
  }else if (location.hash === "#pills-quit-dorm") {
    const triggerEl = document.querySelector('a[href="#pills-quit-dorm"]');
    if (triggerEl) {
      let instance = mdb.Tab.getInstance(triggerEl)
      if (!instance) {
        instance = new mdb.Tab(triggerEl);
      }
      instance.show();
    }
  } else if (location.hash === "#pills-change-dorm") {
    const triggerEl = document.querySelector('a[href="#pills-change-dorm"]');
    if (triggerEl) {
      let instance = mdb.Tab.getInstance(triggerEl)
      if (!instance) {
        instance = new mdb.Tab(triggerEl);
      }
      instance.show();
    }
  }else if (location.hash === "#pills-violated-record") {
    const triggerEl = document.querySelector('a[href="#pills-violated-record"]');
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
  } else if (location.hash === "#pills-help") {
    const triggerEl = document.querySelector('a[href="#pills-help"]');
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
  } else if (location.hash === "#pills-public-equipment") {
    const triggerEl = document.querySelector('a[href="#pills-public-equipment"]');
    if (triggerEl) {
      let instance = mdb.Tab.getInstance(triggerEl)
      if (!instance) {
        instance = new mdb.Tab(triggerEl);
      }
      instance.show();
    }
  } else if (location.hash === "#pills-roommate") {
    const triggerEl = document.querySelector('a[href="#pills-roommate"]');
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


