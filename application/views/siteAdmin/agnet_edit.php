<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <div class="col main pt-5 mt-3">
        <a href="<?php echo base_url('admin/user/') ?>" style="float: right;margin: 14px 2px;" class="btn btn-sm btn-info back-btn">Back</a>
        
      <h1 class="d-sm-block heading"><?php echo $title; ?></h1>
      <?php
      $info = $user[0];
      
     
	  $message = $this->session->flashdata('message');
	  if($message != ''){
	      echo '<div class="alert alert-success">'.$message.'</div>';
	  }$this->session->flashdata('message','');
	  echo validation_errors(); ?>
	  
	  <div class="clearfix"></div>
	  
	  <form class="form" method="post" action="<?php echo base_url('admin/user/edit/').$this->uri->segment('4');?>" enctype="multipart/form-data">
	      
        <div class="row" id="">
             <div class="col-sm-6">
				<div class="form-group">
					<label>Name*</label>
					<input type="text" name="name" value="<?php echo $info->fullName;?>" required class="form-control" placeholder="Name">
				</div>
			</div>
			
			<div class="col-sm-6">
				<div class="form-group">
					<label>Email*</label>
					<input type="email" name="email" value="<?php echo $info->email;?>" required class="form-control" placeholder="Email">
				</div>
			</div>
			
			<div class="col-sm-6">
				<div class="form-group">
					<label>Password</label>
					<input type="password" name="password" value="<?php //echo $info->password;?>" required class="form-control" placeholder="">
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>Phone</label>
					<input type="number" name="mobile" value="<?php echo $info->phone;?>" class="form-control" placeholder="Phone">

				</div>
			</div>

			<div class="col-sm-6">
				<div class="form-group">
					<label>Address</label>
					<input type="text" name="address" value="<?php echo $info->address;?>"  class="form-control" placeholder="Address">

				</div>
			</div>

			
<div class="col-sm-6">
    <div class="form-group">
        <label>Role*</label>
        <select name="role[]" class="form-control" multiple <?php if(strpos($info->role, 'Agent') !== false){ echo 'disabled'; } ?>>
            <option value="Admin" <?php if(strpos($info->role, 'Admin') !== false){ echo 'selected'; } ?>>Admin</option>
            <option value="Manager" <?php if(strpos($info->role, 'Manager') !== false){ echo 'selected'; } ?>>Manager</option>
            <option value="Agent" <?php if(strpos($info->role, 'Agent') !== false){ echo 'selected'; } ?>>Agent</option>
            <option value="Developer" <?php if(strpos($info->role, 'Developer') !== false){ echo 'selected'; } ?>>Developer</option>
            <option value="Sale Person" <?php if(strpos($info->role, 'Sale Person') !== false){ echo 'selected'; } ?>>Sale Person</option>
        </select>
    </div>
</div>

</div>

            
            <div class="row">
                <div class="col-sm-12 text-center">
				    <input type="submit" value="Submit" name="save" class="btn btn-primary">
			    </div>
		    </div>
	  </form>
	
	 
    </div>
    