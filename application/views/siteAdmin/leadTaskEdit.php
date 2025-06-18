<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <div class="col main pt-5 mt-3">
       <a href="<?php echo base_url('admin/leadtask/').$this->uri->segment('5');?>" style="float: right;margin: 14px 2px;" class="btn btn-sm btn-info back-btn">Back</a>
        
      <h1 class="d-sm-block heading"><?php echo $title; ?></h1>
      <?php
      $leadtask = $leadtask[0];
     
	  $message = $this->session->flashdata('message');
	  if($message != ''){
	      echo '<div class="alert alert-success">'.$message.'</div>';
	  }$this->session->flashdata('message','');
	  echo validation_errors(); ?>
	  
	  <div class="clearfix"></div>
	  
	  <form class="form" method="post" action="<?php echo base_url('admin/leadtask/edit/').$this->uri->segment('4');?>" enctype="multipart/form-data">
	      
        <div class="row" id="">
             
            
              <div class="col-sm-12">
                <div class="form-group">
					<label>Task</label>
                    <input type="text" name="task" value="<?php echo $leadtask->task;?>" required class="form-control">				
				</div>
            </div>
	      
            
             <div class="col-sm-4">
                <div class="form-group">
					<label>Start Date</label>
                    <input type="date" class="form-control"  name="start_date" value="<?php echo $leadtask->start_date;?>">
				</div>
            </div>
            
            <div class="col-sm-4">
                <div class="form-group">
					<label>Complete Date</label>
                    <input type="date" class="form-control"  name="complete_date" value="<?php echo $leadtask->complete_date;?>">
				</div>
            </div>
            
            <div class="col-sm-4">
				<div class="form-group">
					<label for="status">Status</label>
					<select id="status" name="status" class="form-control">
						<option value="active" <?php if($leadtask->status =='active'){ echo 'selected'; }?> >Active</option>
						<option value="deactive" <?php if($leadtask->status =='deactive'){ echo 'selected'; }?> >Deactive</option>
						<option value="pending" <?php if($leadtask->status =='pending'){ echo 'selected'; }?> >Pending</option>
						<option value="completed" <?php if($leadtask->status =='completed'){ echo 'selected'; }?> >Completed</option>
					</select>
				</div>
			</div>
            
            <div class="col-sm-6">
                <div class="form-group">
					<label>Special Instruction</label>
					<textarea  name="special_instruction" value="<?php echo $leadtask->special_instruction;?>" class="form-control" placeholder="Special Instruction" rows="4"><?php echo $leadtask->special_instruction;?></textarea>
				</div>
            </div>
            
            <div class="col-sm-6">
                <div class="form-group">
					<label>Task Detail</label>
                    <textarea name="task_detail" value="<?php echo $leadtask->task_detail;?>" class="form-control" placeholder="Task Detail" rows="4"><?php echo $leadtask->task_detail;?></textarea>
				</div>
            </div>
            
            <div class="col-sm-6 images-form">
                <div class="form-group">
					<label>Picture</label>
					<div class="row">
					<input type="file" name="image" class="form-control">
					<input type="hidden" name="imageOld" value="<?php echo $leadtask->image;?>">
					 <?php if($leadtask->image != '') { 
						echo '<img style="height: 50%;" src="'.base_url('assets/task/').''.$leadtask->image.'" class="img-fluid">';
				    } ?>
					</div>
				</div>
            </div>
            
            <div class="col-sm-6">
    <div class="form-group">
        <label>Types</label><br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="choice" id="option1" value="task"
                <?php echo ($leadtask->choice == 'task') ? 'checked' : ''; ?>>
            <label class="form-check-label" for="option1">Task</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="choice" id="option2" value="meeting"
                <?php echo ($leadtask->choice == 'meeting') ? 'checked' : ''; ?>>
            <label class="form-check-label" for="option2">Meeting</label>
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
	  
	  <form class="form" method="post" action="<?php echo base_url('admin/leadtask/edit/').$this->uri->segment('4');?>">
	  
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
		              <table id="datatable1" class="table table-striped table-bordered table-sm display" cellspacing="0" width="100%">
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
                                       <td><a href="<?php echo base_url().'admin/leadtask/delete-comment/'.$comment->id .'/'.$comment->leadtaskId;?>" class="btn btn-danger btn-sm">Delete</a></td>
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
    
                <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    
 <script>
 	jQuery(document).ready(function() {
     jQuery('#datatable1').DataTable();
 	});
 </script>
    