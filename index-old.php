<?php
error_reporting(E_ALL ^ E_NOTICE); // hide all basic notices from PHP

//If the form is submitted
if(isset($_POST['submitted'])) {

	// require a name from user
	if(trim($_POST['contactName']) === '') {
		$nameError =  'Forgot your name!';
		$hasError = true;
	} else {
		$name = trim($_POST['contactName']);
	}

	// need valid email
	if(trim($_POST['email']) === '')  {
		$emailError = 'Forgot to enter in your e-mail address.';
		$hasError = true;
	} else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
		$emailError = 'You entered an invalid email address.';
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}

	// we need at least some content
	if(trim($_POST['comments']) === '') {
		$commentError = 'You forgot to enter a message!';
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['comments']));
		} else {
			$comments = trim($_POST['comments']);
		}
	}

	// upon no failure errors let's email now!
	if(!isset($hasError)) {

		$emailTo = 'getnobody@gmail.com';
		$subject = 'Submitted message from '.$name;
		$sendCopy = trim($_POST['sendCopy']);
		$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
		$headers = 'From: ' .' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		mail($emailTo, $subject, $body, $headers);

        // set our boolean completion value to TRUE
		$emailSent = true;
	}
}
?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Nobody Creative :: Main Container Snippet</title>
        <meta name="description" content="Nobody Creative is a Web design shop dedicated to the small business industry">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->

		<!-- START: CSS LINK -->
        <link rel="stylesheet" href="css/normalize.css" type="text/css" charset="utf-8">
        <link rel="stylesheet" href="css/master.css" type="text/css" charset="utf-8">
<!-- 		<link rel="stylesheet" href="css/slider.css" type="text/css" charset="utf-8">
 -->
		<!-- START: JS SCRIPTS -->
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
		<div class="page">

	        <!-- START: MAIN NAVIGATION CODE -->
			<div class="container navigation-menu">
	        	<h1 class="brand-container">
                    <a href="/">
                        <img class="main-logo" height="auto" alt="Nobody Creative - Logo" src="img/logo/logo-v1-0.svg">
                    </a>
                </h1>
	        	<nav class="navigation collapse" role="navigation">
                    <div class="col-md-3 scrollspy">
                        <ul id="nav" class="nav hidden-xs hidden-sm" data-spy="affix">
                            <!-- <li>
                                <a href="#output">Output</a>
                            </li>
                            <li>
                                <a href="#mixcrate">Crate</a>
                            </li>
                            <li>
                                <a href="#discover">Discover</a>
                            </li>
                            <li>
                                <a href="#nobody">Nobody</a>
                            </li>
                            <li>
                                <a href="#connect">Connect</a>
                            </li> -->
                            <li>
                                <a href="#contact">Contact</a>
                            </li>
                        </ul>
                    </div>
	        	</nav>
	        	<div class="banner-toggle">
	        		<button data-target=".navigation" data-toggle="collapse" type="button">
	        			<span class="icon-bar"></span>
	        			<span class="icon-bar"></span>
	        			<span class="icon-bar"></span>
	        		</button>
	        	</div>
			</div>
			<!-- END: MAIN NAVIGATION CODE -->
			<!-- START: MAIN SLIDER CODE -->
			<!-- <ul class="rslides" id="nobody-slides">
				<li class="slider">
					 <div class="img-slide1">
						 <img src="img/slider/showreel1.jpg" alt="Nobody - Are You Ranked On Google?">
						 <a href="#connect" class="btn">Talk To Nobody</a>
                         <a href="#connect" class="link">Visit Tyreshoponline</a>
					 </div>
					 </li>
				 <li class="slider">
					 <div class="img-slide2">
						 <img src="img/slider/showreel2.jpg" alt="Nobody - Is Your Site Mobile Friendly?">
						 <a href="#connect" class="btn">Nobody Talks Business</a>
					 </div>
				 </li>
            </ul> -->
			<!--- END: MAIN SLIDER CODE -->
			<div class="container">
				<article class="content">
					
					<section class="hero-blurb">
						<div class="inner">
							<img src="img/logo/logo-v1-1.svg" width="100%" height="auto" alt="Project74 Logo">

							<p>
				        		This is a container. It needs to be responsive and able to to added as a snippet to a site without it's styles be over written by something else.
				        	</p>

						</div>
					</section>

				</article>
				<article>
					<section class="section contact" id="contact">
						<div class="row">
							<h2 class="h2-title">The Secret Of Business Is To Know Something That Nobody Else Knows</h2>
							<?php if(isset($emailSent) && $emailSent == true) { ?>
									<p class="info">Your email was sent. Huzzah!</p>
							<?php } else { ?>
		                    <div class="form">
								<?php if(isset($hasError) || isset($captchaError) ) { ?>
				                    <p class="alert">Error submitting the form</p>
				                <?php } ?>
								<form id="contact-us" action="index.php" method="post">
									<label class="screen-reader-text">Name:</label>
									<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="txt requiredField" placeholder="*Name:" />
									<?php if($nameError != '') { ?>
										<br /><span class="error"><?php echo $nameError;?></span>
									<?php } ?>
									<label class="screen-reader-text">Phone:</label>
									<input type="text" name="phoneNumber" id="phoneNumber" value="<?php if(isset($_POST['phoneNumber'])) echo $_POST['phoneNumber'];?>" class="txt requiredField" placeholder="*Phone:" />
									<?php if($nameError != '') { ?>
										<br /><span class="error"><?php echo $nameError;?></span>
									<?php } ?>
									<label class="screen-reader-text">Email:</label>
									<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="txt requiredField email" placeholder="*Email:" />
									<?php if($emailError != '') { ?>
										<br /><span class="error"><?php echo $emailError;?></span>
									<?php } ?>
									<label class="screen-reader-text">Company:</label>
									<input type="text" name="company" id="company" value="<?php if(isset($_POST['company'])) echo $_POST['company'];?>" class="txt" placeholder="Company:" />
									<?php if($nameError != '') { ?>
										<br /><span class="error"><?php echo $nameError;?></span>
									<?php } ?>
									<div class="form__container textarea">
										<label class="screen-reader-text">Message</label>
								 		<textarea name="comments" id="commentsText" class="txtarea requiredField" placeholder="*Message:" cols="5" rows="6"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
										<?php if($commentError != '') { ?>
											<br /><span class="error"><?php echo $commentError;?></span>
										<?php } ?>
									</div>
									<button name="submit" type="submit" class="subbutton">Send That bad boy!</button>
									<input type="hidden" name="submitted" id="submitted" value="true" />
								</form>
		                    </div>
						<?php } ?>
			            </div>
		            </section>
				</article>
			</div>
			<!--- END: MAIN CONTENT CODE -->
		</div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.3.min.js"><\/script>')</script>
		<!-- START: BootStrap Javascript -->
        <script src="js/bootstrap.js"></script>
		<!-- START: MISC Javascript -->
        <script>
		<!--//--><![CDATA[//><!--
			$(document).ready(function() {
				$('form#contact-us').submit(function() {
					$('form#contact-us .error').remove();
					var hasError = false;
					$('.requiredField').each(function() {
						if($.trim($(this).val()) == '') {
							var labelText = $(this).prev('label').text();
							$(this).parent().append('<span class="error">You forgot to enter your '+labelText+'.</span>');
							$(this).addClass('inputError');
							hasError = true;
						} else if($(this).hasClass('email')) {
							var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
							if(!emailReg.test($.trim($(this).val()))) {
								var labelText = $(this).prev('label').text();
								$(this).parent().append('<span class="error">Sorry! You\'ve entered an invalid '+labelText+'.</span>');
								$(this).addClass('inputError');
								hasError = true;
							}
						}
					});
					if(!hasError) {
						var formInput = $(this).serialize();
						$.post($(this).attr('action'),formInput, function(data){
							$('form#contact-us').slideUp("fast", function() {
								$(this).before('<p class="tick">Thanks! Your email has been delivered. We\'ll be in touch as soon as possible.</p>');
							});
						});

					}

					return false;
				});
			});
			//-->!]]>
        // START: Link Anchor Scrolling Javascript
			$(function() {
			  $('a[href*=#]:not([href=#])').click(function() {
			    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			      var target = $(this.hash);
			      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			      if (target.length) {
			        $('html,body').animate({
			          scrollTop: target.offset().top
			      }, 2500);
			        return false;
			      }
			    }
			  });
			});
		</script>

    </body>
</html>
