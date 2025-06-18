<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="col main pt-5 mt-3">
	<a href="<?php echo base_url('admin/user/'); ?>" style="float: right;margin: 14px 2px;" class="btn btn-sm btn-info back-btn">Back</a>

	<h1 class="d-sm-block heading"><?php echo $title; ?></h1>
	<?php
	$message = $this->session->flashdata('message1');
	if ($message != '') {
		echo '<div class="alert alert-success">' . $message . '</div>';
	}
	$this->session->set_flashdata('message1', '');
	echo validation_errors(); ?>

	<div class="clearfix"></div>

	<form class="form" method="post" action="<?php echo base_url('admin/user/add'); ?>" enctype="multipart/form-data">

		<div class="row" id="">

			<div class="col-sm-6">
				<div class="form-group">
					<label>Name*</label>
					<input type="text" name="name" value="" required class="form-control" placeholder="Name">
				</div>
			</div>
			
			<div class="col-sm-6">
				<div class="form-group">
					<label>Email*</label>
					<input type="email" name="email" value="" required class="form-control" placeholder="Email">
				</div>
			</div>

			<div class="col-sm-6">
				<div class="form-group">
					<label>Phone</label>
					<input type="number" name="mobile" value="" class="form-control" placeholder="Phone">

				</div>
			</div>

			<div class="col-sm-6">
				<div class="form-group">
					<label>Address</label>
					<input type="text" name="address" value=""  class="form-control" placeholder="Address">

				</div>
			</div>

			
			<div class="col-sm-6">
				<div class="form-group">
					<label>Password*</label>
					<input type="password" name="password" value="" required class="form-control" placeholder="Password">
				</div>
			</div>
			
		<div class="col-sm-6">
    <div class="form-group">
        <label>Role*</label><br>

        <label><input type="checkbox" name="role[]" value="Admin"> Admin</label><br>
        <label><input type="checkbox" name="role[]" value="Manager"> Manager</label><br>
        <label><input type="checkbox" name="role[]" value="Agent"> Sale Agent</label><br>
        <label><input type="checkbox" name="role[]" value="Telecaller"> Telecaller</label><br>
        <label><input type="checkbox" name="role[]" value="Marketing Exec"> Marketing Exec</label><br>
        <label><input type="checkbox" name="role[]" value="CRM Executive"> CRM Executive</label><br>
        <label><input type="checkbox" name="role[]" value="Documentation"> Documentation</label><br>

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