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
                    <h4 class="card-title"> Change Your Password Here !</h4>
                </div>
                <div class="card-body">
                    <form>
                    <div class="row">
                        <div class="col-md-12 pr-md-1">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" id = "user_password" class="form-control" placeholder="Your Password" required >
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 pr-md-1">
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" id = "new_password" class="form-control" placeholder="Your Password" required onchange="appear()">
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 pr-md-1">
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" id = "confirm_password" class="form-control" placeholder="Your Password" required onchange="appear()">
                        </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" id="save" class="btn btn-fill btn-primary" style="display : none;" onclick="savedata()">Save</button>
                    
                    </form>
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

  <script>
        var Change = false;
		function savedata(){
            var user_password =document.getElementById('user_password').value;
            var new_password =document.getElementById('new_password').value;
            var confirm_password =document.getElementById('confirm_password').value;
            $.ajax({
                url:"<?php echo base_url();?>index.php/User/savedata_password",
                method : "POST",
                data: {user_password: user_password, new_password: new_password, confirm_password: confirm_password},
                dataType : 'json',
                success:function(data){
                console.log(data);
					if (data == 'success'){
						window.location.href = "<?php echo base_url();?>Dashboard";
					}else if(data == 'pass_wrong'){
                        Swal.fire({
							icon: 'error',
							title: 'Attention..',
							text: 'Password Wrong !'
						});
                    }else if(data == 'pass_different'){
                        Swal.fire({
							icon: 'error',
							title: 'Attention..',
							text: "New Password Didn't Match!"
						});
                    }
                
                }
            });
		}
        
		function appear(){
			document.getElementById('save').style.display = "block";
        }
    </script>

</body>

</html>