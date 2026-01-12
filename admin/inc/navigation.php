<!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4 sidebar-no-expand" style="background: linear-gradient(180deg, #13293d, #265d7a, #0976a4ff) !important;">

        <!-- Brand Logo -->
        <a href="<?php echo base_url ?>admin" class="brand-link bg-transparent text-sm shadow-sm">
        <img src="<?php echo validate_image($_settings->info('logo'))?>" alt="Store Logo" class="brand-image img-circle elevation-3 bg-black" style="width: 1.8rem;height: 1.8rem;max-height: unset;object-fit:scale-down;object-position:center center">
        <span class="brand-text font-weight-light"><?php echo $_settings->info('short_name') ?></span>
        </a>
        <!-- Sidebar -->
        <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-transition os-host-scrollbar-horizontal-hidden">
          <div class="os-resize-observer-host observed">
            <div class="os-resize-observer" style="left: 0px; right: auto;"></div>
          </div>
          <div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;">
            <div class="os-resize-observer"></div>
          </div>
          <div class="os-content-glue" style="margin: 0px -8px; width: 249px; height: 646px;"></div>
          <div class="os-padding">
            <div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;">
              <div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
                <!-- Sidebar user panel (optional) -->
                <div class="clearfix"></div>
                <!-- Sidebar Menu -->
                <nav class="mt-4">
                   <ul class="nav nav-pills nav-sidebar flex-column text-mdnav-compact nav-flat nav-child-indent nav-collapse-hide-child" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item dropdown">
                      <a href="./" class="nav-link nav-home">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                          Dashboard
                        </p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="<?php echo base_url ?>admin/?page=archives" class="nav-link nav-archives">
                        <i class="nav-icon fas fa-archive"></i>
                        <p>
                          Archives List
                        </p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="<?php echo base_url ?>admin/?page=students" class="nav-link nav-students">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                          Student List
                        </p>
                      </a>
                    </li>
                    <?php if($_settings->userdata('type') == 1): ?>
                    <li class="nav-header">Management
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=departments" class="nav-link nav-departments">
                        <i class="nav-icon fas fa-th-list"></i>
                        <p>
                          Department List
                        </p>
                      </a>
                    </li>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=curriculum" class="nav-link nav-curriculum">
                        <i class="nav-icon fas fa-scroll"></i>
                        <p>
                          Course List
                        </p>
                      </a>
                    </li>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=user/list" class="nav-link nav-user_list">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>
                          User List
                        </p>
                      </a>
                    </li>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=system_info" class="nav-link nav-system_info">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                          Settings
                        </p>
                      </a>
                    </li>
                     <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=plagiarism" class="nav-link nav-plagiarism">
                      <i class="nav-icon fas fa-clipboard-check"></i>                        <p>
                          Plagiarism Checker
                        </p>
                      </a>
                    </li>
                    <?php endif; ?>
                    <li class="nav-item mt-4">
                      <a href="#" class="nav-link nav-logout" id="logoutBtn">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                      </a>
                    </li>

                  </ul>
                </nav>
                <!-- /.sidebar-menu -->
              </div>
            </div>
          </div>
          <div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden">
            <div class="os-scrollbar-track">
              <div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div>
            </div>
          </div>
          <div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden">
            <div class="os-scrollbar-track">
              <div class="os-scrollbar-handle" style="height: 55.017%; transform: translate(0px, 0px);"></div>
            </div>
          </div>
          <div class="os-scrollbar-corner"></div>
        </div>
        <!-- /.sidebar -->
      </aside>
      <div id="logoutModal" class="modal" tabindex="-1" style="display:none;position:fixed;top:0;left:0;width:100vw;height:100vh;background:rgba(0,0,0,0.45);z-index:9999;align-items:center;justify-content:center;">
  <div style="background:#232733;padding:2rem 2.5rem;border-radius:16px;box-shadow:0 8px 32px rgba(34,42,35,0.18);color:#fff;max-width:350px;margin:auto;text-align:center;">
    <h5 style="margin-bottom:1.2rem;">Are you sure you want to log out?</h5>
    <button id="confirmLogout" style="background:#2176ff;color:#fff;border:none;padding:0.5em 1.5em;border-radius:8px;font-weight:600;margin-right:1em;">Yes</button>
    <button id="cancelLogout" style="background:#383e3f;color:#fff;border:none;padding:0.5em 1.5em;border-radius:8px;font-weight:600;">Cancel</button>
  </div>
</div>
  <script>
        var page;
    $(document).ready(function(){
      page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
      page = page.replace(/\//gi,'_');

      if($('.nav-link.nav-'+page).length > 0){
             $('.nav-link.nav-'+page).addClass('active')
        if($('.nav-link.nav-'+page).hasClass('tree-item') == true){
            $('.nav-link.nav-'+page).closest('.nav-treeview').siblings('a').addClass('active')
          $('.nav-link.nav-'+page).closest('.nav-treeview').parent().addClass('menu-open')
        }
        if($('.nav-link.nav-'+page).hasClass('nav-is-tree') == true){
          $('.nav-link.nav-'+page).parent().addClass('menu-open')
        }

      }
      
		$('#receive-nav').click(function(){
      $('#uni_modal').on('shown.bs.modal',function(){
        $('#find-transaction [name="tracking_code"]').focus();
      })
			uni_modal("Enter Tracking Number","transaction/find_transaction.php");
		})
    })
    document.getElementById('logoutBtn').addEventListener('click', function(e) {
  e.preventDefault();
  document.getElementById('logoutModal').style.display = 'flex';
});
document.getElementById('cancelLogout').addEventListener('click', function() {
  document.getElementById('logoutModal').style.display = 'none';
});
document.getElementById('confirmLogout').addEventListener('click', function() {
  window.location.href = "<?php echo base_url.'/classes/Login.php?f=logout' ?>";
});
  </script>
  <style>
.main-sidebar .nav-link {
    border-radius: 0 50px 50px 0 !important;
    margin-bottom: 0.5em;
    font-weight: 500;
    position: relative;
    transition: background 0.2s, color 0.2s, box-shadow 0.2s;
}
.main-sidebar .nav-link.active,
.main-sidebar .nav-link:hover {
  
    color: #fff !important;
    font-weight: 700;
    box-shadow: 0 0 0 2px #00eaff5e, 0 0 12px 2px #00eaff55;
     border-radius: 0 50px 50px 0 !important;
    outline: none;
}
.main-sidebar .nav-link.active::before,
.main-sidebar .nav-link:hover::before {
    content: '';
    position: absolute;
    left: -6px; right: -6px; top: -4px; bottom: -4px;
   border-radius: 0 50px 50px 0 !important;
    border: 2px solid #ffffff7e;
    box-shadow: 0 0 16px 2px #00eaff55;
    pointer-events: none;
    z-index: 0;
}
.main-sidebar .nav-link i,
.main-sidebar .nav-link p {
    position: relative;
    z-index: 1;
}
.main-sidebar .nav-link.active i,
.main-sidebar .nav-link.active p,
.main-sidebar .nav-link:hover i,
.main-sidebar .nav-link:hover p {
    color: #aaf8ffd8 !important;
    font-weight: 600;
}
.main-sidebar .nav-link.nav-logout:hover {
    background: linear-gradient(135deg, #ff4b5c 0%, #79240aff 100%) !important;
    color: #fff !important;
    box-shadow: 0 0 0 2px #ff4b5c, 0 0 12px 2px #ffb19955;
}
.main-sidebar .nav-link.nav-logout:hover i {
    color: #fff !important;
}
</style>