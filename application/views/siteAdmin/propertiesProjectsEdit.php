<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="col main pt-5 mt-3">
    <a href="<?php echo base_url('admin/projects/');?>" style="float: right;margin: 14px 2px;" class="btn btn-sm btn-info back-btn">Back</a>
    
    <h1 class="d-sm-block heading"><?php echo $title; ?></h1> 
    

   <?php
       $info = $project[0];
	  $message = $this->session->flashdata('message');
	  if($message != ''){
	      echo '<div class="alert alert-success">'.$message.'</div>';
		  // Clear flash data after displaying it once
		$this->session->set_flashdata('message', '');
	  }
	  echo validation_errors(); ?>

    <div class="clearfix"></div>
    
    <?php if($project){
        $project = $project[0];
        
    }
    ?>
   <p><strong>Total Visitor : <?php if($totalVisitor){ echo count($totalVisitor);} else {echo '0'; } ?></strong></p> <br>

    <form class="form" method="post" action="<?php echo base_url('/admin/projects/edit/'.$project->id);?>" enctype="multipart/form-data">
          
        <div class="row">
            <div class="col-sm-4">
                   <div class="form-group">
                    <label>Project Name*</label>
                    <input type="text" name="Project_Name" value="<?php echo $project->Project_Name ;?>" required class="form-control" placeholder="Project Name">                 
                    </div>
                     </div> 
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Project Description</label>
                    <input type="text" name="Project_Discription" value="<?php echo $project->Project_Discription ;?>" class="form-control" placeholder="Project Description">                
                    </div>              
                     </div>
             
             <div class="col-sm-4">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="Email" value="<?php echo $project->Email ; ?>" class="form-control" placeholder="Email">                 
                    </div>
                   </div>   </div> 
            
           <div class="row">
                 <div class="col-sm-3">
    <div class="form-group">
        <label>Project Type</label>
        <select name="Project_Type" class="form-control">
            <option value="">Select Project Type</option>
             <option <?php if($info->Project_Type=='Commercial'){ echo 'selected'; }?> value= "Commercial">Commercial</option>
			 <option <?php if($info->Project_Type=='Residential'){ echo 'selected'; }?> value= "Residential">Residential</option>
           
        </select>				
    </div>
</div>
                <div class="col-sm-3">
                <div class="form-group">
					<label>Certify</label>
					<select name="Certify" class="form-control">
						<option value="">Select Certify Type</option>
			<option <?php if($info->Certify=='Rera'){ echo 'selected'; }?> value= "Rera">Rera</option>
			<option <?php if($info->Certify=='Gamada'){ echo 'selected'; }?> value= "Gamada">Gamada</option>
						
						
  
                       
					</select>				
				</div>
            </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label>Pictures</label>
            <input type="file" name="Images[]" class="form-control" multiple>
            <?php if (!empty($project->Images)): ?>
                <div class="mt-2">
                    <?php foreach ($project->Images as $image): ?>
                        <img src="<?php echo base_url('uploads/'.$image); ?>" alt="Project Image" style="width: 100px; height: auto; margin-right: 10px;">
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
            

                <div class="col-sm-3">
          <div class="form-group">
    <label>Video URL</label>
   
      <textarea name="Video_u" class="form-control" placeholder="Enter video URL"><?php echo $project->Video_u; ?></textarea>
</div>
    </div></div>
    
    <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Minimum Budget</label>
                    <input type="number" name="Min_Budget" value="<?php echo $project->Min_Budget; ?>" class="form-control">
                </div>
            </div>
           <div class="col-sm-4">
                <div class="form-group">
                    <label>Maximum Budget</label>
                    <input type="number" name="Max_Budget" value="<?php echo $project->Max_Budget; ?>" class="form-control">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Built Up Area (Sq.ft)</label>
                    <input type="number" step="0.01" name="Built" value="<?php echo $project->Built; ?>" class="form-control" placeholder="Built Up Area">
                </div>
            </div>
        </div>
              
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Project Sub Heading</label>
                    <input type="text" name="Project_Sub_Heading" value="<?php echo $project->Project_Sub_Heading; ?>" class="form-control" placeholder="Project Sub Heading">                 
                    </div>
                </div>    
          
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="Address" value="<?php echo $project->Address; ?>" class="form-control" placeholder="Project Address">
                </div>
            </div>    
  <div class="col-sm-4 mt-4">
       <div class="form-group">
            <label>
                <input type="checkbox" name="Upcoming_Projects" value="Yes" 
                       <?php echo ($project->Upcoming_Projects == 'Yes') ? 'checked' : ''; ?>>
                Upcoming Projects
            </label>
        </div>
</div>

  
        </div>
            
        <div class="row">
            <div class="col-sm-6">
               <div class="form-group">
                    <label>Bankers</label>
                    <input type="text" name="Bankers" value="<?php echo $project->Bankers; ?>" class="form-control" placeholder="Bankers">
                </div>
            </div>
                <div class="col-sm-6">
                <div class="form-group">
                    <label>Construction Status</label>
                    <input type="text" name="Construction_Status" value="<?php echo $project->Construction_Status; ?>" class="form-control" placeholder="Construction Status">
                </div>    
            </div>
        </div>
              
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Property Sub Description</label>
                    <textarea name="Property_Sub_Description" class="form-control" placeholder="Property Sub Description"><?php echo $project->Property_Sub_Description; ?></textarea>          
                </div>    
            </div>    
                    
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Exclusive Text</label>
                    <textarea name="Exclusive_Limited" class="form-control" placeholder="Exclusive Limited"><?php echo $project->Exclusive_Limited; ?></textarea>
                </div>
            </div>  
        </div>  
             
     <div class="col-sm-6">
    <div class="form-group">
   <button style="margin-top: 30px;" type="button" id="add" class="btn btn-primary">Add Amenities Details</button>

<!-- Dynamic input fields will be added here -->
<div id="dynamic_field">
    <!-- Existing amenities will be populated here -->
</div>
</div>
        </div>
    </div>
        </div>

                
        <div class="row">
            <div class="col-sm-12 text-center">
                <input type="submit" value="Update" name="update" class="btn btn-primary">
            </div>
        </div>
    </form>    
</div>

<script>
    // Backend se existing amenities ko fetch karne ke liye PHP se array data
    var existingAmenities = <?= json_encode(explode(',', $project->amenities)); ?>;

    // Dynamic field container
    var dynamicField = document.getElementById('dynamic_field');

    // Populate existing amenities
    existingAmenities.forEach(function(amenity) {
        createInputField(amenity);
    });

    // Add button click par naye input field create karne ke liye
    document.getElementById('add').addEventListener('click', function() {
        createInputField('');
    });

    // Helper function to create an input field
    function createInputField(value) {
        var inputGroup = document.createElement('div');
        inputGroup.className = 'input-group mb-2';

        var input = document.createElement('input');
        input.type = 'text';
        input.name = 'amenities[]';
        input.placeholder = 'Enter Amenity';
        input.className = 'form-control';
        input.value = value;

        // Remove button
        var removeButton = document.createElement('button');
        removeButton.className = 'btn btn-danger';
        removeButton.type = 'button';
        removeButton.textContent = 'Remove';
        removeButton.addEventListener('click', function() {
            dynamicField.removeChild(inputGroup);
        });

        var inputGroupAppend = document.createElement('div');
        inputGroupAppend.className = 'input-group-append';
        inputGroupAppend.appendChild(removeButton);

        inputGroup.appendChild(input);
        inputGroup.appendChild(inputGroupAppend);

        dynamicField.appendChild(inputGroup);
    }
</script>