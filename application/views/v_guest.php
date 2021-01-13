<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url() . 'assets/dashboard/img/apple-icon.png' ?>">
  <link rel="icon" type="image/png" href="<?php echo base_url() . 'assets/dashboard/img/favicon.png' ?>">
  <title>
    <?= $location ?>
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- Nucleo Icons -->
  <link href="<?php echo base_url() . 'assets/dashboard/css/nucleo-icons.css' ?>" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="<?php echo base_url() . 'assets/dashboard/css/black-dashboard.css?v=1.0.0' ?>" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="<?php echo base_url() . 'assets/dashboard/demo/demo.css' ?>" rel="stylesheet" />
  
  <link href="<?php echo base_url() . 'assets/dashboard/css/check_button.css' ?>" rel="stylesheet" />
  
</head>
<!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red"
    -->

<body class="">
  <div class="wrapper">
    <?php $this->load->view('templates/sidebar') ?>
    <div class="main-panel">
      <!-- Navbar -->
      <?php $this->load->view('templates/navbar') ?>
      <!-- End Navbar -->
      <div class="content">
        <div class="alert alert-info text-center" role="alert" id="expired_time">
            
        </div>
        <div class="row" id="guest_devices">
          <?php 
              $i = 1;
              foreach($devices as $row):
                if($row['type'] == 1){ 
                  $icon = "fas fa-key";
                  $left = "<i class='fas fa-lock-open'></i>";
                  $right = "<i class='fas fa-lock'></i>";
                  $id = "lock";
                  $id2 = "lock_id";
                  $id3 = "lock_room_id";
                  $click = "changeStatusLock()";
                } elseif($row['type'] == 2){
                  $icon = "far fa-lightbulb";
                  $left = "On";
                  $right = "Off";
                  $id = "lamp";
                  $id2 = "lamp_id";
                  $id3 = "lamp_room_id";
                  $click = "changeStatusLamp()";
                }elseif($row['type'] == 3){
                  $icon = "far fa-snowflake";
                  $left = "On";
                  $right = "Off";
                  $id = "fan";
                  $id2 = "fan_id";
                  $id3 = "fan_room_id";
                  $click = "changeStatusFan()";
                }
          ?>
          <div class="col-lg-4">
            <div class="card">
              <div class="card-header">
                <h5 class="card-category">Device <?=$i?></h5>
                <h3 class="card-title" style="text-transform: capitalize;"><i class="<?= $icon; ?>"></i> &nbsp; <?= $row['device_name'] ?></h3>
                <input type="hidden" id="<?= $id2; ?>" value="<?= $row['device_id'] ?>">
                <input type="hidden" id="<?= $id3; ?>" value="<?= $row['room_id'] ?>">
              </div>
              <div class="card-body">
                <div class="row" style="vertical-align: middle; text-align: center;">
                  <div class="col-lg-6 col-md-12">
                    <i class="<?= $icon; ?> fa-7x"></i>
                  </div>
                  <div class="col-lg-6 col-md-12 my-auto">
                    <div id='timer'></div>
                    <?php if ($row['type'] != 1) : ?>
                      <div class="mid">
                        <label class="rocker">
                          <input type="checkbox" id="<?= $id; ?>" onclick="<?= $click; ?>">
                          <span class="switch-left"><?= $left; ?></span>
                          <span class="switch-right"><?= $right; ?></span>
                        </label>
                      </div>
                    <?php else: ?>
                      <div class="mid">
                      <button type="button" class="btn btn-fill btn-primary btn-sm" onclick="changeStatusLock()"><i class='fas fa-lock-open'>&nbsp; Unlock</i></button>
                      </div>
                    <?php endif;?>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <?php $i++;
              endforeach;
          ?>
        </div>
        <div class="row" id="expired" style = "display : none">
              <h3 style = "text-align: center"> Your Access to This Room Has Expired </hr>
        </div>
      </div>
      <?php $this->load->view('templates/footer') ?>
      
    </div>
  </div>

  <!-- Setting -->
  <?php $this->load->view('templates/setting') ?>

  <!--   Core JS Files   -->
  <?php $this->load->view('templates/script') ?>
  </script> -->

   <!-- script check status -->
   <script>
    var lamp = document.getElementById("lamp");
    var fan = document.getElementById("fan");

    $(document).ready(function() {
      setInterval(function(){
         $.ajax({
            url:"<?php echo base_url();?>index.php/Dashboard/get_last_status",
            method : "POST",
            data: {token: <?=$token?>},
            dataType : 'json',
            success:function(data){
              //lock
                // if(data[0] == 1){
                //   lock.checked = true;
                // } else if (data[0] == 0){
                //   lock.checked = false;
                // }
                
                //lamp
                if(data[1] == 1){
                  lamp.checked = true;
                } else if (data[1] == 0){
                  lamp.checked = false;
                }

                //fan
                if(data[2] == 1){
                  fan.checked = true;
                } else if (data[2] == 0){
                  fan.checked = false;
                }

            }
        });
      }, 1000);
    });
  </script>

  <!-- Script for change status -->
    <script>
      function changeStatusLamp(){
        var lamp = document.getElementById("lamp");
        var lamp_id = document.getElementById("lamp_id").value;
        var lamp_room_id = document.getElementById("lamp_room_id").value;
        if (lamp.checked == true){
          var status = 1;
          var device = 'lamp';
          //console.log('on');
          $.ajax({
                url:"<?php echo base_url();?>index.php/Dashboard/device",
                method : "POST",
                data: {status: status, device_id: lamp_id, room_id: lamp_room_id, device: device},
                dataType : 'json',
                success:function(data){
                  if (data != false){
                      //console.log(data);
                  }
                }
            });
        } else {
          var status = 0;
          var device = 'lamp';
          //console.log('off');
          $.ajax({
                url:"<?php echo base_url();?>index.php/Dashboard/device",
                method : "POST",
                data: {status: status, device_id: lamp_id, room_id: lamp_room_id, device: device},
                dataType : 'json',
                success:function(data){
                  if (data != false){
                      //console.log(data);
                  }
                }
            });
        }
      }

      function changeStatusFan(){
        var fan = document.getElementById("fan");
        var fan_id = document.getElementById("fan_id").value;
        var fan_room_id = document.getElementById("fan_room_id").value;
       
        if (fan.checked == true){
          var status = 1;
          var device = 'fan';
          //console.log('on');
          $.ajax({
                url:"<?php echo base_url();?>index.php/Dashboard/device",
                method : "POST",
                data: {status: status, device_id: fan_id, room_id: fan_room_id, device: device},
                dataType : 'json',
                success:function(data){
                  if (data != false){
                      //console.log(data);
                  }
                }
            });
        } else {
          var status = 0;
          var device = 'fan';
          //console.log('off');
          $.ajax({
                url:"<?php echo base_url();?>index.php/Dashboard/device",
                method : "POST",
                data: {status: status, device_id: fan_id, room_id: fan_room_id, device: device},
                dataType : 'json',
                success:function(data){
                  if (data != false){
                      //console.log(data);
                  }
                }
            });
        }
      }

      function changeStatusLock(){
        var lock_id = document.getElementById("lock_id").value;
        var lock_room_id = document.getElementById("lock_room_id").value;
        var status = null;
        var device = 'lock';
          //console.log('unlocked');
        $.ajax({
            url:"<?php echo base_url();?>index.php/Dashboard/device",
            method : "POST",
            data: {status: status, device_id: lock_id, room_id: lock_room_id, device: device},
            dataType : 'json',
            success:function(data){
              if (data != false){
                  //console.log(data);
              }
            }
        });
      }

    </script>
  <!-- END Script for change status -->

    <!-- Script for expiration time -->
    <script>
        // Set the date we're counting down to
        var countDownDate = new Date(<?php echo '"' . $expired . '"'; ?>).getTime();
        var expired_time = document.getElementById('expired_time');
        var guest_devices = document.getElementById('guest_devices');
        var expired = document.getElementById('expired');
        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;
            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            var time_left = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
            expired_time.innerHTML = "Your Access to This Room is Ended in : <br>" + time_left;
            //console.log(time_left);
            // If the count down is finished, write some text
            if (distance < 0) {
                clearInterval(x);
                expired_time.style.display = 'none';
                guest_devices.style.display = 'none';
                expired.style.display = 'block';
            }
        }, 1000);


    </script>
    <!-- END Script for expiration time  -->
</body>

</html>