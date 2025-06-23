<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <div class="col main pt-5 mt-3">
        <a href="<?php echo base_url('admin/projects/');?>" style="float: right;margin: 14px 2px;" class="btn btn-sm btn-info back-btn">Back</a>
        
      <h1 class="d-sm-block heading"><?php echo $title; ?></h1>
      <?php
	  $message = $this->session->flashdata('message');
	  if($message != ''){
	     $this->session->set_flashdata('message','');
	      echo '<div class="alert alert-success">'.$message.'</div>';
	  }
	  echo validation_errors(); ?>
	  
	  <div class="clearfix"></div>
	  
	  <form class="form" method="post" action="<?php echo base_url('admin/project/add');?>" enctype="multipart/form-data">
	      
        <div class="row" id="">
            <div class="col-sm-12">
                <div class="form-group">
					<label>Title*</label>
                    <input type="text" name="title" value="" required class="form-control" placeholder="Title"> 				
				</div>
            </div> 
            
            <div class="col-sm-4">
                <div class="form-group">
					<label>Start Date*</label>
                    <input type="date" name="start_date" value="" required class="form-control">				
				</div>
            </div>
            
            <div class="col-sm-4">
                <div class="form-group">
					<label>Complete Date*</label>
                    <input type="date" name="complete_date" value="" required class="form-control">				
				</div>
            </div>
            
        
                    <select hidden id="status" name="status" class="form-control" >
                        <option value="">Status</option>
						<option value="new">New</option>
						<option value="hold">Hold</option>
						<option value="pending">Pending</option>
					    <option value="inprogress">Inprogress</option>
						<option value="qa">QA</option>
						<option value="fail">Fail</option>
						<option value="tbd">TBD</option>
						<option value="client_review">Client Review</option>
						<option value="completed">Completed</option>
                   </select>			
            
            
            <div class="col-sm-4">
                <div class="form-group">
				<label for="status">Status*</label>
                    <select id="status" name="status" class="form-control">
                        <option value="">Status</option>
						<option value="new">New</option>
						<option value="hold">Hold</option>
						<option value="pending">Pending</option>
					    <option value="inprogress">Inprogress</option>
						<option value="qa">QA</option>
						<option value="fail">Fail</option>
						<option value="tbd">TBD</option>
						<option value="client_review">Client Review</option>
						<option value="completed">Completed</option>
                   </select>			
				</div>
            </div> 
            
            <div class="col-sm-12">
                <div class="form-group">
					<label>Special Instructions</label>
                    <textarea  name="spe_instruction" class="form-control" placeholder="Special Instructions"></textarea>
				</div>
            </div>
                         
            <div class="col-sm-12">
                <div class="form-group">
					<label>Description*</label>
                    <textarea  name="description" class="form-control" placeholder="Description" required></textarea>

				</div>
            </div> 
            
           
			
            <div class="row">
                <div class="col-sm-12 text-center">
				    <input type="submit" value="Submit" name="save" class="btn btn-primary">
			    </div>
		    </div>
	  </form>
	   
    </div>