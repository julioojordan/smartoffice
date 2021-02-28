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
          <div class="col-lg-4">
            <div class="card">
              <div class="card-header">
                <h5 class="card-category">Menu 1</h5>
                <h3 class="card-title" style="text-transform: capitalize;"><i class="tim-icons icon-single-02"></i> &nbsp; Add User</h3>
              </div>
              <div class="card-body">
                <div class="row" style="vertical-align: middle; text-align: center;">
                  <div class="col-lg-6 col-md-12">
                    <i class="fas fa-users fa-7x"></i>
                  </div>
                  <div class="col-lg-6 col-md-12 my-auto">
                      <div class="mid">
                        <button type="button" class="btn btn-fill btn-primary btn-sm" data-toggle="modal" data-target="#addUserModal"><i class='tim-icons icon-simple-add'> Add</i></button>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="card">
              <div class="card-header">
                <h5 class="card-category">Menu 2</h5>
                <h3 class="card-title" style="text-transform: capitalize;"><i class="tim-icons icon-single-02"></i> &nbsp; Total User</h3>
              </div>
              <div class="card-body">
                <div class="row" style="vertical-align: middle; text-align: center;">
                  <div class="col-lg-6 col-md-12">
                    <i class="fas fa-users fa-7x"></i>
                  </div>
                  <div class="col-lg-6 col-md-12 my-auto">
                      <div class="mid">
                        <h3 id="total_user">  </h3>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="card">
              <div class="card-header">
                <h5 class="card-category">Menu 3</h5>
                <h3 class="card-title" style="text-transform: capitalize;"><i class="tim-icons icon-single-02"></i> &nbsp; User Online</h3>
              </div>
              <div class="card-body">
                <div class="row" style="vertical-align: middle; text-align: center;">
                  <div class="col-lg-6 col-md-12">
                    <i class="fas fa-users fa-7x"></i>
                  </div>
                  <div class="col-lg-6 col-md-12 my-auto">
                      <div class="mid">
                        <h3 id="user_online">  </h3>
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
  </div>

  <!-- Setting -->
  <?php $this->load->view('templates/setting') ?>

  <!--   Core JS Files   -->
  <?php $this->load->view('templates/script') ?>

  <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Input User ID and Room Type</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="post" action="<?php echo base_url() . 'DashboardAdmin/addUser' ?>">
                  <div class="form-group">
                      <label>User ID</label>
                      <input type="text" id = "user_id" name = "user_id" class="form-control" style="color : black;" placeholder="Max 25 character" required>
                  </div>
                  <div class="form-group">
                      <label>Room Type</label>
                      <select id="room_type" name = "room_type" required>
                        <?php foreach($room_type as $row) : ?>
                          <option value="<?=$row['id_type']; ?>"><?=$row['type_name']; ?></option>
                        <?php endforeach; ?>
                      </select>
                  </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Add</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <?php if ($this->session->flashdata('added')) : ?>
        <script type="text/javascript">
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Account Has Been Added !',
            });
        </script>
  <?php endif; ?>

  <script>
    $(document).ready(function() {
      setInterval(function(){
         $.ajax({
            url:"<?php echo base_url();?>index.php/DashboardAdmin/get_user",
            dataType : 'json',
            success:function(data){
              //onsole.log(data);
              document.getElementById('total_user').innerHTML = data[0];
              document.getElementById('user_online').innerHTML = data[1];
            }
        });
      }, 1000);
    });
  </script>
  
</body>

</html>