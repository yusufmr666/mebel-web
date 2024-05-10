<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="icon" href="<?=base_url()?>assets/images/logosdua.png">
	<title>Anwar Jaya Funitur &mdash; <?=$id?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Website Template by gettemplates.co" />
	<meta name="keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
	<meta name="author" content="gettemplates.co" />

	<!-- 
	//////////////////////////////////////////////////////

	FREE HTML5 TEMPLATE 
	DESIGNED & DEVELOPED by FreeHTML5.co
		
	Website: 		http://freehtml5.co/
	Email: 			info@freehtml5.co
	Twitter: 		http://twitter.com/fh5co
	Facebook: 		https://www.facebook.com/fh5co

	//////////////////////////////////////////////////////
	 -->

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet"> -->
	<!-- <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i" rel="stylesheet"> -->
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="<?= base_url()?>/assets/css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="<?= base_url()?>/assets/css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="<?= base_url()?>/assets/css/bootstrap.css">

	<!-- Flexslider  -->
	<link rel="stylesheet" href="<?= base_url()?>/assets/css/flexslider.css">

	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="<?= base_url()?>/assets/css/owl.carousel.min.css">
	<link rel="stylesheet" href="<?= base_url()?>/assets/css/owl.theme.default.min.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="<?= base_url()?>/assets/css/style.css">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

	<!-- Modernizr JS -->
	<script src="<?= base_url()?>/assets/js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>
		
	<div class="fh5co-loader"></div>
	
	<div id="page">
	<nav class="fh5co-nav" role="navigation">
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-xs-2">
					<div id="fh5co-logo"><a href="<?=base_url()?>home"><img src="<?=base_url()?>assets/images/logos.png" width="125"></a></div>
				</div>
				<div class="col-md-6 col-xs-6 text-center menu-1">
					<ul>
						<li class="has-dropdown">
							<a href="<?= base_url()?>home">Shop</a>
						</li>
						<li class="has-dropdown">
							<a href="<?= base_url()?>user/service">Pesanan</a>
						</li>
						<?php
						$id_user = $this->session->userdata('id');
						$datachat = $this->db->query("SELECT * FROM faqone WHERE id_user='$id_user'")->result();
						foreach($datachat as $dtc){
							$id_faq = $dtc->id_faq;
						}
						if(!empty($id_faq)){
							$jmlchat = $this->db->query("SELECT * FROM faqone WHERE id_level='admin' and id_status='2' and id_faq='$id_faq'")->num_rows();
						}
						?>
						<li class=""><a href="<?=base_url()?>user/chat" class="cart">Chat<span><small><?php if(empty($jmlchat)){echo "0";} else { echo $jmlchat;}?></small><i class=""></i></span></a></li>
					</ul>
				</div>
				<div class="col-md-3 col-xs-4 text-right hidden-xs menu-2">
					<ul>
						<?php
						//$id_user = $this->session->userdata('id');
						$username = $this->session->userdata('username');
						$cart = $this->mebel_model->get_cart_byid($id_user)->num_rows();
						if($cart == 0){
							$jmlcart = '0';
						} else {
							$jmlcart = $cart;
						}
						
						?>
						<li class=""><a href="<?= base_url()?>user/chart" class="cart"><span><small><?= $jmlcart?></small><i class="icon-shopping-cart"></i></span></a></li>
						<li class="has-dropdown">
							<a href="javascript:void(0);"> <?php if(!empty($this->session->userdata('username'))){ echo "Hi, ".$username."!" ;}?></a>
							<?php if(!empty($this->session->userdata('username'))) {?>
							<ul class="dropdown">								
								<li><a href="<?=base_url()?>login/aksi_logout">Logout</a></li>								
							</ul>
							<?php } ?>
						</li>
						<?php if(empty($this->session->userdata('username'))){?>
						<li><p><a href="<?=base_url()?>login">Login</a></p></li>
						<?php } ?>
					</ul>
				</div>
			</div>
			
		</div>
	</nav>