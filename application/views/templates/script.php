<!-- <?php echo base_url() . 'assets/dashboard/demo/demo.js' ?> -->
<script src="<?php echo base_url() . 'assets/dashboard/js/core/jquery.min.js' ?>"></script> 
  <script src="<?php echo base_url() . 'assets/dashboard/js/core/popper.min.js' ?>"></script>
  <script src="<?php echo base_url() . 'assets/dashboard/js/core/bootstrap.min.js' ?>"></script>
  <script src="<?php echo base_url() . 'assets/dashboard/js/plugins/perfect-scrollbar.jquery.min.js' ?>"></script>
  <!--  Google Maps Plugin    -->
  <!-- Place this tag in your head or just before your close body tag. -->
  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
  <!-- Chart JS -->
  <script src="<?php echo base_url() . 'assets/dashboard/js/plugins/chartjs.min.js' ?>"></script>
  <!--  Notifications Plugin    -->
  <script src="<?php echo base_url() . 'assets/dashboard/js/plugins/bootstrap-notify.js' ?>"></script>
  <!-- Control Center for Black Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="<?php echo base_url() . 'assets/dashboard/js/black-dashboard.min.js?v=1.0.0' ?>"></script><!-- Black Dashboard DEMO methods, don't include it in your project! -->
  <script src="<?php echo base_url() . 'assets/dashboard/demo/demo.js' ?>"></script>
  
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

  <script>
    $(document).ready(function() {
      $().ready(function() {
        $sidebar = $('.sidebar');
        $navbar = $('.navbar');
        $main_panel = $('.main-panel');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');
        sidebar_mini_active = true;
        white_color = false;

        window_width = $(window).width();

        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();



        $('.fixed-plugin a').click(function(event) {
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $('.fixed-plugin .background-color span').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data', new_color);
          }

          if ($main_panel.length != 0) {
            $main_panel.attr('data', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data', new_color);
          }
        });

        $('.switch-sidebar-mini input').on("switchChange.bootstrapSwitch", function() {
          var $btn = $(this);

          if (sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            sidebar_mini_active = false;
            blackDashboard.showSidebarMessage('Sidebar mini deactivated...');
          } else {
            $('body').addClass('sidebar-mini');
            sidebar_mini_active = true;
            blackDashboard.showSidebarMessage('Sidebar mini activated...');
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function() {
            clearInterval(simulateWindowResize);
          }, 1000);
        });

        $('.switch-change-color input').on("switchChange.bootstrapSwitch", function() {
          var $btn = $(this);

          if (white_color == true) {

            $('body').addClass('change-background');
            setTimeout(function() {
              $('body').removeClass('change-background');
              $('body').removeClass('white-content');
            }, 900);
            white_color = false;
          } else {

            $('body').addClass('change-background');
            setTimeout(function() {
              $('body').removeClass('change-background');
              $('body').addClass('white-content');
            }, 900);

            white_color = true;
          }


        });

        $('.light-badge').click(function() {
          $('body').addClass('white-content');
        });

        $('.dark-badge').click(function() {
          $('body').removeClass('white-content');
        });
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      demo.initDashboardPageCharts();

    });
  </script>
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  <script>
    window.TrackJS &&
      TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "black-dashboard-free"
      });
  </script>

<!-- untuk check messages -->
<script>
    var message_now = 0;
    $(document).ready(function() {
        var notif_navbar =  document.getElementById("notif_navbar");
        var badges_notif =  document.getElementById("badges_notif");
        setInterval(function(){
              $.ajax({
                  url:"<?php echo base_url();?>index.php/MessageControl/get_message",
                  dataType : 'json',
                  success:function(data){
                      if (data != 0 && data != message_now){ //ada pesan masuk
                          console.log(data);
                          $.ajax({
                              url:"<?php echo base_url();?>index.php/MessageControl/get_last_message",
                              dataType : 'json',
                              success:function(data1){
                                  $.each(data1, function(key,val){
                                    var u_from = val.u_from;
                                    showNotification('top','right', u_from);
                                  });
                              }
                          });
                          notif_navbar.classList.add("notification");
                          badges_notif.innerHTML = data;
                          message_now = data;
                      }else if(data == 0){
                          message_now = 0;
                          notif_navbar.classList.remove("notification");
                          badges_notif.innerHTML = "";
                      }
                  }
              });
          }, 1000);

          //for checking whenever user is operating the website so that their last_login_status will change
          $.ajax({
              url:"<?php echo base_url();?>index.php/MessageControl/change_last_user_status",
              dataType : 'json',
              success:function(data){
                  console.log('online');
              }
          });
        
    });

    function showNotification(from, align, user) {
        color = Math.floor((Math.random() * 4) + 1);

        $.notify({
          icon: "tim-icons icon-bell-55",
          message: "You Have New <b>Room Access Request </b> By - "+user

        }, {
          type: type[color],
          timer: 8000,
          placement: {
            from: from,
            align: align
          }
        });
    }
  </script>