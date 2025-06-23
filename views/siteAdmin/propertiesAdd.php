<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <div class="col main pt-5 mt-3">
        <a href="<?php echo base_url('admin/properties/');?>" style="float: right;margin: 14px 2px;" class="btn btn-sm btn-info back-btn">Back</a>
        
      <h1 class="d-sm-block heading"><?php echo $title; ?></h1>
      <?php
	  $message = $this->session->flashdata('message');
	  if($message != ''){
	      echo '<div class="alert alert-success">'.$message.'</div>';
		  // Clear flash data after displaying it once
		$this->session->set_flashdata('message', '');
	  }
	  echo validation_errors(); ?>
	  
	  <div class="clearfix"></div>
	  
	  <form class="form" method="post" action="<?php echo base_url('admin/properties/add');?>" enctype="multipart/form-data">
	      
	      
	      
	      
        <div class="row" id="">
            <div class="col-sm-3">
                <div class="form-group">
					<label>Property Name*</label>
                    <input type="text" name="rName"  value="<?php echo $this->input->post('rName')?>" required class="form-control" placeholder="Property Name"> 				
					</div>
            </div> 
            <div class="col-sm-3">
                <div class="form-group">
					<label>Property Type*</label>
					<select name="property_type" class="form-control" required>
						<option value="">Select Property Type</option>

                		<option value="Industrial Property">Industrial Property</option>
                		<option value="Factory">Factory</option>
                		<option value="Residential Property">Residential Property</option>
                		<option value="Bungalows / Villas">Bungalows / Villas</option>
                		<option value="Flats & Apartments">Flats & Apartments</option>
                		<option value="Residential - Others">Residential - Others</option>
                		<option value="Individual House/Home">Individual House/Home</option>
                		<option value="Residential Land / Plot">Residential Land / Plot</option>
                		<option value="Commercial Property">Commercial Property</option>
                		<option value="Commercial Shops">Commercial Shops</option>
                		<option value="Commercial Lands & Plots">Commercial Lands & Plots</option>
                		<option value="Hotel & Restaurant">Hotel & Restaurant</option>		

					</select>				
					</div>
            </div>    
            <div class="col-sm-3">
                <div class="form-group">
					<label>Project/Builder</label>
                    <input type="text" name="property_builder" value="<?php echo $this->input->post('property_builder')?>" class="form-control" placeholder="Property Name"> 				
					</div>
            </div> 
               <div class="col-sm-3">
                <div class="form-group">
					<label>BHK</label>
					<select name="BHK" class="form-control">
						<option value="">Select Property Type</option>
                		<option value="1BHK">1BHK</option>
                		<option value="2BHK">2BHK</option>
                		<option value="3BHK"> 3BHK</option>
                		<option value="4BHK">4BHK</option>
                		<option value="5BHK">5BHK</option>
                

					</select>				
					</div>
            </div> 
            <div class="col-sm-6">
                <div class="form-group">
					<label>Property For*</label>
					<select name="property_for" class="form-control" required>
						<option value="">Select Type</option>
                        <option value="Buy">Buy</option>
                        <option value="Rent">Rent</option>
                        <option value=" Leased/Rent">Leased/Rent</option>
                       
					</select>				
				</div>
            </div> 
			<div class="col-sm-6">
                <div class="form-group">
                    <div class="row">
                    <div class="col-md-6">
					<label>Budget In Lacs/Crore</label>
					<input type="number" step="0.01" name="budget" class="form-control" placeholder="Budget">
					</div>
					<div class="col-md-6">
					<label>Budget In Word</label>
					<input type="text"  name="budget_in_words" class="form-control" placeholder="Budget in word">
					</div>
					</div>
				</div>
            </div>            
		
			<div class="col-sm-4">
                <div class="form-group">
					<label>Address*</label>
					<input type="text" name="address" value="<?php echo $this->input->post('address')?>" required class="form-control" placeholder="Property Address">

				</div>
            </div>
			<div class="col-sm-4">
                <div class="form-group">
					<label>State*</label>
					<input type="text" name="state" value="<?php echo $this->input->post('state')?>" required class="form-control" placeholder="State">

				</div>
            </div>
             <div class="col-sm-4">
                <div class="form-group">
					<label>Type*</label>
					<select name="type" class="form-control" required>
						<option value="">Select Property Type</option>

                		<option value="Kothi">Kothi</option>
                		<option value="Flat">Flat</option>
                		<option value="Plot Property">Plot</option>
                				

					</select>				
					</div>
            </div>    
			<div class="col-sm-6">
                <div class="form-group">
					<label>City*</label>
					<input type="text" name="city" value="<?php echo $this->input->post('city')?>" required class="form-control" placeholder="City">

				</div>
            </div>  
		
            
            <div class="col-sm-6">
                <div class="form-group">
					<label>Services*</label>
					<select name="service" class="form-control" required>
						<option value="">Select Service</option>
							<option value="Commercial">Commercial</option>
                        <option value="Residential">Residential</option>
                        <option value="Office Space">Office Space</option>
                        <option value="Flats and Plots">Flats and Plots</option>  
					</select>				
				</div>
            </div> 
            
            
            
            
            
            	<div class="col-sm-6">
                <div class="form-group">
					<label>Zip Code</label>
					<input type="text" name="zip_code" value="<?php echo $this->input->post('zip_code')?>"  class="form-control" placeholder="Zip Code">
                </div>
            </div>
            	<div class="col-sm-6">
                <div class="form-group">
					<label>Built Up Area (Sq.ft)</label>
					<input type="number" step="0.01" name="built" value="<?php echo $this->input->post('number')?>"  class="form-control" placeholder="Built Up Area">

				</div>
            </div>
			<div class="col-sm-6">
                <div class="form-group">
					<label>Land / Plot Area (Sq.ft)</label>
					<input type="number" step="0.01" name="land" value="<?php echo $this->input->post('land')?>"  class="form-control" placeholder="Land / Plot Area">

				</div>
            </div>
			<div class="col-sm-6">
                <div class="form-group">
					<label>Carpet</label>
					<input type="number" step="0.01" name="carpet" value="<?php echo $this->input->post('carpet')?>"  class="form-control" placeholder="Carpet">

				</div>
            </div>            
            
            <div class="col-sm-6">
                <div class="form-group">
					<label>Property Description</label>
                    <textarea  name="note" value="<?php echo $this->input->post('note')?>"  class="form-control" placeholder="Property Description"></textarea>			
					</div>
            </div>  
          <div class="col-sm-6">
<div class="form-group">
    <label for="project">Select Project Name:</label>
  <select name="project_n" id="project" class="form-control">
    <option value="">Select a project</option>
    <?php foreach ($projects as $project): ?>
        <option value="<?= htmlspecialchars($project['Project_Name']); ?>"><?= htmlspecialchars($project['Project_Name']); ?></option>
    <?php endforeach; ?>
</select>

</div>
            </div>       
			<div class="col-sm-6">
                <div class="form-group">
					<label>Person Name</label>
					<input type="text" name="pName" value="<?php echo $this->input->post('pName')?>"  class="form-control" placeholder="Person Name">

				</div>
            </div>    
			<div class="col-sm-6">
                <div class="form-group">
					<label>Person Phone</label>
					<input type="number" name="pPhone" value="<?php echo $this->input->post('pPhone')?>"  class="form-control" placeholder="Person Phone">

				</div>
            </div>    
			<div class="col-sm-6">
                <div class="form-group">
					<label>Person Address</label>
					<input type="text" name="pAddress" value="<?php echo $this->input->post('pAddress')?>"  class="form-control" placeholder="Person Address">

				</div>
            </div> 
            <div class="col-sm-6">
                <div class="form-group">
					<label>Picture</label>
					<input type="file" name="image" class="form-control">
				</div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
					<label>Picture</label>
					<input type="file" name="image2" class="form-control">
				</div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
					<label>Picture</label>
					<input type="file" name="image3" class="form-control">
				</div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
					<label>Picture</label>
					<input type="file" name="image4" class="form-control">
				</div>
            </div> 
      <!-- <div class="col-sm-6">
    <div class="form-group">
        <label for="status">Status</label>
        <select id="status" name="status" class="form-control">
            <option value="" disabled selected>Choose One</option>
            <option value="active">Active</option>
            <option value="deactive">Deactive</option>
        </select>
    </div>
</div>-->

            <div class="col-sm-6"></div>
                <div class="col-sm-6">
                <div class="form-group">
					<label>Amenities*</label></br>
					<div class="row"><div class="col-md-6">
					<label><input type="checkbox" name="amenities[]" value="Car parking"> Car parking</label></br>
					<label><input type="checkbox" name="amenities[]" value="Security services"> Security services</label></br>
					<label><input type="checkbox" name="amenities[]" value="Water supply"> Water supply</label></br>
					<label><input type="checkbox" name="amenities[]" value="Elevators"> Elevators</label></br>
					<label><input type="checkbox" name="amenities[]" value="Power backup"> Power backup</label></br>
					<label><input type="checkbox" name="amenities[]" value="Gym"> Gym</label></br>
					<label><input type="checkbox" name="amenities[]" value="Play area"> Play area</label></br>
					</div>
					<div class="col-md-6">
					<label><input type="checkbox" name="amenities[]" value="Swimming pool"> Swimming pool</label></br>
					<label><input type="checkbox" name="amenities[]" value="Restaurants"> Restaurants</label></br>
					<label><input type="checkbox" name="amenities[]" value="Party hall"> Party hall</label></br>
					<label><input type="checkbox" name="amenities[]" value="Temple and religious activity place"> Temple and religious activity place</label></br>
					<label><input type="checkbox" name="amenities[]" value="Cinema hall"> Cinema hall</label></br>
					<label><input type="checkbox" name="amenities[]" value="Walking/Jogging track"> Walking/Jogging track</label></div></div>
				</div>
            </div>  
            <div class="col-sm-6"></div>
            </div>
            <div id="dynamic_field"><label id="label" style="display:none;">Additional Details</label></div>
            
 			<div class="col-sm-6">
                <div class="form-group">
					<label></label>
                      <button style="margin-top: 30px;" type="button" id="add"  class="btn btn-primary">Add Additional Details</button>
				</div>
            </div> 
            <div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>Bathrooms</label>
            <select name="bathrooms" class="form-control">
                <option value="">Select Bathrooms</option>
                <option value="0" <?php if(isset($info->bathrooms) && $info->bathrooms == 0) echo 'selected'; ?>>0</option>
                <option value="1" <?php if(isset($info->bathrooms) && $info->bathrooms == 1) echo 'selected'; ?>>1</option>
                <option value="2" <?php if(isset($info->bathrooms) && $info->bathrooms == 2) echo 'selected'; ?>>2</option>
                <option value="3" <?php if(isset($info->bathrooms) && $info->bathrooms == 3) echo 'selected'; ?>>3</option>
                <option value="4" <?php if(isset($info->bathrooms) && $info->bathrooms == 4) echo 'selected'; ?>>4</option>
                <option value="5" <?php if(isset($info->bathrooms) && $info->bathrooms == 5) echo 'selected'; ?>>5</option>
            </select>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label>Bedrooms</label>
            <select name="bedrooms" class="form-control">
                <option value="">Select Bedrooms</option>
                <option value="0" <?php if(isset($info->bedrooms) && $info->bedrooms == 0) echo 'selected'; ?>>0</option>
                <option value="1" <?php if(isset($info->bedrooms) && $info->bedrooms == 1) echo 'selected'; ?>>1</option>
                <option value="2" <?php if(isset($info->bedrooms) && $info->bedrooms == 2) echo 'selected'; ?>>2</option>
                <option value="3" <?php if(isset($info->bedrooms) && $info->bedrooms == 3) echo 'selected'; ?>>3</option>
                <option value="4" <?php if(isset($info->bedrooms) && $info->bedrooms == 4) echo 'selected'; ?>>4</option>
                <option value="5" <?php if(isset($info->bedrooms) && $info->bedrooms == 5) echo 'selected'; ?>>5</option>
            </select>
        </div>
    </div>
</div>

            
         <!--   <div class="col-sm-6">
                <div class="form-group">
					<label>Area In Square Feet</label>
					<input type="text" name="area_in_sq_ft" value="<?php echo $this->input->post('area_in_sq_ft')?>" = class="form-control" placeholder="Area In Square Feet">
				</div>
            </div> -->
            
            
         <div class="row">
            <div class="col-sm-12 text-center">
				<input type="submit" value="Submit" name="save" class="property-submit-btn btn btn-primary">
			</div>
		</div>
	  </form>
	   
    </div>
<script>
jQuery(document).ready(function() {
       var i=1; 
       jQuery('#add').click(function(){  
         i++;  
         jQuery('#label').show();
         jQuery('#dynamic_field').append('<div id="custom'+i+'" class="row"><div class="col-sm-4" id="row'+i+'" class="dynamic-added"><div class="form-group"><input type="text" class="form-control" name="additional[]" value="" placeholder="label"></div></div><div class="col-sm-6" id="row'+i+'" class="dynamic-added"><div class="form-group"><input type="text" class="form-control" placeholder="value" name="custom_value[]" value="" id="custom_value"></div></div><div class="col-sm-2"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></div></div>');  
      });
       jQuery(document).on('click', '.btn_remove', function(){  
           var button_id = jQuery(this).attr("id");   
           jQuery('#custom'+button_id+'').remove();  

      });
});      
 </script>      