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
        <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-border" data-mdb-toggle="pill" href="#pills-border" role="tab" aria-controls="pills-border" aria-selected="true">
          <i class="fas fa-person-shelter pe-3"></i>住宿生
        </a>
        <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-violated-record" data-mdb-toggle="pill" href="#pills-violated-record" role="tab" aria-controls="pills-violated-record" aria-selected="false">
          <i class="fas fa-book pe-3"></i>違規紀錄
        </a>
        <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-entry-and-exit" data-mdb-toggle="pill" href="#pills-entry-and-exit" role="tab" aria-controls="pills-entry-and-exit" aria-selected="false">
          <i class="fas fa-note pe-3"></i>進出紀錄
        </a>
        <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-room" data-mdb-toggle="pill" href="#pills-room" role="tab" aria-controls="pills-room" aria-selected="false">
          <i class="fas fa-door-open pe-3"></i>宿舍房間
        </a>
        <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-equipment" data-mdb-toggle="pill" href="#pills-equipment" role="tab" aria-controls="pills-equipment" aria-selected="false">
          <i class="fas fa-bed pe-3"></i>宿舍設備
        </a>
        <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-public-equipment" data-mdb-toggle="pill" href="#pills-public-equipment" role="tab" aria-controls="pills-public-equipment" aria-selected="false">
          <i class="fas fa-washing-machine pe-3"></i>公共設施 
        </a>
        <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-parking-permit" data-mdb-toggle="pill" href="#pills-parking-permit" role="tab" aria-controls="pills-parking-permit" aria-selected="false">
          <i class="fas fa-car pe-3"></i>停車許可
        </a>

      </div>
      <div class="list-group list-group-flush mx-3">
        <a href="./login.php" class="list-group-item py-2 ripple pb-2">
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

  <div class="tab-content" style="max-height: 100vh;">

    <!-- check parking permit -->
    <?php
      require("./components/checkParkingPermitQRCode.php")
    ?>


    <!--main-->
    <div class="tab-pane fade show active" id="pills-main" role="tabpanel" aria-labelledby="tab-main">
      <?php
        require("./components/infoComponent.php")
      ?>
    </div>
  
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


    <!--border-->
    <div class="tab-pane fade" id="pills-border" role="tabpanel" aria-labelledby="tab-border">
      <?php
        require("./views/border_table.php") 
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
      // add account
        require("./views/entry_and_exit_table.php")
      ?>
    </div>

    <!-- room -->
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

    <!--public equipment-->
    <div class="tab-pane fade" id="pills-public-equipment" role="tabpanel" aria-labelledby="tab-public-equipment">
      <?php
        require("./views/public_equipment_table.php")
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
  } else if (location.hash === "#pills-equipment") {
    const triggerEl = document.querySelector('a[href="#pills-equipment"]');
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
  } else if (location.hash === "#pills-entry-and-exit") {
    const triggerEl = document.querySelector('a[href="#pills-entry-and-exit"]');
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
  } else if (location.hash === "#pills-public-equipment") {
    const triggerEl = document.querySelector('a[href="#pills-public-equipment"]');
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
  }
</script>


