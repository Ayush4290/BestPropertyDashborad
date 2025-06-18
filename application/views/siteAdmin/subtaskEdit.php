<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 $task = $task[0];
?>

    <div class="col main pt-5 mt-3">
        <a href="<?php echo base_url('admin/subtask/' . $this->uri->segment(4) . '/' . $this->uri->segment(5)); ?>" style="float: right;margin: 14px 2px;" class="btn btn-sm btn-info back-btn">Back</a>
        
      <h1 class="d-sm-block heading"><?php echo $title; ?></h1>
      <?php
     
	  $message = $this->session->flashdata('message');
	  if($message != ''){
	      
	      $this->session->set_flashdata('message','');
	      echo '<div class="alert alert-success">'.$message.'</div>';
	  }$this->session->flashdata('message','');
	  echo validation_errors(); ?>
	  
	  <div class="clearfix"></div>
	  
	  <form class="form" method="post" action="<?php echo base_url('admin/subtask/edit/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/' . $this->uri->segment(6)); ?>" enctype="multipart/form-data">
	      
        <div class="row" id="">
             
            
              <div class="col-sm-12">
                <div class="form-group">
					<label>Sub Task</label>
                    <input type="text" name="task" value="<?php echo $task->subtask;?>" required class="form-control">				
				</div>
            </div>
	      
            
             <div class="col-sm-4">
                <div class="form-group">
					<label>Start Date</label>
                    <input type="date" class="form-control"  name="start_date" value="<?php echo $task->start_date;?>">
				</div>
            </div>
            
            <div class="col-sm-4">
                <div class="form-group">
					<label>Complete Date</label>
                    <input type="date" class="form-control"  name="complete_date" value="<?php echo $task->complete_date;?>">
				</div>
            </div>
            
            <div class="col-sm-4">
				<div class="form-group">
					<label for="status">Status</label>
					<select id="status" name="status" class="form-control">
						<option value="new" <?php if($task->status =='new'){ echo 'selected'; }?> >New</option>
						<option value="hold" <?php if($task->status =='hold'){ echo 'selected'; }?> >Hold</option>
						<option value="pending" <?php if($task->status =='pending'){ echo 'selected'; }?> >Pending</option>
						<option value="inprogress" <?php if($task->status =='inprogress'){ echo 'selected'; }?> >Inprogress</option>
						<option value="qa" <?php if($task->status =='qa'){ echo 'selected'; }?> >QA</option>
						<option value="fail" <?php if($task->status =='fail'){ echo 'selected'; }?> >Fail</option>
						<option value="tbd" <?php if($task->status =='tbd'){ echo 'selected'; }?> >TBD</option>
						<option value="client_review" <?php if($task->status =='client_review'){ echo 'selected'; }?> >Client Review</option>
						<option value="completed" <?php if($task->status =='completed'){ echo 'selected'; }?> >Completed</option>
					</select>
				</div>
			</div>
            
            <div class="col-sm-12">
                <div class="form-group">
					<label>Special Instruction</label>
					<textarea  name="special_instruction" value="<?php echo $task->special_instruction;?>" class="form-control" placeholder="Special Instruction" rows="4"><?php echo $task->special_instruction;?></textarea>
				</div>
            </div>
            
            <div class="col-sm-12">
                <div class="form-group">
					<label>Task Detail</label>
                    <textarea name="task_detail" value="<?php echo $task->subtask_detail;?>" class="form-control" placeholder="Task Detail" rows="4"><?php echo $task->subtask_detail;?></textarea>
				</div>
            </div>
            
            <div class="col-sm-6 images-form">
                <div class="form-group">
					<label>Picture</label>
					<div class="row">
					<input type="file" name="image" class="form-control">
					<input type="hidden" name="imageOld" value="<?php echo $task->image;?>">
					 <?php if($task->image != '') { 
						echo '<img style="height: 50%;" src="'.base_url('assets/task/').''.$task->image.'" class="img-fluid">';
				    } ?>
					</div>
				</div>
            </div>
            
            
		</div>
            
            <div class="row">
                <div class="col-sm-12 text-center">
				    <input type="submit" value="Submit" name="save" class="btn btn-primary">
			    </div>
		    </div>
	  </form>
	  
	  <!--Comment-->
	  
	  <form class="form" method="post" action="<?php echo base_url('admin/subtask/edit/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/' . $this->uri->segment(6)); ?>">
	  
	  <h1 class="d-sm-block heading">Comment</h1>
	  <div class="row">
	      <div class="col-sm-12">
             <div class="form-group">
				 <label>Comment</label>
                 <textarea  name="comment" value="" rows="4" class="form-control" placeholder="Comment"></textarea>  				
			 </div>
         </div>
	      
         
         <div class="col-sm-12 mt-4 text-center">
				<input type="submit" value="Submit" name="submit" class="btn btn-primary">
		</div>
		
	  </div>
	 </form>
	 
	 
	 
	
	  
	  <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
		              <table class="table table-striped">
                         <thead>
						    <tr>
							   <th>Comment Id</th>
							   <th>Comment</th>
							   <th>Operation</th>
							 
							</tr>
						 </thead>
						  <tbody>
						      <?php 
						      if(!empty($comment)) { 
						            $i = 1;
						          foreach($comment as $comment){?>
                                        <tr>
                                       <td><?php echo $i;?></td>
                                       <td><?php echo $comment->comment;?></td>
                                       <td><a href="<?php echo base_url().'admin/subtask/delete-comment/'.$comment->id .'/'.$comment->subtaskId;?>" class="btn btn-danger btn-sm">Delete</a></td>
                                      </tr>
						  <?php
						  $i++;
						      } 
						  }?>
						 
						  </tbody>
					  </table>
					 </div>
                </div>
            </div>
    </div>
    