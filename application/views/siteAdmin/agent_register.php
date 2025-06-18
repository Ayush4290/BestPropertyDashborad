<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="col main pt-5 mt-3">
    <a href="<?php echo base_url('admin/agent/'); ?>" style="float: right;margin: 14px 2px;" class="btn btn-sm btn-info back-btn">Back</a>

    <h1 class="d-sm-block heading"><?php echo $title; ?></h1>
    
    <?php
    // Flash message display
    $message = $this->session->flashdata('message1');
    if ($message != '') {
        echo '<div class="alert alert-success">' . $message . '</div>';
    }
    
    // Validation errors display
    echo validation_errors();
    ?>

    <div class="clearfix"></div>

    <form class="form" method="post" action="<?php echo base_url('admin/agent/add'); ?>" enctype="multipart/form-data">

        <div class="row">

            <!-- Name Field -->
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Name*</label>
                    <input type="text" name="name" value="<?php echo set_value('name'); ?>" required class="form-control" placeholder="Name">
                </div>
            </div>

            <!-- Email Field -->
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Email*</label>
                    <input type="email" name="email" value="<?php echo set_value('email'); ?>" required class="form-control" placeholder="Email">
                </div>
            </div>

            <!-- Phone Field -->
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Phone</label>
                    <input type="number" name="phone" value="<?php echo set_value('phone'); ?>" class="form-control" placeholder="Phone">
                </div>
            </div>

            <!-- Address Field -->
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" value="<?php echo set_value('address'); ?>" class="form-control" placeholder="Address">
                </div>
            </div>

            <!-- Password Field -->
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Password*</label>
                    <input type="password" name="password" value="<?php echo set_value('password'); ?>" required class="form-control" placeholder="Password">
                </div>
            </div>

            <!-- Role Field -->
            

        </div>

        <!-- Submit Button -->
        <div class="row">
            <div class="col-sm-12 text-center">
                <input type="submit" value="Submit" name="save" class="btn btn-primary">
            </div>
        </div>

    </form>
</div>
