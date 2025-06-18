<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="col main pt-5 mt-3">
    <a href="<?php echo base_url('admin/leads/'); ?>" style="float: right; margin: 14px 2px;" class="btn btn-sm btn-info back-btn">Back</a>

    <h1 class="d-sm-block heading"><?php echo $title; ?></h1>
    <?php
    $message = $this->session->flashdata('message1');
    if ($message != '') {
        echo '<div class="alert alert-success">' . $message . '</div>';
    }
    $this->session->set_flashdata('message1', '');
    echo validation_errors(); ?>

    <div class="clearfix"></div>

    <form class="form" method="post" action="<?php echo base_url('admin/leads/add'); ?>" enctype="multipart/form-data">

        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Name*</label>
                    <input type="text" name="name" required value="" class="form-control" placeholder="Name">
                </div>
            </div>
           <div class="col-sm-3">
   <div class="form-group">
    <label>Phone*</label>
    <input type="text" id="phone" name="phone" class="form-control" 
           placeholder="Phone" maxlength="10" required 
           oninput="this.value=this.value.replace(/[^0-9]/g, '').slice(0,10)">
    <small id="phone-error" style="color: red; display: none;">Please enter exactly 10 digits.</small>
</div>
</div>

            <div class="col-sm-3">
                <div class="form-group">
                    <label>Preferred Location</label>
                    <input type="text" name="preferred_location" value="" class="form-control" placeholder="Preferred Location">
                </div>
            </div>
          <div class="col-sm-3">
    <div class="form-group">
        <label>Property Type*</label>
       
        <select id="propertyType" name="propertyType" required class="form-control">
            <option value="">Select</option>
            <option value="Residential">Residential</option>
            <option value="Commercial">Commercial</option>
        </select>
    </div>
</div>

<div class="col-sm-3" id="residentialDiv" style="display:none;">
    <div class="form-group">
        <label>Residential</label>
        <select id="residentialOptions" class="form-control">
            <option value="">Select</option>
            <option value="Flat/Apartment">Flat/Apartment</option>
            <option value="Independent House/Villa">Independent House/Villa</option>
            <option value="Independent/Builder Floor">Independent/Builder Floor</option>
            <option value="Plot">Plot</option>
            <option value="1RK/Studio Apartment">1RK/Studio Apartment</option>
            <option value="Serviced Apartment">Serviced Apartment</option>
            <option value="Farmhouse">Farmhouse</option>
            <option value="Other">Other</option>
        </select>
    </div>
</div>

<div class="col-sm-3" id="commercialDiv" style="display:none;">
    <div class="form-group">
        <label>Commercial</label>
        <select id="commercialOptions" class="form-control">
            <option value="">Select</option>
            <option value="Office">Office</option>
            <option value="Retail">Retail</option>
            <option value="Plot/Land">Plot/Land</option>
            <option value="Storage">Storage</option>
            <option value="Industry">Industry</option>
            <option value="Hospitality">Hospitality</option>
            <option value="Other">Other</option>
        </select>
    </div>
</div>
<input type="hidden" name="propertyType_sub" id="propertyType_sub">
        </div>

        <div class="row">
           
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Budget</label>
                    <input type="number" name="budget" value="" class="form-control">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Maximum Budget</label>
                    <input type="number" name="max_budget" value="" class="form-control">
                </div>
            </div>
             <div class="col-sm-3">
                <div class="form-group">
                    <label>Project Builder</label>
                     <input type="Project_Builder" name="Project_Builder" value="" class="form-control">
                    </select>
                </div>
            </div>
             <div class="col-sm-3">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" name="status" class="form-control">
                            <option value="New">New</option>
                            <option value="Contacted">Contacted</option>
                            <option value="Qualified">Qualified</option>
                            <option value="Site Visit Scheduled">Site Visit Scheduled</option>
                            <option value="Site Visited">Site Visited</option>
                            <option value="Negotiation">Negotiation</option>
                            <option value="Booking Confirmed">Booking Confirmed</option>
                            <option value="Document Collection">Document Collection</option>
                            <option value="Loan Under Process">Loan Under Process</option>
                            <option value="Finalized / Closed">Finalized / Closed</option>
                            <option value="Follow-up Later">Follow-up Later</option>
                            <option value="Not Interested">Not Interested</option>
                            <option value="Duplicate">Duplicate</option>
                            <option value="Invalid Lead">Invalid Lead</option>
                        </select>
                    </div>
                </div> </div>
                
                 <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="source">Source</label>
                        <select id="source" name="source" class="form-control">
                             <option value="">Select</option>
                            <option value="Website">Website</option>
                            <option value="Social media">Social media</option>
                            <option value="Third Party">Third Party</option>
                            <option value="Manually">Manually</option>
                           
                        </select>
                    </div></div>
                     <div class="col-sm-3">
                    <div class="form-group">
                        <label for="priority">Priority</label>
                        <select id="priority" name="priority" class="form-control">
                             <option value="">Select</option>
                            <option value="Hot">Hot***</option>
                            <option value="Cold">Cold</option>
                        </select>
                    </div></div>
                    
                     <div class="col-sm-3">
                     <div class="form-group">
                        <label for="timeline">Time line</label>
                        <select id="timeline" name="timeline" class="form-control">
                             <option value="">Select</option>
                            <option value="Urgent">Urgent</option>
                            <option value="Within week">Within week</option>
                            <option value=">Within month">Within month</option>
                             <option value=">1 to 3 months">1 to 3 months</option>
                            <option value=">Up to 6 months">Up to 6 months</option>
                        </select>
                    </div>
                </div></div>
     
      
        <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="status">Leads Type</label>
                        <select id="leads_type" name="leads_type" class="form-control">
                             <option value="">Select</option>
                            <option value="Seller">Seller</option>
                            <option value="Buyer">Buyer</option>
                             <option value="Both">Both</option>
                            <option value="Investor">Investor</option>
                            
                            
                        </select>
                    </div>
                </div>
            <div class="col-sm-5">
                <div class="form-group">
                    <label>Requirement</label>
                    <textarea name="requirement" class="form-control" placeholder="Requirement" value= "requirement"></textarea>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" class="form-control" placeholder="Description"></textarea>
                </div>
            </div>
        </div>

        <div class="personal-main-div">
        <!-- Toggle Button -->
        <button id="toggleButton" type="button" class="btn btn-secondary mt-3">Show Personal Information</button>

        <!-- Additional Fields Section -->
        <fieldset class="personal-div mt-4">
            <legend>Personal Information</legend>
            <div  id="more-information" class="hide-div">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>User Type</label>
                        <select name="buyer" class="form-control">
                            
                            <option value="individual_customer">Individual Customer</option>
                            <option value="investor">Investor</option>
                            <option value="dealer">Dealer</option>
                        </select>
                    </div>
                </div>
              
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="address" value="" class="form-control" placeholder="Address">
                    </div>
                </div>
                 <div class="col-4">
                        <label>Profession</label>
                  <input type="text" name="Profession" value="" class="form-control" placeholder="Profession">
                  
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <label>City</label>
                    <select name="city" class="form-control">
                        <option value="">City</option>
                        <option value="Zirakpur">Zirakpur</option>
                        <option value="Mohali">Mohali</option>
                        <option value="Chandigarh">Chandigarh</option>
                        <option value="Kharar">Kharar</option>
                        <option value="Panchkula">Panchkula</option>
                    </select>
                </div>
                    <div class="col-4">
                        <label>Email</label>
                <input type="email" name="email" value="" class="form-control" placeholder="Email" pattern="^[^\s@]+@[^\s@]+\.[^\s@]+$" title="Please enter a valid email address">

                </div>
                  
            </div>
             <div class="row">
            <div class="col-sm-12">
                
    <div class="form-group">
        <label>Payment Method</label>
        <div class="d-flex">
            <!-- Cash Payment Checkbox -->
         <div class="form-check mr-12">
    <input type="checkbox" id="cash_payment" name="Payment_Method[]" value="cash" class="form-check-input">
    <label for="cash_payment" class="form-check-label">Cash Payment</label>
</div>

<div class="form-check">
    <input type="checkbox" id="online_payment" name="Payment_Method[]" value="online" class="form-check-input">
    <label for="online_payment" class="form-check-label">Online Payment</label>
</div>

<div class="form-check">
    <input type="checkbox" id="loan_payment" name="Payment_Method[]" value="loan" class="form-check-input">
    <label for="loan_payment" class="form-check-label">Loan Payment</label>
</div>

        </div>
    </div>
</div></div></div>
           
        </fieldset>
        
        </div>

        <div class="row">
            <div class="col-sm-12 text-center">
                <input type="submit" value="Submit" name="save" class="property-submit-btn btn btn-primary mt-4">
            </div>
        </div>
    </form>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButton = document.getElementById('toggleButton');
        const moreInfoSection = document.getElementById('more-information');
        
        toggleButton.addEventListener('click', function() {
            if (moreInfoSection.classList.contains('hide-div')) {
                moreInfoSection.classList.remove('hide-div');
                toggleButton.textContent = 'Hide Personal Information';
            } else {
                moreInfoSection.classList.add('hide-div');
                toggleButton.textContent = 'Show Personal Information';
            }
        });
    });
</script>
<script>
    // Optional: prevent non-digit inputs
    const phoneInput = document.getElementById('phone');
    const phoneError = document.getElementById('phone-error');

    phoneInput.closest('form').addEventListener('submit', function(e) {
        const phoneValue = phoneInput.value.trim();

        if (phoneValue.length !== 10) {
            e.preventDefault(); // Stop form submission
            phoneError.style.display = 'block'; // Show error
            phoneInput.focus();
        } else {
            phoneError.style.display = 'none'; // Hide error
        }
    });
</script>
<script>
    const propertyType = document.getElementById("propertyType");
    const residentialDiv = document.getElementById("residentialDiv");
    const commercialDiv = document.getElementById("commercialDiv");
    const residentialOptions = document.getElementById("residentialOptions");
    const commercialOptions = document.getElementById("commercialOptions");
    const finalInput = document.getElementById("propertyType_sub");

    propertyType.addEventListener("change", function() {
        const selectedType = this.value;
        residentialDiv.style.display = "none";
        commercialDiv.style.display = "none";
        finalInput.value = "";

        if (selectedType === "Residential") {
            residentialDiv.style.display = "block";
        } else if (selectedType === "Commercial") {
            commercialDiv.style.display = "block";
        }
    });

    residentialOptions.addEventListener("change", function() {
        finalInput.value = this.value;
    });

    commercialOptions.addEventListener("change", function() {
        finalInput.value = this.value;
    });
</script>

<style>
.form-check-label {
  padding: 0px 18px 0px 0px;
}
    .hide-div { display: none; }
</style>
