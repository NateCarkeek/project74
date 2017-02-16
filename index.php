<?php
error_reporting(E_ALL ^ E_NOTICE); // hide all basic notices from PHP

//If the form is submitted
if(isset($_POST['submitted'])) {

    // require a name from user
    if(trim($_POST['contactName']) === '') {
        $nameError =  'You forgot your name!';
        $hasError = true;
    } else {
        $name = trim($_POST['contactName']);
    }

    // need valid email
    if(trim($_POST['email']) === '')  {
        $emailError = 'You forgot to enter in your e-mail address';
        $hasError = true;
    } else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
        $emailError = 'You entered an invalid email address';
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

        $emailTo = 'nobody@nobodycreative.co.nz';
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
<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
            <title>Project74 :: Welcome</title>
            <meta name="description" content="Project74 is a site dedicated to lots of things">

            <link rel="apple-touch-icon" href="apple-touch-icon.png">
            <!-- Place favicon.ico in the root directory -->

            <!-- Bootstrap -->
            <link href="css/bootstrap.min.css" rel="stylesheet">
            <!-- START: CSS LINK -->
            <link rel="stylesheet" href="css/normalize.css" type="text/css" charset="utf-8">
            <link rel="stylesheet" href="css/master.css" type="text/css" charset="utf-8">

            <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
            <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
            <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
              <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->
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
                    <div class="scrollspy-i">
                        <ul id="nav" class="nav hidden-xss hidden-sms" data-spy="affix">
                            <!-- <li>
                                <a href="#home">Home</a>
                            </li>
                            <li>
                                <a href="#about">About</a>
                            </li>
                            <li>
                                <a href="#work">Work</a>
                            </li>
                            <li>
                                <a href="#things">Things</a>
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
            <!-- <div class="jumbotron">
                <div class="owl-carousel owl-loaded"></div>
            </div> -->
            <!--- END: MAIN SLIDER CODE -->

            <!--- START: MAIN CONTENT CODE -->
                <section class="content">
                    
                    <article class="hero-blurb">
                        <div class="inner">
                            <img src="img/logo/logo-v1-1.svg" class="hero-logo" width="100%" height="auto" alt="Project74 Logo">
                            <div class="row hero">
                                <div class="col-xs-6">
                                    <span class="accent">Project74</span> is an experience design advisor. Clever direction and execution of user experience design projects is what we offer.
                                </div>
                                <div class="col-xs-6">
                                    If it’s for the web, we care that your clients smartphone, laptop and desktop display your product correctly. If you would like to connect with Project74, get in <a href="#contact" class="link">touch</a>.
                                </div>
                            </div>
                        </div>
                    </article>
                    <div id="contact"></div>
                </section>
            <!--- END: MAIN CONTENT CODE -->

            <!--- START: MAIN CONTENT CODE -->
                <section class="container-fluid contact">
                    <article class="section">
                        <div class="container-fluid">
                            <h2 class="h2-title">Contact</h2>
                            <?php if(isset($emailSent) && $emailSent == true) { ?>
                                    <p class="info">Your email was sent. Huzzah!</p>
                            <?php } else { ?>
                            <div class="form">
                                <?php if(isset($hasError) || isset($captchaError) ) { ?>
                                    <p class="alert">Error submitting the form</p>
                                <?php } ?>
                                <form id="contact-us" action="index.php" method="post" class="form-horizontal">
                                <div class="form-group">
                                    <label class="screen-reader-text control-label">Name</label>
                                    <input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="form-control input-lg requiredField" placeholder="*Name:" />
                                    <?php if($nameError != '') { ?>
                                        <br />
                                        <div class="error"><?php echo $nameError;?></div>
                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label class="screen-reader-text control-label">Phone</label>
                                    <input type="text" name="phoneNumber" id="phoneNumber" value="<?php if(isset($_POST['phoneNumber'])) echo $_POST['phoneNumber'];?>" class="form-control input-lg requiredField" placeholder="*Phone:" />
                                    <?php if($nameError != '') { ?>
                                        <br /><div class="error"><?php echo $nameError;?></div>
                                    <?php } ?>
                                </div>
                                
                                <div class="form-group">
                                    <label class="screen-reader-text control-label">Email</label>
                                    <input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="form-control input-lg requiredField email" placeholder="*Email:" />
                                    <?php if($emailError != '') { ?>
                                        <br /><div class="error"><?php echo $emailError;?></div>
                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label class="screen-reader-text control-label">Company</label>
                                    <input type="text" name="company" id="company" value="<?php if(isset($_POST['company'])) echo $_POST['company'];?>" class="form-control input-lg" placeholder="Company:" />
                                    <?php if($nameError != '') { ?>
                                        <br /><div class="error"><?php echo $nameError;?></div>
                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label class="screen-reader-text control-label">Message</label>
                                    <textarea name="comments" id="commentsText" class="form-control input-lg requiredField" placeholder="*Message:" cols="5" rows="6"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
                                    <?php if($commentError != '') { ?>
                                        <br /><div class="error"><?php echo $commentError;?></div>
                                    <?php } ?>
                                </div>
                                <button name="submit" type="submit" class="btn btn-default">Send to Project74</button>
                                <input type="hidden" name="submitted" id="submitted" value="true" />
                                </form>
                            </div>
                        <?php } ?>
                        </div>
                    </article>
                </section>
                <!--- END: MAIN CONTENT CODE -->

                <footer>
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-6 col-sm-4">
                                <address>
                                    <strong>Project74</strong><br>
                                    Hawkes Bay,<br>
                                    New Zealand 4130<br>
                                    <abbr title="Phone">P:</abbr> (021) 023-42422
                                </address>
                            </div>
                            <div class="col-xs-6 col-sm-4">
                                <address>
                                    <strong>Email</strong><br>
                                    <a href="mailto:#">project@project74.co.nz</a>
                                </address>
                            </div>
                            <!-- Optional: clear the XS cols if their content doesn't match in height -->
                            <div class="clearfix visible-xs-block"></div>
                            <div class="col-xs-6 col-sm-4">Copyright © Project74 2017</div>
                        </div>
                    </div>
                </footer>

        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <script>
        <!--//--><![CDATA[//><!--//-->!]]>
            $(document).ready(function() {
                $('form#contact-us').submit(function() {
                    $('form#contact-us .error').remove();
                    var hasError = false;
                    $('.requiredField').each(function() {
                        if($.trim($(this).val()) == '') {
                            var labelText = $(this).prev('label').text();
                            $(this).parent().append('<div class="error">You forgot to enter your '+labelText+'.</div>');
                            $(this).addClass('inputError');
                            hasError = true;
                        } else if($(this).hasClass('email')) {
                            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                            if(!emailReg.test($.trim($(this).val()))) {
                                var labelText = $(this).prev('label').text();
                                $(this).parent().append('<div class="error">Sorry! You\'ve entered an invalid '+labelText+'.</div>');
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
        </script>
        <script>
             $(function() {
                $('a[href*="#"]:not([href="#"])').click(function() {
                    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
                        var target = $(this.hash);
                            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                    if (target.length) {
                        $('html, body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                        return false;
                        }
                    }
                });
            });
        </script>

    </body>
</html>