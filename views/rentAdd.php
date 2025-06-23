<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
.rentSubmit {
    padding-bottom: 20px;
}
</style>
    <div class="col main pt-5 mt-3">
        <a href="<?php echo base_url('admin/rent/');?>" style="float: right;margin: 14px 2px;" class="btn btn-sm btn-info back-btn">Back</a>
        
      <h1 class="d-sm-block heading"><?php echo $title; ?></h1>
      <?php
	  $message = $this->session->flashdata('message');
	  if($message != ''){
	      echo '<div class="alert alert-success">'.$message.'</div>';
	  }
	  echo validation_errors(); ?>
	  
	  <div class="clearfix"></div>
	  
	  <form class="form" method="post" action="<?php echo base_url('admin/rent/add');?>" enctype="multipart/form-data">
	      
        <div class="row" id="">
            <div class="stepOne col-sm-12">
               <div class="row" id=""> 
            <div class="col-sm-12">
                <div class="form-group">
					<label class="font-weight-bold"><h3>Title *</h3></label>
                    <input type="text" name="rName" value="" required class="form-control rName" placeholder="Title">
                    <span class="error-msg rName_msg"></span>
				</div>
            </div> 
			
            <div class="col-sm-6">
                <div class="form-group">
					<label class="font-weight-bold">Location / Sector *</label>
					<input type="text" name="address" value="" required class="form-control address" placeholder="Sector">
					<span class="error-msg address-msg"></span>

				</div>
            </div>			

			
			<div class="col-sm-6">
                <div class="form-group">
                    <div class="row">
                    <div class="col-md-12">
					<label><span class="font-weight-bold">Rent</span> per month (in thousands) *</label>
					<input type="number" step="0.01" name="budget" required class="form-control budget" placeholder="Rent per month (in thousands)">
					<span class="error-msg budget-msg"></span>
					</div>
					</div>
				</div>
            </div>            

			<!--div class="col-sm-6">
                <div class="form-group">
					<label class="font-weight-bold">Property Type * </label>
					<Select name="property_type" class="form-control property_type" required>
						<option value="">Select Property Type </option>
						<option value="1 BHK">1 BHK </option>
						<option value="2 BHK">2 BHK </option>
						<option value="3 BHK">3 BHK </option>
						<option value="1 Room Only">1 Room Only </option>
						<option value="1 Room with Kitchen">1 Room with Kitchen </option>
						<option value="2 Rooms Only">2 Rooms Only </option>
						<option value="2 Rooms with Kitchen">2 Rooms with Kitchen </option>
						<option value="Boys PG">Boys PG </option>
						<option value="Girls PG">Girls PG </option>
						<option value="Annex House">Annex House </option>
						<option value="Other">Other </option>
					</select>
					<span class="error-msg property_type-msg"></span>
				</div>
            </div--> 
			
			 <!-- Load your custom helper -->
			<?php $this->load->helper('headerdata_helper'); ?>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="font-weight-bold">Property Type *</label>
                    <select name="property_type" class="form-control property_type" required>
                            <option value="">Select Property Type</option>
                        <?php foreach (rentPropertyType() as $value): ?>
                            <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            
			<div class="col-sm-6">
                <div class="form-group">
					<label class="font-weight-bold">Property Status *</label>
					<Select name="property-status" class="form-control property-status" required>
					    <option value="">Select Property Status </option>
						<option value="Furnished">Furnished </option>
						<option value="Semi-Furnished">Semi-Furnished </option>
						<option value="Un-Furnished">Un-Furnished </option>
						<option value="New Construction">New Construction </option>
						<option value="With AC"> With AC</option>
					</select>
					<span class="error-msg property-status-msg"></span>
				</div>
            </div>
			
			
			  <div class="col-sm-12">
                <label>Amenities</label></br>
                <div class="form-group">
					<div class="row">
					<div class="col-sm-4">
    					<label><input type="checkbox" name="amenities[]" value="Car parking"> Car parking</label></br>
    					<label><input type="checkbox" name="amenities[]" value="Gated Society"> Gated Society </label></br>
    					<label><input type="checkbox" name="amenities[]" value="24x7 Water supply"> 24x7 Water supply</label></br>
    					<label><input type="checkbox" name="amenities[]" value="Elevators"> Lift/Elevators</label></br>
    					<label><input type="checkbox" name="amenities[]" value="Power Backup"> Power Backup</label></br>
    				</div>
    				    <div class="col-sm-4">
    					<label><input type="checkbox" name="amenities[]" value="Swimming pool"> Swimming pool</label></br>
    					<label><input type="checkbox" name="amenities[]" value="Party hall"> Community hall</label></br>
    					<label><input type="checkbox" name="amenities[]" value="Pooja Room"> Pooja Room</label></br>
    					<label><input type="checkbox" name="amenities[]" value="Power Backup"> Power Backup</label></br>
    					<label><input type="checkbox" name="amenities[]" value="Guest Car Parking"> Guest Car Parking</label></br>
				        </div>
				        <div class="col-sm-4">
				        <label><input type="checkbox" name="amenities[]" value="Kids Play area"> Kids Play area</label></br>
    					<label><input type="checkbox" name="amenities[]" value="24x7 Security"> 24x7 Security </label></br> 
    					
    					<label><input type="checkbox" name="amenities[]" value="Wi-Fi"> Wi-Fi</label></br>
    				    <label><input type="checkbox" name="amenities[]" value="Park/Jogging track"> Park /Jogging track</label>
				            
				        </div>
				    </div>
				</div>
            </div>  
			
	    <div class="col-sm-12">
                <div class="form-group">
					<label>Property Description</label>
                    <textarea  name="note" value=""  class="form-control" placeholder="Property Description"></textarea>			
				</div>
        </div>
        <div class="rentSubmit col-sm-12">
            <div class="row">
                <div class="col-sm-12 text-right">
        				<input type="submit" value="Next >>>>" name="step-btn" class="btn btn-primary step-btn" data-cls=".step-2">
        		</div>
    		</div>
    	</div>	
    </div> 
    </div>

<!-- //////// after this can be skiped  -->			
	<div class="col-sm-12 stepTwo d-none">
	    <div class="col-sm-12">
	        <div class="row">
	            <div class="col-sm-6 text-right">
				    <input type="submit" value="Skip >>>>" name="step-btn" class="btn btn-primary step-btn" data-cls=".step-3">
		        </div>
	        </div>
	    </div>     
		    <div class="row">	
            <div class="col-sm-6">
                <div class="form-group">
					<label>Area In Square Feet</label>
					<input type="text" name="area_in_sq_ft" value="" = class="form-control" placeholder="Area In Square Feet">
				</div>
            </div> 
            
            <div class="col-sm-6">
                <div class="form-group">
					<label>Bathrooms</label>
                    <input type="number" name="bathrooms" value="" class="form-control" placeholder="Bathrooms" min="0" max="10"> 				
				</div>
            </div>

            <div class="col-sm-6  ">
                <div class="form-group">
					<label>Prefered <small>Instruction if any like family, service, IT, etc </small></label>
                    <input type="text" name="prefer" value="" class="form-control" placeholder="Prefered only"> 				
				</div>
            </div>
		  
            <div class="col-sm-6">
                <div class="form-group">
					<label>Available </label>
					<Select name="available" class="form-control">
						<option value="yes">Yes </option>
						<option value="no">No </option>
					</select>
				</div>
            </div>
            
            <div class="col-sm-6">
                <div class="form-group">
					<label>Available From</label>
					<input type="date" class="form-control" name="available_from" value="">
				</div>
            </div>
               
			<div class="col-sm-6">
                <div class="form-group">
					<label>Security Desposite </label>
					<Select name="security-deposite" class="form-control">
					    <option value="1 Month">1 Month </option>
						<option value="2 Month">2 Month </option>
						<option value="No">No </option>
					</select>
				</div>
            </div>
			
            
            <!--div class="col-sm-6"></div-->
	<!-- //////// Add Pictures skiped  -->	

            <div class="col-sm-6">
                <div class="form-group">
					<label>Front Picture</label>
					<input type="file" name="image" class="form-control">
				</div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
					<label>Bedroom Picture</label>
					<input type="file" name="image2" class="form-control">
				</div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
					<label>Washroom</label>
					<input type="file" name="image3" class="form-control">
				</div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
					<label>Kitchen</label>
					<input type="file" name="image4" class="form-control">
				</div>
            </div>
            <div class="rentSubmit col-sm-12">
                <div class="row">
                <div class="col-sm-6 text-left">
    				<input type="submit" value="<<<< Previous" name="step-btn" class="btn btn-primary step-btn d-none" data-cls=".step-pre-1">
    		    </div>
		    <div class="col-sm-6 text-right">
				<input type="submit" value="Next >>>>" name="step-btn" class="btn btn-primary step-btn" data-cls=".nxtt-step-3">
		    </div>
        </div> 
        </div>
	</div>	
	</div>


	 <!-- ////////// Owner  Info not be shown in front //  -->
	 <div class="stepThree col-sm-12 d-none">
	     <div class="row">
		    <div class="col-sm-6">
                <div class="form-group">
					<label><span class="font-weight-bold">House No.*</span><small>(not shown to customer)</small></label>
					<input type="text" name="house_no" value="" required class="form-control" placeholder="Property Address">

				</div>
            </div>
			
            <div class="col-sm-6">
                <div class="form-group">
					<label>Owner Name <small>(not shown to customer)</small></label>
                    <input type="text" name="owner_name" value="" class="form-control" placeholder="Owner Name"> 				
				</div>
            </div>
			
			<div class="col-sm-6">
                <div class="form-group">
					<label>Owner Contact <small>(not shown to customer)</small></label>
                    <input type="text" name="owner_contact" value="" class="form-control" placeholder="Owner Contact"> 				
				</div>
            </div>
            
            <div class="col-sm-6">
                <div class="form-group">
					<label>Owner Class <small>(not shown to customer)</small> </label>
					<Select name="owner_class" class="form-control">
						<option value="5 Star - Excellent">5 Star - Excellent</option>
						<option value="4 Star - Good">4 Star - Good</option>
						<option value="3 Star - Normal">3 Star - Normal</option>
						<option value="2 Strar - Med">2 Strar - Med</option>
						<option value="1 Strar - Med">1 Star - So So</option>
					</select>
				</div>
            </div>
   
            <div class="col-sm-6">
                <div class="form-group">
					<label>Verified </label>
					<Select name="verified" class="form-control">
					    <option value="Yes">Yes </option>
						<option value="No">No </option>
					</select>
				</div>
            </div>
			<div class="col-sm-6"></div>
			<div class="col-sm-6 d-none hide" >
                <div class="form-group">
					<label>Referal if any</label>
                    <input type="text" name="refer" value="" class="form-control" placeholder="referral"> 				
				</div>
            </div>
			
			
<!-- ////////// Booking Info Only time of booking -->
			
            <div class="col-sm-6 d-none hide">
                <div class="form-group">
					<label>Booking Amount</label>
                    <input type="text" name="booking_amount" value="" class="form-control" placeholder="Booking Amount"> 				
				</div>
            </div>
            
            <div class="col-sm-6 d-none hide">
                <div class="form-group">
					<label>Booked By</label>
					<Select name="owner_class" class="form-control">
						<option value="Lead"> Agent </option>
				
						<option value="other">Other</option>
					</select>
                    <input type="text" name="booked_by" value="" class="form-control" placeholder="Booked By"> 					
				</div>
            </div> 
            
            <div class="col-sm-6 d-none hide">
                <div class="form-group">
					<label>Booking Advance</label>
                    <input type="text" name="booking_advance" value="" class="form-control" placeholder="Booking Advance"> 				
				</div>
            </div>
   <!-- ////////// Agent Task Info -->          
            <div class="col-sm-3 d-none hide">
                <div class="form-group">
					<label>Agreement </label>
    					<Select name="agreement" class="form-control">
    						<option value="yes">Yes </option>
    						<option value="no">No </option>
    					</select>
				 </div>
			</div>
            
            <div class="col-sm-3 d-none hide">
                <div class="form-group">
					<label>Police Verification</label>
					<Select name="police_verification" class="form-control">
						<option value="yes">Yes </option>
						<option value="no">No </option> 
					</select>				
				</div>
            </div>
            
            <div class="col-sm-3 d-none hide">
                <div class="form-group">
					<label>Security </label>
    					<Select name="security" class="form-control">
        					<option value="yes">Yes </option>
        					<option value="no">No </option>
        			    </select>
				</div>
            </div>
            
            <div class="col-sm-3 d-none hide">
                <div class="form-group">
					<label>Commission</label>
					<Select name="commission" class="form-control">
        					<option value="Paid">Paid </option>
        					<option value="Not Paid">Not Paid </option>
        			</select> 				
				</div>
            </div>
            
			<div class="col-sm-6 d-none hide">
                <div class="form-group">
					<label>Mohali*</label>
					<input type="text" name="state" value="Mohali"  class="form-control" placeholder="State">
                </div>
            </div>
			  
			<div class="col-sm-6 d-none hide">
                <div class="form-group">
					<label>Zip Code</label>
					<input type="text" name="zip_code" value="160071"  class="form-control" placeholder="Zip Code">
                </div>
            </div>
            
            <!--div class="col-sm-6">
                <div class="form-group">
					<label>Services*</label>
					<select name="service" class="form-control" required>
						<option value="">Select Service</option>
                        <option value="Residential">Residential</option>
                        <option value="Office Space">Office Space</option>
                        <option value="Flats and Plots">Flats and Plots</option>  
					</select>				
				</div>
            </div--> 
            
           
			<div class="col-sm-6 d-none hide">
                <div class="form-group">
					<label>Person Name</label>
					<input type="text" name="pName" value=""  class="form-control" placeholder="Person Name">
                </div>
            </div>    
			<div class="col-sm-6 d-none hide">
                <div class="form-group">
					<label>Person Phone</label>
					<input type="number" name="pPhone" value=""  class="form-control" placeholder="Person Phone">

				</div>
            </div>    
			<div class="col-sm-6 d-none hide">
                <div class="form-group">
					<label>Person Address</label>
					<input type="text" name="pAddress" value=""  class="form-control" placeholder="Person Address">

				</div>
            </div>
			
<div class="rentSubmit col-sm-12">
            <div class="row">
			<div class="col-sm-6 text-left">
				<input type="submit" value="<<<< Previous" name="step-btn" class="btn btn-primary step-btn d-none" data-cls=".step-pre-2">
		    </div>
		    
		    <div class="col-sm-12 text-center">
				<input type="submit" value="Submit" name="save" class="btn btn-primary step-btn" data-cls=".step-4">
		    </div>
		</div>  
		</div>
		    
        </div>
        </div>
<!-- /// End Step2 -->

         <div class="row">
            
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
      
      jQuery('.step-btn').click(function(){
		var cls = jQuery(this).attr('data-cls');
		var hideShow = 'true';
					
		if(cls == '.step-2') {
		let title = jQuery('input.rName').val();
		let locationSector = jQuery('input.address').val();
		let rent = jQuery('input.budget').val();
		let property_type = jQuery('select.property_type').val();
		let property_status = jQuery('select.property-status').val();
			
		if(title=='') {
		jQuery('.rName-msg').html('Please fill out this field.');hideShow = 'false';
		}
		if(locationSector == '') {
		jQuery('.address-msg').html('Please fill out this field.');hideShow = 'false';
		}
		if(rent == '') {
		jQuery('.budget-msg').html('Please fill out this field.');hideShow = 'false';
		}
		if(property_type == '') {
		jQuery('.property_type-msg').html('Please Select One option.');hideShow = 'false';
		}
		if(property_status == '') {
		jQuery('.property-status-msg').html('Please Select one option.');hideShow = 'false';
		}
		
		if(hideShow=='true') {
		    jQuery(".stepTwo").removeClass("d-none");
		    jQuery(".stepOne").addClass("d-none");
			}
		}
		
		if(cls == '.step-3') {
		   jQuery(".stepTwo").addClass("d-none");
		   jQuery(".stepThree").removeClass("d-none"); 
		}
		if(cls == '.nxtt-step-3') {
		   jQuery(".stepTwo").addClass("d-none");
		   jQuery(".stepThree").removeClass("d-none"); 
		}
		if(cls == '.step-pre-1') {
		   jQuery(".stepTwo").addClass("d-none");
		   jQuery(".stepOne").removeClass("d-none"); 
		}
		if(cls == '.step-pre-2') {
		   jQuery(".stepTwo").removeClass("d-none");
		   jQuery(".stepThree").addClass("d-none"); 
		}
});   
}); 
 </script> 