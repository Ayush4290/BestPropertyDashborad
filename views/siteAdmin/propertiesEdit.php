<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <div class="col main pt-5 mt-3 inner-main-div">
        <a href="<?php echo base_url('admin/properties/');?>" style="float: right;margin: 14px 2px;" class="btn btn-sm btn-info back-btn">Back</a>
        
      <h1 class="d-sm-block heading"><?php echo $title; ?></h1>
      <?php
      $info = $properties[0];
      
      
	  $message = $this->session->flashdata('message');
	  if($message != ''){
	      echo '<div class="alert alert-success">'.$message.'</div>';
		  
			$this->session->set_flashdata('message', '');
	  }
	  echo validation_errors(); ?>
	  
	  <div class="clearfix"></div>
	  
	  <form class="form" method="post" action="<?php echo base_url('admin/properties/edit/').$this->uri->segment('4');?>" enctype="multipart/form-data">
	      
        <div class="row" id="">
             <div class="col-sm-3">
                <div class="form-group">
					<label>Property Name*</label>
                    <input type="text" name="rName" value="<?php  echo $info->name;?>" required class="form-control" placeholder="Property Name"> 				
					</div>
            </div>    
           <div class="col-sm-3">
                <div class="form-group">
				   <label>Property Type*</label>
					<select name="property_type" class="form-control" required>
						<option value="">Select Property Type</option>

                		<option <?php if($info->property_type=='Industrial Property'){ echo 'selected'; }?> value="Industrial Property">Industrial Property</option>
                		<option <?php if($info->property_type=='Factory'){ echo 'selected'; }?> value="Factory">Factory</option>
                		<option <?php if($info->property_type=='Residential Property'){ echo 'selected'; }?> value="Residential Property">Residential Property</option>
                		<option <?php if($info->property_type=='Bungalows / Villas'){ echo 'selected'; }?> value="Bungalows / Villas">Bungalows / Villas</option>
                		<option <?php if($info->property_type=='Flats & Apartments'){ echo 'selected'; }?> value="Flats & Apartments">Flats & Apartments</option>
                		<option <?php if($info->property_type=='Residential - Others'){ echo 'selected'; }?> value="Residential - Others">Residential - Others</option>
                		<option <?php if($info->property_type=='Individual House/Home'){ echo 'selected'; }?> value="Individual House/Home">Individual House/Home</option>
                		<option <?php if($info->property_type=='Residential Land / Plot'){ echo 'selected'; }?> value="Residential Land / Plot">Residential Land / Plot</option>
                		<option <?php if($info->property_type=='Commercial Property'){ echo 'selected'; }?> value="Commercial Property">Commercial Property</option>
                		<option <?php if($info->property_type=='Commercial Shops'){ echo 'selected'; }?> value="Commercial Shops">Commercial Shops</option>
                		<option <?php if($info->property_type=='Commercial Lands & Plots'){ echo 'selected'; }?> value="Commercial Lands & Plots">Commercial Lands & Plots</option>
                		<option <?php if($info->property_type=='Hotel & Restaurant'){ echo 'selected'; }?> value="Hotel & Restaurant">Hotel & Restaurant</option>		

					</select>				
				</div>
            </div>   
             <div class="col-sm-3">
                <div class="form-group">
					<label>Project Builder</label>
					<input type="text" name="property_builder" value="<?php  echo $info->property_builder;?>"  class="form-control" placeholder="Project Builder">
					</div></div>
					    <div class="col-sm-3">
                <div class="form-group">
					<label>BHK</label>
					<select name="BHK" class="form-control">
						<option  value="">Select Property Type</option>
                		<option <?php if($info->bhk=='1BHK'){ echo 'selected'; }?> value="1BHK">1BHK</option>
                		<option <?php if($info->bhk=='2BHK'){ echo 'selected'; }?> value="2BHK">2BHK</option>
                		<option <?php if($info->bhk=='3BHK'){ echo 'selected'; }?> value="3BHK"> 3BHK</option>
                		<option <?php if($info->bhk=='4BHK'){ echo 'selected'; }?> value="4BHK">4BHK</option>
                			<option <?php if($info->bhk=='5BHK'){ echo 'selected'; }?> value="5BHK">5BHK</option>
                

					</select>				
					</div>
            </div> 
					
            <div class="col-sm-6">
                <div class="form-group">
					<label>Property For*</label>
					<select name="property_for" class="form-control" required>
						<option value="">Select Type</option>
                        <option <?php if($info->property_for=='Buy'){ echo 'selected';}?> value="Buy">Buy</option>
                        <option <?php if($info->property_for=='Rent'){ echo 'selected';}?> value="Rent">Rent</option>
                        <option <?php if($info->property_for=='Leased/Rent'){ echo 'selected';}?> value="Leased/Rent">Leased/Rent</option>
					</select>				
				</div>
            </div> 
			<div class="col-sm-6">
                <div class="form-group">
                    <div class="row">
                    <div class="col-md-6">
					<label>Budget In Lacs/Crore</label>
					<input type="number" step="0.01" name="budget" value="<?php  echo $info->budget;?>"  class="form-control" placeholder="Budget">
					</div>
					<div class="col-md-6">
					<label>Budget In Word</label>
					<input type="text"  name="budget_in_words" value="<?php  echo $info->budget_in_words?>"  class="form-control" placeholder="Budget in word">
					</div>
					</div>
				</div>
            </div>              
			<div class="col-sm-4">
                <div class="form-group">
					<label>Built Up Area</label>
					<input type="number" step="0.01" name="built" value="<?php  echo $info->built;?>"  class="form-control" placeholder="Built Up Area">

				</div>
            </div>
			<div class="col-sm-4">
                <div class="form-group">
					<label>Land / Plot Area</label>
					<input type="number" step="0.01" name="land" value="<?php  echo $info->land;?>"  class="form-control" placeholder="Land / Plot Area">
				</div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
					<label>Address</label>
					<input type="text" name="address" value="<?php  echo $info->address;?>" required class="form-control" placeholder="Property Address">
					</div></div>
			<div class="col-sm-6">
                <div class="form-group">
					<label>Carpet</label>
					<input type="number" step="0.01" name="carpet" value="<?php  echo $info->carpet;?>"  class="form-control" placeholder="Carpet">

				</div>
          	</div>
			<div class="col-sm-6">
                <div class="form-group">
					<label>State*</label>
					<input type="text" name="state" value="<?php  echo $info->state;?>" required class="form-control" placeholder="State">

				</div>
            </div>
			<div class="col-sm-6">
                <div class="form-group">
					<label>City*</label>
					<input type="text" name="city" value="<?php  echo $info->city;?>" required class="form-control" placeholder="City">

				</div>
            </div>  
			<div class="col-sm-6">
                <div class="form-group">
					<label>Zip Code</label>
					<input type="text" name="zip_code" value="<?php  echo $info->zip_code;?>"  class="form-control" placeholder="Zip Code">

				</div>
            </div>      
			<div class="col-sm-6">
                <div class="form-group">
					<label>Type*</label>
					<select name="type" class="form-control">
					    <option value="">Property Type</option>
					    <option <?php if($info->type=='Kothi'){ echo 'selected'; }?> value = "Kothi">Kothi</option>
					    <option <?php if($info->type=='Flat'){ echo 'selected'; }?> value = "Flat">Flat</option>
					    <option <?php if($info->type=='Plot'){ echo 'selected'; }?> value = "Plot">Plot</option>
					</select>

				</div>
            </div>
            
            <div class="col-sm-6">
                <div class="form-group">
					<label>Services*</label>
					<select name="servicess" class="form-control">
					    <option value="">Select Services</option>
					     <option <?php if($info->services=='Commercial'){ echo 'selected'; }?> value= "Commercial">Commercial</option>
					    <option <?php if($info->services=='Residential'){ echo 'selected'; }?> value= "Residential">Residential</option>
					    <option <?php if($info->services=='Office Space'){ echo 'selected'; }?> value= "Office Space">Office Space</option>
					    <option <?php if($info->services=='Flats and Plots'){ echo 'selected'; }?> value= "Flats and Plots">Flats and Plots</option>
					</select>

				</div>
            </div>
           
            
            <div class="col-sm-6">
                <div class="form-group">
					<label>Property Description</label>
                    <textarea  name="note" value=""  class="form-control" placeholder="Property Description"><?php  echo $info->description;?></textarea>			
					</div>
            </div>   
            <div class="col-sm-6">
                <div class="form-group">
					<label>Select Project Name:</label>
        <select name="project_n" id="project" class="form-control">
        <?php $selectedOption = $info->project_n;?>    
        <option value="">Select a project</option>
        <?php 
        
        foreach ($projects as $project): ?>
            <option value="<?= htmlspecialchars($project['Project_Name']); ?>"<?php if($project['Project_Name'] == $selectedOption){echo 'selected';} ?><?= ($project['Project_Name'] == $existingProjectName) ? 'selected' : ''; ?>>
                <?= htmlspecialchars($project['Project_Name']); ?>
            </option>
            
            
        <?php endforeach; ?>
    </select>			
					</div>
            </div> 
            
			<div class="col-sm-6">
                <div class="form-group">
					<label>Person Name</label>
					<input type="text" name="pName" value="<?php  echo $info->person;?>"  class="form-control" placeholder="Person Name">

				</div>
            </div>    
			<div class="col-sm-6">
                <div class="form-group">
					<label>Person Phone</label>
					<input type="number" name="pPhone" value="<?php  echo $info->phone;?>"  class="form-control" placeholder="Person Phone">

				</div>
            </div>    
			<div class="col-sm-6 images-form">
                <div class="form-group">
					<label>Person Address</label>
					<div class="row">
					<input type="text" name="pAddress" value="<?php  echo $info->person_address;?>"  class="form-control" placeholder="Person Address">
					</div>
				</div>
            </div> 
            
            <!--<div class="col-sm-3">
                <div class="form-group">
				  <label>Area In Square Feet</label>
				    <div class="row">
					<input type="text" name="area_in_sq_ft" value="<?php  echo $info->sqft;?>"  class="form-control" placeholder="Area In Square Feet">
				      </div>
					</div>
				</div>-->
			<div class="col-sm-3">
			      <div class="form-group">
						<label>Measure Unit</label>
					    <select name="unit" class="form-control">
					    <option value="">Select Measure Unit</option>
					    <option value="Super Area" <?php if($info->measureUnit=='Super Area'){echo 'selected';} ?> >Super Area</option>
					    <option value="Marla" <?php if($info->measureUnit=='Marla'){echo 'selected';} ?> >Marla</option>
					    <option value="Sqft" <?php if($info->measureUnit=='Sqft'){echo 'selected';} ?> >Sqft</option>
					    <option value="Sqft Yard" <?php if($info->measureUnit=='Sqft Yard'){echo 'selected';} ?> >Sqft Yard</option>
					    <option value="Karnal" <?php if($info->measureUnit=='Karnal'){echo 'selected';} ?> >Karnal</option>
					    <option value="Acre" <?php if($info->measureUnit=='Acre'){echo 'selected';} ?> >Acre</option>
					    <option value="Gaj" <?php if($info->measureUnit=='Gaj'){echo 'selected';} ?> >Gaj</option>
					</select>
				</div>
            </div>
            
            <div class="col-sm-6 images-form">
                <div class="form-group">
					<label>Picture</label>
					<div class="row">
					<input type="file" name="image" class="form-control">
					<input type="hidden" name="imageOld" value="<?php echo $info->image_one;?>">
					 <?php if($info->image_one != '') { 
						echo '<img style="height: 50%;" src="'.base_url('assets/properties/').''.$info->image_one.'" class="img-fluid">';
				    } ?>
					</div>
				</div>
            </div>
            <div class="col-sm-6 images-form">
                <div class="form-group">
					<label>Picture</label>
					<div class="row">
					<input type="file" name="image2" class="form-control">
					<input type="hidden" name="imageOldTwo" value="<?php echo $info->image_two;?>">
										 <?php if($info->image_two != '') { 
						echo '<img style="height: 90%;" src="'.base_url('assets/properties/').''.$info->image_two.'" class="img-fluid">';
				    } ?>
					</div>
				</div>
            </div>
            <div class="col-sm-6 images-form">
                <div class="form-group">
					<label>Picture</label>
					
					<div class="row">
					<input type="file" name="image3" class="form-control">
					<input type="hidden" name="imageOldThree" value="<?php echo $info->image_three;?>">
										 <?php if($info->image_three != '') { 
						echo '<img style="height: 90%;" src="'.base_url('assets/properties/').''.$info->image_three.'" class="img-fluid">';
				    } ?>
					</div>
				</div>
            </div>
            <div class="col-sm-6 images-form">
                <div class="form-group">
					<label>Picture</label>
					<div class="row">
					 <input type="file" name="image4" class="form-control">
					<input type="hidden" name="imageOldFour" value="<?php echo $info->image_four;?>">
										 <?php if($info->image_four != '') { 
						echo '<img style="height: 90%;" src="'.base_url('assets/properties/').''.$info->image_four.'" class="img-fluid">';
				    } ?>
					</div>
					
				</div>
            </div>            
                <div class="col-sm-6">
                <div class="form-group">
					<label>Amenities</label></br>
					<div class="row"><div class="col-md-6">
					<?php 
                     $amenities=explode('~-~',$info->amenities);?>    
					<label><input type="checkbox" <?php if(in_array('Car parking',$amenities)){?> checked <?php }?> name="amenities[]" value="Car parking"> Car parking</label></br>
					<label><input type="checkbox" <?php if(in_array('Security services',$amenities)){?> checked <?php }?> name="amenities[]" value="Security services"> Security services</label></br>
					<label><input type="checkbox" <?php if(in_array('Water supply',$amenities)){?> checked <?php }?> name="amenities[]" value="Water supply"> Water supply</label></br>
					<label><input type="checkbox" <?php if(in_array('Elevators',$amenities)){?> checked <?php }?> name="amenities[]" value="Elevators"> Elevators</label></br>
					<label><input type="checkbox" <?php if(in_array('Power backup',$amenities)){?> checked <?php }?> name="amenities[]" value="Power backup"> Power backup</label></br>
					<label><input type="checkbox" <?php if(in_array('Gym',$amenities)){?> checked <?php }?> name="amenities[]" value="Gym"> Gym</label></br>
					<label><input type="checkbox" <?php if(in_array('Play area',$amenities)){?> checked <?php }?> name="amenities[]" value="Play area"> Play area</label></br>
					</div>
					<div class="col-md-6">
					<label><input type="checkbox" <?php if(in_array('Swimming pool',$amenities)){?> checked <?php }?> name="amenities[]" value="Swimming pool"> Swimming pool</label></br>
					<label><input type="checkbox" <?php if(in_array('Restaurants',$amenities)){?> checked <?php }?> name="amenities[]" value="Restaurants"> Restaurants</label></br>
					<label><input type="checkbox" <?php if(in_array('Party hall',$amenities)){?> checked <?php }?> name="amenities[]" value="Party hall"> Party hall</label></br>
					<label><input type="checkbox" <?php if(in_array('Temple and religious activity place',$amenities)){?> checked <?php }?> name="amenities[]" value="Temple and religious activity place"> Temple and religious activity place</label></br>
					<label><input type="checkbox" <?php if(in_array('Cinema hall',$amenities)){?> checked <?php }?> name="amenities[]" value="Cinema hall"> Cinema hall</label></br>
					<label><input type="checkbox" <?php if(in_array('Walking/Jogging track',$amenities)){?> checked <?php }?> name="amenities[]" value="Walking/Jogging track"> Walking/Jogging track</label></div></div>
				</div>
            </div>  
            <div class="col-sm-6 "></div>
            </div>
            <?php if(!empty($info->additional)){
          
                $addition=explode('~~--~~',$info->additional); 
                $custom_value=explode('~~--~~',$info->additional_value); 
                $i=0;
                foreach($addition as $key=>$addit){?>
                <label>Additional Details</label>
                <div id="custom<?php echo $i;?>" class="row">
                <div class="col-sm-4"><div class="form-group"><input type="text" class="form-control" value="<?php echo $addit;?>" name="additional[]"></div></div>
                <div class="col-sm-6"><div class="form-group"><input type="text" class="form-control" value="<?php echo $custom_value[$key];?>" name="custom_value[]"></div></div>
                <div class="col-sm-2"><button type="button" name="remove" id="<?php echo $i ?>" class="btn btn-danger btn_remove">X</button></div>
                </div>
                <?php $i++;
                }
                }
                ?>
                <div id="dynamic_field"></div>
                
  			<div class="col-sm-6 add-additional-detail">
                <div class="form-group">
					<label></label>
                      <button style="margin-top: 30px;" type="button" id="add"  class="btn btn-sm btn-primary">Add Additional Details</button>
				</div>
            </div>  
            <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
					<label>Bathrooms*</label>
					<select name="bathrooms" class="form-control">
					    <option value="">Bathrooms</option>
					    <option <?php if($info->bathrooms==0){ echo 'selected'; }?> value="0">0</option>
					    <option <?php if($info->bathrooms==1){ echo 'selected'; }?> value="1">1</option>
					    <option <?php if($info->bathrooms==2){ echo 'selected'; }?> value="2">2</option>
					    <option <?php if($info->bathrooms==3){ echo 'selected'; }?> value="3">3</option>
					    <option <?php if($info->bathrooms==4){ echo 'selected'; }?> value="4">4</option>
					    <option <?php if($info->bathrooms==5){ echo 'selected'; }?> value="5">5</option>
					</select>

				</div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
					<label>Bedrooms*</label>
					<select name="bedrooms" class="form-control">
					    <option value="">Bedrooms</option>
					    <option <?php if($info->bedrooms==0){ echo 'selected'; }?> value="0">0</option>
					    <option <?php if($info->bedrooms==1){ echo 'selected'; }?> value="1">1</option>
					    <option <?php if($info->bedrooms==2){ echo 'selected'; }?> value="2">2</option>
					    <option <?php if($info->bedrooms==3){ echo 'selected'; }?> value="3">3</option>
					    <option <?php if($info->bedrooms==4){ echo 'selected'; }?> value="4">4</option>
					    <option <?php if($info->bedrooms==5){ echo 'selected'; }?> value="1">5</option>
					</select>

				</div>
            </div>
            
            <div class="col-sm-6">
                <div class="form-group">
					<label>Show in Slider</label>
					<input type="radio" id="yes" name="show_in_slider" value="1" <?php if($info->show_in_slider=='1'){ ?>checked<?php } ?>>
                    <label for="yes">Yes</label>
                    <input type="radio" id="no" name="show_in_slider" value="0" <?php if($info->show_in_slider=='0'){ ?>checked<?php } ?>>
                    <label for="no">No</label><br>
				</div>
            </div> 
            
            <div class="col-sm-6">
                <div class="form-group">
					<label>Show in Gallery</label>
					<input type="radio" id="yes" name="show_in_gallery" value="1" <?php if($info->show_in_gallery=='1'){ ?>checked<?php } ?>>
                    <label for="yes">Yes</label>
                    <input type="radio" id="no" name="show_in_gallery" value="0" <?php if($info->show_in_gallery=='0'){ ?>checked<?php } ?>>
                    <label for="no">No</label><br>
				</div>
            </div>
            <div class="col-sm-6 images-form">
                <div class="form-group">
					<label>Icon</label>
					<div class="row">
					<input type="file" name="icon" class="form-control">
					<input type="hidden" name="icon" value="<?php echo $info->icon;?>">
					 <?php if($info->icon != '') { 
						echo '<img style="height: 50%;" src="'.base_url('assets/properties/').''.$info->icon.'" class="img-fluid">';
				    } ?>
					</div>
				</div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
					<label>Verified</label>
					<div class="row"><div class="col-md-6">
					    	<label><input type="checkbox"  <?php if(strstr($info->verified,'gmada.png')){ echo 'checked'; }?> name="verified[]" value="gmada.png"> GMADA</label>&nbsp;&nbsp;&nbsp;
					    	<label><input type="checkbox" <?php if(strstr($info->verified,'rera.png')){ echo 'checked'; }?> name="verified[]" value="rera.png"> RERA</label>&nbsp;&nbsp;&nbsp;
					    	<label><input type="checkbox" <?php if(strstr($info->verified,'mc.png')){ echo 'checked'; }?> name="verified[]" value="mc.png"> MC</label>&nbsp;&nbsp;&nbsp;
					    	<label><input type="checkbox" <?php if(strstr($info->verified,'clu.png')){ echo 'checked'; }?> name="verified[]" value="clu.png"> CLU</label>
					    </div>
					</div>
				</div>
            </div>
			
			<div class="col-sm-6">
                <div class="form-group">
					<label>Status</label>
					<select name="status" class="form-control">
					    <option <?php if($info->status=='active'){ echo 'selected'; }?> value="active">Active</option>
					    <option <?php if($info->status=='deactive'){ echo 'selected'; }?> value="deactive">Deactive</option>
					</select>
				</div>
            </div>
			
			<div class="col-sm-6">
				<div class="form-group">
					<label>Hot Deals</label><br>
					<label class="radio-inline">
						<input type="radio" name="hot_deals" <?php if($info->hot_deals == 'yes') echo 'checked'; ?> value="yes"> Yes
					</label>
					<label class="radio-inline">
						<input type="radio" name="hot_deals" <?php if($info->hot_deals == 'no') echo 'checked'; ?> value="no"> No
					</label>
				</div>
			</div>
		</div>	
              
        
		
		<div class="row">
            <div class="col-sm-12 text-center">
				<input type="submit" value="Submit" name="save" class="property-submit-btn btn btn-primary">
			</div>
		</div>
	  </form>
<?php if (!empty($clone_data) && !empty($clone_data->property_url)) { ?>
    <h3>Other Properties Details</h3>
    <div style="margin-top:20px; padding:10px; border:1px solid #ccc;">
        <strong>Property URL:</strong> 
        <a href="<?php echo htmlspecialchars($clone_data->property_url); ?>" target="_blank">
            <?php echo htmlspecialchars($clone_data->property_url); ?>
        </a><br>

        <strong>Main Site:</strong> 
        <a href="<?php echo htmlspecialchars($clone_data->main_site); ?>" target="_blank">
            <?php echo htmlspecialchars($clone_data->main_site); ?>
        </a><br>

        <strong>Image One:</strong> 
        <a href="<?php echo htmlspecialchars($clone_data->image_one); ?>" target="_blank">
            <?php echo htmlspecialchars($clone_data->image_one); ?>
        </a><br>

        <strong>Image Two:</strong> 
        <a href="<?php echo htmlspecialchars($clone_data->image_two); ?>" target="_blank">
            <?php echo htmlspecialchars($clone_data->image_two); ?>
        </a><br>

        <strong>Image Three:</strong> 
        <a href="<?php echo htmlspecialchars($clone_data->image_three); ?>" target="_blank">
            <?php echo htmlspecialchars($clone_data->image_three); ?>
        </a>
    </div>
<?php } ?>




    </div>
<script>
jQuery(document).ready(function() {
       var i=1; 
       jQuery('#add').click(function(){  
         i++;  
         jQuery('#dynamic_field').append('<div id="custom'+i+'" class="row"><div class="col-sm-4" id="row'+i+'" class="dynamic-added"><div class="form-group"><input type="text" class="form-control" name="additional[]" value="" placeholder="label"></div></div><div class="col-sm-6" id="row'+i+'" class="dynamic-added"><div class="form-group"><input type="text" class="form-control" placeholder="value" name="custom_value[]" value="" id="custom_value"></div></div><div class="col-sm-2"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></div></div>');  
      });
       jQuery(document).on('click', '.btn_remove', function(){  
           var button_id = jQuery(this).attr("id");   
           jQuery('#custom'+button_id+'').remove();  

      });
});      
 </script>      