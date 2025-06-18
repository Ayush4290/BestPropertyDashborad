<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">
   <head>
     <meta charset="utf-8">
   
      <title><?php if(isset($title)) { echo $title.' | Best Properties Mohali'; } else { echo 'Best Properties Mohali'; } ?></title>
      <meta name="description" content=""> 
      
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
       <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css" />
       <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
       
      <link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet"> 
      <link href="<?php echo base_url();?>assets/css/style-admin.css?v=<?php echo rand(10,999);?>" rel="stylesheet">
       
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   
   
   
   
   </head>
   <body>
<!--div class="loader-gif-file">
   <img alt="Loader" src="<?php echo base_url();?>assets/images/loader.gif" alt="Loader"/>
</div-->   
<nav class="navbar fixed-top navbar-expand-md navbar-dark bg-primary mb-3">
    <div class="flex-row d-flex">
        <!--- button type="button" class="navbar-toggler mr-2 " data-toggle="offcanvas" title="Toggle responsive left sidebar">
            <span class="navbar-toggler-icon"></span>
        </button --->
        <a class="navbar-brand" href="https://bestpropertiesmohali.com" title="Free Bootstrap 4 Admin Template">
            <?php 
            if(strstr($_SERVER['HTTP_HOST'],'krrissh')){
                echo '<img  src="'.base_url().'/assets/images/krissh.png" class="img-fluid">';
            } else {
                echo '<img  src="'.base_url().'/assets/images/logo.4f0aef3b00619eb99344.png" class="img-fluid">';
            }
            ?>
            
        </a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsingNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse" id="collapsingNavbar">
        <ul class="navbar-nav d-none">
            <li class="nav-item active">
                <a class="nav-link" href="/">Home <span class="sr-only">Home</span></a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto d-none">
            <li class="nav-item">
                <a class="nav-link" href="#myAlert" data-toggle="collapse">Alert</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="" data-target="#myModal" data-toggle="modal">About</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container-fluid" id="main">
    <div class="row row-offcanvas row-offcanvas-left">
 <script>
  /*  jQuery(document).ready(function(){
        jQuery('.loader-gif-file').delay(1000).hide(100);
    }); */
</script>       
        
