<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="col main pt-5 mt-3">
    
    <div class="button-container">
        <a href="<?= base_url('admin/leads/view/' . $this->uri->segment('4')); ?>" id="leadView">Follow Ups</a>
        <a href="<?= base_url('admin/leads/edit/' . $this->uri->segment('4')); ?>">Requirement</a>
        <!--- <a href='<?= base_url('admin/leadtask/') . $this->uri->segment('4'); ?>'>Meeting and Task </a>-->
        <a href="<?= base_url('admin/leads/personal/' . $this->uri->segment('4')); ?>" id="personalInfoLink">Personal Information</a>
        <a href="<?= base_url('admin/leads/deal/' . $this->uri->segment('4')); ?>" id="personalInfoLink">Deal</a>
    </div>
    
    <a href="<?php echo base_url('admin/leads/'); ?>" style="float: right; margin: 14px 2px;" class="btn btn-sm btn-info back-btn">Back</a>

    <h1 class="d-sm-block heading"><?php echo $title; ?></h1>
    <?php
    $message = $this->session->flashdata('message1');
    if ($message != '') {
        echo '<div class="alert alert-success">' . $message . '</div>';
    }
    $this->session->set_flashdata('message1', '');
    
    $error = $this->session->flashdata('error');
    if ($error != '') {
        echo '<div class="alert alert-danger">' . $error . '</div>';
    }
    $this->session->set_flashdata('error', '');
    echo validation_errors(); ?>
    <h1 class="d-sm-block heading">Deals</h1>

    <form class="form" method="post" action="" enctype="multipart/form-data">

        <div class="row">
           <div class="col-sm-3">
                    <div class="form-group">
                        <label>Add property</label>
                        <input type="number" name="addProperty" value="" class="form-control" placeholder="Add Property">
                    </div>
            </div>
        </div>    

        <div class="row">
            <div class="col-sm-12">
                <input type="submit" value="Submit" name="save" class="btn btn-primary mt-4">
            </div>
        </div>
    </form>
    
    <?php 
    if($propertyDeal){ ?>
    <h1 class="d-sm-block heading">Properties</h1>
        <table class="table table-striped">
                         <thead>
						    <tr>
							   <th>Sr. No.</th>
							   <th>Name</th>
							   <th>Address</th>
							   <th>City</th>
							   <th>State</th>
							      <th>Status</th>
							   
							</tr>
						 </thead>
						  <tbody>
						      <?php 
						      if(!empty($propertyDeal)) {
						          $i = 1;
						          foreach($propertyDeal as $property){ ?>
						          <tr>
						                <td><?php echo $i;?></td>
						                <td><?php echo $property->name;?></td>
						                <td><?php echo $property->address;?></td>
						                <td><?php echo $property->city;?></td>
						                <td><?php echo $property->state;?></td>
						                 <td>
                                 
                                  <select name="interestedDropDown" data-id="<?php echo $property->id ; ?>">
                                      <option value="Interested" <?php if($property->Status == 'Interested'){ echo 'selected'; } ?> >Interested</option>
                                      <option value="Not Interested" <?php if ($property->Status == 'Not Interested') { echo 'selected' ; } ?> >Not Interested</option>
                                  </select>
                              </td>                              
						               
						               
						               
						               
						              </tr>
						              <?php 
						              $i++;
						          }
						      } ?>
						  </tbody>
					  </table>
    <?php }
    
    ?>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get the current URL
    const currentUrl = window.location.href;

    // Get all the anchor tags within the button container
    const links = document.querySelectorAll('.button-container a');

    // Loop through each link and apply the 'active' class if the current URL matches the link URL
    links.forEach(function(link) {
        const linkUrl = link.getAttribute('href');
        if (currentUrl.includes(linkUrl)) {
            link.classList.add('active');
        }
    });
});
</script>


<script>
jQuery(document).ready(function(){
    jQuery('select[name="interestedDropDown"]').change(function(){
        var pId = jQuery(this).data('id');
        var status = jQuery(this).val();
        var leadId = '<?php echo $this->uri->segment("4"); ?>';
        jQuery.ajax({
            url: '<?php echo base_url("Siteadmin/Leads/updateDealStatus"); ?>',
            type: 'POST',
            data: {
                propertyId : pId,
                status : status,
                leadId : leadId 
            },
            success: function(response) {
                alert('Status updated successfully');

                location.reload();
            }
        });
    });
});
</script>

