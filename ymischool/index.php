<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en"> 
<head>
    <title> YMI </title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">    
    <link rel="shortcut icon" href="favicon.ico"> 
    
    <!-- FontAwesome JS-->
    <script defer src="assets/plugins/fontawesome/js/all.min.js"></script>
    <link rel="stylesheet" href="assets/css/font.css">

    
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">
    <link rel="shortcut icon" href="assets/img/logo1.png">

    <style type="text/css">
    	.logo-text{
    		font-family: AlfaSlabOne-Regular;
    	}
    </style>

</head> 

<body class="app app-login p-0">    	
    <div class="row g-0 app-auth-wrapper justify-content-center align-items-center">
	    <div class="col-12 col-md-7 col-lg-7 auth-main-col text-center p-5 ">
		    <div class="d-flex flex-column align-content-end ">
			    <div class="app-auth-body mx-auto">	
				    <div class="app-auth-branding mb-4">
				    	<a class="app-logo" href="index.php">
				    		<img class="logo-icon me-2" src="assets/img/logo.png" alt="logo">
                        	<span class="logo-text"> YMI </span>
                        </a>
				    </div>
					<h2 class="auth-heading text-center mb-5">Log in to YMI School Protal</h2>
					<?php if(isset($_SESSION['login_fail'])){ ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <p> <?= $_SESSION['login_fail']; ?> </p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                    <?php } unset($_SESSION['login_fail']); ?>
					<h5 class='mb-3'> Are you Staff or Student ? </h5>
			        <div class="auth-form-container text-start">
			        	<ul class="nav nav-pills nav-justified mb-3" id="pills-tab" role="tablist">
						  	
						  	<li class="nav-item" role="presentation">
						    	<button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false"> Staff </button>
						  	</li>
						  	<li class="nav-item" role="presentation">
						    	<button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false"> Student </button>
						  	</li>
						</ul>
						<div class="tab-content" id="pills-tabContent">
						  	
						  	<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
						  		<form class="auth-form login-form" action="singin.php" method="POST">   
						  			<input type="hidden" name="status" value="Staff">      
									<div class="email mb-3">
										<label class="sr-only" for="signin-email">Email</label>
										<input id="signin-email" name="email" type="email" class="form-control signin-email" placeholder="Email address" required="required">
									</div><!--//form-group-->
									<div class="password mb-3">
										<label class="sr-only" for="signin-password">Password</label>
										<input id="signin-password" name="password" type="password" class="form-control signin-password" placeholder="Password" required="required">
									</div><!--//form-group-->
									<div class="text-center">
										<button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Log In</button>
									</div>
								</form>
						  	</div>
						  	<div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
						  		<form class="auth-form login-form" action="singin.php" method="POST">  
						  			<input type="hidden" name="status" value="Student">      
									<div class="email mb-3">
										<label class="sr-only" for="signin-email">Email</label>
										<input id="signin-email" name="email" type="email" class="form-control signin-email" placeholder="Email address" required="required">
									</div><!--//form-group-->
									<div class="password mb-3">
										<label class="sr-only" for="signin-password">Password</label>
										<input id="signin-password" name="password" type="password" class="form-control signin-password" placeholder="Password" required="required">
									</div><!--//form-group-->
									<div class="text-center">
										<button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Log In</button>
									</div>
								</form>
						  	</div>
						</div>
						
					</div><!--//auth-form-container-->	

			    </div><!--//auth-body-->
		    
			    <footer class="app-auth-footer">
				    <div class="container text-center py-3">
				         <!--/* This template is free as long as you keep the footer attribution link. If you'd like to use the template without the attribution link, you can buy the commercial license via our website: themes.3rdwavemedia.com Thank you for your support. :) */-->
			        <small class="copyright">Designed with <i class="fas fa-heart" style="color: #fb866a;"></i> by YMI IT Team</small>
				       
				    </div>
			    </footer><!--//app-auth-footer-->	
		    </div><!--//flex-column-->   
	    </div><!--//auth-main-col-->
	    <div class="col-12 col-md-5 col-lg-5 h-100 auth-background-col">
		    <div class="auth-background-holder">
		    </div>
		    <div class="auth-background-mask"></div>
		    <div class="auth-background-overlay p-3 p-lg-5">
		    </div><!--//auth-background-overlay-->
	    </div><!--//auth-background-col-->
    
    </div><!--//row-->

	<script src="assets/plugins/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>  
</body>
</html> 

