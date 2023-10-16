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
        <a onclick="modifyState('pills-main')" class="list-group-item list-group-item-action py-2 ripple pb-2 active" id="tab-main" data-mdb-toggle="pill" href="#pills-main" role="tab" aria-controls="pills-main" aria-selected="true">
          <i class="fas fa-house pe-3"></i>主畫面
        </a>
        <a onclick="modifyState('pills-announcement')" class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-announcement" data-mdb-toggle="pill" href="#pills-announcement" role="tab" aria-controls="pills-announcement" aria-selected="false">
          <i class="fas fa-envelope pe-3"></i>公告
        </a>
        <a onclick="modifyState('pills-message')" class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-message" data-mdb-toggle="pill" href="#pills-message" role="tab" aria-controls="pills-message" aria-selected="false">
          <i class="fas fa-comment pe-3"></i>留言板
        </a>

        <a onclick="modifyState('pills-apply-dorm')" class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-apply-dorm" data-mdb-toggle="pill" href="#pills-apply-dorm" role="tab" aria-controls="pills-apply-dorm" aria-selected="false">
          <i class="fas fa-building-circle-check pe-3"></i>申請住宿 
        </a>
        <a onclick="modifyState('pills-quit-dorm')" class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-quit-dorm" data-mdb-toggle="pill" href="#pills-quit-dorm" role="tab" aria-controls="pills-quit-dorm" aria-selected="false">
          <i class="fas fa-building-circle-xmark pe-3"></i>申請退宿 
        </a>
        <a onclick="modifyState('pills-change-dorm')" class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-change-dorm" data-mdb-toggle="pill" href="#pills-change-dorm" role="tab" aria-controls="pills-change-dorm" aria-selected="false">
          <i class="fas fa-building-circle-arrow-right pe-3"></i>申請換宿 
        </a>

        <a onclick="modifyState('pills-border')" class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-border" data-mdb-toggle="pill" href="#pills-border" role="tab" aria-controls="pills-border" aria-selected="false">
          <i class="fas fa-person-shelter pe-3"></i>住宿生
        </a>
        <a onclick="modifyState('pills-bill')" class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-bill" data-mdb-toggle="pill" href="#pills-bill" role="tab" aria-controls="pills-bill" aria-selected="false">
          <i class="fas fa-money-bills pe-3"></i>帳單紀錄 
        </a>
        <a onclick="modifyState('pills-equipment')" class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-equipment" data-mdb-toggle="pill" href="#pills-equipment" role="tab" aria-controls="pills-equipment" aria-selected="false">
          <i class="fas fa-bed pe-3"></i>宿舍設備
        </a>
        <a onclick="modifyState('pills-public-equipment')" class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-public-equipment" data-mdb-toggle="pill" href="#pills-public-equipment" role="tab" aria-controls="pills-public-equipment" aria-selected="false">
          <i class="fas fa-washing-machine pe-3"></i>公共設施 
        </a>

        <a onclick="modifyState('pills-access-card')" class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-access-card" data-mdb-toggle="pill" href="#pills-access-card" role="tab" aria-controls="pills-access-card" aria-selected="false">
          <i class="fas fa-address-card pe-3"></i>通行證紀錄 
        </a>

      </div>
      <div class="list-group list-group-flush mx-3">
        <a href="./login.php" class="list-group-item py-2 ripple pb-2">
          <i class="fas fa-right-from-bracket pe-3"></i>登出
        </a>
      </div>
      <div class=" text-center text-reset mt-5">
        <em><small>Copyright © 2023 - </small></em>
      </div>
  </nav>
</header>

<!--Main layout-->
<main>

  <div class="tab-content" style="max-height: 100vh;">

  <?php
    require("./components/successful.php");
  ?>
    
  <!--check access card QR Code-->
  <?php
    require("./components/checkAccessCardQRCode.php")
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



    <!--apply dorm-->
    <div class="tab-pane fade" id="pills-apply-dorm" role="tabpanel" aria-labelledby="tab-apply-dorm">
      <?php
        require("./views/apply_dorm_table.php")
      ?>
    </div>
    
    <!--quit dorm-->
    <div class="tab-pane fade" id="pills-quit-dorm" role="tabpanel" aria-labelledby="tab-quit-dorm">
      <?php
        require("./views/quit_dorm_table.php")
      ?>
    </div>

    <!--change dorm-->
    <div class="tab-pane fade" id="pills-change-dorm" role="tabpanel" aria-labelledby="tab-change-dorm">
      <?php
        require("./views/change_dorm_table.php")
      ?>
    </div>

    <!--border-->
    <div class="tab-pane fade" id="pills-border" role="tabpanel" aria-labelledby="tab-border">
      <?php
        require("./views/border_table.php") 
      ?>
    </div>

    <!--bill-->
    <div class="tab-pane fade" id="pills-bill" role="tabpanel" aria-labelledby="tab-bill">
      <?php
        require("./views/bill_table.php")
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

    <!--access card-->
    <div class="tab-pane fade" id="pills-access-card" role="tabpanel" aria-labelledby="tab-access-card">
      <?php
        require("./views/access_card_table.php")
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
  } else if (location.hash === "#pills-apply-dorm") {
    const triggerEl = document.querySelector('a[href="#pills-apply-dorm"]');
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
  } else if (location.hash === "#pills-bill") {
    const triggerEl = document.querySelector('a[href="#pills-bill"]');
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
  } else if (location.hash === "#pills-quit-dorm") {
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


