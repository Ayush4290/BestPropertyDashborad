<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="col main pt-5 mt-3">
    <a href="<?php echo base_url('admin/leadtask/').$this->uri->segment('4');?>" style="float: right;margin: 14px 2px;" class="btn btn-sm btn-info back-btn">Back</a>
    
    <h1 class="d-sm-block heading"><?php echo $title; ?></h1>
    <?php
    $message = $this->session->flashdata('message');
    if($message != ''){
        echo '<div class="alert alert-success">'.$message.'</div>';
    }
    echo validation_errors(); ?>
    
    <div class="clearfix"></div>
    
    <form class="form" method="post" action="<?php echo base_url('admin/leadtask/add/').$this->uri->segment('4');?>" enctype="multipart/form-data">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Task</label>
                    <input type="text" name="task" value="" required class="form-control">                
                </div>
            </div>
            
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Start Date</label>
                    <input type="datetime-local" id="startdt" name="startdt" class="form-control" placeholder="Next Follow Up Date & Time" min="2024-01-01T08:00" max="2024-12-31T22:00">               
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label>Complete Date</label>
                    <input type="datetime-local" id="completedt" name="completedt" class="form-control" placeholder="Next Follow Up Date & Time" min="2024-01-01T08:00" max="2024-12-31T22:00">               
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status" class="form-control">
                        <option value="">Status</option>
                        <option value="active">Active</option>
                        <option value="deactive">Deactive</option>
                        <option value="pending">Pending</option>
                        <option value="complete">Complete</option>
                    </select>
                </div>
            </div>
            
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Task Detail</label>
                    <textarea name="task_detail" class="form-control" placeholder="Task Detail" rows="4"></textarea>
                </div>
            </div>
            
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Special Instruction</label>
                    <textarea name="special_instruction" class="form-control" placeholder="Special Instruction" rows="4"></textarea>
                </div>
            </div>
            
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Picture</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                    </div>
                    
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Types</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="choice" id="option1" value="task">
                                <label class="form-check-label" for="option1">Task</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="choice" id="option2" value="meeting">
                                <label class="form-check-label" for="option2">Meeting</label>
                            </div>
                        </div>
                    </div>
                </div>
            
            <div class="row">
                <div class="col-sm-12 text-center">
                    <input type="submit" value="Submit" name="save" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>

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

            // Ensure time is within the range 08:00 to 22:00
            if (hours < 8) hours = '08';
            if (hours > 22) hours = '22';

            const today = `${year}-${month}-${day}T${hours}:${minutes}`;
            document.getElementById('startdt').value = today;
            document.getElementById('completedt').value = today;

            // Function to update required attributes based on selected radio button
            function updateDateRequirements() {
                const choice = document.querySelector('input[name="choice"]:checked');
                const startdt = document.getElementById('startdt');
                const completedt = document.getElementById('completedt');

                if (choice && choice.value === 'meeting') {
                    startdt.setAttribute('required', 'required');
                    completedt.setAttribute('required', 'required');
                } else {
                    startdt.removeAttribute('required');
                    completedt.removeAttribute('required');
                }
            }

            // Event listeners for radio buttons
            document.getElementById('option1').addEventListener('change', updateDateRequirements);
            document.getElementById('option2').addEventListener('change', updateDateRequirements);
        });
    </script>
</body>
</html>
