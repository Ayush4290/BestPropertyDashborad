<div class="container">
    <div class="clearfix"></div>
    <div class="content inner_page_content contact_page_content">
         <h2 class="text-center">Contact Us</h2>
        


        <div class="row">
                 <div class="col-md-3 col-lg-3">
                </div>
            <div class="col-md-6 col-lg-6 form_content_page">
                <p>Get in touch and we’ll get back to you as soon as we can.  We look forward to hearing from you!</p> 
                  <?php if($this->session->flashdata('msg')){ ?>
        <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong></strong> <?php echo $this->session->flashdata('msg'); ?>
        </div>

    <?php } ?>
                <form id="contact-form" method="post" action="" role="form">
                
    <div class="controls">
        <div class="row">
            
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_name"></label>
                    <input id="form_name" type="text" name="name" class="form-control" placeholder="Your Name">
                    <span class="text-danger"><?php echo form_error('name'); ?></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_lastname"></label>
                    <input id="form_lastname" type="text" name="surname" class="form-control" placeholder="Subject" >
                    <span class="text-danger"><?php echo form_error('surname'); ?></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_email"></label>
                    <input id="form_email" type="email" name="email" class="form-control" placeholder="Email"  >
                    <span class="text-danger"><?php echo form_error('email'); ?></span>
                </div>
            </div>
            <div class="col-md-6">
                 <div class="form-group">
                    <label for="form_phone"></label>
                    <input id="form_phone" type="text" name="phone" class="form-control" onkeyup="this.value=this.value.replace(/[^\d]/,'')" maxlength="10" placeholder="Phone" maxlength="10" >
                    <span class="text-danger"><?php echo form_error('phone'); ?></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="form_message"></label>
                    <textarea id="form_message" name="message" class="form-control" placeholder="Message" rows="4"></textarea>
                </div>
            </div>
                <div class="col-md-6">
                <div class="g-recaptcha" data-sitekey="6LcmZ6IaAAAAAAVFDvjv2W1P2oAVBKXUcDB7NKiQ"></div>
                <span class="text-danger"><?php echo form_error('emailkkkk'); ?></span>
                <div style="margin-top: 5px;color: red;"><?php echo
                form_error('g-recaptcha-response'); ?></div>
                </div>            
            <div class="col-md-12">
                <input type="submit" name="submit" class="btn btn-success btn-send" value="Send message">
            </div>
            
        </div>
    </div>

</form>
                </div>
                <div class="col-md-3 col-lg-3">
                </div>

 <?php
/* <div class="col-md-6 col-lg-6 mapside">
// <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d109782.86712310296!2d76.62733979581444!3d30.698305207263022!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390fee906da6f81f%3A0x512998f16ce508d8!2sSahibzada%20Ajit%20Singh%20Nagar%2C%20Punjab!5e0!3m2!1sen!2sin!4v1617368450085!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
*/ </div>
?>

            </div>
        </div>
    </div>
