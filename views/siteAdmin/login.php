<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">
   <head>
     <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Admin Login | <?=$title?></title>
       
      <link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet"> 
      <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
       
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   </head>
   <body>
    <div id="wrapper">    
	  <section class="login_signup">
	    <div class="inner_container" style="overflow: hidden;">
			<h2>
			<?php 
            if(strstr($_SERVER['HTTP_HOST'],'krrissh')){
                echo '<img  src="'.base_url().'/assets/images/krissh.png" class="img-fluid" style="width:auto">';
            } else {
                echo '<img  src="'.base_url().'/assets/images/logo.4f0aef3b00619eb99344.png" class="img-fluid">';
            }
            ?></h2>
			 
			<?php if($this->session->flashdata('msg')){ ?>
                <div class="alert alert-danger"><?php echo $this->session->flashdata('msg'); ?></div>
            <?php } ?>
            <?php echo validation_errors(); ?>
          
			<form method="post" action="<?php echo base_url().$this->uri->segment(1);?>" id="loginform" name="loginform"> 
			  <label>Enter Email</label>
			 <input type="email" id="Email" class="form-control" name="userName" value="<?php echo get_cookie('userName') ? get_cookie('userName') : set_value('userName'); ?>" required/>
           <label>Enter Password</label>
           <input type="password" id="Password" class="form-control" name="pass" value="<?php echo get_cookie('password') ? get_cookie('password') : set_value('pass'); ?>" required/>

			    <label>Captcha: <strong><?php echo $captcha_question; ?></strong></label>
			    <input type="text" id="captcha" class="form-control" name="captcha" required/>
                <label><input type="checkbox" name="remember" <?php echo get_cookie('userName') ? 'checked' : ''; ?> /> Remember Me</label><br>
			    <input id="sign" type="submit" name="loginsubmit" value="Sign In"/>
			</form>
		</div>
	  </section>
	</div>
  </body>
</html>
