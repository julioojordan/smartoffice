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
                <div class="col-lg-12 col-md-12">
                    <div class="card scroll-card">
                        <div class="card-header">
                            <h4 class="card-title" style="font-weight:bold;">Access Request</h4>
                            <input type="text" class="form-control" id="search" name="search" placeholder="SEARCH" style="background-color: white; color: black; font-weight: 800;" autocomplete = off>
                        </div>
                        <div class="card-body">
                            <div class="row" id="result">
                                <?php 
                                    $i = 1;
                                    foreach($message_1 as $row) :
                                ?>
                                <!-- <div class="col-md-12">
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
                                                    <button type="button" class="btn btn-fill btn-info btn-sm" onclick="giveAccess(<?php echo $row['user_id']; ?>, <?php echo $row['id']; ?>)"><i class="tim-icons icon-controller"></i> Give Access</button>
                                                    <button type="button" class="btn btn-fill btn-danger btn-sm" onclick="declineAccess(<?php echo $row['user_id']; ?>, <?php echo $row['id']; ?>)"><i class="tim-icons icon-controller"></i> Decline Access</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <?php $i++; endforeach; ?>
                            </div>
                            <div class="row" id="result2" style="display: none;">

                            </div>
                        </div>
                    </div>
                </div>

                <!-- History -->
                <div class="col-lg-12 col-md-12">
                    <div class="card scroll-card">
                        <div class="card-header">
                            <h4 class="card-title" style="font-weight:bold;">History (show only last 10 data)</h4>
                            <!-- <input type="text" class="form-control" id="search_history" name="search_history" placeholder="SEARCH" style="background-color: white; color: black; font-weight: 800;" autocomplete = off> -->
                        </div>
                        <div class="card-body">
                            <div class="row" id="history_result">
                    
                            </div>
                            <div class="row" id="history_result2" style="display: none;">

                            </div>
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

           //access request 
            //$("#search").keyup(function(){
            $(document).on("keyup", "#search", function() {
                if($("#search").val().length>2){
                    result.style.display = "none";
                    result2.style.display = "block";
                    $.ajax({
                        url:"<?php echo base_url();?>index.php/Notification/search_1",
                        method : "POST",
                        data: 'search='+$("#search").val(),
                        dataType : 'json',
                        success:function(data){
                            result2.innerHTML ="";
                            var content ="";
                            var i = 1;
                            if (data != false){
                                $.each(data, function(key,val){
                                    
                                    content += "<div class='col-md-12'><div class='card'><div class='card-header'><h4 class='card-title' style='font-weight:bold;'>Request "+i+ "<span style='color:grey; text-align: right;'> " + val.time+"</span></h4></div><div class='card-body'><div class='row' style='vertical-align: middle;'><div class='col-lg-6 col-md-12'><p style='font-weight: bold;'> User : "+val.name+"</p><p style='font-weight: bold;'> Email : "+val.u_from+"</p></div><div class='col-lg-6 col-md-12 my-auto'><button type='button' class='btn btn-fill btn-info btn-sm' onclick='giveAccess("+val.user_id+", "+val.id+")'><i class='tim-icons icon-controller'></i> Give Access</button><button type='button' class='btn btn-fill btn-danger btn-sm' onclick='declineAccess("+val.user_id+", "+val.id+")'><i class='tim-icons icon-controller'></i> Decline Access</button></div></div></div></div></div>";
                                    i++;
                                });
                                result2.innerHTML = content;
                            } else{ //data tidak ditemukan
                                result2.innerHTML = "<br><p style='text-align: center; font-weight: bold;'> No Request Found ! </p>"
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
    var result2 =  document.getElementById("result2");

    var history_result =  document.getElementById("history_result");
    var history_result2 =  document.getElementById("history_result2");
    $(document).ready(function() {
      setInterval(function(){
        // for access request
        if (document.getElementById("search").value.length == 0 ){
            $.ajax({
                url:"<?php echo base_url();?>index.php/Notification/auto_1",
                dataType : 'json',
                success:function(data){
                    result.innerHTML ="";
                    var content_3 ="";
                    var counter_0 = 1;
                    if (data != false){
                        result.style.display = "block";
                        result2.style.display = "none";
                        $.each(data, function(key,val){
                            content_3 += '<div class="col-md-12"><div class="card"><div class="card-header"><h4 class="card-title" style="font-weight:bold;">Request '+counter_0+ '<span style="color:grey; text-align: right;"> ' + val.time+'</span></h4></div><div class="card-body"><div class="row" style="vertical-align: middle;"><div class="col-lg-6 col-md-12"><p style="font-weight: bold;"> User : '+val.name+'</p><p style="font-weight: bold;"> User ID : '+val.u_from+'</p></div><div class="col-lg-6 col-md-12 my-auto"><button type="button" class="btn btn-fill btn-info btn-sm" onclick="giveAccess('+val.user_id+' ,'+val.id+')"><i class="tim-icons icon-controller"></i> Give Access</button><button type="button" class="btn btn-fill btn-danger btn-sm" onclick="declineAccess('+val.user_id+', '+val.id+')"><i class="tim-icons icon-controller"></i> Decline Access</button></div></div></div></div></div>';
                            counter_0++;
                        });
                        result.innerHTML = content_3;
                    } else{ //data tidak ditemukan
                        result.innerHTML = "";
                        result.style.display = "none";
                        result2.style.display = "block";
                        result2.innerHTML = "<br><p style='text-align: center; font-weight: bold;' id='not_found'> No Request Found ! </p>";
                    }
                }
            });
        }

        //for history
        // if (document.getElementById("search_history").value.length == 0 ){
            $.ajax({
                url:"<?php echo base_url();?>index.php/Notification/auto_history",
                dataType : 'json',
                success:function(data){
                    history_result.innerHTML ="";
                    var content_history ="";
                    var counter = 1;
                    if (data != false){
                        history_result.style.display = "block";
                        history_result2.style.display = "none";
                        $.each(data, function(key,val){
                            if(val.message == 2){
                                var badge = "info";
                                var info = "Granted";
                            }else{
                                var badge = "danger";
                                var info = "Declined";
                            }
                            content_history += '<div class="col-md-12"><div class="card"><div class="card-header"><h4 class="card-title" style="font-weight:bold;">No. '+counter+' <span style="color:grey; text-align: right;">'+val.time+'</span></h4> </div><div class="card-body"><div class="row" style="vertical-align: middle;"><div class="col-lg-6 col-md-12"><p style="font-weight: bold;"> User : '+val.name+' </p><p style="font-weight: bold;"> User ID : '+val.u_from+' </p></div><div class="col-lg-6 col-md-12 my-auto" style="text-align : center;"><button type="button" class="btn btn-'+badge+ ' btn-lg" disabled>'+info+'</button></div></div></div></div></div>';
                            counter++;
                        });
                        history_result.innerHTML = content_history;
                    } else{ //data tidak ditemukan
                        history_result.innerHTML = "";
                        history_result.style.display = "none";
                        history_result2.style.display = "block";
                        history_result2.innerHTML = "<br><p style='text-align: center; font-weight: bold;' id='not_found'> No Data Found ! </p>";
                    }
                }
            });
       // }
      }, 1000);
    });
</script>

<script>
    function giveAccess(id_user_from, id_message)
    {
        //console.log(id_user_from);
        Swal.fire({
            title: 'Attention',
            text: "Are You Sure Want To Give Your Room Access ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Give'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:"<?php echo base_url();?>Notification/give_access",
                    method : "POST",
                    data: {id_user_from: id_user_from, id_message: id_message},
                    dataType : 'json',
                    success:function(data){
                        //window.location.reload();
                        Swal.fire(
                            'Success',
                            'Access Given ! ',
                            'success'
                        )
                    }
                });  
            }
        });
    }

    function declineAccess(id_user_from, id_message)
    {
        //console.log(id_user_from);
        Swal.fire({
            title: 'Attention',
            text: "Are You Sure Want To Decline This Room Access ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Decline'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:"<?php echo base_url();?>Notification/decline_access",
                    method : "POST",
                    data: {id_user_from: id_user_from, id_message: id_message},
                    dataType : 'json',
                    success:function(data){
                        //window.location.reload();
                        Swal.fire(
                            'Success',
                            'Access Declined ! ',
                            'success'
                        )
                    }
                });  
            }
        });
    }
</script>

</body>

</html>