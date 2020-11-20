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
        <div class="row">
          <div class="col-lg-6 col-md-12">
            <div class="card card-tasks">
              <div class="card-header ">
                <h6 class="title d-inline">Tasks(5)</h6>
                <p class="card-category d-inline">today</p>
                <div class="dropdown">
                  <button type="button" class="btn btn-link dropdown-toggle btn-icon" data-toggle="dropdown">
                    <i class="tim-icons icon-settings-gear-63"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="#pablo">Action</a>
                    <a class="dropdown-item" href="#pablo">Another action</a>
                    <a class="dropdown-item" href="#pablo">Something else</a>
                  </div>
                </div>
              </div>
              <div class="card-body ">
                <div class="table-full-width table-responsive">
                  <table class="table">
                    <tbody>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="">
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>
                          <p class="title">Update the Documentation</p>
                          <p class="text-muted">Dwuamish Head, Seattle, WA 8:47 AM</p>
                        </td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="" class="btn btn-link" data-original-title="Edit Task">
                            <i class="tim-icons icon-pencil"></i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked="">
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>
                          <p class="title">GDPR Compliance</p>
                          <p class="text-muted">The GDPR is a regulation that requires businesses to protect the personal data and privacy of Europe citizens for transactions that occur within EU member states.</p>
                        </td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="" class="btn btn-link" data-original-title="Edit Task">
                            <i class="tim-icons icon-pencil"></i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="">
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>
                          <p class="title">Solve the issues</p>
                          <p class="text-muted">Fifty percent of all respondents said they would be more likely to shop at a company </p>
                        </td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="" class="btn btn-link" data-original-title="Edit Task">
                            <i class="tim-icons icon-pencil"></i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="">
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>
                          <p class="title">Release v2.0.0</p>
                          <p class="text-muted">Ra Ave SW, Seattle, WA 98116, SUA 11:19 AM</p>
                        </td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="" class="btn btn-link" data-original-title="Edit Task">
                            <i class="tim-icons icon-pencil"></i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="">
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>
                          <p class="title">Export the processed files</p>
                          <p class="text-muted">The report also shows that consumers will not easily forgive a company once a breach exposing their personal data occurs. </p>
                        </td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="" class="btn btn-link" data-original-title="Edit Task">
                            <i class="tim-icons icon-pencil"></i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="">
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>
                          <p class="title">Arival at export process</p>
                          <p class="text-muted">Capitol Hill, Seattle, WA 12:34 AM</p>
                        </td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="" class="btn btn-link" data-original-title="Edit Task">
                            <i class="tim-icons icon-pencil"></i>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-12">
            <div class="card ">
              <div class="card-header">
                <h4 class="card-title"> Simple Table</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table tablesorter " id="">
                    <thead class=" text-primary">
                      <tr>
                        <th>
                          Name
                        </th>
                        <th>
                          Country
                        </th>
                        <th>
                          City
                        </th>
                        <th class="text-center">
                          Salary
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          Dakota Rice
                        </td>
                        <td>
                          Niger
                        </td>
                        <td>
                          Oud-Turnhout
                        </td>
                        <td class="text-center">
                          $36,738
                        </td>
                      </tr>
                      <tr>
                        <td>
                          Minerva Hooper
                        </td>
                        <td>
                          Curaçao
                        </td>
                        <td>
                          Sinaai-Waas
                        </td>
                        <td class="text-center">
                          $23,789
                        </td>
                      </tr>
                      <tr>
                        <td>
                          Sage Rodriguez
                        </td>
                        <td>
                          Netherlands
                        </td>
                        <td>
                          Baileux
                        </td>
                        <td class="text-center">
                          $56,142
                        </td>
                      </tr>
                      <tr>
                        <td>
                          Philip Chaney
                        </td>
                        <td>
                          Korea, South
                        </td>
                        <td>
                          Overland Park
                        </td>
                        <td class="text-center">
                          $38,735
                        </td>
                      </tr>
                      <tr>
                        <td>
                          Doris Greene
                        </td>
                        <td>
                          Malawi
                        </td>
                        <td>
                          Feldkirchen in Kärnten
                        </td>
                        <td class="text-center">
                          $63,542
                        </td>
                      </tr>
                      <tr>
                        <td>
                          Mason Porter
                        </td>
                        <td>
                          Chile
                        </td>
                        <td>
                          Gloucester
                        </td>
                        <td class="text-center">
                          $78,615
                        </td>
                      </tr>
                      <tr>
                        <td>
                          Jon Porter
                        </td>
                        <td>
                          Portugal
                        </td>
                        <td>
                          Gloucester
                        </td>
                        <td class="text-center">
                          $98,615
                        </td>
                      </tr>
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
<!-- <script>
    $(document).ready(function() {
      var jam = 0
      var detik = 57;
      var menit = 59;
      function hitung() {
        setTimeout(hitung,1000);
        $('#timer').html( jam + ' hours ' + menit + ' minutes ' + detik + ' seconds ');
        detik ++;
        if(detik > 59) {
            detik = 0;
            menit ++;
          if(menit > 59) {
            jam ++;
            menit = 0; 
          }
        }
      }
        hitung();
    });
  </script> -->

   <!-- script check status -->
   <script>
    var lamp = document.getElementById("lamp");
    var fan = document.getElementById("fan");
    $(document).ready(function() {
      setInterval(function(){
         $.ajax({
            url:"<?php echo base_url();?>index.php/Dashboard/get_last_status",
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
        // else {
        //   var status = 0;
        //   var device = 'lock';
        //   //console.log('locked');
        //   $.ajax({
        //         url:"<?php echo base_url();?>index.php/Dashboard/device",
        //         method : "POST",
        //         data: {status: status, device_id: lock_id, room_id: lock_room_id, device: device},
        //         dataType : 'json',
        //         success:function(data){
        //           if (data != false){
        //               //console.log(data);
        //           }
        //         }
        //     });
        // }
      }

    </script>
  <!-- END Script for change status -->

 
  
</body>

</html>