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
          <div class="col-lg-8 col-md-12">
            <div class="card ">
              <div class="card-header">
                <h4 class="card-title"> Device Available <span class="float-right" style="display : none"><button type="button" class="btn btn-fill btn-primary btn-sm" data-toggle="modal" data-target="#modalAdd"><i class="tim-icons icon-simple-add"></i></button></span></h4>
                <small>Room id : <?= $room_id ?></small>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table tablesorter"">
                    <thead class=" text-primary">
                      <tr>
                        <th class="text-center">
                          No
                        </th>
                        <th>
                          Type
                        </th>
                        <th>
                          Device Name
                        </th>
                        <th class="text-center">
                          Action
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if ($devices):
                                $i = 1 ;
                                foreach($devices as $row) :
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $i; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['device_name']; ?></td>
                            <td class="text-center">
                                <?php if ($row['guest'] == 1) : ?>

                                <a href="#" class="btn btn-danger btn-danger-split btn-sm" onclick="disable('<?php echo $row['device_id']; ?>')">
                                    <span class="icon text-white-50">
                                    <i class="tim-icons icon-simple-remove"></i> Disable
                                    </span>
                                </a> &nbsp;
                                <?php else : ?>
                                  <a href="#" class="btn btn-info btn-info-split btn-sm" onclick="enable('<?php echo $row['device_id']; ?>')">
                                    <span class="icon text-white-50">
                                    <i class="tim-icons icon-simple-remove"></i> Enable
                                    </span>
                                  </a> &nbsp;
                                <?php endif ; ?>
                            </td>
                        </tr>
                        <?php 
                            $i++ ;
                            endforeach;
                            else: ?>
                        <tr>
                            <td colspan="4" class="text-center">No Device Available!</td>
                        </tr>

                        <?php    
                            endif;
                        ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-12">
            <div class="card ">
              <div class="card-header">
                <h4 class="card-title"> Automation </h4>
              </div>
              <div class="card-body">
                <div calss="row">
                  <input type="number" class="form-control col-md-12" id="set" name="set" placeholder="Set Timer (in minutes)" style="background-color: white; color: black; font-weight: 800;" autocomplete = off>
                  <button type="button" class="btn btn-fill btn-info btn-sm" onclick="set_timer()"><i class="fa fa-cog"></i> Set</button>
                </div>
                <br>
                <div calss="row">
                  <div class="center">
                      <h5 id="automation"></h5>
                      <input type="checkbox" id="auto_checkbox" name="auto" class="a" disabled/>
                  </div>
                </div>
                <div calss="row">
                  <h5> Automation Timer : <span id="timer"></span> Minutes</h5>
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

  <!-- Modal Add Device -->
    <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Device</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
            </div>
        </div>
    </div>

  <!-- Script for deleting devices -->
  <script>
      function enable(id){
        Swal.fire({
                title: 'Are You Sure Want to Enable This Device?',
                text: "Guest can use this device if you enable it!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Enable!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url:"<?php echo base_url();?>index.php/MyRoom/enable_device",
                        method : "POST",
                        data: {id: id},
                        dataType : 'json',
                        success:function(data){
                            window.location.reload();
                        }
                    });  
                }
            })
      }

      function disable(id){
        Swal.fire({
                title: 'Are You Sure Want to Disable This Device?',
                text: "Guest can't use this device if you disable it!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Disable!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url:"<?php echo base_url();?>index.php/MyRoom/disable_device",
                        method : "POST",
                        data: {id: id},
                        dataType : 'json',
                        success:function(data){
                            window.location.reload();
                        }
                    });  
                }
            })
      }
      
</script>

<script>

  function set_timer()
  {
    var timer = document.getElementById("set").value;
    $.ajax({
      url:"<?php echo base_url();?>index.php/MyRoom/set_timer",
      method : "POST",
      data: {timer: timer},
      dataType : 'json',
      success:function(data){
        window.location.reload();
      }
    });
  }

  var automation = document.getElementById("automation");
  var timer = document.getElementById("timer");
  var auto_checkbox = document.getElementById("auto_checkbox");
  $(document).ready(function(){
            setInterval(function(){
                $.ajax({
                    url:"<?php echo base_url();?>index.php/MyRoom/user_automation_status",
                    dataType : 'json',
                    success:function(data){
                      $.each(data, function(key,val){
                        if(val.automation == 1){
                          automation.innerHTML = "Automation Enabled !";
                          auto_checkbox.checked = true;
                        }else{
                          automation.innerHTML = "Automation Disabled !";
                          auto_checkbox.checked = false;
                        }
                        timer.innerHTML = val.automation_timer;
                      });
                    }
                });

            }, 1000);
        });
</script>
<?php if ($this->session->flashdata('delete_success')) : ?>
    <script>
        Swal.fire(
            'Success',
            'Device deleted! ',
            'success'
        )
    </script>
<?php endif; ?>

<?php if ($this->session->flashdata('enable_success')) : ?>
    <script>
        Swal.fire(
            'Success',
            'Device enabled for guest! ',
            'success'
        )
    </script>
<?php endif; ?>

<?php if ($this->session->flashdata('disable_success')) : ?>
    <script>
        Swal.fire(
            'Success',
            'Device disabled for guest! ',
            'success'
        )
    </script>
<?php endif; ?>

<?php if ($this->session->flashdata('timer_success')) : ?>
    <script>
        Swal.fire(
            'Success',
            'Automation Timer Has Been Set ! ',
            'success'
        )
    </script>
<?php endif; ?>

    <!-- END Script for deleting devices -->
</body>

</html>