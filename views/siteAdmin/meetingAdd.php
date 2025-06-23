<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <div class="col main pt-5 mt-3">
        <a href="<?php echo base_url('admin/meetings/').$this->uri->segment('4');?>" style="float: right;margin: 14px 2px;" class="btn btn-sm btn-info back-btn">Back</a>
        
      <h1 class="d-sm-block heading"><?php echo $title; ?></h1>
      <?php
	  $message = $this->session->flashdata('message');
	  if($message != ''){
	      echo '<div class="alert alert-success">'.$message.'</div>';
	  }
	  echo validation_errors(); ?>
	  
	  <div class="clearfix"></div>
	  
	  <form class="form" method="post" action="<?php echo base_url('admin/meeting/add/').$this->uri->segment('4');?>" enctype="multipart/form-data">
	      <div class="row" id="">
             
	      <div class="col-sm-6">
                <div class="form-group">
					<label>Meeting Date and Time*</label>
                    <input type="datetime-local" name="meeting_date" value="" required class="form-control">				
				</div>
            </div>
	      
           <div class="col-sm-6">
                <div class="form-group">
				<label for="status">Status</label>
                    <select id="status" name="status" class="form-control">
                         <option value="active">Active</option>
                         <option value="deactive">Deactive</option>
                    </select>			
				</div>
            </div> 
            
            <div class="col-sm-12">
                <div class="form-group">
					<label>Description*</label>
                    <textarea  name="description" value=""  class="form-control" placeholder="Description" required></textarea>
				</div>
            </div>
            
            <div class="row">
                <div class="col-sm-12 text-center">
				    <input type="submit" value="Submit" name="save" class="btn btn-primary">
			    </div>
		    </div>
	  </form>
	   
    </div>