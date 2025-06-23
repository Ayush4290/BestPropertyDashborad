<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <div class="col main pt-5 mt-3">
        <a href="<?php echo base_url('admin/tag/');?>" style="float: right;margin: 14px 2px;" class="btn btn-sm btn-info back-btn">Back</a>
      <h1 class="d-sm-block heading"><?php echo $title; ?></h1>
      <?php
      $info = $tag[0];
	  $message = $this->session->flashdata('message');
	  if($message != ''){
	      echo '<div class="alert alert-success">'.$message.'</div>';
	      $this->session->set_flashdata('message','');
	  }
	  echo validation_errors(); ?>
	  
	  <div class="clearfix"></div>
	  
	  <form class="form" method="post" action="<?php echo base_url('admin/tag/edit/').$this->uri->segment('4');?>" >
	      
       
          <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
					<label>Title*</label>
					<input type="text" name="title" value="<?php echo $info->title;?>" class="form-control" placeholder="Title">
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
 