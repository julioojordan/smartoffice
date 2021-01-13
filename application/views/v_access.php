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
          <div class="col-lg-12 col-md-12">
            <div class="card ">
              <div class="card-header">
                <h4 class="card-title"> Your Access to Other's Rooms </h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table tablesorter" id = "table-1" width=100%>
                    <thead class=" text-primary">
                      <tr>
                        <th style="text-align:center;"> No </th>
                        <th style="text-align:center;"> Room Id </th>
                        <th style="text-align:center;"> Owner </th>
                        <th style="text-align:center;"> Action </th>
                      </tr>
                    </thead>
                    <tbody id="table_body_access">
                        <?php if($access):
                            $i = 1;
                            foreach($access as $row):
                        ?>
                            <tr>
                                <td style="text-align:center;"><?=$i?></td>
                                <td style="text-align:center;"><?=$row['room_id']?></td>
                                <td style="text-align:center;"><?=$row['name']?></td>
                                <td style="text-align:center;"><a href='<?php echo base_url();?>Access/rooms/<?=$row['token']?>'><button type='button' class='btn btn-fill btn-info btn-sm'><i class='tim-icons icon-controller'>&nbsp; Access</i></button></a></td>
                            </tr>
                        <?php
                            $i++;
                            endforeach;
                            else:
                        ?>
                            <tr>
                                <td style="text-align:center;" colspan="4">You Have no Access to other's Rooms</td>
                            </tr>
                        <?php endif; ?>

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

    $(document).ready(function() {
      setInterval(function(){

        //guest
        // $.ajax({
        //     url:"<?php echo base_url();?>index.php/Dashboard/auto_guest",
        //     dataType : 'json',
        //     success:function(data){
        //         if (data == false){//no guest
        //             table_body_guest.innerHTML = "<td style='text-align:center;' colspan='6'>You Have no Guest</td>"
        //         }else{
        //             table_body_guest.innerHTML = "";
        //             var i = 1;
        //             $.each(data, function(key,val){
        //               table_body_guest.innerHTML += "<tr><td style='text-align:center;'>"+i+"</td><td style='text-align:center;'>"+val.user_id+"</td><td style='text-align:center;'>"+val.name+"</td><td style='text-align:center;'>"+val.user_email+"</td></tr>";
        //               i++ ;
        //             });
        //         }
        //     }
        // });

        //access
        // $.ajax({
        //     url:"<?php echo base_url();?>index.php/Dashboard/auto_access",
        //     dataType : 'json',
        //     success:function(data){
        //         if (data == false){//no guest
        //             table_body_access.innerHTML = "<td style='text-align:center;' colspan='6'>You Have no Access to other's Rooms</td>"
        //         }else{
        //             table_body_access.innerHTML = "";
        //             var j = 1;
        //             $.each(data, function(key,val){
        //               table_body_access.innerHTML += "<tr><td style='text-align:center;'>"+j+"</td><td style='text-align:center;'>"+val.user_id+"</td><td style='text-align:center;'>"+val.name+"</td><td style='text-align:center;'><a href='<?php echo base_url();?>index.php/Access/rooms/"+val.token+"'><button type='button' class='btn btn-fill btn-info btn-sm'><i class='tim-icons icon-controller'>&nbsp; Access</i></button></a></td></tr>";
        //               j++ ;
        //             });
        //         }
        //     }
        // });
      }, 1000);
    });
  </script>

 
  
</body>

</html>