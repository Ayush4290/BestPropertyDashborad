<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class= "row" style="width:100%;">
<div class="col main pt-5 mt-3">
    <div class="button-container">
        <a href="<?= base_url('admin/leads/view/' . $this->uri->segment('4')); ?>" id="leadView">Follow Ups</a>
        <a href="<?= base_url('admin/leads/edit/' . $this->uri->segment('4')); ?>">Requirement</a>
        <!--- <a href='<?= base_url('admin/leadtask/') . $this->uri->segment('4'); ?>'>Meeting and Task </a>-->
        <a href="<?= base_url('admin/leads/personal/' . $this->uri->segment('4')); ?>" id="personalInfoLink">Personal Information</a>
        <a href="<?= base_url('admin/leads/deal/' . $this->uri->segment('4')); ?>" id="personalInfoLink">Deal</a>
    </div>
    <a href="<?= base_url('admin/leads/'); ?>" style="float: right; margin: 14px 2px;" class="btn btn-sm btn-info back-btn">Back</a>

    <!--h1 class="d-sm-block heading"><?php echo $title; ?></h1 -->

    <?php
    $info = $leads[0];
   $status = isset($info->status) ? $info->status : '';
   $uName =  $info->uName;
   $mobile =  $info->mobile;
    $message = $this->session->flashdata('message1');
    if ($message != '') {
        echo '<div class="alert alert-success">' . $message . '</div>';
        $this->session->set_flashdata('message1', '');
    }
    $error = $this->session->flashdata('error');
    if ($error != '') {
        echo '<div class="alert alert-danger">' . $error . '</div>';
        $this->session->set_flashdata('error', '');
    }
    ?>

    <div class="clearfix"></div>

    <!-- Information Table Start -->
    <!--div class="info-container">
    <div class="info-grid">
        <div class="info-item">
            <strong>Name:</strong> <?php echo ($info->uName); ?>
        </div>
        <div class="info-item">
            <strong>Phone:</strong> <?php echo ($info->mobile); ?>
        </div>
        <div class="info-item">
            <strong>Requirement:</strong> <?php echo ($info->requirement); ?>
        </div>
        <div class="info-item">
            <strong>Residential:</strong> <?php echo ($info->residential); ?>
        </div>
        <div class="info-item">
            <strong>Commercial:</strong> <?php echo ($info->commercial); ?>
        </div>
        <div class="info-item">
            <strong>Budget:</strong> <?php echo ($info->budget); ?>
        </div>
    </div>
    <div class="info-item description">
        <strong>Description:</strong> <?php echo ($info->description); ?>
    </div>
</div -->

<!-- Enhanced CSS -->
<!--style>
.info-container {
    border: 2px solid #8e44ad;
    padding: 20px;
    width: 100%; /* Set width to 50% */
    margin: 20px auto;
    background: #f5f5f5;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
}

.info-item {
    padding: 10px;
    border-bottom: 1px solid #ddd;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.info-item strong {
    display: inline-block;
    width: 140px;
    color: #34495e;
    font-weight: 500;
}

.description {
    grid-column: 1 / -1; /* Span the description across both columns */
    margin-top: 20px;
    border-bottom: none; /* Remove border-bottom for the last item */
    background-color: #f7f7f7;
}

.info-container {
    margin-bottom: 40px; /* Added bottom margin */
}
</style-->





  	  
	  <form class="form" method="post" action="<?php echo base_url('admin/leads/view/').$this->uri->segment('4');?>">
	  
 <div class="container">
        <div class="row">
           <div class="col-sm-6">
            <h1 class="heading text-left">
                Follow Up 
                    <small>(
                        <?php echo $uName . ' , ' . $mobile; ?> 
                    )</small>
            </h1> 
            </div>

            <div class="col-sm-4">
                  <h1 class="heading status text-right">
               Status :- <?php echo ($status); ?>
                </h1>
            </div>
        </div>
    </div>
	 
<div class="container">
    <div class="row">
        <div class="col-sm-5">
            <div class="form-group">
                <div style="display: flex; gap: 10px;">
                    <label><input type="radio" id="choice-followup" name="choice" value="Followup" <?php echo set_value('choice', 'Followup') == 'Followup' ? 'checked' : ''; ?> /> Followup</label>
                    <label><input type="radio" id="choice-meeting" name="choice" value="Meeting" <?php echo set_value('choice') == 'Meeting' ? 'checked' : ''; ?> /> Meeting</label>
                    <label><input type="radio" id="choice-message" name="choice" value="Message" <?php echo set_value('choice') == 'Message' ? 'checked' : ''; ?> /> Message</label>
                </div>
            </div>
        </div>
        <div class="col-sm-5">
            <div id="nextdt-container" class="form-group">
                <input type="datetime-local" id="nextdt" name="nextdt" class="form-control" placeholder="Next Follow Up Date & Time">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-10">
            <div class="form-group">
                <textarea id="comment" name="comment" class="form-control" placeholder="Updated Message"></textarea>
            </div>
        </div>
    </div> 

    <div class="row">
        <div class="col-sm-10 text-center">
            <input type="submit" value="Submit" name="submit" class="btn btn-primary">
        </div>
    </div>
</div>
</form>
<script>
 document.addEventListener('DOMContentLoaded', function() {
   
//     function toggleDateField() {
//         const meetingRadio = document.querySelector('input[name="choice"][value="Meeting"]');
//         const dateFieldContainer = document.getElementById('nextdt-container');
//         if (meetingRadio.checked) {
//             dateFieldContainer.style.display = 'block';
//         } else {
//             dateFieldContainer.style.display = 'none';
//         }
//     }

 
//     document.querySelectorAll('input[name="choice"]').forEach(radio => {
//         radio.addEventListener('change', function() {
//             toggleDateField();
//         });
//     });


//     window.addEventListener('load', function() {
//         toggleDateField();
//     });

   
    document.querySelector('input[type="submit"]').addEventListener('click', function(event) {
        // Function to validate the form
        function validateForm() {
            const selectedChoice = document.querySelector('input[name="choice"]:checked');
            const nextdtInput = document.getElementById('nextdt');
            const commentTextarea = document.getElementById('comment');

            if (selectedChoice) {
                if (selectedChoice.value === 'Meeting') {
                    nextdtInput.required = true;
                    if (nextdtInput.value === '') {
                        alert('Please provide a date and time for the Meeting.');
                        return false;
                    }
                    // Default comment if empty
                    if (commentTextarea.value.trim() === '') {
                        commentTextarea.value = 'Meeting Scheduled';
                    }
                } else {
                    nextdtInput.required = false;
                }
                
                // Check comment length for Followup and Message
                if ((selectedChoice.value === 'Followup' || selectedChoice.value === 'Message') && commentTextarea.value.trim().length < 3) {
                    alert('Comment must be at least 3 characters long for Followup and Message.');
                    return false;
                }

                // Check comment field for Followup and Message
                if (commentTextarea.value.trim() === '') {
                    alert('Comment field is required for Followup or Message.');
                    return false;
                }
            } else {
                alert('Please select an option.');
                return false;
            }

            return true;
        }

        if (!validateForm()) {
            event.preventDefault();
        }
    });
});
</script>




<style>
h1 small {
    font-size: 40% !important;
    text-transform:capitalize;
}
h1.heading.status.text-right {
    font-size: 18px;
}
   .heading {
            margin: 0;
        }
        .status {
            margin: 0;
            text-align: right; /* Aligns text to the right */
        }


textarea.form-control {
    min-height: 100px; /* Adjust height as needed */
}

.mt-3 {
    margin-top: 1rem; /* Adjust spacing as needed */
}
      
</style>
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

 <div class="container">
<h1 class="d-sm-block heading">Follow Data</h1>
<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Choice</th>
                        <th>Message</th>
                        <th>  Date & Time</th>
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
                                <td><?php echo ($leadsc->choice);?></td>
                                <td><?php echo htmlspecialchars($leadsc->comment);?></td>
                             <td><?php echo date('d M Y h:i A', strtotime($leadsc->nextdt)); ?></td>

                                 
                               <!--td><a href="<?php // echo base_url().'admin/leads/delete-comment/'.$leadsc->id .'/'.$leadsc->leadId;?>" class="btn btn-danger btn-sm">Delete</a></td-->
<td>
    <?php if ($leadsc->status == 'Completed'): ?>
        <span>Completed</span>
    <?php elseif ($leadsc->choice == 'Meeting' && ($leadsc->status == 'Active' || $leadsc->status == '')): ?>
        <select name="FollowUpStatus" data-id="<?php echo ($leadsc->id); ?>">
            <option value="Active" <?php echo ($leadsc->status == 'Active') ? 'selected' : ''; ?>>Active</option>
            <option value="Cancelled" <?php echo ($leadsc->status == 'Cancelled') ? 'selected' : ''; ?>>Cancelled</option>
            <option value="Postponed" <?php echo ($leadsc->status == 'Postponed') ? 'selected' : ''; ?>>Postponed</option>
            <option value="Completed" <?php echo ($leadsc->status == 'Completed') ? 'selected' : ''; ?>>Completed</option>
        </select>
    <?php elseif ($leadsc->choice == 'Meeting' && $leadsc->status != 'Active'): ?>
        <span><?php echo ($leadsc->status); ?></span>
    <?php endif; ?>
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
</div>


<?php
$role = $this->session->userdata('role');
$roles = explode(',', str_replace(' ', '', $role));
if (in_array('Admin', $roles)) {
?>

    
    <div class="container">
        <h1 class="d-sm-block heading">Assign Lead</h1>
     
    <?php 
    $selectedAgentIds = array();
    if($selectedAgents){
        foreach ($selectedAgents as $selectedAgent) {
            $selectedAgentIds[] = $selectedAgent->userid;
            }
    }
    if($agents){ ?>
    <form class="form" method="post" action="" enctype="multipart/form-data">
    <?php
        foreach($agents as $agent){ ?>
            <label>
                <input type="checkbox" name="agents[]" value="<?php echo $agent->id; ?>" <?php if (in_array($agent->id, $selectedAgentIds)) { echo 'checked'; } ?>>
                <?php echo $agent->fullName; ?>
            </label>&nbsp; 
      <?php  } ?>
      
        <div class="col-sm-12 text-center">
				<input type="submit" value="Assign Lead" name="assignLead" class="btn btn-primary step-btn">
		</div>
    </form>
    </div>
    <?php
    }
    else{
        echo 'No Agents Found';
    }

} ?>



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