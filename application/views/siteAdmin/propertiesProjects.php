<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="col main pt-5 mt-3">
 <?php 
$role = $this->session->userdata('role');  // Session se role ko fetch kiya
$roles = explode(',', str_replace(' ', '', $role));  // Roles ko comma se separate karke array mein convert kiya

if (in_array('Admin', $roles)):  // Agar Admin role ho
?>
          <a href="<?php echo base_url('admin/project-approvel'); ?>" style="float: right; margin: 14px 2px;" class="btn btn-sm btn-info back-btn">
        Approval
    </a> <?php endif; ?>
    <a href="<?php echo base_url('/admin/projects/add/');?>" style="float: right;margin: 14px 2px;" class="btn btn-sm btn-info back-btn">Add New</a>
    
    <h1 class="d-sm-block heading"><?php echo $title; ?></h1>
    <div class="clearfix"></div>
  <?php
	  $message = $this->session->flashdata('message');
	  if($message != ''){
	      echo '<div class="alert alert-success">'.$message.'</div>';
		  // Clear flash data after displaying it once
		$this->session->set_flashdata('message', '');
	  }
	  echo validation_errors(); ?>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-sm-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Project Name</th>
                            <th>Address</th>
                            <th>Construction Status</th>
                            <th>Bankers</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                        foreach($projects as $project): ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $project->Project_Name; ?></td>
                                <td><?php echo $project->Address; ?></td>
                                <td><?php echo $project->Construction_Status; ?></td>
                                <td><?php echo $project->Bankers; ?></td>
                                <td><input type="hidden" name="list_id" value="" class="listId<?php echo $project->id;?>">
                              	<label class="switch">
                                  <input type="checkbox" value="deactivate" <?php if($project->Status=='active'){ ?> checked <?php } ?> name="status" class="status" data-id="<?php echo $project->id;?>">
                                  <span class="slider round"></span>
                                </label></td>
                                <td>
                                    <a href="<?php echo base_url().'admin/projects/edit/'.$project->id;?>" class="btn btn-success btn-sm">Edit</a>
                                  <?php 
$role = $this->session->userdata('role');  // Session se role ko fetch kiya
$roles = explode(',', str_replace(' ', '', $role));  // Roles ko comma se separate karke array mein convert kiya

if (!in_array('Agent', $roles)): ?>
                                   <a href="<?php echo base_url().'admin/projects/delete/'.$project->id;?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this project?')">Delete</a>
                                   <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   
    <script type="text/javascript" src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script> 
    <script>
 	jQuery(document).ready(function() {
     jQuery('.status').click(function(){
         var val=jQuery(this).val();
         var dat_id=jQuery(this).data('id');
         var listId=jQuery('.listId'+dat_id).val(dat_id);
         var list_id=jQuery('.listId'+dat_id).val();
         
    if (jQuery(this).is(':checked')) {
        var statusVal = jQuery('.status').val('active');
        var status = jQuery('.status').val();
    }  else if($(this).not(':checked'))
          {
         var statusVal = jQuery('.status').val('deactivate');
         var status = jQuery('.status').val();
    }

        $.ajax({
			type: "POST",
			url: "<?php echo base_url('Siteadmin/PropertiesProject/updateStatus');?>",
			//data:"field="+field, 
			data: {status: status,list_id:list_id},
			success: function(data){
			}
		});    
     });
    
 	});
 </script>
    <style>
/* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 72px;
  height: 20px;
}

/* Hide default HTML checkbox */
.switch input {display:none;}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #888888;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 20px;
  width: 20px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
  
  /* svg pattern */
background-color: #ffffff;
}

input:checked + .slider {
  background-color: #0ba038;
}

input:focus + .slider {
  box-shadow: 0 0 1px #0ba038;
}

input:checked + .slider:before {
  -webkit-transform: translateX(52px);
  -ms-transform: translateX(52px);
  transform: translateX(52px);
  
  /* svg pattern */
background-color: #ffffff;
background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%230ba038' fill-opacity='0.4' fill-rule='evenodd'/%3E%3C/svg%3E");
}

/* Rounded sliders */
.slider.round {
  border-radius: 68px;
}

.slider.round:before {
  border-radius: 50%;
}

.search_btn {
    background: #2ed8b6;
    border-color: #2ed8b6;
    padding: 2px 15px;
    transition: all 0.5s ease;
    color: #fff;
    font-size: 14px;
}
</style>
