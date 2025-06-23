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
    

     
     
</div>

        <!-- <a href="<?php echo base_url('admin/leadtask/271');?>" style="float: right;margin: 14px 2px;" class="btn btn-sm btn-info back-btn">Manage Task</a>-->
        <a href="<?php echo base_url('admin/leads/');?>" style="float: right;margin: 14px 2px;" class="btn btn-sm btn-info back-btn">Back</a>
       <!--  <a href="<?php echo base_url('admin/meetings/').$this->uri->segment('4');?>" style="float: right;margin: 14px 2px;" class="btn btn-sm btn-info back-btn">Meetings</a>-->
      <h1 class="d-sm-block heading"><?php echo $title; ?></h1>
      <?php
      $info = $leads[0];
          $a= $task;
          print_r($a);
	  $message = $this->session->flashdata('message1');
	  if($message != ''){
	      echo '<div class="alert alert-success">'.$message.'</div>';
	      $this->session->set_flashdata('message1','');
	  }
	  echo validation_errors(); ?>
	  
	  <div class="clearfix"></div>
	  
<form class="form" method="post" action="<?php echo base_url('admin/leads/personal/'.$this->uri->segment('4'));?>">
    
<div class="col-sm-12">
    <fieldset id="more-information" class="hide-div">
        <legend>Personnel Information</legend>

<?php
echo $a;
?>
          

        <div class="row">
		
		 <div class="col-sm-4">
            <div class="form-group">
                <label>User Type</label>
                <select name="buyer" class="form-control">
                    <option <?php if($info->userType=='individual_customer'){ echo 'selected'; }?> value="individual_customer">Individual</option>
                    <option <?php if($info->userType=='investor'){ echo 'selected'; }?> value="investor">Investor</option>
                    <option <?php if($info->userType=='dealer'){ echo 'selected'; }?> value="dealer">Dealer</option>
                </select> 				
            </div>
        </div>  
    
        <div class="col-sm-4">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="<?php echo ($info->uName); ?>" class="form-control" placeholder="Name">

            </div>
        </div>    
         
        <div class="col-sm-4">
    <div class="form-group">
        <label>Phone*</label>
        <input type="text" name="phone" 
               value="<?php echo $info->mobile;?>" 
               required 
               maxlength="10" 
               pattern="\d{10}" 
               class="form-control" 
               placeholder="Phone"
               title="Please enter exactly 10 digits">
    </div>
</div>

		
	
		<!-- // -->
		

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
       

       
      
            <div class="col-sm-4">
            <div class="form-group">
                <label>Profession</label>
                <input type="text" name="Profession" value="<?php echo $info->Profession; ?>" class="form-control" placeholder="Profession">
            </div>
        </div>
         
     <div class="col-sm-4">
   <div class="form-group">
    <label>Payment Method</label>
    <div class="d-flex">
        <?php 
      
        $selected_methods = explode(', ', $info->Payment_Method);
        ?>
        <div class="form-check mr-3">
            <input type="checkbox" id="cash_payment" name="Payment_Method[]" value="cash" 
                <?php if (in_array('cash', $selected_methods)) { echo 'checked'; } ?>  
                class="form-check-input">
            <label for="cash_payment" class="form-check-label">Cash Payment</label>
        </div>
        
        <div class="form-check">
            <input type="checkbox" id="online_payment" name="Payment_Method[]" value="online" 
                <?php if (in_array('online', $selected_methods)) { echo 'checked'; } ?>  
                class="form-check-input">
            <label for="online_payment" class="form-check-label">Online Payment</label>
        </div>
        <div class="form-check">
            <input type="checkbox" id="loan_payment" name="Payment_Method[]" value="loan" 
                <?php if (in_array('loan', $selected_methods)) { echo 'checked'; } ?>  
                class="form-check-input">
            <label for="loan_payment" class="form-check-label">Loan Payment</label>
        </div>
    </div>
</div>

</div>
        </div>
    </fieldset>

    
</div>





            
		<div class="row">
            <div class="col-sm-12 text-center mt-4">
				<input type="submit" value="Submit" name="save" class="btn btn-primary">
			</div>
		</div>
	</form>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the current URL
        const currentUrl = window.location.href;
        
        // Get the link element by ID
        const link = document.getElementById('personalInfoLink');
        
        // Get the href value of the link
        const linkUrl = link.getAttribute('href');
        
        // Apply the 'active' class if the current URL matches the link URL
        if (currentUrl.includes(linkUrl)) {
            link.classList.add('active');
        }
    });
</script>



	  
	