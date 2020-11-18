<!DOCTYPE html>
<html>
<head>
  <title>Server</title>
</head>
<body style="text-align: center;">
    <h1>Server is Running</h1>
    <button type="button" onclick="stop_server()">Stop</button>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>


    <script>
		function stop_server(){
            Swal.fire({
                title: 'Do You Want to Stop The Server?',
                text: "Website will be unavailable until you turn it on again!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Stop!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url:"<?php echo base_url();?>ServerControl/stop",
                        dataType : 'json',
                        success:function(data){
                            window.location.href = "<?php echo base_url();?>LandingPage";
                        }
                    });  
                }
            })
		}

        $(document).ready(function(){
            setInterval(function(){
                $.ajax({
                    url:"<?php echo base_url();?>index.php/ServerControl/user_status",
                    dataType : 'json',
                    success:function(data){
                        console.log(data);
                    }
                });
            }, 1000);
        });
    </script>
    
    
</body>
</html>