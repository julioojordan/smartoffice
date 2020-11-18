<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->

	<link rel="icon" type="image/png" href="<?php echo base_url().'assets/login/images/icons/favicon.ico'?>" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/login/vendor/bootstrap/css/bootstrap.min.css'?>">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css'?>">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/login/vendor/animate/animate.css'?>">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/login/vendor/css-hamburgers/hamburgers.min.css'?>">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/login/vendor/select2/select2.min.css'?>">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/login/css/util.css'?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/login/css/main.css'?>">
	<!--===============================================================================================-->
</head>

<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="<?php echo base_url().'assets/login/images/img-01.png'?>" alt="IMG">
				</div>

				<form class="login100-form validate-form">
					<span class="login100-form-title">
						Login
					</span>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="email" id="email" placeholder="Email..." autocomplete="off" required
						>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="password" name="password" id="password" placeholder="Password..."
							autocomplete="off" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="button" onclick="login()">
							<b>Login</b>
						</button>
					</div>

					<div class="text-center p-t-136">
                        Don't have an account ?
						<a class="p-t-136" href="<?php echo base_url().'Login/signup'?>">
							<strong>Sign Up</strong>
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>




	<!--===============================================================================================-->

	<script src="<?php echo base_url().'assets/login/vendor/jquery/jquery-3.2.1.min.js'?>"></script>
	<!--===============================================================================================-->
	<script src="<?php echo base_url().'assets/login/vendor/bootstrap/js/popper.js'?>"></script>
	<script src="<?php echo base_url().'assets/login/vendor/bootstrap/js/bootstrap.min.js'?>"></script>
	<!--===============================================================================================-->
	<script src="<?php echo base_url().'assets/login/vendor/select2/select2.min.js'?>"></script>
	<!--===============================================================================================-->
	<script src="<?php echo base_url().'assets/login/vendor/tilt/tilt.jquery.min.js'?>"></script>
	<script>
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>


	<!--===============================================================================================-->
	<script src="<?php echo base_url().'assets/login/scripts/main2.js'?>"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

	<script>
		function login(){
			var email =document.getElementById('email').value;
			var password =document.getElementById('password').value;
            $.ajax({
                url:"<?php echo base_url();?>index.php/Login/auth",
                method : "POST",
                data: {email: email, password: password},
                dataType : 'json',
                success:function(data){
                console.log(data);
					if (data == 'success'){ // data not found
						window.location.href = "<?php echo base_url();?>Dashboard";
					}else if(data == 'failed'){
						
                        Swal.fire({
							icon: 'error',
							title: 'Oops..',
							text: 'Account Not Found !',
							footer: '<a href="<?php echo base_url() . 'Login/signup' ?>"> Sign Up Now !</a>'
						});
                    }else if(data=='server_on'){
						window.location.href = "<?php echo base_url();?>ServerControl";
					}else if(data=='server_off'){
						Swal.fire({
							icon: 'error',
							title: 'Cannot Login At This Time',
							text: 'Server is not Ready !'
						});
					}
                    
                }
            });
		}
	</script>

    <?php if ($this->session->flashdata('done')) : ?>
        <script>
            Swal.fire(
                'Sign Up Complete',
                'You Can Login Now ! ',
                'success'
            )
        </script>
    <?php endif; ?>

</body>

</html>