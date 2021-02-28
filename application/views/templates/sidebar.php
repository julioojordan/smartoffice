
    <div class="sidebar">
      <div class="sidebar-wrapper">
        <div class="logo">
          <?php if ($this->session->userdata('role') == 'user') : ?>
            <?php if ($this->session->userdata('email') != NULL) : ?>
            <a href="javascript:void(0)" class="simple-text logo-mini">
              Hai
            </a>
            <a href="javascript:void(0)" class="simple-text logo-normal">
              <?= $this->session->userdata('name'); ?> !
            </a>
            <?php else : ?>
            <a href="javascript:void(0)" class="simple-text logo-normal">
              COMPLETE YOUR DATA FIRST !
            </a>
            <?php endif; ?>
          <?php elseif ($this->session->userdata('role') == 'admin') : ?>
            <a href="javascript:void(0)" class="simple-text logo-mini">
              Hai
            </a>
            <a href="javascript:void(0)" class="simple-text logo-normal">
              Admin !
            </a>
          <?php endif; ?>
        </div>
        <ul class="nav">
          <?php if ($this->session->userdata('role') == 'user') : ?>
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
              <a href="<?php echo base_url() . 'Access' ?>">
              <i class="tim-icons icon-controller"></i>
                <p>Access</p>
              </a>
            </li>
            <li class="<?= $profile_class; ?>">
              <a href="<?php echo base_url() . 'User' ?>">
                <i class="tim-icons icon-single-02"></i>
                <p>User Profile</p>
              </a>
            </li>
          <?php elseif ($this->session->userdata('role') == 'admin') : ?>
            <li class="<?= $dashboard_class_admin; ?>">
              <a href="<?php echo base_url() . 'DashboardAdmin' ?>">
                <i class="tim-icons icon-chart-pie-36"></i>
                <p>Dashboard</p> 
              </a>
            </li>
          <?php endif; ?>
        </ul>

      </div>
    </div>