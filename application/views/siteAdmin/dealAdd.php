<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="col main pt-5 mt-3">
	<a href="<?php echo base_url('admin/deal/'); ?>" style="float: right;margin: 14px 2px;" class="btn btn-sm btn-info back-btn">Back</a>

	<h1 class="d-sm-block heading"><?php echo $title; ?></h1>
	<?php
	$message = $this->session->flashdata('message');
	if ($message != '') {
		echo '<div class="alert alert-success">' . $message . '</div>';
	}
	$this->session->set_flashdata('message', '');
	echo validation_errors(); ?>

	<div class="clearfix"></div>

	<form class="form" method="post" action="<?php echo base_url('admin/deal/add'); ?>" enctype="multipart/form-data">

		<div class="row" id="">


			<div class="col-sm-6">
				<div class="form-group">
					<label>Title*</label>
					<input type="text" name="title" value="" required class="form-control" placeholder="Title">
				</div>
			</div>
			
			<div class="col-sm-6">
                <div class="form-group">
					<label>Price</label>
					 <input type="number" class="form-control mb-2 mr-sm-2 mb-sm-0" name="price" id="price" placeholder="Price" value="">
				</div>
            </div>

			<div class="col-sm-12">
                <div class="form-group">
					<label>Description</label>
                    <textarea  name="description" row="5" value=""  class="form-control" placeholder="Description"></textarea>			
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