
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

			
<?php
$selected_roles = !empty($user[0]->role) ? array_map('trim', explode(',', $user[0]->role)) : [];
?>

<div class="form-group">
    <label>Role*</label><br>

    <label><input type="checkbox" name="role[]" value="Admin" <?php echo in_array('Admin', $selected_roles) ? 'checked' : ''; ?>> Admin</label><br>
    <label><input type="checkbox" name="role[]" value="Manager" <?php echo in_array('Manager', $selected_roles) ? 'checked' : ''; ?>> Manager</label><br>
    <label><input type="checkbox" name="role[]" value="Agent" <?php echo in_array('Agent', $selected_roles) ? 'checked' : ''; ?>> Sale Agent</label><br>
    <label><input type="checkbox" name="role[]" value="Telecaller" <?php echo in_array('Telecaller', $selected_roles) ? 'checked' : ''; ?>> Telecaller</label><br>
    <label><input type="checkbox" name="role[]" value="Marketing Exec" <?php echo in_array('Marketing Exec', $selected_roles) ? 'checked' : ''; ?>> Marketing Exec</label><br>
    <label><input type="checkbox" name="role[]" value="CRM Executive" <?php echo in_array('CRM Executive', $selected_roles) ? 'checked' : ''; ?>> CRM Executive</label><br>
    <label><input type="checkbox" name="role[]" value="Documentation" <?php echo in_array('Documentation', $selected_roles) ? 'checked' : ''; ?>> Documentation</label><br>
</div>




            
            <div class="row">
                <div class="col-sm-12 text-center">
				    <input type="submit" value="Submit" name="save" class="btn btn-primary">
			    </div>
		    </div>
	  </form>
	
	 
    </div>
    