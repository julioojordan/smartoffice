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
                <?php if ($this->session->userdata('email') != NULL) : ?>
                <div class="card-header">
                    <h4 class="card-title"> Profile</h4>
                </div>
                <div class="card-body">
                    <form>
                    <div class="row">
                        <div class="col-md-6 pr-md-1">
                        <div class="form-group">
                            <label>User ID (disabled)</label>
                            <input type="text" id = "user_id" class="form-control" disabled="" value="<?=$this->session->userdata('user_id')?>">
                        </div>
                        </div>
                        <div class="col-md-6 px-md-1">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" id = "user_email" class="form-control" placeholder="Email" value="<?=$this->session->userdata('email')?>" onchange="appear()">
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" id = "user_name" class="form-control" placeholder="Name" value="<?=$this->session->userdata('name')?>" onchange="appear()">
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 pr-md-1">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" id = "user_password" class="form-control" placeholder="Your Password" required>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" id="save" class="btn btn-fill btn-primary" style="display : none;" onclick="savedata()">Save</button>
                    
                    </form>
                </div>
              
                <!-- if email hasn't registered -->
                <?php else : ?> 
                <div class="card-header">
                    <h4 class="card-title"> Complete Your Profile!</h4>
                </div>
                <div class="card-body">
                    <form>
                    <div class="row">
                        <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" id = "register_email" class="form-control" placeholder="Input Your Email !" required>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" id = "register_name" class="form-control" placeholder="Input Your Name !" required>
                        </div>
                        </div>
                    </div>
                    
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-fill btn-primary" onclick="register()">Save</button>
                </div>
                </form>
                <?php endif; ?>
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
			var user_id =document.getElementById('user_id').value;
            var user_email =document.getElementById('user_email').value;
			var user_name =document.getElementById('user_name').value;
            var user_password =document.getElementById('user_password').value;
            $.ajax({
                url:"<?php echo base_url();?>index.php/User/savedata",
                method : "POST",
                data: {user_id: user_id, user_email: user_email , user_name: user_name , user_password: user_password},
                dataType : 'json',
                success:function(data){
                console.log(data);
					if (data == 'success'){
						window.location.href = "<?php echo base_url();?>Dashboard";
					}else if(data == 'email_used'){
                        Swal.fire({
							icon: 'error',
							title: 'Attention..',
							text: 'Email Already Used !'
						});
                    }else if(data == 'pass_wrong'){
                        Swal.fire({
							icon: 'error',
							title: 'Attention..',
							text: 'Password Wrong !'
						});
                    }
                
                }
            });
		}
        
		function appear(){
			document.getElementById('save').style.display = "block";
        }
        
        function changepassword(){
            document.getElementById('change_password_input').style.display = "block";
            document.getElementById("user_new_password").required;
            document.getElementById("user_confirm_password").required;
            Change = true;
            
		}
    </script>
    
    <script>
		function register(){
			var email =document.getElementById('register_email').value;
			var name =document.getElementById('register_name').value;
            $.ajax({
                url:"<?php echo base_url();?>index.php/User/register",
                method : "POST",
                data: {email: email, name: name},
                dataType : 'json',
                success:function(data){
                console.log(data);
					if (data == 'success'){
						window.location.href = "<?php echo base_url();?>Dashboard";
					}else if(data == 'email_used'){
                        Swal.fire({
							icon: 'error',
							title: 'Attention..',
							text: 'Email Already Used !'
						});
                    } 
                }
            });
		}
    </script>

</body>

</html>