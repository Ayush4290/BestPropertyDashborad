<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            max-width: 600px;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin: 30px auto; /* Form body me center hoga */
        }
        .btn-primary {
            width: 100%;
        }
        header, footer {
            background: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>
<body>



<!-- Body Content (Form Centered) -->
<div class="container">
    <div class="form-container">
        <h2 class="text-center mb-4">Registration Form</h2>

        <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>

       <?php echo form_open(base_url('schedule-demo')); ?>


        <div class="mb-3">
            <label class="form-label">Name*</label>
            <input type="text" name="name" class="form-control" value="<?php echo set_value('name'); ?>" required>
            <?php echo form_error('name'); ?>
        </div>

        <div class="mb-3">
            <label class="form-label">Phone*</label>
            <input type="text" name="phone" class="form-control" value="<?php echo set_value('phone'); ?>" required>
            <?php echo form_error('phone'); ?>
        </div>

        <div class="mb-3">
            <label class="form-label">Email*</label>
            <input type="email" name="email" class="form-control" value="<?php echo set_value('email'); ?>" required>
            <?php echo form_error('email'); ?>
        </div>

        <div class="mb-3">
            <label class="form-label">City*</label>
            <input type="text" name="city" class="form-control" value="<?php echo set_value('city'); ?>" required>
            <?php echo form_error('city'); ?>
        </div>

        <div class="mb-3">
            <label class="form-label">Sales Team Size*</label>
            <input type="text" name="sales_team_size" class="form-control" value="<?php echo set_value('sales_team_size'); ?>" required>
            <?php echo form_error('sales_team_size'); ?>
        </div>

        <div class="mb-3">
            <label class="form-label">RE Developer or Channel Partner? *</label>
            <select name="re_type" class="form-select" required>
                <option value="">Select</option>
                <option value="RE Developer">Developer</option>
                <option value="Channel Partner">Channel Partner</option>
            </select>
            <?php echo form_error('re_type'); ?>
        </div>

        <div class="mb-3">
            <label class="form-label">Company*</label>
            <input type="text" name="company" class="form-control" value="<?php echo set_value('company'); ?>" required>
            <?php echo form_error('company'); ?>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="subscribe" class="form-check-input" value="1" required>
            <label class="form-check-label">
                I authorize Sell.Do & its representatives to contact me with updates and notifications via Email/SMS/WhatsApp/Call. This will override DND/NDNC.
            </label>
        </div>

       <input type="submit" name="save" class="btn btn-primary" value="Submit">


        <?php echo form_close(); ?>
    </div>
</div>



</body>
</html>
