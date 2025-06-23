<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <div class="col main pt-5 mt-3">
        <a href="<?php echo base_url('admin/rent/');?>" style="float: right;margin: 14px 2px;" class="btn btn-sm btn-info back-btn">Back</a>
        
      <h1 class="d-sm-block heading"><?php echo $title; ?></h1>
      <?php
	  $message = $this->session->flashdata('message');
	  if($message != ''){
	      echo '<div class="alert alert-success">'.$message.'</div>';
	  }
	  echo validation_errors(); ?>
	  
	  <div class="clearfix"></div>
	  
	  <form class="form" method="post" action="<?php echo base_url('admin/customer/add');?>" enctype="multipart/form-data">
	      
        <div class="row" id="">
            <div class="col-sm-6">
                <div class="form-group">
					<label>Name*</label>
                    <input type="text" name="cname" value="" required class="form-control" placeholder="Name"> 				
				</div>
            </div>
            
            <div class="col-sm-6">
                <div class="form-group">
					<label>Phone*</label>
                    <input type="number" name="number" value="" required class="form-control" placeholder="Phone"> 				
				</div>
            </div>
            
            <div class="col-sm-6">
                <div class="form-group">
					<label>Email*</label>
                    <input type="email" name="email" value="" required class="form-control" placeholder="Email"> 				
				</div>
            </div> 
            
            <div class="col-sm-6">
                <div class="form-group">
					<label>Password*</label>
                    <input type="password" name="password" value="" required class="form-control" placeholder="Password"> 				
				</div>
            </div> 

         <div class="row">
            <div class="col-sm-12 text-center">
				<input type="submit" value="Submit" name="save" class="btn btn-primary">
			</div>
		</div>
	  </form>
	   
    </div>