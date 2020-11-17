
    <div class="sidebar">
      <div class="sidebar-wrapper">
        <div class="logo">
          <a href="javascript:void(0)" class="simple-text logo-mini">
            Hai
          </a>
          <a href="javascript:void(0)" class="simple-text logo-normal">
            <?= $this->session->userdata('name'); ?> !
          </a>
        </div>
        <ul class="nav">
          <li class="<?= $dashboard_class; ?>">
            <a href="<?php echo base_url() . 'Dashboard' ?>">
              <i class="tim-icons icon-chart-pie-36"></i>
              <p>Dashboard</p> 
            </a>
          </li>
          <li class="<?= $myroom_class; ?>">
            <a href="<?php echo base_url() . 'MyRoom' ?>">
              <i class="tim-icons icon-tv-2"></i>
              <p>My Room</p>
            </a>
          </li>
          <li class="<?= $find_class; ?>">
            <a href="<?php echo base_url() . 'Find' ?>">
              <i class="tim-icons icon-zoom-split"></i>
              <p>Find</p>
            </a>
          </li>
          <li class="<?= $notif_class; ?>">
            <a href="<?php echo base_url() . 'Notification' ?>">
              <i class="tim-icons icon-bell-55"></i>
              <p>Notifications <span class="badge badge-danger" id="badges_notif"></span></p>
            </a>
          </li>
          <li class="<?= $access_class; ?>">
            <a href="./notifications.html">
            <i class="tim-icons icon-controller"></i>
              <p>Access</p>
            </a>
          </li>
          <li class="<?= $profile_class; ?>">
            <a href="./user.html">
              <i class="tim-icons icon-single-02"></i>
              <p>User Profile</p>
            </a>
          </li>
        </ul>
      </div>
    </div>