<div class="col main pt-5 mt-3">
    <a href="<?php echo base_url('admin/whatsapp/');?>" style="float: right;margin: 14px 2px;" class="btn btn-sm btn-info back-btn">Back</a>
    <h1 class="d-sm-block heading">Send New Whatsapp Message</h1>

    <?php 
		if($this->session->flashdata('error') != ''){
		    $this->session->set_flashdata('error','');
			echo '<div class="alert alert-danger">';
			echo '<a class="close" data-dismiss="alert">×</a><strong>Error!</strong> '.$this->session->flashdata('error');
			echo '</div>'; 
		}
		if($this->session->flashdata('success') != ''){
		    $this->session->set_flashdata('success','');
			echo '<div class="alert alert-success">';
			echo '<a class="close" data-dismiss="alert">×</a><strong>Done!</strong> '.$this->session->flashdata('success');
			echo '</div>'; 
		}
		echo validation_errors(); 
	?>
	
    <form method="post" action="<?= base_url('admin/whatsapp-new-user') ?>">
        <div class="form-group">
            <label for="name">Name:</label>
            <input class="form-control" type="text" name="name" placeholder="Your Name" required value="<?php if($this->input->post('name')){ echo $this->input->post('name'); } ?>">
        </div>
        <div class="form-group">
            <label for="contact_number">WhatsApp Number:</label>
            <input class="form-control" type="number" name="contact_number" placeholder="Contact Number" required  value="<?php if($this->input->post('contact_number')){ echo $this->input->post('contact_number'); } ?>">
        </div>
        <button class="btn btn-success mt-3" type="submit">Send Welcome Message</button>
    </form>
    <p>&nbsp;</p>
</div>
