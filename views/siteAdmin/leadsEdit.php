<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  
    <div class="col main pt-5 mt-3">
    <div class="button-container">
         <a href="<?= base_url('admin/leads/view/' . $this->uri->segment('4')); ?>" id="leadView">Follow Ups</a>
        <a href="<?= base_url('admin/leads/edit/' . $this->uri->segment('4')); ?>">Requirement</a>
        <!--- <a href='<?= base_url('admin/leadtask/') . $this->uri->segment('4'); ?>'>Meeting and Task </a>-->
        <a href="<?= base_url('admin/leads/personal/' . $this->uri->segment('4')); ?>" id="personalInfoLink">Personal Information</a>
        <a href="<?= base_url('admin/leads/deal/' . $this->uri->segment('4')); ?>" id="personalInfoLink">Deal</a>
        
        
 <?php if (isset($property) && !empty($property) && $property->lead_id > 0): ?>
    <a href="<?php echo base_url().'admin/properties/edit/'.$property->id; ?>" 
       class="btn btn-warning btn-sm" style="color:white;">
        <i class="t"></i> Edit Property
    </a>
<?php endif; ?>


     

</div>
        <!-- <a href="<?php echo base_url('admin/leadtask/271');?>" style="float: right;margin: 14px 2px;" class="btn btn-sm btn-info back-btn">Manage Task</a>-->
        <a href="<?php echo base_url('admin/leads/');?>" style="float: right;margin: 14px 2px;" class="btn btn-sm btn-info back-btn">Back</a>
       <!--  <a href="<?php echo base_url('admin/meetings/').$this->uri->segment('4');?>" style="float: right;margin: 14px 2px;" class="btn btn-sm btn-info back-btn">Meetings</a>-->
      <h1 class="d-sm-block heading"><?php echo $title; ?></h1>
      <?php
      $info = $leads[0];
	  $message = $this->session->flashdata('message1');
	  if($message != ''){
	      echo '<div class="alert alert-success">'.$message.'</div>';
	      $this->session->set_flashdata('message1','');
	  }
	  echo validation_errors(); ?>
	  
	  <div class="clearfix"></div>
	  
<form class="form" method="post" action="<?php echo base_url('admin/leads/edit/'.$this->uri->segment('4'));?>">
   
   
   
    <div class="row">
<div class="col-sm-6">
            <div class="form-group">
                <label>Requirement</label>
                <textarea name="requirement" class="form-control" placeholder="Requirement"><?php echo $info->requirement; ?></textarea>
            </div>
        </div>
		   <div class="col-sm-6">
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control" placeholder="Description"><?php echo $info->description; ?></textarea>
            </div>

        </div>
        
          
		 <div class="col-sm-3">
            <div class="form-group">
                <label>Preferred Location</label>
                <input type="text" name="preferred_location" value="<?php echo $info->preferred_location; ?>" class="form-control" placeholder="Preferred Location">
            </div>
        </div>
		
		
		
        <!-- 4-column fields -->
        <div class="col-sm-3">
            <div class="form-group">
                <label for="status">Status</label> 
                <select id="status" name="status" class="form-control">
                     <option value="New" <?php if($info->status=='New') { echo 'selected'; }?>>New</option>
                     <option value="Contacted" <?php if($info->status=='Contacted') { echo 'selected'; }?>>Contacted</option>
                     <option value="Qualified" <?php if($info->status=='Qualified') { echo 'selected'; }?>>Qualified</option>
                     <option value="Site Visit Scheduled" <?php if($info->status=='Site Visit Scheduled') { echo 'selected'; }?>>Site Visit Scheduled</option>
                     <option value="Site Visited" <?php if($info->status=='Site Visited') { echo 'selected'; }?>>Site Visited</option>
                     <option value="Negotiation" <?php if($info->status=='Negotiation') { echo 'selected'; }?>>Negotiation</option>
                     <option value="Booking Confirmed" <?php if($info->status=='Booking Confirmed') { echo 'selected'; }?>>Booking Confirmed</option>
                     <option value="Document Collection" <?php if($info->status=='Document Collection') { echo 'selected'; }?>>Document Collection</option>
                     <option value="Loan Under Process" <?php if($info->status=='Loan Under Process') { echo 'selected'; }?>>Loan Under Process</option>
                     <option value="Finalized / Closed" <?php if($info->status=='Finalized / Closed') { echo 'selected'; }?>>Finalized / Closed</option>
                     <option value="Follow-up Later" <?php if($info->status=='Follow-up Later') { echo 'selected'; }?>>Follow-up Later</option>
                     <option value="Not Interested" <?php if($info->status=='Not Interested') { echo 'selected'; }?>>Not Interested</option>
                     <option value="Duplicate" <?php if($info->status=='Duplicate') { echo 'selected'; }?>>Duplicate</option>
                     <option value="Invalid Lead" <?php if($info->status=='Invalid Lead') { echo 'selected'; }?>>Invalid Lead</option>
                     
                </select>			
            </div>
        </div>
        
        <div class="col-sm-3">
                <div class="form-group">
                    <label>City</label>
                    <input type="text" name="city" value="<?php echo $info->city; ?>" class="form-control" placeholder="City">
                </div>
            </div>
<div class="col-sm-3">
    <div class="form-group">
        <label>Property Type</label>
        <select id="propertyType" name="propertyType" class="form-control">
           
            <option value="Residential" <?php if ($info->propertyType == 'Residential') echo 'selected'; ?>>Residential</option>
            <option value="Commercial" <?php if ($info->propertyType == 'Commercial') echo 'selected'; ?>>Commercial</option>

        </select>
    </div>
</div>

<div class="col-sm-3" id="residentialDiv" style="display:<?php if ($info->propertyType=='Residential') { echo 'block'; } else { echo 'none'; } ?>;">
    <div class="form-group">
        <label>Residential</label>
        <select id="residentialOptions" class="form-control">
            <option value="">Select</option>
            <option <?php if($info->propertyType_sub=='Flat/Apartment'){ echo 'selected'; }?> value="Flat/Apartment">Flat/Apartment</option>
            <option <?php if($info->propertyType_sub=='Independent House/Villa'){ echo 'selected'; }?> value="Independent House/Villa">Independent House/Villa</option>
            <option <?php if($info->propertyType_sub=='Independent/Builder Floor'){ echo 'selected'; }?> value="Independent/Builder Floor">Independent/Builder Floor</option>
            <option <?php if($info->propertyType_sub=='Plot'){ echo 'selected'; }?> value="Plot">Plot</option>
            <option <?php if($info->propertyType_sub=='1RK/Studio Apartment'){ echo 'selected'; }?> value="1RK/Studio Apartment">1RK/Studio Apartment</option>
            <option <?php if($info->propertyType_sub=='Serviced Apartment'){ echo 'selected'; }?> value="Serviced Apartment">Serviced Apartment</option>
            <option <?php if($info->propertyType_sub=='Farmhouse'){ echo 'selected'; }?> value="Farmhouse">Farmhouse</option>
            <option <?php if($info->propertyType_sub=='Other'){ echo 'selected'; }?> value="Other">Other</option>
        </select>
    </div>
</div>

<div class="col-sm-3" id="commercialDiv" style="display:none<?php if ($info->propertyType=='Commercial;') { echo 'block'; } else { echo 'none'; } ?>;">
    <div class="form-group">
        <label>Commercial</label>
        <select id="commercialOptions" class="form-control">
            <option value="">Select</option>
            <option <?php if($info->propertyType_sub=='Office'){ echo 'selected'; }?> value="Office">Office</option>
            <option <?php if($info->propertyType_sub=='Retail'){ echo 'selected'; }?> value="Retail">Retail</option>
            <option <?php if($info->propertyType_sub=='Plot/Land'){ echo 'selected'; }?> value="Plot/Land">Plot/Land</option>
            <option <?php if($info->propertyType_sub=='Storage'){ echo 'selected'; }?> value="Storage">Storage</option>
            <option <?php if($info->propertyType_sub=='Industry'){ echo 'selected'; }?> value="Industry">Industry</option>
            <option <?php if($info->propertyType_sub=='Hospitality'){ echo 'selected'; }?> value="Hospitality">Hospitality</option>
            <option <?php if($info->propertyType_sub=='Other'){ echo 'selected'; }?> value="Other">Other</option>
        </select>
    </div>
</div>

<input type="hidden" name="propertyType_sub" id="propertyType_sub">

     
            <div class="col-sm-3">
            <div class="form-group">
                <label>Leads Type</label>
                <select name="leads_type" class="form-control">
                    <option value="">Select</option>
                    <option <?php if($info->leads_type=='Seller'){ echo 'selected'; }?> value="Seller">Seller</option>
                    <option <?php if($info->leads_type=='Buyer'){ echo 'selected'; }?> value="Buyer">Buyer</option>
                    <option <?php if($info->leads_type=='Both'){ echo 'selected'; }?> value="Both">Both</option>
                    <option <?php if($info->leads_type=='Investor'){ echo 'selected'; }?> value="Investor">Investor</option>
                  
                    
                </select> 				
            </div>
        </div>

<div class="col-sm-3">
            <div class="form-group">
                <label>Project / Builder</label>
                <input type="text" name="Project_Builder" value="<?php echo $info->Project_Builder; ?>" class="form-control" placeholder="Project Builder">
            </div>
        </div>


        <div class="col-sm-3">
            <div class="form-group">
                <label>Budget</label>
                <input type="text" name="budget" value="<?php echo $info->budget;?>" class="form-control" placeholder="Budget"> 				
            </div>
        </div>

   
        <div class="col-sm-3">
            <div class="form-group">
                <label>Maximum Budget</label>
                <input type="number" name="budgetmax" value="<?php echo $info->max_budget;?>" class="form-control" placeholder="Maximum Budget"> 				
            </div>
        </div>
        
        
        
         <div class="col-sm-3">
            <div class="form-group">
                <label>Source</label>
                <select name="source" class="form-control">
                    <option value="">Select</option>
                    <option <?php if($info->source=='Website'){ echo 'selected'; }?> value="Website">Website</option>
                    <option <?php if($info->source=='Social media'){ echo 'selected'; }?> value="Social media">Social media</option>
                    <option <?php if($info->source=='Third Party'){ echo 'selected'; }?> value="Third Party">Third Party</option>
                    <option <?php if($info->source=='Manually'){ echo 'selected'; }?> value="Manually">Manually</option>
                  
                    
                </select> 				
            </div>
        </div>
            <div class="col-sm-3">
            <div class="form-group">
                <label>Priority</label>
                <select name="priority" class="form-control">
                    <option value="">Select</option>
                    <option <?php if($info->priority=='Hot'){ echo 'selected'; }?> value="Hot">Hot***</option>
                    <option <?php if($info->priority=='Cold'){ echo 'selected'; }?> value="Cold">Cold</option>
 
                </select> 				
            </div>
        </div>
            <div class="col-sm-3">
            <div class="form-group">
                <label>Time line</label>
                <select name="timeline" class="form-control">
                    <option value="">Select</option>
                    <option <?php if($info->timeline=='Urgent'){ echo 'selected'; }?> value="Urgent">Urgent</option>
                    <option <?php if($info->timeline=='Within week'){ echo 'selected'; }?> value="Within week">Within week</option>
                    <option <?php if($info->timeline=='Within months'){ echo 'selected'; }?> value="Within months">Within months</option>
                    <option <?php if($info->timeline=='Up to 6 months'){ echo 'selected'; }?> value="Up to 6 months">Up to 6 months</option>
 
                </select> 				
            </div>
        </div>
        
        
        
       
	
		 	
            <div class="col-sm-3 text-center mt-4">
				<input type="submit" value="Submit" name="save" class="btn btn-primary">
			</div>
		</div>	
	
	</form>

        
   


        <!-- New fields added here -->
       
        
    
<!--<div class="col-sm-12">
    <fieldset id="more-information" class="hide-div">
        <legend>Personnel Information</legend>
<button id="toggleMoreInfo" type="button">Show</button>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label>City</label>
                    <input type="text" name="city" value="<?php echo $info->city; ?>" class="form-control" placeholder="City">
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="<?php echo $info->email; ?>" class="form-control" placeholder="Email">
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" value="<?php echo $info->address; ?>" class="form-control" placeholder="Address">
                </div>
            </div>
        </div>

        <div class="row">
      
            <div class="col-sm-4">
            <div class="form-group">
                <label>Profession</label>
                <input type="text" name="profession" value="<?php echo $info->profession; ?>" class="form-control" placeholder="Profession">
            </div>
        </div>
     <div class="col-sm-4">
    <div class="form-group">
        <label>Payment Method</label>
        <div class="d-flex">
            <div class="form-check mr-3">
                <input type="checkbox" id="cash_payment" name="payment_method[]" value="cash"  class="form-check-input">
                <label for="cash_payment" class="form-check-label">Cash Payment</label>
            </div>
            <div class="form-check">
                <input type="checkbox" id="online_payment" name="payment_method[]" value="online" class="form-check-input">
                <label for="online_payment" class="form-check-label">Online Payment</label>
            </div>
        </div>
    </div>
</div>
        </div>
    </fieldset>

    
</div>

<script>
    $(document).ready(function() {
        $("#toggleMoreInfo").click(function() {
            var moreInfoSection = $("#more-information");
            var button = $(this);
            
            // Toggle visibility based on current state
            if ($("#more-information > div").is(":hidden")) {
                moreInfoSection.removeClass('hide-div');
                button.text("Hide");
            } else {
                moreInfoSection.addClass('hide-div');
                button.text("Show");
            }
        });
    });
</script>-->



            
	

	  
	  
	  <!---leads Comment--->
	  <?php /*
	  $message = $this->session->flashdata('message2');
	  if($message != ''){
	      echo '<div class="alert alert-success">'.$message.'</div>';
	      $this->session->set_flashdata('message2','');
	  }
	  ?>
	  
	  <form class="form" method="post" action="<?php echo base_url('admin/leads/edit/').$this->uri->segment('4');?>">
	  
	  <h1 class="d-sm-block heading">Follow Up</h1>
	  <div class="row">
	      <div class="col-sm-12">
             <div class="form-group">
				 <label>Comment</label>
                 <textarea  name="comment" value=""  class="form-control" placeholder="Comment"></textarea>  				
			 </div>
         </div>    </div>
	      
	     	  <div class="row">
         <div class="col-sm-5">
    <div class="form-group">
        <label>Date & Time</label>
        <input type="datetime-local" id="nextdt" name="nextdt" required class="form-control" placeholder="Next Follow Up Date & Time">               
    </div>
</div>
                     <div class="col-sm-4">
           <div class="form-group">
    <label>Type</label>
    <div style="display: flex; gap: 10px;">
        <input type="radio" name="choice" value="Followup" <?php echo set_value('choice', 'Followup') == 'Followup' ? 'checked' : ''; ?> /> Followup
        <input type="radio" name="choice" value="Meeting" <?php echo set_value('choice') == 'Meeting' ? 'checked' : ''; ?> /> Meeting
    </div>
     </div>
        </div>
<div class="col-sm-3 mt-4 text-center">
    <input type="submit" value="Submit" name="submit" class="btn btn-primary">
</div></div> 
       

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const date = new Date();
        let day = date.getDate();
        let month = date.getMonth() + 1; // January is 0!
        const year = date.getFullYear();
        let hours = date.getHours();
        let minutes = date.getMinutes();

        // Add leading zero to single digit day, month, hours, and minutes
        if (day < 10) day = '0' + day;
        if (month < 10) month = '0' + month;
        if (hours < 10) hours = '0' + hours;
        if (minutes < 10) minutes = '0' + minutes;

        const today = `${year}-${month}-${day}T${hours}:${minutes}`;
        document.getElementById('nextdt').value = today;
    });
</script>
<h1 class="d-sm-block heading">Follow Data</h1>
<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Leads Id</th>
                        <th>Comment</th>
                        <th>Next Follow Up Date & Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if (!empty($leadscomment)) { 
                        $leadscomment = array_reverse($leadscomment); // Array ko reverse karke descending order mein karna
                        $i = 1;
                        foreach ($leadscomment as $leadsc) { ?>
                            <tr>
                                <td><?php echo $i;?></td>
                                <td><?php echo htmlspecialchars($leadsc->comment);?></td>
                             <td><?php echo date('d M Y h:iA', strtotime($leadsc->nextdt)); ?></td>

                                 
                               <!--td><a href="<?php // echo base_url().'admin/leads/delete-comment/'.$leadsc->id .'/'.$leadsc->leadId;?>" class="btn btn-danger btn-sm">Delete</a></td-->
                                <td>
                                <?php if ($leadsc->status == 'Completed') { ?>
                                    <span>Completed</span>
                                <?php } else { ?>
                                    <select name="FollowUpStatus" data-id="<?php echo $leadsc->id; ?>">
                                        <option value="Active" <?php if($leadsc->status == 'Active'){echo 'selected';}?>>Active</option>
                                        <option value="Completed" <?php if($leadsc->status == 'Completed'){echo 'selected';}?>>Completed</option>
                                    </select>
                                <?php } ?>
                                </td>
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
*/?>

<?php if ($logs): ?>
    <h2 class="d-sm-block mb-5">Logs</h2>

    <table class="log-table">
        <thead>
            <tr>
                <th>User</th> <!-- New Column for Username -->
                <th>IP Address</th> <!-- IP Address Column -->
                <th>Date</th> <!-- Date Column -->
                <th>Changes</th> <!-- Consolidated Changes Column -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($logs as $log): ?>
                <?php 
                $contentArray = json_decode($log->content, true);
                $changes = ''; // Initialize an empty string to store changes

                foreach ($contentArray as $field => $change): 
                    // Check if the old and new values are null
                    $oldValue = ($change['old'] === null) ? 'N/A' : "<strong>" . htmlspecialchars($change['old']) . "</strong>";
                    $newValue = ($change['new'] === null) ? 'N/A' : "<strong>" . htmlspecialchars($change['new']) . "</strong>";

                    // Append each change to the $changes string
                    $changes .= "Changed the " . htmlspecialchars($field) . " from '" . $oldValue . "' to '" . $newValue . "'<br>";
                endforeach;
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($log->username); ?></td> <!-- Display Username -->
                    <td><?php echo htmlspecialchars($log->ip); ?></td> <!-- IP Address -->
                    <td>
                    <?php echo  date('d M Y h:iA',strtotime($log->rdate)); ?></td> <!-- Date -->
                    <td><?php echo $changes; ?></td> <!-- Consolidated Changes -->
                </tr>
               
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>


<style>
.hide-div > div{
    display:none;
}
</style>
<script>
    // Function to set the active link based on the current URL
    function setActiveLink() {
        const currentUrl = window.location.href;
        
        // Get all links inside the button-container
        const links = document.querySelectorAll('.button-container a');
        
        links.forEach(link => {
            // Get the href value of each link
            const linkUrl = link.getAttribute('href');
            
            // If the link URL matches the current URL, add the active class
            if (currentUrl.includes(linkUrl)) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });
    }
    
    // Call the function on page load
    window.onload = setActiveLink;
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
jQuery(document).ready(function(){
    jQuery('select[name="FollowUpStatus"]').change(function(){
        var followUpId = jQuery(this).data('id');
        var status = jQuery(this).val();
        jQuery.ajax({
            url: '<?php echo base_url("Siteadmin/Leads/updateFollowUpStatus"); ?>',
            type: 'POST',
            data: {
                followUpId: followUpId,
                status: status
            },
            success: function(response) {
                alert('Status updated successfully');

                location.reload();
            }
    });
});
});
</script>

<script>
    const propertyType = document.getElementById("propertyType");
    const residentialDiv = document.getElementById("residentialDiv");
    const commercialDiv = document.getElementById("commercialDiv");
    const residentialOptions = document.getElementById("residentialOptions");
    const commercialOptions = document.getElementById("commercialOptions");
    const finalInput = document.getElementById("propertyType_sub");

    propertyType.addEventListener("change", function () {
        const selectedType = this.value;
        residentialDiv.style.display = "none";
        commercialDiv.style.display = "none";
        finalInput.value = "";

        if (selectedType === "Residential") {
            residentialDiv.style.display = "block";
            finalInput.value = residentialOptions.value;
        } else if (selectedType === "Commercial") {
            commercialDiv.style.display = "block";
            finalInput.value = commercialOptions.value;
        }
    });

    residentialOptions.addEventListener("change", function () {
        finalInput.value = this.value;
    });

    commercialOptions.addEventListener("change", function () {
        finalInput.value = this.value;
    });

    // Auto select on page load (edit mode)
    window.addEventListener("DOMContentLoaded", function () {
        const selectedType = propertyType.value;

        if (selectedType === "residential") {
            residentialDiv.style.display = "block";
            finalInput.value = residentialOptions.value;
        } else if (selectedType === "commercial") {
            commercialDiv.style.display = "block";
            finalInput.value = commercialOptions.value;
        }
    });
</script>



 