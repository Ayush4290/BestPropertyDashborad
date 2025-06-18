<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="col main pt-5 mt-3">
    <a href="<?php echo base_url('admin/projects/');?>" style="float: right;margin: 14px 2px;" class="btn btn-sm btn-info back-btn">Back</a>
    
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

    <form class="form" method="post" action="<?php echo base_url('/admin/projects/add/');?>" enctype="multipart/form-data">
	      
        <div class="row" id="">
            <div class="col-sm-4">
                   <div class="form-group">
					<label>Project Name*</label>
                    <input type="text" name="Project_Name" value="" required class="form-control" placeholder="Project Name"> 				
					</div>
                     </div> 
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Project Discription</label>
                    <input type="text" name="Project_Discription" value="" class="form-control" placeholder="Project Discription">                
                    </div>              
                     </div>
       
             
             <div class="col-sm-4">
                <div class="form-group">
					<label>Email</label>
                    <input type="Email" name="Email" value=""  class="form-control" placeholder="Property Name"> 				
					</div>
                   </div>   </div> 
            
            
               <div class="row">
                         <div class="col-sm-3">
                <div class="form-group">
					<label>Certify</label>
					<select name="Certify" class="form-control">
						<option value="">Select Certify Type</option>
							<option value="Rera">Rera</option>
                        <option value="Gamada">Gamada</option>
                       
					</select>				
				</div>
            </div> 
                         <div class="col-sm-3">
                <div class="form-group">
					<label>Project Type</label>
					<select name="Project_Type" class="form-control">
						<option value="">Select Project Type</option>
							<option value="Commercial">Commercial</option>
                        <option value="Residential">Residential</option>
                       
					</select>				
				</div>
            </div> 
                 <div class="col-sm-3">
               <div class="form-group">
        <label>Pictures</label>
        <input type="file" name="Images[]" class="form-control" multiple>
  
				</div></div>
            

		    	<div class="col-sm-3">
          <div class="form-group">
    <label>Video URL</label>
    
    <textarea  name="Video_u" value=""  class="form-control" placeholder="Enter video URL"></textarea>
</div>
	</div></div>
    
    
	
					<div class="row">
                 <div class="col-sm-4">
                <div class="form-group">
                    <label>Minimum Budget</label>
                    <input type="number" name="Min_Budget" value="" class="form-control">
                </div>
            </div>
           <div class="col-sm-4">
                <div class="form-group">
                    <label>Maximum Budget</label>
                    <input type="number" name="Max_Budget" value="" class="form-control">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
					<label>Built Up Area (Sq.ft)</label>
					<input type="number" step="0.01" name="Built" value=""  class="form-control" placeholder="Built Up Area">

				</div>
            </div>
            
        </div>
			  
     	    <div class="row">
			<div class="col-sm-4">
                <div class="form-group">
					<label>Project Sub Heading</label>
                    <input type="text" name="Project_Sub_Heading" value="" class="form-control" placeholder="Project Sub Heading"> 				
					</div>
				</div>	
          
			<div class="col-sm-4">
                <div class="form-group">
					<label>Address</label>
					<input type="text" name="Address" value=""  class="form-control" placeholder="Project Address">
            	</div> 
				</div>
<div class="col-sm-4 mt-4">
    <div class="form-group">
        <label>
            <input type="checkbox" name="Upcoming_Projects" value="yes">
            Upcoming Projects
        </label>
    </div>
</div>
   </div> 
            
            
            <div class="row">
			<div class="col-sm-6">
               <div class="form-group">
					<label>Bankers</label>
					<input type="text" name="Bankers" value=""  class="form-control" placeholder="Bankers">
                </div>
            </div>
				<div class="col-sm-6">
                <div class="form-group">
					<label>Construction Status</label>
					<input type="text" name="Construction_Status" value=""  class="form-control" placeholder="Construction Status">

				</div>	</div>
				
            </div>
				
				
              <div class="row">
	
            
              <div class="col-sm-6">
                 <div class="form-group">
					<label>Property Sub Description </label>
                    <textarea  name="Property_Sub_Description" value=""  class="form-control" placeholder="Property Sub Description"></textarea>			
					</div>	</div>	
					
					
			
			<div class="col-sm-6">
                <div class="form-group">
					<label>Exclusive Text</label>
					<textarea  name="Exclusive_Limited" value=""  class="form-control" placeholder="Exclusive Limited"></textarea>
					

				</div>
            </div>  </div>  
             
<div class="col-sm-6">
    <div class="form-group">
        <div id="dynamic_field"></div> <!-- Only dynamic field, no label -->
    </div>
</div>

<button style="margin-top: 30px;" type="button" id="add" class="btn btn-primary">Add Amenities Details</button>
<div id="dynamic_field"></div>
				</div>
            </div>   </div>  
            
            
        
              <div class="row">
            <div class="col-sm-12 text-center">
				<input type="submit" value="Submit" name="save" class="btn btn-primary">
			</div>
		</div>
	  </form>	</div>
    
<script>
    document.getElementById('add').addEventListener('click', function() {
        // Create a new input element dynamically
        var input = document.createElement('input');
        input.type = 'text';
        input.name = 'amenities[]';
        input.placeholder = 'Enter Amenity';
        input.className = 'form-control';
        input.style.marginTop = '10px';

        // Append the input to the dynamic_field div
        document.getElementById('dynamic_field').appendChild(input);
    });
</script>
 