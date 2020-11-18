<!DOCTYPE html>
<html lang="en" class="ie_11_scroll">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="hhhwidth=device-width, initial-scale=1">
        <title>App Landing Page</title>
<!--

App Landing Template

http://www.templatemo.com/tm-474-app-landing

-->
        <!-- CSS -->
        <link rel="stylesheet" href="<?php echo base_url() . 'assets/landingpage/css/bootstrap.min.css' ?>">
        <link rel="stylesheet" href="<?php echo base_url() . 'assets/landingpage/css/font-awesome.min.css' ?>">
        <link rel="stylesheet" href="<?php echo base_url() . 'assets/landingpage/css/templatemo_style.css' ?>">
        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="<?php echo base_url() . 'assets/landingpage/favicon.png' ?>" />
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <!-- Top menu -->
        <!-- <div class="show-menu">
            <a href="#" class="shadow-top-down">+</a>
        </div> -->
        <!-- <nav class="main-menu shadow-top-down">
            <ul class="nav nav-pills nav-stacked">
                <li><a href="#templatemo_home" class="scroll_effect">Home</a></li>
                <li><a href="#templatemo_features" class="scroll_effect">Features</a></li>
                <li><a href="#templatemo_download" class="scroll_effect">Download</a></li>
                <li><a href="http://www.facebook.com/templatemo" rel="nofollow" target="_parent">Fan Page</a></li>
                <li><a href="elements.html">Elements</a></li>
                <li><a href="#templatemo_contact" class="scroll_effect">Contact</a></li>
            </ul>
        </nav> -->
        <!-- Home -->
        <section id="templatemo_home">
            <div class="container">
                <div class="templatemo_home_inner_wapper">
                    <h1 class="text-center"><i class="fa fa-mobile-phone"></i> Smart Office</h1>
                </div>
                <div class="templatemo_home_inner_wapper">
                    <h2 class="text-center">Beta</h2>
                    <p class="text-center">
                        <a href="<?php echo base_url() . 'Login' ?>" class="btn col-xs-12">
                            <i class="fa fa-user"></i> Login
                        </a>
                    </p>
                    <p class="text-center">
                        Organize your room using the internet as an implementation from Internet of Things.
                    </p>
                </div>
                <div class="templatemo_home_inner_wapper btn_wapper">
                    <div class="col-sm-6">
                        <a href="#templatemo_features" class="btn col-xs-12 scroll_effect shadow-top-down">
                            <i class="fa fa-align-justify"></i> Features
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <a href="#templatemo_download" class="btn col-xs-12 scroll_effect shadow-top-down">
                            <i class="fa fa-download"></i> Download
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!-- Features -->
        <section id="templatemo_features">
            <div class="container-fluid">
                <header class="template_header">
                    <h1 class="text-center"><span>...</span> Features <span>...</span></h1>
                </header>
                <div class="col-sm-12">
                    <div class="col-sm-6 col-lg-3 feature-box">
                        <div class="feature-box-inner">
                            <div class="feature-box-icon">
                                <i class="fa fa-laptop"></i>
                            </div>
                            <p>
                                Manage recognized devices from anywhere using the website by only clicking buttons.
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 feature-box">
                        <div class="feature-box-inner">
                            <div class="feature-box-icon">
                                <i class="fa fa-search"></i>
                            </div>
                            <p>
                                Find out if someone is in their rooms or not by being a guest.
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 feature-box">
                        <div class="feature-box-inner">
                            <div class="feature-box-icon">
                                <i class="fa fa-users"></i>
                            </div>
                            <p>
                                Register yourself as a guest to someone else's room to gain room access.
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 feature-box">
                        <div class="feature-box-inner">
                            <div class="feature-box-icon">
                                <i class="fa fa-database"></i>
                            </div>
                            <p>
                                Store data on tool usage in our database for future use
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Download -->
        <section id="templatemo_download">
            <div class="container">
                <header class="template_header">
                    <h1 class="text-center"><span>...</span> Download <span>...</span></h1>
                </header>
                <div class="templatemo_download_text_wapper">
                    <p>
                        Everyone can download this project from Github by clicking this button.
                    </p>
                </div>
                <div class="col-xs-12">
                    <a href="#" class="shadow-top-down"><img src="<?php echo base_url() . 'assets/landingpage/images/github.jpg' ?>" width="260" heigh="100"/></a>
                </div>
            </div>
        </section>
        <!-- Contact -->
        <section id="templatemo_contact">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <header class="template_header">
                            <h1 class="text-center"><span>...</span> Contact <span>...</span></h1>
                        </header>
                        <p class="text-center">
                            <i class="fa fa-envelope"></i> Email: andyanjordan1153@gmail.com<br />
                            <i class="fa fa-phone"></i> Phone: +62 813-2928-4226
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <ul class="nav nav-pills social">
                            <li><a href="#" class="shadow-top-down social-facebook"><i class="fa fa-facebook-official"></i></a></li>
                            <li><a href="#" class="shadow-top-down social-twitter"><i class="fa fa-twitter-square"></i></a></li>
                            <li><a href="#" class="shadow-top-down social-youtube"><i class="fa fa-youtube-square"></i></a></li>
                            <li><a href="#" class="shadow-top-down social-instagram"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer -->
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 footer-copyright">
                        <p>Copyright &copy; 2084 <a href="#" target="_parent">Company Name</a></p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- require plugins -->
        <script src="<?php echo base_url() . 'assets/landingpage/js/jquery.min.js' ?>"></script>
        <script src="<?php echo base_url() . 'assets/landingpage/js/jquery-ui.min.js' ?>"></script>
        <script src="<?php echo base_url() . 'assets/landingpage/js/bootstrap.min.js' ?>"></script>
        <script src="<?php echo base_url() . 'assets/landingpage/js/jquery.parallax.js' ?>"></script>
        <!-- template mo config script -->
        <script src="<?php echo base_url() . 'assets/landingpage/js/templatemo_scripts.js' ?>"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    </body>
</html>