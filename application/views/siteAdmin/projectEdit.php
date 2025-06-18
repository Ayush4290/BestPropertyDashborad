<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <div class="col main pt-5 mt-3">
        <a href="<?php echo base_url('admin/projects/');?>" style="float: right;margin: 14px 2px;" class="btn btn-sm btn-info back-btn">Back</a>
        <a href="<?php echo base_url('admin/task/').$this->uri->segment('4');?>" style="float: right;margin: 14px 2px;" class="btn btn-sm btn-info back-btn">Task</a>
      <h1 class="d-sm-block heading"><?php echo $title; ?></h1>
      <?php
      $project = $project[0];
     
	  $message = $this->session->flashdata('message');
	  if($message != ''){
	      $this->session->set_flashdata('message','');
	      echo '<div class="alert alert-success">'.$message.'</div>';
	  }
	  echo validation_errors(); ?>
	  
	  <div class="clearfix"></div>
	  
	  <form class="form" method="post" action="<?php echo base_url('admin/project/edit/').$this->uri->segment('4');?>" enctype="multipart/form-data">
	      
        <div class="row" id="">
             <div class="col-sm-12">
                <div class="form-group">
					<label>Title*</label>
                    <input type="text" name="title" value="<?php  echo $project->title;?>" required class="form-control" placeholder="Title"> 				
				</div>
            </div>
            
            <div class="col-sm-4">
                <div class="form-group">
					<label>Start Date</label>
                    <input type="date" name="start_date" value="<?php  echo $project->start_date;?>" required class="form-control"> 				
				</div>
            </div>
                    
			<div class="col-sm-4">
                <div class="form-group">
					<label>Complete Date*</label>
					<input type="date" name="complete_date" value="<?php  echo $project->complete_date;?>" required class="form-control">

				</div>
            </div>
            
            
             <select hidden name="status" class="form-control">
			    <option <?php if($project->status=='new'){ echo 'selected'; }?> value="new">New</option>
			    <option <?php if($project->status=='hold'){ echo 'selected'; }?> value="hold">Hold</option>
			    <option <?php if($project->status=='pending'){ echo 'selected'; }?> value="pending">Pending</option>
			    <option <?php if($project->status=='inprogress'){ echo 'selected'; }?> value="inprogress">Inprogress</option>
			    <option <?php if($project->status=='qa'){ echo 'selected'; }?> value="qa">QA</option>
			    <option <?php if($project->status=='fail'){ echo 'selected'; }?> value="fail">Fail</option>
			    <option <?php if($project->status=='tbd'){ echo 'selected'; }?> value="tbd">TBD</option>
			    <option <?php if($project->status=='client_review'){ echo 'selected'; }?> value="client_review">Client Review</option>
			    <option <?php if($project->status=='completed'){ echo 'selected'; }?> value="completed">Completed</option>
			</select>
			
			<div class="col-sm-4">
                <div class="form-group">
					<label>Status*</label>
					<select name="status" class="form-control">
					    <option <?php if($project->status=='new'){ echo 'selected'; }?> value="new">New</option>
					    <option <?php if($project->status=='hold'){ echo 'selected'; }?> value="hold">Hold</option>
					    <option <?php if($project->status=='pending'){ echo 'selected'; }?> value="pending">Pending</option>
					    <option <?php if($project->status=='inprogress'){ echo 'selected'; }?> value="inprogress">Inprogress</option>
					    <option <?php if($project->status=='qa'){ echo 'selected'; }?> value="qa">QA</option>
					    <option <?php if($project->status=='fail'){ echo 'selected'; }?> value="fail">Fail</option>
					    <option <?php if($project->status=='tbd'){ echo 'selected'; }?> value="tbd">TBD</option>
					    <option <?php if($project->status=='client_review'){ echo 'selected'; }?> value="client_review">Client Review</option>
					    <option <?php if($project->status=='completed'){ echo 'selected'; }?> value="completed">Completed</option>
					</select>

				</div>
            </div>
            
            
			<div class="col-sm-12">
                <div class="form-group">
					<label>Special Instruction</label>
					<textarea  name="spe_instruction" class="form-control" placeholder="Special Instruction"><?php  echo $project->special_instruction;?></textarea>

				</div>
            </div>
            
		    <div class="col-sm-12">
                <div class="form-group">
					<label>Description*</label>
                    <textarea  name="description"  class="form-control" placeholder="Description"><?php  echo $project->description;?></textarea>			
				</div>
            </div>              
		
             
			<div class="col-sm-12">
                <div class="form-group">
					<label>Tags</label>
                    <input type="text" name="tags" value="<?php  echo $project->tags;?>" class="form-control" placeholder="tags"> 				
				</div>
            </div>
			
        
		
		<div class="row">
            <div class="col-sm-12 text-center">
				<input type="submit" value="Submit" name="save" class="btn btn-primary">
			</div>
		</div>
	  </form>
	   
    </div>
