<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <div class="col main pt-5 mt-3">
        <a href="<?php echo base_url('admin/meetings/').$this->uri->segment('4');?>" style="float: right;margin: 14px 2px;" class="btn btn-sm btn-info back-btn">Back</a>
        
      <h1 class="d-sm-block heading"><?php echo $title; ?></h1>
      <?php
      $meeting = $meeting[0];
     
	  $message = $this->session->flashdata('message');
	  if($message != ''){
	      echo '<div class="alert alert-success">'.$message.'</div>';
	  }$this->session->flashdata('message','');
	  echo validation_errors(); ?>
	  
	  <div class="clearfix"></div>
	  
	  <form class="form" method="post" action="<?php echo base_url('admin/meeting/edit/').$this->uri->segment('4');?>" enctype="multipart/form-data">
	      
        <div class="row" id="">
             
            
            <div class="col-sm-6">
                <div class="form-group">
					<label>Meeting Date & Time</label>
                    <input type="datetime-local" name="meeting_date" value="<?php  echo $meeting->meeting_date;?>" required class="form-control"> 				
				</div>
            </div>
             
			<div class="col-sm-6">
                <div class="form-group">
					<label>Status*</label>
					<select name="status" class="form-control">
					    <option <?php if($meeting->status=='active'){ echo 'selected'; }?> value="active">Active</option>
					    <option <?php if($meeting->status=='deactive'){ echo 'selected'; }?> value="deactive">Deactive</option>
					    <option <?php if($meeting->status=='pending'){ echo 'selected'; }?> value="pending">Pending</option>
					    <option <?php if($meeting->status=='completed'){ echo 'selected'; }?> value="completed">Completed</option>
					</select>

				</div>
            </div>
            
		    <div class="col-sm-12">
                <div class="form-group">
					<label>Description</label>
                    <textarea  name="description" value="<?php  echo $meeting->description;?>"  class="form-control" placeholder="Description"><?php  echo $meeting->description;?></textarea>			
				</div>
            </div>              
		
              
        
		
		<div class="row">
            <div class="col-sm-12 text-center">
				<input type="submit" value="Submit" name="save" class="btn btn-primary">
			</div>
		</div>
	  </form>
	   
    </div>
    