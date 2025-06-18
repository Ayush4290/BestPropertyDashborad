<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <div class="col main pt-5 mt-3">
        <a href="<?php echo base_url('admin/rent/');?>" style="float: right;margin: 14px 2px;" class="btn btn-sm btn-info back-btn">Back</a>
        
      <h1 class="d-sm-block heading"><?php echo $title; ?></h1>
      <?php
      $info = $properties[0];
	  $message = $this->session->flashdata('message');
		if ($message != '') {
			echo '<div class="alert alert-success">' . $message . '</div>';
			// Clear flash data after displaying it once
			$this->session->set_flashdata('message', '');
		}

	  echo validation_errors(); ?>
	  
	  <div class="clearfix"></div>
	  
	  <form class="form" method="post" action="<?php echo base_url('admin/rent/edit/').$this->uri->segment('4');?>" enctype="multipart/form-data">
	      
        <div class="row" id="">
             <div class="col-sm-12">
                <div class="form-group">
					<h3><label>Title*</label></h3>
                    <input type="text" name="rName" value="<?php  echo $info->name;?>" required class="form-control" placeholder="Title"> 				
				</div>
            </div>
            
            <div class="col-sm-6">
                <div class="form-group">
					<label class="font-weight-bold">Location / Address *</label>
					<input type="text" name="address" value="<?php  echo $info->address;?>" required class="form-control address" placeholder="Address">
                </div>
            </div>
			
			<div class="col-sm-6">
                <div class="form-group">
					<label class="font-weight-bold">Sector *</label>
					<input type="number" name="sector" value="<?php echo $info->sector;?>" required class="form-control sector" placeholder="Sector">
					<span class="error-msg address-msg"></span>

				</div>
            </div>

			<div class="col-sm-6">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
    					    <label><span class="font-weight-bold">Rent</span> per month *</label>
    					    <input type="number" name="budget" value="<?php  echo $info->budget;?>"  class="form-control" placeholder="Rent per month (in thousands)">
    					</div>
					</div>
				</div>
            </div>              

		    <div class="col-sm-6">
                <div class="form-group">
					<label class="font-weight-bold">Property Type </label>
					<Select name="property_type" class="form-control">
						<option value="">Select Property Type </option>
						<option value="1 BHK" <?php if($info->property_type=='1 BHK'){echo 'selected';} ?>>1 BHK </option>
						<option value="2 BHK" <?php if($info->property_type=='2 BHK'){echo 'selected';} ?>>2 BHK </option>
						<option value="3 BHK" <?php if($info->property_type=='3 BHK'){echo 'selected';} ?>>3 BHK </option>
						<option value="1 Room Only" <?php if($info->property_type=='1 Room Only'){echo 'selected';} ?>>1 Room Only </option>
						<option value="1 Room with Kitchen" <?php if($info->property_type=='1 Room with Kitchen'){echo 'selected';} ?>>1 Room with Kitchen </option>
						<option value="2 Rooms Only" <?php if($info->property_type=='2 Rooms Only'){echo 'selected';} ?>>2 Rooms Only </option>
						<option value="2 Rooms with Kitchen" <?php if($info->property_type=='2 Rooms with Kitchen'){echo 'selected';} ?>>2 Rooms with Kitchen </option>
						<option value="Boys PG" <?php if($info->property_type=='Boys PG'){echo 'selected';} ?>>Boys PG </option>
						<option value="Girls PG" <?php if($info->property_type=='Girls PG'){echo 'selected';} ?>>Girls PG </option>
						<option value="Annex House"<?php if($info->property_type=='Annex House'){echo 'selected';} ?>>Annex House </option>
						<option value="Other" <?php if($info->property_type=='Other'){echo 'selected';} ?>>Other </option>
					</select>
				</div>
            </div> 
            
            <div class="col-sm-6">
                <div class="form-group">
					<label class="font-weight-bold">Property Status *</label>
					<Select name="property-status" class="form-control property-status" required>
					    <option value="">Select Property Status </option>
						<option value="Furnished" <?php if($info->property_status=='Furnished'){echo 'selected';} ?>>Furnished </option>
						<option value="Semi-Furnished" <?php if($info->property_status=='Semi-Furnished'){echo 'selected';} ?>>Semi-Furnished </option>
						<option value="Un-Furnished" <?php if($info->property_status=='Un-Furnished'){echo 'selected';} ?>>Un-Furnished </option>
						<option value="New Construction" <?php if($info->property_status=='New Construction'){echo 'selected';} ?>>New Construction </option>
						<option value="With AC" <?php if($info->property_status=='With AC'){echo 'selected';} ?>> With AC</option>
					</select>
					<span class="error-msg property-status-msg"></span>
				</div>
            </div>
			
			<div class="col-sm-6">
                <div class="form-group">
					<label class="font-weight-bold">Floor</label>
					<input type="test" name="floor" value="<?php echo $info->floor;?>" class="form-control sector" placeholder="Floor">
				</div>
            </div>
            
            <div class="col-sm-12">
                <label>Amenities</label></br>
                <div class="form-group">
					<div class="row">
					<div class="col-sm-4">
					    <?php 
                        $amenities=explode('~-~',$info->amenities);?>
    					<label><input type="checkbox" <?php if(in_array('Car parking',$amenities)){?> checked <?php }?> name="amenities[]" value="Car parking"> Car parking</label></br>
    					<label><input type="checkbox" <?php if(in_array('Gated Society',$amenities)){?> checked <?php }?> name="amenities[]" value="Gated Society"> Gated Society </label></br>
    					<label><input type="checkbox" <?php if(in_array('24x7 Water supply',$amenities)){?> checked <?php }?> name="amenities[]" value="24x7 Water supply"> 24x7 Water supply</label></br>
    					<label><input type="checkbox" <?php if(in_array('Elevators',$amenities)){?> checked <?php }?> name="amenities[]" value="Elevators"> Lift/Elevators</label></br>
    					<label><input type="checkbox" <?php if(in_array('Power Backup',$amenities)){?> checked <?php }?> name="amenities[]" value="Power Backup"> Power Backup</label></br>
    				</div>
    				    <div class="col-sm-4">
    					    <label><input type="checkbox" <?php if(in_array('Swimming pool',$amenities)){?> checked <?php }?> name="amenities[]" value="Swimming pool"> Swimming pool</label></br>
    					    <label><input type="checkbox" <?php if(in_array('Party hall',$amenities)){?> checked <?php }?> name="amenities[]" value="Party hall"> Community hall</label></br>
    					    <label><input type="checkbox" <?php if(in_array('Pooja Room',$amenities)){?> checked <?php }?> name="amenities[]" value="Pooja Room"> Pooja Room</label></br>
    					    <label><input type="checkbox" <?php if(in_array('Guest Car Parking',$amenities)){?> checked <?php }?> name="amenities[]" value="Guest Car Parking"> Guest Car Parking</label></br>
				        </div>
				        <div class="col-sm-4">
				            <label><input type="checkbox" <?php if(in_array('Kids Play area',$amenities)){?> checked <?php }?> name="amenities[]" value="Kids Play area"> Kids Play area</label></br>
    					    <label><input type="checkbox" <?php if(in_array('24x7 Security',$amenities)){?> checked <?php }?> name="amenities[]" value="24x7 Security"> 24x7 Security </label></br> 
    					    <label><input type="checkbox" <?php if(in_array('Wi-Fi',$amenities)){?> checked <?php }?> name="amenities[]" value="Wi-Fi"> Wi-Fi</label></br>
    				        <label><input type="checkbox" <?php if(in_array('Park/Jogging track',$amenities)){?> checked <?php }?> name="amenities[]" value="Park/Jogging track"> Park /Jogging track</label>
				        </div>
				    </div>
				</div>
            </div>
            
            <div class="col-sm-12">
                <div class="form-group">
					<label>Property Description</label>
                    <textarea  name="note" value=""  class="form-control" placeholder="Property Description"><?php  echo $info->description;?></textarea>			
				</div>
            </div> 
            
	        <div class="col-sm-6">
                <div class="form-group">
				  <label>Area In Square Feet</label>
					<input type="text" name="area_in_sq_ft" value="<?php echo $info->sqft;?>"  class="form-control" placeholder="Area In Square Feet">
				</div>
			</div>
			
			<div class="col-sm-6">
                <div class="form-group">
					<label>Bathrooms</label>
                    <input type="number" name="bathrooms" value="<?php echo $info->bathrooms;?>" class="form-control" placeholder="Bathrooms" min="0" max="10"> 				
				</div>
            </div>
            
            <div class="col-sm-6  ">
                <div class="form-group">
					<label>Prefered <small>Instruction if any like family, service, IT, etc </small></label>
                    <input type="text" name="prefer" value="<?php echo $info->prefer;?>" class="form-control" placeholder="Prefered only"> 				
				</div>
            </div>
            
            <div class="col-sm-6">
                <div class="form-group">
					<label>Available </label>
					<Select name="available" class="form-control">
						<option value="yes" <?php if($info->available=='yes'){echo 'selected';} ?>>Yes </option>
						<option value="no" <?php if($info->available=='no'){echo 'selected';} ?>>No </option>
					</select>
				</div>
            </div>
            
            <div class="col-sm-6">
                <div class="form-group">
					<label>Available From</label>
					<input type="date" class="form-control" name="available_from" value="<?php echo $info->available_from;?>">
				</div>
            </div>
            
            <div class="col-sm-6">
                <div class="form-group">
					<label>Security Desposite </label>
					<Select name="security-deposite" class="form-control">
					    <option value="1 Month" <?php if($info->security_deposite=='1 Month'){echo 'selected';} ?>>1 Month </option>
						<option value="2 Month" <?php if($info->security_deposite=='2 Month'){echo 'selected';} ?>>2 Month </option>
						<option value="No" <?php if($info->security_deposite=='No'){echo 'selected';} ?>>No </option>
					</select>
				</div>
            </div>
            
            <div class="col-sm-6 images-form">
                <div class="form-group">
					<label>Front Picture</label>
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
					<label>Bedroom Picture</label>
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
					<label>Washroom</label>
					
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
					<label>Kitchen</label>
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
					<label><span class="font-weight-bold">House No.*</span><small>(not shown to customer)</small></label>
					<input type="text" name="house_no" value="<?php echo $info->house_number;?>" required class="form-control" placeholder="Property Address">
                </div>
            </div>
            
            <div class="col-sm-6">
                <div class="form-group">
					<label>Owner Name <small>(not shown to customer)</small></label>
                    <input type="text" name="owner_name" value="<?php echo $info->owner_name;?>" class="form-control" placeholder="Owner Name">				
				</div>
            </div>
            
            <div class="col-sm-6">
                <div class="form-group">
					<label>Owner Contact <small>(not shown to customer)</small></label>
                    <input type="text" name="owner_contact" value="<?php echo $info->owner_contact;?>" class="form-control" placeholder="Owner Contact"> 				
				</div>
            </div>
            
            <div class="col-sm-6">
                <div class="form-group">
					<label>Owner Class </label>
					<Select name="owner_class" class="form-control">
						<option value="5 Star - Excellent" <?php if($info->owner_class=='5 Star - Excellent'){echo 'selected';} ?>>5 Star - Excellent</option>
						<option value="4 Star - Good" <?php if($info->owner_class=='4 Star - Good'){echo 'selected';} ?>>4 Star - Good</option>
						<option value="3 Star - Normal" <?php if($info->owner_class=='3 Star - Normal'){echo 'selected';} ?>>3 Star - Normal</option>
						<option value="2 Strar - Med" <?php if($info->owner_class=='2 Strar - Med'){echo 'selected';} ?>>2 Strar - Med</option>
						<option value="1 Strar - Med" <?php if($info->owner_class=='1 Strar - Med'){echo 'selected';} ?>>1 Star - So So</option>
					</select>
				</div>
            </div>
            
            <div class="col-sm-6">
                <div class="form-group">
					<label>Verified </label>
					<Select name="verified" class="form-control">verified
					    <option value="Yes" <?php if($info->verified=='Yes'){echo 'selected';} ?>>Yes </option>
						<option value="No" <?php if($info->verified=='No'){echo 'selected';} ?>>No </option>
					</select>
				</div>
            </div>
            
        <!---All the fields below are display none--->

            <div class="col-sm-6 d-none">
                <div class="form-group">
					<label>Refer</label>
                    <input type="text" name="refer" value="<?php echo $info->refer;?>" class="form-control" placeholder="Refer"> 				
				</div>
            </div>
            
            <div class="col-sm-6 d-none hide">
                <div class="form-group">
					<label>Booking Amount</label>
                    <input type="text" name="booking_amount" value="<?php echo $info->booking_amount;?>" class="form-control" placeholder="Booking Amount"> 				
				</div>
            </div>
            
            <div class="col-sm-6 d-none hide">
                <div class="form-group">
					<label>Booked By</label>
                    <input type="text" name="booked_by" value="<?php echo $info->booked_by;?>" class="form-control" placeholder="Booked By"> 				
				</div>
            </div> 
            
            <div class="col-sm-6 d-none hide">
                <div class="form-group">
					<label>Booking Advance</label>
                    <input type="text" name="booking_advance" value="<?php echo $info->booking_advance;?>" class="form-control" placeholder="Booking Advance"> 				
				</div>
            </div>
            
            <div class="col-sm-6 d-none hide">
                <div class="form-group">
					<label>Agreement </label>
                    <input type="text" name="agreement" value="<?php echo $info->agreement;?>" class="form-control" placeholder="Agreement"> 				
				</div>
            </div>
            
            <div class="col-sm-6 d-none hide">
                <div class="form-group">
					<label>Police Verification</label>
					<Select name="police_verification" class="form-control">
						<option value="yes" <?php if($info->police_verification=='yes'){echo 'selected';} ?>>Yes </option>
						<option value="no" <?php if($info->police_verification=='no'){echo 'selected';} ?>>No </option> 
					</select>				
				</div>
            </div>
            
            <div class="col-sm-6 d-none hide">
                <div class="form-group">
					<label>Security </label>
                    <input type="text" name="security" value="<?php echo $info->security;?>" class="form-control" placeholder="Security"> 				
				</div>
            </div>
            
            <div class="col-sm-6 d-none hide">
                <div class="form-group">
					<label>Commission</label>
                    <input type="text" name="commission" value="<?php echo $info->commission;?>" class="form-control" placeholder="Commission">  				
				</div>
            </div>
			
			
            
			<div class="col-sm-6 d-none hide">
                <div class="form-group">
					<label>State*</label>
					<input type="text" name="state" value="<?php  echo $info->state;?>" class="form-control" placeholder="State">

				</div>
            </div>
 
			<div class="col-sm-6 d-none hide">
                <div class="form-group">
					<label>Zip Code</label>
					<input type="text" name="zip_code" value="<?php  echo $info->zip_code;?>"  class="form-control" placeholder="Zip Code">

				</div>
            </div>      
            
            <div class="col-sm-12 d-none hide">
                <div class="form-group">
					<label>Comment</label>
                    <textarea  name="comment" value=""  class="form-control" placeholder="Property Description"><?php  echo $info->comment;?></textarea>			
				</div>
            </div> 
            
			<div class="col-sm-6 d-none hide">
                <div class="form-group">
					<label>Person Name</label>
					<input type="text" name="pName" value="<?php  echo $info->person;?>"  class="form-control" placeholder="Person Name">

				</div>
            </div>    
			<div class="col-sm-6 d-none hide">
                <div class="form-group">
					<label>Person Phone</label>
					<input type="number" name="pPhone" value="<?php  echo $info->phone;?>"  class="form-control" placeholder="Person Phone">

				</div>
            </div>    
			<div class="col-sm-6 images-form d-none hide">
                <div class="form-group">
					<label>Person Address</label>
					<div class="row">
					<input type="text" name="pAddress" value="<?php  echo $info->person_address;?>"  class="form-control" placeholder="Person Address">
					</div>
				</div>
            </div> 
            
			<div class="col-sm-3 d-none hide">
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

			
            <div class="col-sm-6 d-none hide">
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
            <div class="col-sm-6 d-none hide">
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
            
            <div class="col-sm-6 d-none hide">
                <div class="form-group">
					<label>Show in Slider</label>
					<input type="radio" id="yes" name="show_in_slider" value="1" <?php if($info->show_in_slider=='1'){ ?>checked<?php } ?>>
                    <label for="yes">Yes</label>
                    <input type="radio" id="no" name="show_in_slider" value="0" <?php if($info->show_in_slider=='0'){ ?>checked<?php } ?>>
                    <label for="no">No</label><br>
				</div>
            </div> 
            
            <div class="col-sm-6 d-none hide">
                <div class="form-group">
					<label>Show in Gallery</label>
					<input type="radio" id="yes" name="show_in_gallery" value="1" <?php if($info->show_in_gallery=='1'){ ?>checked<?php } ?>>
                    <label for="yes">Yes</label>
                    <input type="radio" id="no" name="show_in_gallery" value="0" <?php if($info->show_in_gallery=='0'){ ?>checked<?php } ?>>
                    <label for="no">No</label><br>
				</div>
            </div>
            <div class="col-sm-6 images-form d-none hide">
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
            <div class="col-sm-6 d-none hide">
                <div class="form-group">
					<label>Verified</label>
					<div class="row"><div class="col-md-6">
					    	<label><input type="checkbox"  name="verified" value="gmada.png">GMADA</label></br>
					    	<label><input type="checkbox"  name="verified" value="rera.png">RERA</label></br>
					    	<label><input type="checkbox"  name="verified" value="mc.png">MC</label></br>
					    	<label><input type="checkbox"  name="verified" value="clu.png">CLU</label></br>
					    </div>
					</div>
				</div>
            </div>
              
        <div class="col-sm-12"></div>
		<div class="col-sm-12 text-center">
            <input type="submit" value="Submit" name="save" class="btn btn-primary">
		</div>
	  </form>
	   
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