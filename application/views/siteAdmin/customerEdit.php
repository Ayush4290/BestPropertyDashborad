<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <div class="col main pt-5 mt-3">
        <a href="<?php echo base_url('admin/rent/');?>" style="float: right;margin: 14px 2px;" class="btn btn-sm btn-info back-btn">Back</a>
        
      <h1 class="d-sm-block heading"><?php echo $title; ?></h1>
      <?php
      $info = $customer[0];
	  $message = $this->session->flashdata('message');
	  if($message != ''){
	      echo '<div class="alert alert-success">'.$message.'</div>';
	  }
	  echo validation_errors(); ?>
	  
	  <div class="clearfix"></div>
	  
	  <form class="form" method="post" action="<?php echo base_url('admin/customer/edit/').$this->uri->segment('4');?>" enctype="multipart/form-data">
	      
        <div class="row" id="">
             <div class="col-sm-6">
                <div class="form-group">
					<label>Name*</label>
                    <input type="text" name="cname" value="<?php  echo $info->name;?>" required class="form-control" placeholder="Name"> 				
				</div>
            </div> 
            
            <div class="col-sm-6">
                <div class="form-group">
					<label>Email*</label>
                    <input type="email" name="email" value="<?php  echo $info->email;?>" required class="form-control" placeholder="Email"> 				
				</div>
            </div>
            
            <div class="col-sm-6">
                <div class="form-group">
					<label>Phone*</label>
                    <input type="number" name="number" value="<?php  echo $info->mobile;?>" required class="form-control" placeholder="Phone"> 				
				</div>
            </div> 
            
            <div class="col-sm-6">
                <div class="form-group">
					<label>Password*</label>
                    <input type="text" name="password" value="" class="form-control" placeholder="Password"> 				
				</div>
            </div> 
            
            <div class="col-sm-6">
                <div class="form-group">
					<label>Varify User </label>
					<Select name="varified_user" class="form-control">
						<option value="Yes" <?php if($info->varified_user=='Yes'){echo 'selected';} ?>>Yes </option>
						<option value="No" <?php if($info->varified_user=='No'){echo 'selected';} ?>>No </option>
					</select>
				</div>
            </div>
              
        <div class="col-sm-12"></div>
		<div class="col-sm-12 text-center">
            <input type="submit" value="Submit" name="save" class="btn btn-primary">
		</div>
	  </form>
	   
    </div>
<script>
jQuery(document).ready(function() {
       var i=1; 
       jQuery('#add').click(function(){  
         i++;  
         jQuery('#dynamic_field').append('<div id="custom'+i+'" class="row"><div class="col-sm-4" id="row'+i+'" class="dynamic-added"><div class="form-group"><input type="text" class="form-control" name="additional[]" value="" placeholder="label"></div></div><div class="col-sm-6" id="row'+i+'" class="dynamic-added"><div class="form-group"><input type="text" class="form-control" placeholder="value" name="custom_value[]" value="" id="custom_value"></div></div><div class="col-sm-2"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></div></div>');  
      });
       jQuery(document).on('click', '.btn_remove', function(){  
           var button_id = jQuery(this).attr("id");   
           jQuery('#custom'+button_id+'').remove();  

      });
});      
 </script>      