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

                <!-- Acccess reques -->
                <div class="col-lg-4 col-md-12">
                    <div class="card scroll-card">
                        <div class="card-header">
                            <h4 class="card-title" style="font-weight:bold;">Access Requested</h4>
                            <input type="text" class="form-control" id="search" name="search" placeholder="SEARCH" style="background-color: white; color: black; font-weight: 800;" autocomplete = off>
                        </div>
                        <div class="card-body">
                            <div class="row" id="result">
                                <?php 
                                    $i = 1;
                                    foreach($message_0 as $row) :
                                ?>
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title" style="font-weight:bold;">Request <?= $i;?> <span style="color:grey; text-align: right;"><?= $row['time']?></span></h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row" style="vertical-align: middle;">
                                                <div class="col-lg-6 col-md-12">
                                                    <p style="font-weight: bold;"> User : <?= $row['name']?> </p>
                                                    <p style="font-weight: bold;"> Email : <?= $row['u_from']?> </p>
                                                </div>
                                                <div class="col-lg-6 col-md-12 my-auto">
                                                    <button type="button" class="btn btn-fill btn-info btn-sm" onclick="give('<?php echo $row['u_from']; ?>')"><i class="tim-icons icon-controller"></i> Give Access</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $i++; endforeach; ?>
                            </div>
                            <div class="row" id="result2" style="display: none;">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- access granted -->
                <div class="col-lg-4 col-md-12">
                    <div class="card scroll-card">
                        <div class="card-header">
                            <h4 class="card-title" style="font-weight:bold;">Access Grated</h4>
                            <input type="text" class="form-control" id="search" name="search" placeholder="SEARCH" style="background-color: white; color: black; font-weight: 800;" autocomplete = off>
                        </div>
                        <div class="card-body">
                            <div class="row" id="result">
                                <?php 
                                    $i = 1;
                                    foreach($message_0 as $row) :
                                ?>
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title" style="font-weight:bold;">Request <?= $i;?> <span style="color:grey; text-align: right;"><?= $row['time']?></span></h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row" style="vertical-align: middle;">
                                                <div class="col-lg-6 col-md-12">
                                                    <p style="font-weight: bold;"> User : <?= $row['name']?> </p>
                                                    <p style="font-weight: bold;"> Email : <?= $row['u_from']?> </p>
                                                </div>
                                                <div class="col-lg-6 col-md-12 my-auto">
                                                    <button type="button" class="btn btn-fill btn-info btn-sm" onclick="give('<?php echo $row['u_from']; ?>')"><i class="tim-icons icon-controller"></i> Give Access</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $i++; endforeach; ?>
                            </div>
                            <div class="row" id="result2" style="display: none;">
                            </div>
                        </div>
                    </div>
                </div>


                <!-- access Declined -->

                <div class="col-lg-4 col-md-12">
                    <div class="card scroll-card">
                        <div class="card-header">
                            <h4 class="card-title" style="font-weight:bold;">Access Declined</h4>
                            <input type="text" class="form-control" id="search" name="search" placeholder="SEARCH" style="background-color: white; color: black; font-weight: 800;" autocomplete = off>
                        </div>
                        <div class="card-body">
                            <div class="row" id="result">
                                <?php 
                                    $i = 1;
                                    foreach($message_0 as $row) :
                                ?>
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title" style="font-weight:bold;">Request <?= $i;?> <span style="color:grey; text-align: right;"><?= $row['time']?></span></h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row" style="vertical-align: middle;">
                                                <div class="col-lg-6 col-md-12">
                                                    <p style="font-weight: bold;"> User : <?= $row['name']?> </p>
                                                    <p style="font-weight: bold;"> Email : <?= $row['u_from']?> </p>
                                                </div>
                                                <div class="col-lg-6 col-md-12 my-auto">
                                                    <button type="button" class="btn btn-fill btn-info btn-sm" onclick="give('<?php echo $row['u_from']; ?>')"><i class="tim-icons icon-controller"></i> Give Access</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $i++; endforeach; ?>
                            </div>
                            <div class="row" id="result2" style="display: none;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
      <?php $this->load->view('templates/footer') ?>
</div>

  <!-- Setting -->
  <?php $this->load->view('templates/setting') ?>

  <!--   Core JS Files   -->
  <?php $this->load->view('templates/script') ?>

  <!-- Script for searching -->
  <script>
        $(document).ready(function(){
            var result =  document.getElementById("result");
            var result2 =  document.getElementById("result2");
            
            $("#search").keyup(function(){
                if($("#search").val().length>2){
                    result.style.display = "none";
                    result2.style.display = "block";
                    $.ajax({
                        url:"<?php echo base_url();?>index.php/Notification/search_0",
                        method : "POST",
                        data: 'search='+$("#search").val(),
                        dataType : 'json',
                        success:function(data){
                            console.log(data);
                            result2.innerHTML ="";
                            var content ="";
                            var i = 1;
                            if (data != false){
                                $.each(data, function(key,val){
                                    content += "<div class='col-md-12'><div class='card'><div class='card-header'><h4 class='card-title' style='font-weight:bold;'>Request "+i+ "<span style='color:grey; text-align: right;'> " + val.time+"</span></h4></div><div class='card-body'><div class='row' style='vertical-align: middle;'><div class='col-lg-6 col-md-12'><p style='font-weight: bold;'> User : "+val.name+"</p><p style='font-weight: bold;'> Email : "+val.u_from+"</p></div><div class='col-lg-6 col-md-12 my-auto'><button type='button' class='btn btn-fill btn-info btn-sm' onclick='give('"+val.u_from+"')'><i class='tim-icons icon-controller'></i> Give Access</button></div></div></div></div></div>";
                                    i++;
                                });
                                result2.innerHTML = content;
                            } else{ //data tidak ditemukan
                                result2.innerHTML = "<br><p style='text-align: center; font-weight: bold;'> No Rooms Found ! </p>"
                            }
                            
                        }
                    });
                }else{
                    result.style.display = "block";
                    result2.style.display = "none";
                }
            });
        });
      
</script>

    <!-- END Script for searching -->

<!-- Script auto  -->
<script>
    var result =  document.getElementById("result");
    var result_granted =  document.getElementById("result_granted");
    $(document).ready(function() {
      setInterval(function(){
        // for access request
        $.ajax({
            url:"<?php echo base_url();?>index.php/Notification/auto_0",
            dataType : 'json',
            success:function(data){
                result.innerHTML ="";
                var content_0 ="";
                var counter_0 = 1;
                if (data != false){
                    $.each(data, function(key,val){
                        content_0 += "<div class='col-md-12'><div class='card'><div class='card-header'><h4 class='card-title' style='font-weight:bold;'>Request "+counter_0+ "<span style='color:grey; text-align: right;'> " + val.time+"</span></h4></div><div class='card-body'><div class='row' style='vertical-align: middle;'><div class='col-lg-6 col-md-12'><p style='font-weight: bold;'> User : "+val.name+"</p><p style='font-weight: bold;'> Email : "+val.u_from+"</p></div><div class='col-lg-6 col-md-12 my-auto'><button type='button' class='btn btn-fill btn-info btn-sm' onclick='give('"+val.u_from+"')'><i class='tim-icons icon-controller'></i> Give Access</button></div></div></div></div></div>";
                        counter_0++;
                    });
                    result.innerHTML = content;
                } else{ //data tidak ditemukan
                    result.innerHTML = "<br><p style='text-align: center; font-weight: bold;'> No Request Found ! </p>"
                }
            }
        });

        //for access granted
        $.ajax({
            url:"<?php echo base_url();?>index.php/Notification/auto_1",
            dataType : 'json',
            success:function(data){
                result_granted.innerHTML ="";
                var content_1 ="";
                var counter_1 = 1;
                $.each(data, function(key,val){
                     content_1 += "<div class='col-md-12'><div class='card'><div class='card-header'><h4 class='card-title' style='font-weight:bold;'>Request "+counter_1+ "<span style='color:grey; text-align: right;'> " + val.time+"</span></h4></div><div class='card-body'><div class='row' style='vertical-align: middle;'><div class='col-lg-6 col-md-12'><p style='font-weight: bold;'> User : "+val.name+"</p><p style='font-weight: bold;'> Email : "+val.u_from+"</p></div><div class='col-lg-6 col-md-12 my-auto'><button type='button' class='btn btn-fill btn-info btn-sm' onclick='give('"+val.u_from+"')'><i class='tim-icons icon-controller'></i> Give Access</button></div></div></div></div></div>";
                    counter_1++;
                });

            }
        });
      }, 1000);
    });
  </script>

<!-- <script>
    function request(room_id)
    {
        $.ajax({
            url:"<?php echo base_url();?>index.php/Find/request",
            method : "POST",
            data: {room_id: room_id},
            dataType : 'json',
            success:function(data){
                if(data == true){ //never asking for a request
                    Swal.fire(
                        'Request Has been Sent',
                        'Please Wait for The Owner to Giving you Access!',
                        'success'
                    )
                }else{
                    Swal.fire({
                        icon: 'info',
                        title: 'Oops...',
                        text: 'You have already requesting access to this room!',
                        footer: '<a href="<?php echo base_url();?>Notification">See Notification</a>'
                    });
                }
                         
            }
        });
    }
</script> -->
</body>

</html>