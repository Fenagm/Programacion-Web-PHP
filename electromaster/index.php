<?php

require_once('database/mysql-login.php');
require_once('seccion/array.php');
require_once('helpers/functions.php');
require_once('helpers/querys.php');

$con = new PDO('mysql:host='.$hostname.';port='.$port.';dbname='.$database, $username, $password);

$seccion = $_GET["seccion"] ?? "home";

?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Electro Store</title>

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
		<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap.min.css" rel="stylesheet">

		<!-- Bootstrap 4.1.1 -->
		<link type="text/css" rel="stylesheet" href="css/bootstrap4.1.1.min.css"/>
		
		<!-- Bootstrap 3.7 -->
		<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>
		
		<!-- Slick -->
		<link type="text/css" rel="stylesheet" href="css/slick.css"/>
		<link type="text/css" rel="stylesheet" href="css/slick-theme.css"/>

		<!-- nouislider -->
		<link type="text/css" rel="stylesheet" href="css/nouislider.min.css"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="css/font-awesome.min.css">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="css/style.css"/>

	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
		 <script src="https://code.jquery.com/jquery-3.2.1.js"></script>

   
		<script type="text/javascript">
$(document).ready(function() {	
    $('#usuario').on('blur', function() {
        $('#check_user').html('<img src="imagenes/loader.gif" />').fadeOut(1000);
 
        var usuario = $(this).val();		
        var dataString = 'usuario='+usuario;
 
        $.ajax({
            type: "POST",
            url: "seccion/user_check.php",
            data: dataString,
            success: function(data) {
                $('#check_user').fadeIn(1000).html(data);
            }
        });
    });              
});    
</script>

	</head>
	
		<!-- HEADER -->
		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone"></i> +54-011-4999-5555</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> contacto@electromaster.com</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i> Av.Cordoba 2510</a></li>
					</ul>
					<ul class="header-links pull-right">						
					<li><a href="#"><i class="fa fa-user-o"></i> Mi Cuenta</a></li>
					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="index.php" class="logo">
									<img src="./img/logo.png" alt="">
								</a>
							</div>	
						</div>
						<!-- /LOGO -->

					<?php /*
					<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form>
									<select class="input-select">
										<option value="0">All Categories</option>
										<option value="1">Category 01</option>
										<option value="1">Category 02</option>
									</select>
									<input class="input" placeholder="Search here">
									<button class="search-btn">Search</button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR --> 
		
*/ ?>
						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
						
							
								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->

		<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
					<?php foreach($nav as $url): ?>
                            <li class="nav-item <?= $seccion == $url["seccion"]? "active rounded" : "" ?>">
                                <a class="nav-link link font-weight-bold barra pl-2"
                                    href="index.php?seccion=<?php echo $url["seccion"]; ?>"><?php echo $url ["nombre"]; ?></a>
                            </li>
                            <?php 
                endforeach;
            ?>
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->

		<body>


	<?php 
	if(file_exists("seccion/$seccion.php")):
    require_once("seccion/$seccion.php");
else:
    require_once("seccion/home.php");
endif;

	
?>


		<!-- FOOTER -->
			<!-- NEWSLETTER -->
			<div id="newsletter" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="newsletter">
							<p>Sign Up for the <strong>NEWSLETTER</strong></p>
							<form>
								<input class="input" type="email" placeholder="Enter Your Email">
								<button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
							</form>
							<ul class="newsletter-follow">
								<li>
									<a href="#"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-instagram"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-pinterest"></i></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /NEWSLETTER -->
		<!-- /FOOTER -->


		<!-- jQuery Plugins -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/slick.min.js"></script>
		<script src="js/nouislider.min.js"></script>
		<script src="js/jquery.zoom.min.js"></script>
		<script src="js/main.js"></script>
		<script tipo="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
		<script tipo="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
		<script tipo="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap.min.js"></script>

	</body>
</html>

<script>var monkeyList = new List('comlist', {
  valueNames: ['name'],
  page: 3,
  pagination: true
});</script>

<script>
    $(document).ready(function() {
        $('#filtroTabla').DataTable();
    });
</script>