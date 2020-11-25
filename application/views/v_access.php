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
                <div class="col-lg-12 col-md-12">
                    <div class="card ">
                        <div class="card-header">
                            <input type="text" class="form-control" id="search" name="search" placeholder="SEARCH ROOM" style="background-color: white; color: black; font-weight: 800;" autocomplete = off>
                        </div>
                        <div class="card-body" id="result">
                            <div class="row">
                                <?php 
                                    foreach($rooms as $row) :
                                    if($row['status1'] == 0){//offline
                                        $dot = "grey";
                                        $k1 = "Offline";
                                    } elseif($row['status1'] == 1){
                                        $dot = "yellow";
                                        $k1 = "Idle";
                                    } elseif($row['status1'] == 2){
                                        $dot = "green";
                                        $k1 = "Online";
                                    }
                                ?>
                                <div class="col-lg-4 col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title" style="font-weight:bold;">Room Id #<span style="color:grey;"><?= $row['room_id']?></span></h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row" style="vertical-align: middle; text-align: center;">
                                                <div class="col-lg-6 col-md-12">
                                                    <p style="font-weight: bold;"> Owner : <?= $row['name']?> </p>
                                                    <p> <i class="fas fa-circle" style="color: <?= $dot;?>;"></i> <?= $k1;?> </p>
                                                    <?php if($row['status1'] == 2) : ?>
                                                    <p><?= $row['status2'];?></p> 
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-lg-6 col-md-12 my-auto">
                                                    <button type="button" class="btn btn-fill btn-info btn-sm" onclick="request('<?php echo $row['room_id']; ?>')"><i class="tim-icons icon-controller"></i> Request Access</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="card-body" id="result2" style="display: none;">
                        </div>
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

  <!-- Script for searching -->
  <script>
        $(document).ready(function(){
            var result =  document.getElementById("result");
            var result2 =  document.getElementById("result2");
            var dot = "";
            var k1 = "";
            $("#search").keyup(function(){
                if($("#search").val().length>1){
                    result.style.display = "none";
                    result2.style.display = "block";
                    $.ajax({
                        url:"<?php echo base_url();?>index.php/Find/search",
                        method : "POST",
                        data: 'search='+$("#search").val(),
                        dataType : 'json',
                        success:function(data){
                            //console.log(data);
                            if (data != false){
                                $.each(data, function(key,val){
                                    if (val.status1 == 0){
                                        dot = "grey";
                                        k1 = "Offline";
                                        result2.innerHTML = "<div class='col-lg-4 col-md-6'> <div class='card'><div class='card-header'><h4 class='card-title' style='font-weight:bold;'>Room Id #<span style='color:grey;'>"+val.room_id+"</span></h4></div><div class='card-body'><div class='row' style='vertical-align: middle; text-align: center;'><div class='col-lg-6 col-md-12'><p style='font-weight: bold;'> Owner : "+val.name+" </p><p> <i class='fas fa-circle' style='color: "+dot+";'></i> "+k1+" </p></div><div class='col-lg-6 col-md-12 my-auto'><button type='button' class='btn btn-fill btn-info btn-sm' onclick='request('"+val.room_id+"')'><i class='tim-icons icon-controller'></i> Request Access</button></div></div></div></div></div>";
                                    }else if (val.status1 == 1){
                                        dot = "yellow";
                                        k1 = "Idle";
                                        result2.innerHTML = "<div class='col-lg-4 col-md-6'> <div class='card'><div class='card-header'><h4 class='card-title' style='font-weight:bold;'>Room Id #<span style='color:grey;'>"+val.room_id+"</span></h4></div><div class='card-body'><div class='row' style='vertical-align: middle; text-align: center;'><div class='col-lg-6 col-md-12'><p style='font-weight: bold;'> Owner : "+val.name+" </p><p> <i class='fas fa-circle' style='color: "+dot+";'></i> "+k1+" </p></div><div class='col-lg-6 col-md-12 my-auto'><button type='button' class='btn btn-fill btn-info btn-sm' onclick='request('"+val.room_id+"')'><i class='tim-icons icon-controller'></i> Request Access</button></div></div></div></div></div>";
                                    }else if(val.status1 == 2){
                                        dot = "green";
                                        k1 = "Online";
                                        result2.innerHTML = "<div class='col-lg-4 col-md-6'> <div class='card'><div class='card-header'><h4 class='card-title' style='font-weight:bold;'>Room Id #<span style='color:grey;'>"+val.room_id+"</span></h4></div><div class='card-body'><div class='row' style='vertical-align: middle; text-align: center;'><div class='col-lg-6 col-md-12'><p style='font-weight: bold;'> Owner : "+val.name+" </p><p> <i class='fas fa-circle' style='color: "+dot+";'></i> "+k1+" </p><p>"+val.status2+"</p></div><div class='col-lg-6 col-md-12 my-auto'><button type='button' class='btn btn-fill btn-info btn-sm' onclick='request('"+val.room_id+"')'><i class='tim-icons icon-controller'></i> Request Access</button></div></div></div></div></div>";
                                    }
                                });
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
<!-- <script>
    var result =  document.getElementById("result");
    $(document).ready(function() {
      setInterval(function(){
         $.ajax({
            url:"<?php echo base_url();?>index.php/Find/auto",
            dataType : 'json',
            success:function(data){
                result.innerHTML ="";
                $.each(data, function(key,val){
                    if (val.status1 == 0){
                        dot = "grey";
                        k1 = "Offline";
                        result.innerHTML += "<div class='col-lg-4 col-md-6'> <div class='card'><div class='card-header'><h4 class='card-title' style='font-weight:bold;'>Room Id #<span style='color:grey;'>"+val.room_id+"</span></h4></div><div class='card-body'><div class='row' style='vertical-align: middle; text-align: center;'><div class='col-lg-6 col-md-12'><p style='font-weight: bold;'> Owner : "+val.name+" </p><p> <i class='fas fa-circle' style='color: "+dot+";'></i> "+k1+" </p></div><div class='col-lg-6 col-md-12 my-auto'><button type='button' class='btn btn-fill btn-info btn-sm' onclick='request('"+val.room_id+"')'><i class='tim-icons icon-controller'></i> Request Access</button></div></div></div></div></div>";
                    }else if (val.status1 == 1){
                        dot = "yellow";
                        k1 = "Idle";
                        result.innerHTML += "<div class='col-lg-4 col-md-6'> <div class='card'><div class='card-header'><h4 class='card-title' style='font-weight:bold;'>Room Id #<span style='color:grey;'>"+val.room_id+"</span></h4></div><div class='card-body'><div class='row' style='vertical-align: middle; text-align: center;'><div class='col-lg-6 col-md-12'><p style='font-weight: bold;'> Owner : "+val.name+" </p><p> <i class='fas fa-circle' style='color: "+dot+";'></i> "+k1+" </p></div><div class='col-lg-6 col-md-12 my-auto'><button type='button' class='btn btn-fill btn-info btn-sm' onclick='request('"+val.room_id+"')'><i class='tim-icons icon-controller'></i> Request Access</button></div></div></div></div></div>";
                    }else if(val.status1 == 2){
                        dot = "green";
                        k1 = "Online";
                        result.innerHTML += "<div class='col-lg-4 col-md-6'> <div class='card'><div class='card-header'><h4 class='card-title' style='font-weight:bold;'>Room Id #<span style='color:grey;'>"+val.room_id+"</span></h4></div><div class='card-body'><div class='row' style='vertical-align: middle; text-align: center;'><div class='col-lg-6 col-md-12'><p style='font-weight: bold;'> Owner : "+val.name+" </p><p> <i class='fas fa-circle' style='color: "+dot+";'></i> "+k1+" </p><p>"+val.status2+"</p></div><div class='col-lg-6 col-md-12 my-auto'><button type='button' class='btn btn-fill btn-info btn-sm' onclick='request('"+val.room_id+"')'><i class='tim-icons icon-controller'></i> Request Access</button></div></div></div></div></div>";
                    }
                });

            }
        });
      }, 1000);
    });
  </script> -->

<script>
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
</script>
</body>

</html>