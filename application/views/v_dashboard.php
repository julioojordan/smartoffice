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
        <div class="row">
          <?php 
              $i = 1;
              foreach($devices as $row):
                if($row['type'] == 1){ 
                  $icon = "fas fa-key";
                  $left = "<i class='fas fa-lock-open'></i>";
                  $right = "<i class='fas fa-lock'></i>";
                  $id = $row['device_id'];
                  $click = "changeStatusLock('".$row['device_id']."', '".$row['room_id']."', 'lock')";
                } elseif($row['type'] == 2){
                  $icon = "far fa-lightbulb";
                  $left = "On";
                  $right = "Off";
                  $id = $row['device_id'];
                  $click = "changeStatus(this.checked, '".$row['device_id']."', '".$row['room_id']."', 'fan')";
                }elseif($row['type'] == 3){
                  $icon = "far fa-snowflake";
                  $left = "On";
                  $right = "Off";
                  $id = $row['device_id'];
                  $click ="changeStatus(this.checked, '".$row['device_id']."', '".$row['room_id']."', 'lamp')";
                }
          ?>
          <div class="col-lg-4">
            <div class="card">
              <div class="card-header">
                <h5 class="card-category">Device <?=$i?></h5>
                <h3 class="card-title" style="text-transform: capitalize;"><i class="<?= $icon; ?>"></i> &nbsp; <?= $row['device_name'] ?></h3>
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
                      <button type="button" class="btn btn-fill btn-primary btn-sm" onclick="<?= $click; ?>"><i class='fas fa-lock-open'>&nbsp; Unlock</i></button>
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
        <div class="row">
          <div class="col-lg-6 col-md-12">
            <div class="card ">
              <div class="card-header">
                <h4 class="card-title"> Active Guest </h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table tablesorter ">
                    <thead class=" text-primary">
                      <tr>
                        <th style="text-align:center;"> No </th>
                        <th style="text-align:center;"> User ID </th>
                        <th style="text-align:center;"> Name </th>
                        <th style="text-align:center;"> Email </th>
                      </tr>
                    </thead>
                    <tbody id="table_body_guest">
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-12">
            <div class="card ">
              <div class="card-header">
                <h4 class="card-title"> Access to Other's Rooms </h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table tablesorter ">
                    <thead class=" text-primary">
                      <tr>
                        <th style="text-align:center;"> No </th>
                        <th style="text-align:center;"> Room Id </th>
                        <th style="text-align:center;"> Owner </th>
                        <th style="text-align:center;"> Action </th>
                      </tr>
                    </thead>
                    <tbody id="table_body_access">

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php $this->load->view('templates/footer') ?>
      
    </div>
  </div>

  <!-- Setting -->
  <?php $this->load->view('templates/setting') ?>

  <!--   Core JS Files   -->
  <?php $this->load->view('templates/script') ?>


   <!-- script check status -->
   <script>
    var table_body_guest = document.getElementById("table_body_guest");
    var table_body_access = document.getElementById("table_body_access");

    $(document).ready(function() {
      setInterval(function(){
         $.ajax({
            url:"<?php echo base_url();?>index.php/Dashboard/get_last_status",
            dataType : 'json',
            success:function(data){
              $.each(data, function(key,val){
                var device_type = val.type
                if( device_type != 1){
                  var id_tag = val.device_id
                  var status = val.status
                  if (status == 1){
                    document.getElementById(id_tag).checked = true;
                  }else if (status == 0){
                    document.getElementById(id_tag).checked = false;
                  }
                }
                
              });
            }
        });

        //guest
        $.ajax({
            url:"<?php echo base_url();?>index.php/Dashboard/auto_guest",
            dataType : 'json',
            success:function(data){
                if (data == false){//no guest
                    table_body_guest.innerHTML = "<td style='text-align:center;' colspan='6'>You Have no Guest</td>"
                }else{
                    table_body_guest.innerHTML = "";
                    var i = 1;
                    $.each(data, function(key,val){
                      table_body_guest.innerHTML += "<tr><td style='text-align:center;'>"+i+"</td><td style='text-align:center;'>"+val.user_id+"</td><td style='text-align:center;'>"+val.name+"</td><td style='text-align:center;'>"+val.email+"</td></tr>";
                      i++ ;
                    });
                }
            }
        });

        //access
        $.ajax({
            url:"<?php echo base_url();?>index.php/Dashboard/auto_access",
            dataType : 'json',
            success:function(data){
                if (data == false){//no guest
                    table_body_access.innerHTML = "<td style='text-align:center;' colspan='6'>You Have no Access to other's Rooms</td>"
                }else{
                    table_body_access.innerHTML = "";
                    var j = 1;
                    $.each(data, function(key,val){
                      table_body_access.innerHTML += "<tr><td style='text-align:center;'>"+j+"</td><td style='text-align:center;'>"+val.user_id+"</td><td style='text-align:center;'>"+val.name+"</td><td style='text-align:center;'><a href='<?php echo base_url();?>index.php/Access/rooms/"+val.token+"'><button type='button' class='btn btn-fill btn-info btn-sm'><i class='tim-icons icon-controller'>&nbsp; Access</i></button></a></td></tr>";
                      j++ ;
                    });
                }
            }
        });
      }, 1000);
    });
  </script>

  <!-- Script for change status -->
    <script>
      function changeStatus(status, device_id, room_id, device){
        console.log(status);
        if(status == true){
          var status_d = 1;
        }else{
          var status_d = 0;
        }
          $.ajax({
                url:"<?php echo base_url();?>index.php/Dashboard/device",
                method : "POST",
                data: {status: status_d, device_id: device_id, device: device, room_id: room_id},
                dataType : 'json',
                success:function(data){
                  if (data != false){
                      //console.log(data);
                  }
                }
            });
      }

      function changeStatusLock(device_id, room_id, device){
        var status = null;
          //console.log('unlocked');
        $.ajax({
            url:"<?php echo base_url();?>index.php/Dashboard/device",
            method : "POST",
            data: {status: status, device_id: device_id, device: device, room_id: room_id},
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

  <?php if ($this->session->flashdata('registered')) : ?>
        <script type="text/javascript">
            Swal.fire({
                icon: 'success',
                title: 'Success <?=$this->session->userdata("name")?>',
                text: 'Your Account Has Been Registered !',
            });
        </script>
  <?php endif; ?>

  <?php if ($this->session->flashdata('updated')) : ?>
        <script type="text/javascript">
            Swal.fire({
                icon: 'success',
                title: 'Success <?=$this->session->userdata("name")?>',
                text: 'Your Data Has Been Updated !',
            });
        </script>
  <?php endif; ?>

  <?php if ($this->session->flashdata('updated_password')) : ?>
        <script type="text/javascript">
            Swal.fire({
                icon: 'success',
                title: 'Success <?=$this->session->userdata("name")?>',
                text: 'Your Password Has Been Updated !',
            });
        </script>
  <?php endif; ?>
  
</body>

</html>