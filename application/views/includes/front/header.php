<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  <!-- SITE TITTLE -->
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Best Properties Mohali</title>
  <!-- Owl Carousel CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

<!-- Bootstrap CSS (अगर पहले से नहीं है तो) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS + Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


<!-- jQuery (Owl Carousel ke liye zaroori) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Owl Carousel JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link href="img/favicon.html" rel="shortcut icon">
   <link rel="icon" type="image/png" href="/assets/images/Best-Properties-favicone.png">
  <!-- PLUGINS CSS STYLE -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- <link href="../stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.	min.css" rel="stylesheet"/> -->
  <link href="assets/css/style.css" rel="stylesheet" type="text/css">
  
  
   <!-- <link href="assets/css/styles.css" rel="stylesheet"> -->


  <!-- FAVICON -->
  <!-- FAVICON -->
  <link href="img/favicon.html" rel="shortcut icon">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
<link rel="stylesheet" href="style.css">



</head>
<?php
    $page_class = $this->uri->segment(1) ? strtolower($this->uri->segment(1)) : 'home';
    $page_class .= $this->uri->segment(2) ? '-' . strtolower($this->uri->segment(2)) : '';
?>
<body class="body-wrapper <?= $page_class.'cstm-cls' ?>">


<section>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<nav class="navbar navbar-expand-lg  navigation">
					<a class="navbar-brand" href="/new-home-page">
						<img src="https://bestpropertiesmohali.com/assets/images/logo1.png" alt="">
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
					<span class="navbar-toggler-icon"></span>
					<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav ml-auto main-nav ">
							<li class="nav-item active">
								<a class="nav-link" href="/for-sale">For Sale</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="/buy">Buy</a>
							</li>
							<li class="nav-item dropdown dropdown-slide">
								<a class="nav-link dropdown-toggle" href="/for-rent-new" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									For Rent								</a>
								<!-- Dropdown list -->
								
							</li>
							<li class="nav-item dropdown dropdown-slide">
								<a class="nav-link dropdown-toggle" href="sell-with-us" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Sell With Us </i>
								</a>
								<!-- Dropdown list -->
								</li>
								<li class="nav-item">
									<a class="nav-link" href="/home-loan">Home Loan</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="/log-in">Login</a>
								</li>
						</ul>
					
					</div>
				</nav>
			</div>
		</div>
	</div>
</section>
