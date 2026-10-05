<?php
require_once __DIR__ . '/includes/admin.php';

$loginStatus = $_GET['login'] ?? '';
$loginModalShouldOpen = is_string($loginStatus) && in_array($loginStatus, ['failed', 'required'], true);
$loginError = isset($_SESSION['login_error']) && is_string($_SESSION['login_error'])
    ? $_SESSION['login_error']
    : '';
$loginEmail = isset($_SESSION['login_email']) && is_string($_SESSION['login_email'])
    ? $_SESSION['login_email']
    : '';
unset($_SESSION['login_error'], $_SESSION['login_email']);

if ($loginModalShouldOpen && $loginError === '') {
    $loginError = $loginStatus === 'failed'
        ? 'Invalid ID/Email or password'
        : 'Please sign in to access the admin area.';
}
?>
<!--
author: W3layouts
author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="en">
<head>
<title>E Sudha</title>
<!-- custom-theme -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //custom-theme -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="css/mainStyles.css" />
		<link rel='stylesheet' href='css/dscountdown.css' type='text/css' media='all' />

<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" property="" />
<!-- gallery -->
<link href="css/lsb.css" rel="stylesheet" type="text/css">
<!-- //gallery -->
<!-- font-awesome-icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,600,600i,700,900" rel="stylesheet">

</head>	
<body>
<?php
$headerActivePage = 'home';
$headerLabelSpacing = ' ';
require __DIR__ . '/includes/header.php';
?>	
    <!--<div id="exampleSlider">
        <div><h3></span></h3></div>
        <div><h3></span></h3></div>
         <div><h3></span></h3></div>
    </div>-->
    
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="images/banner12.jpg" class="img-responsive" alt="Los Angeles">
    </div>

    <div class="item">
      <img src="images/banner13.jpg" class="img-responsive" alt="Chicago">
    </div>

    <div class="item">
      <img src="images/banner14.jpg" class="img-responsive" alt="New York">
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<!-- banner-bottom -->	
	<div class="banner-bottom">
		<div class="container">
			<div class="col-md-6 w3ls_banner_bottom_left">
				<div class="w3ls_banner_bottom_right1">
                
                
                <p style="font-style:italic;">I dream of a Digital India where quality Medicine percolates right up to the remotest regions powered by e- Medicine</p>
<p>Shri Narendra Modi</p>
<p style="font-style:italic;">Hon’ble Prime Minister of India
</p>

<h4 style="color:#093; margin-bottom:20px;">National Telemedicine Service</h4>
<h2>Bridging the Digital Health Divide</h2>
<p style="text-align:justify;">eSudha- National Telemedicine Service of India is a step towards digital health equity to achieve Universal Health Coverage (UHC). eSudha facilitates quick and easy access to medicine from your smartphones. You can also access quality health services remotely via eSudha by visiting the nearest Ayushman Bharat Health & Wellness Centre.</p>

<img src="images/gov.jpg" class="img-responsive" style="margin-bottom:20px;">

					<!--<h2>Find Loan Products We Offers</h2>
					<p>Pellentesque convallis diam consequat magna vulputate malesuada. 
						Cras a ornare elit. Nulla viverra pharetra sem, eget pulvinar neque pharetra ac.</p>
						<p>Lorem Ipsum convallis diam consequat magna vulputate malesuada. 
						Cras a ornare elit. Nulla viverra pharetra sem, eget pulvinar neque pharetra ac.</p>
					<ul class="some_agile_facts">
						<li><i class="fa fa-long-arrow-right" aria-hidden="true"></i> Home Loan.</li>
						<li><i class="fa fa-long-arrow-right" aria-hidden="true"></i> Personal Loan</li>
						<li><i class="fa fa-long-arrow-right" aria-hidden="true"></i> Education Loan</li>
						<li><i class="fa fa-long-arrow-right" aria-hidden="true"></i>Car Loan</li>
					</ul>-->
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="col-md-6 w3ls_banner_bottom_right">
				<section class="slider">
					<div class="flexslider">
						<ul class="slides">
							<li>	
								<div class="agileits_w3layouts_banner_bottom_grid">
									<img src="images/1.jpg" alt=" " class="img-responsive" />
								</div>
							</li>
							<li>	
								<div class="agileits_w3layouts_banner_bottom_grid">
									<img src="images/2.jpg" alt=" " class="img-responsive" />
								</div>
							</li>
							<li>	
								<div class="agileits_w3layouts_banner_bottom_grid">
									<img src="images/3.jpg" alt=" " class="img-responsive" />
								</div>
							</li>
						</ul>
					</div>
				</section>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
<!-- //banner-bottom -->	
<!-- middle -->
<!--<div class="middle-w3l">
	<div class="col-md-3 w3ls-special-img text_info">
		<h4>Recent Projects</h4>
	</div>
	<div class="col-md-3 w3ls-special-img w3l-grid-1">
		<div class="w3ls-special-text effect-1">
			<h4>Project 1</h4>
			<ul>
				<li>Secured  </li>
				<li>Transaction</li>

			</ul>
		</div>
	</div>
	<div class="col-md-3 w3ls-special-img w3l-grid-2">
		<div class="w3ls-special-text effect-1">
			<h4>Project 2</h4>
			<ul>
				<li>Financial  </li>
				<li>Planning </li>

			</ul>
		</div>
	</div>
		<div class="col-md-3 w3ls-special-img w3l-grid-3">
		<div class="w3ls-special-text effect-1">
			<h4>Project 3</h4>
			<ul>
				<li>Secured  </li>
				<li>Transaction</li>

			</ul>
		</div>
	</div>
	<div class="clearfix"> </div>
</div>-->
<!-- //middle -->
<!--<div class="testimonials">
<div class="container">
 <h3 class="w3l_header w3_agileits_header">Latest <span>News</span></h3>
		  <p class="sub_para_agile">Ipsum dolor sit amet consectetur adipisicing elit</p>
<div class="agile_team_grids_top">
				<div class="col-md-4 w3_agile_services_grid">
					<div class="agile_services_grid1 wthree_services_grid1">
						<h3>TANUSRI LEGAL AND ASSOCIATE</h3>
						<div class="agile_services_grid1_sub">
							<p>05 January 2017</p>
						</div>
						<h4><span>TANUSRI LEGAL AND ASSOCIATE</span></h4>
					</div>
					<div class="agileits_w3layouts_services_grid1">
						<div class="w3_agileits_services_grid1">
							<div class="w3_agileits_services_grid1l">
								<img src="images/6.png" alt=" " class="img-responsive">
							</div>
							<div class="w3_agileits_services_grid1r">
								<ul>
									<li><i class="fa fa-star" aria-hidden="true"></i></li>
									<li><i class="fa fa-star" aria-hidden="true"></i></li>
									<li><i class="fa fa-star-half-o" aria-hidden="true"></i></li>
									<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
									<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
								</ul>
							</div>
							<div class="clearfix"> </div>
						</div>
						<h4><a href="#" data-toggle="modal" data-target="#myModal">Sed dictum augue quis varius</a></h4>
						<p>Etiam quis placerat dui, sit amet tristique nisl. Donec eget finibus eros.</p>
					</div>
				</div>
				<div class="col-md-4 w3_agile_services_grid">
					<div class="agile_services_grid1 wthree_services_grid2">
						<h3>TANUSRI LEGAL AND ASSOCIATE</h3>
						<div class="agile_services_grid1_sub">
							<p>14 January 2017</p>
						</div>
						<h4><span>TANUSRI LEGAL AND ASSOCIATE</span></h4>
					</div>
					<div class="agileits_w3layouts_services_grid1">
						<div class="w3_agileits_services_grid1">
							<div class="w3_agileits_services_grid1l">
								<img src="images/2.png" alt=" " class="img-responsive">
							</div>
							<div class="w3_agileits_services_grid1r">
								<ul>
									<li><i class="fa fa-star" aria-hidden="true"></i></li>
									<li><i class="fa fa-star" aria-hidden="true"></i></li>
									<li><i class="fa fa-star-half-o" aria-hidden="true"></i></li>
									<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
									<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
								</ul>
							</div>
							<div class="clearfix"> </div>
						</div>
						<h4><a href="#" data-toggle="modal" data-target="#myModal">lobortis sem dictum placerat</a></h4>
						<p>Etiam quis placerat dui, sit amet tristique nisl. Donec eget finibus eros.</p>
					</div>
				</div>
				<div class="col-md-4 w3_agile_services_grid">
					<div class="agile_services_grid1 wthree_services_grid3">
						<h3>TANUSRI LEGAL AND ASSOCIATE</h3>
						<div class="agile_services_grid1_sub">
							<p>20 January 2017</p>
						</div>
						<h4><span>TANUSRI LEGAL AND ASSOCIATE</span></h4>
					</div>
					<div class="agileits_w3layouts_services_grid1">
						<div class="w3_agileits_services_grid1">
							<div class="w3_agileits_services_grid1l">
								<img src="images/1.png" alt=" " class="img-responsive">
							</div>
							<div class="w3_agileits_services_grid1r">
								<ul>
									<li><i class="fa fa-star" aria-hidden="true"></i></li>
									<li><i class="fa fa-star" aria-hidden="true"></i></li>
									<li><i class="fa fa-star-half-o" aria-hidden="true"></i></li>
									<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
									<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
								</ul>
							</div>
							<div class="clearfix"> </div>
						</div>
						<h4><a href="#" data-toggle="modal" data-target="#myModal">Praesent amet tempor risus</a></h4>
						<p>Etiam quis placerat dui, sit amet tristique nisl. Donec eget finibus eros.</p>
					</div>
				</div>
				
				<div class="clearfix"> </div>
			</div>
		</div>
</div>-->
<!-- /flip -->
	<!--<div class="w3_agile_timer">
 	   
						<div class="agileits-timer"> 
							<div class="main-title">
							<h4><p>Spend your money</p>It Save Tons of time</h4>	
						     <div class="demo2"></div>
						</div>
						</div>-->
						
					

					
	</div>

	<div class="modal video-modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
				</div>
				<div class="signin-form profile">
						<h3 class="agileinfo_sign">E-Sudha</h3>	
					<div class="modal-body">
						<img src="images/g1.jpg" alt=" " class="img-responsive" />
						<p>Ut enim ad minima veniam, quis nostrum 
							exercitationem ullam corporis suscipit laboriosam, 
							nisi ut aliquid ex ea commodi consequatur? Quis autem 
							vel eum iure reprehenderit qui in ea voluptate velit 
							esse quam nihil molestiae consequatur, vel illum qui 
							dolorem eum fugiat quo voluptas nulla pariatur.
							<i>" Quis autem vel eum iure reprehenderit qui in ea voluptate velit 
								esse quam nihil molestiae consequatur.</i></p>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- //bootstrap-pop-up -->
<!-- gallery -->
	<div class="gallery">
	     	      <h3 class="w3l_header w3_agileits_header">Latest <span>Gallery</span></h3>
		<!--  <p class="sub_para_agile">Ipsum dolor sit amet consectetur adipisicing elit</p>-->
		  	<div class="agile_team_grids_top">
		<ul id="flexiselDemo1">	
			<li>
				<div class="wthree_gallery_grid">
					<a href="images/g1.jpg" class="lsb-preview" data-lsb-group="header">
						<div class="view second-effect">
							<img src="images/g1.jpg" alt="" class="img-responsive" />
							<div class="mask">
								<p>E-Sudha</p>
							</div>
						</div>	
					</a>
				</div>
			</li>
			<li>
				<div class="wthree_gallery_grid">
					<a href="images/g2.jpg" class="lsb-preview" data-lsb-group="header">
						<div class="view second-effect">
							<img src="images/g2.jpg" alt="" class="img-responsive" />
							<div class="mask">
								<p>E-Sudha</p>
							</div>
						</div>	
					</a>
				</div>
			</li>
			<li>
				<div class="wthree_gallery_grid">
					<a href="images/g3.jpg" class="lsb-preview" data-lsb-group="header">
						<div class="view second-effect">
							<img src="images/g3.jpg" alt="" class="img-responsive" />
							<div class="mask">
								<p>E-Sudha</p>
							</div>
						</div>	
					</a>
				</div>
			</li>
			<li>
				<div class="wthree_gallery_grid">
					<a href="images/g4.jpg" class="lsb-preview" data-lsb-group="header">
						<div class="view second-effect">
							<img src="images/g4.jpg" alt="" class="img-responsive" />
							<div class="mask">
								<p>E-Sudha</p>
							</div>
						</div>	
					</a>
				</div>
			</li>
			<li>
				<div class="wthree_gallery_grid">
					<a href="images/g5.jpg" class="lsb-preview" data-lsb-group="header">
						<div class="view second-effect">
							<img src="images/g5.jpg" alt="" class="img-responsive" />
							<div class="mask">
								<p>E-Sudha</p>
							</div>
						</div>	
					</a>
				</div>
			</li>
		</ul>
	</div>
</div>
<!-- //gallery -->
<!-- testimonials -->
	<!--<div class="testimonials">
		<div class="container">
	      <h3 class="w3l_header w3_agileits_header">Our <span>Clients</span></h3>
		  <p class="sub_para_agile">Ipsum dolor sit amet consectetur adipisicing elit</p>
			<div class="w3ls_testimonials_grids">
				 <section class="center slider">
						<div class="agileits_testimonial_grid">
							<div class="w3l_testimonial_grid">
								<p>In eu auctor felis, id eleifend dolor. Integer bibendum dictum erat, 
									non laoreet dolor.</p>
								<h4>Rosy Crisp</h4>
								<h5>Client</h5>
								<div class="w3l_testimonial_grid_pos">
									<img src="images/1.png" alt=" " class="img-responsive" />
								</div>
							</div>
						</div>
						<div class="agileits_testimonial_grid">
							<div class="w3l_testimonial_grid">
								<p>In eu auctor felis, id eleifend dolor. Integer bibendum dictum erat, 
									non laoreet dolor.</p>
								<h4>Laura Paul</h4>
								<h5>Client</h5>
								<div class="w3l_testimonial_grid_pos">
									<img src="images/2.png" alt=" " class="img-responsive" />
								</div>
							</div>
						</div>
						<div class="agileits_testimonial_grid">
							<div class="w3l_testimonial_grid">
								<p>In eu auctor felis, id eleifend dolor. Integer bibendum dictum erat, 
									non laoreet dolor.</p>
								<h4>Michael Doe</h4>
								<h5>Client</h5>
								<div class="w3l_testimonial_grid_pos">
									<img src="images/3.png" alt=" " class="img-responsive" />
								</div>
							</div>
						</div>
				</section>
			</div>
		</div>
	</div>-->
<!-- //testimonials -->
<!-- footer -->
<div class="footer_agile_w3ls">
	<div class="container">
		<!--<div class="agileits_w3layouts_footer_grids">
	        <div class="col-md-3 footer-w3-agileits">
					<h3>Training Grounds</h3>
					<ul>
						<li>Etiam quis placerat</li>
						<li>the printing</li>
						<li>unknown printer</li>
						<li>Lorem Ipsum</li>
					</ul>
			</div>
			<div class="col-md-3 footer-agileits">
					<h3>Specialized</h3>
					<ul>
						<li>the printing</li>
						<li>Etiam quis placerat</li>
						<li>Lorem Ipsum</li>
						<li>unknown printer</li>
					</ul>
				</div>
				<div class="col-md-3 footer-wthree">
					<h3>Partners</h3>
					<ul>
						<li>unknown printer</li>
						<li>Lorem Ipsum</li>
						<li>the printing</li>
						<li>Etiam quis placerat</li>
					</ul>
				</div>
	
				<div class="col-md-3 footer-agileits-w3layouts">
					<h3>Our Links</h3>
					<ul>
						<li><a href="index.php">Home</a></li>
						<li><a href="about.php">About</a></li>
						<li><a href="events.html">Events</a></li>
						<li><a href="mail.php">Contact</a></li>
					</ul>
				</div>
				<div class="clearfix"></div>

		</div>-->
		<div class="agileits_w3layouts_logo logo2">
			<?php $footerBrand = 'E-Sudha'; require __DIR__ . '/includes/footer.php'; ?>
	</div>
</div>
<!--<div class="wthree_copy_right">
	<div class="container">
		<p>Design by <a href="">Zeon Technology Services</a></p>
	</div>
</div>-->
<!-- //footer -->

<div class="modal fade" id="myModal2" tabindex="-1" role="dialog">
														<div class="modal-dialog">
														<!-- Modal content-->
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal">&times;</button>
																	
																	<div class="signin-form profile">
																	<h3 class="agileinfo_sign">Sign In</h3>	
																			<div class="login-form">
																				<form action="auth/login.php" method="post">
																					<input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8'); ?>">
																					<?php if ($loginError !== ''): ?>
																						<p class="alert alert-danger" role="alert"><?php echo htmlspecialchars($loginError, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></p>
																					<?php endif; ?>
																					<input type="text" name="identifier" placeholder="ID/Email" value="<?php echo htmlspecialchars($loginEmail, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>" autocomplete="username" maxlength="254" required>
																					<input type="password" name="password" placeholder="Password" autocomplete="current-password" required>
																					<div class="tp">
																						<input type="submit" value="Sign In">
																					</div>
																				</form>
																			</div>
																			<div class="login-social-grids">
																				<ul>
																					<li><a href="#"><i class="fa fa-facebook"></i></a></li>
																					<li><a href="#"><i class="fa fa-twitter"></i></a></li>
																					<li><a href="#"><i class="fa fa-rss"></i></a></li>
																				</ul>
																			</div>
																			<p><a href="#" data-toggle="modal" data-target="#myModal3" > Don't have an account?</a></p>
																		</div>
																</div>
															</div>
														</div>
													</div>
													<!-- //Modal1 -->	
													<!-- Modal2 -->
													<div class="modal fade" id="myModal3" tabindex="-1" role="dialog">
														<div class="modal-dialog">
														<!-- Modal content-->
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal">&times;</button>
																	
																	<div class="signin-form profile">
																	<h3 class="agileinfo_sign">Sign Up Coming Soon</h3>
																			<p>Sign Up Coming Soon</p>
																			<!-- Registration is disabled for now and preserved for future use.
																			<div class="login-form">
																				<form action="#" method="post">
																				   <input type="text" name="name" placeholder="Username" required>
																					<input type="email" name="email" placeholder="Email" required>
																					<input type="password" name="password" placeholder="Password" required>
																					<input type="password" name="password" placeholder="Confirm Password" required>
																					<input type="submit" value="Sign Up">
																				</form>
																			</div>
																			<p><a href="#"> By clicking register, I agree to your terms</a></p>
																			-->
																		</div>
																</div>
															</div>
														</div>
													</div>
													<!-- //Modal2 -->	

<!-- //bootstrap-pop-up -->

<!-- js -->
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<!-- //js -->
<!-- Counter required files -->
		<script type="text/javascript" src="js/dscountdown.min.js"></script>
		<script>
			jQuery(document).ready(function($){						
				$('.demo2').dsCountDown({
					endDate: new Date("December 24, 2020 23:59:00"),
					theme: 'black'
					});								
			});
		</script>
	<!-- //Counter required files -->



<script src="js/mainScript.js"></script>
<script src="js/rgbSlide.min.js"></script>
<!-- carousal -->
	<script src="js/slick.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript">
		$(document).on('ready', function() {
		  $(".center").slick({
			dots: true,
			infinite: true,
			centerMode: true,
			slidesToShow:2,
			slidesToScroll:2,
			responsive: [
				{
				  breakpoint: 768,
				  settings: {
					arrows: true,
					centerMode: false,
					slidesToShow: 2
				  }
				},
				{
				  breakpoint: 480,
				  settings: {
					arrows: true,
					centerMode: false,
					centerPadding: '40px',
					slidesToShow: 1
				  }
				}
			 ]
		  });
		});
	</script>
<!-- //carousal -->
<!-- flexisel -->
		<script type="text/javascript">
		$(window).load(function() {
			$("#flexiselDemo1").flexisel({
				visibleItems: 4,
				animationSpeed: 1000,
				autoPlay: true,
				autoPlaySpeed: 3000,    		
				pauseOnHover: true,
				enableResponsiveBreakpoints: true,
				responsiveBreakpoints: { 
					portrait: { 
						changePoint:480,
						visibleItems: 1
					}, 
					landscape: { 
						changePoint:640,
						visibleItems:2
					},
					tablet: { 
						changePoint:768,
						visibleItems: 2
					}
				}
			});
			
		});
	</script>
	<script type="text/javascript" src="js/jquery.flexisel.js"></script>
<!-- //flexisel -->
<!-- gallery-pop-up -->
	<script src="js/lsb.min.js"></script>
	<script>
	$(window).load(function() {
		  $.fn.lightspeedBox();
		});
	</script>
<!-- //gallery-pop-up -->
<!-- flexSlider -->
	<script defer src="js/jquery.flexslider.js"></script>
	<script type="text/javascript">
		$(window).load(function(){
		  $('.flexslider').flexslider({
			animation: "slide",
			start: function(slider){
			  $('body').removeClass('loading');
			}
		  });
		});
	</script>
<!-- //flexSlider -->

<!-- start-smooth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- start-smooth-scrolling -->
<!-- for bootstrap working -->
	<script src="js/bootstrap.js"></script>
<!-- //for bootstrap working -->
<?php if ($loginModalShouldOpen): ?>
<script type="text/javascript">
	jQuery(function($) {
		$('#myModal2').modal('show');
	});
</script>
<?php endif; ?>
<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
<!-- //here ends scrolling icon -->
</body>
</html>