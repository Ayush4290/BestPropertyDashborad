

<style>
   .bussw{min-height:400px;}
</style>
<div class="inner_page_content">
   <div class="container inner_page ">
      <div class="text-center col-sm-12 mt-sm-3 category_list_business">
         <?php if(empty($title)){?>
         <h2 class="text-center">Search Result</h2>
         <?php } else{?>
         <h2 class="text-center"><?php echo $title;?></h2>
         <?php }?>
      </div>
      <div class="product-grid-list bussw col-sm-12 col-md-12">
         <div class="row mt-30">
            <?php if(!empty($properties)){
               foreach ($properties as $property){ 
                              $replace = array("'",","," ",'&','.');
               $replace_with = array("","","-",'','');
               $slug = str_replace($replace,$replace_with,$property->name);
               $slug = strtolower($slug.'-'.$property->id);  					
               ?>
            <div class="col-md-12 product-item inner-page">
               <div class="row">
                  <div class="col-sm-12 col-lg-3 col-md-3">
                     <div class="thumb-content">
                        <div class="gallery js-gallery">
                            <?php if(!empty($property->image_one)){?>
                           <div class="gallery-item">
                              <div class="gallery-img-holder js-gallery-popup">
                                 <img src="<?php echo base_url();?>assets/properties/<?php echo $property->image_one; ?>" alt="" class="gallery-img">
                              </div>
                           </div><?php }?>
                           <?php if(!empty($property->image_two)){?>
                           <div class="gallery-item">
                              <div class="gallery-img-holder js-gallery-popup">
                                 <img src="<?php echo base_url();?>assets/properties/<?php echo $property->image_two; ?>" alt="" class="gallery-img">
                              </div>
                           </div><?php }?>
                           <?php if(!empty($property->image_three)){?>
                           <div class="gallery-item">
                              <div class="gallery-img-holder js-gallery-popup">
                                 <img src="<?php echo base_url();?>assets/properties/<?php echo $property->image_three; ?>" alt="" class="gallery-img">
                              </div>
                           </div>
                           <?php }?>
                            <?php if(!empty($property->image_four)){?>
                           <div class="gallery-item">
                              <div class="gallery-img-holder js-gallery-popup">
                                 <img src="<?php echo base_url();?>assets/properties/<?php echo $property->image_four; ?>" alt="" class="gallery-img">
                              </div>
                           </div>
                           <?php }?>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-12 col-lg-9 col-md-9">
                     <!-- product card -->
                     <div class="card">
                        <div class="card-body searchpage">
                           <h4 class="card-title"><a href="<?php echo base_url().'properties/'.$slug;?>"><?php echo $property->name;?></a></h4>
                           <ul>
                              <!--li id="prop_price55">
                                 <p>Rs 300000 / 3.00 Lac</p>
                              </li-->
                              <li class=" babal">
                                 <p id="prop_bed55" >Built Up Area: <?php echo $property->built;?> (Sq.ft)</p>
                              </li>
                              <li>
                                 <p>Carpet Area: <?php echo $property->carpet;?> (Sq.ft)</p>
                              </li>
                              <?php if($property->land!=0){ ?>
                              <li>
                                 <p><?php echo $property->land;?> (Sq.ft)</p>
                              </li>
                              <?php }?>
              
                           </ul>
                           <p class="property_id" id="prop_id55" >Property Id: <?php echo $property->id;?></p>
                           <a class="nav-link add-button inner-btn" href="<?php echo base_url().'properties/'.$slug;?>">View Details</a>
                           <p class="property_id date">Updated: <?php echo date('d/m/Y', strtotime($property->updated_at));?></p>
                           <!-- Trigger/Open The Modal -->
                           <button class="contact-btn" id="myBtn" data-id="<?php echo $property->id;?>">Contact Us</button>
                           <!-- The Modal -->
                           <div id="myModal<?php echo $property->id;?>" class="modal">
                              <!-- Modal content -->

                              <div class="modal-content">
                                  <span class="close">&times;</span>
                              <div class="row bg-color">
                               <div class="col-md-3">
                            <?php if(!empty($property->image_one)){?>
                                 <img src="<?php echo base_url();?>assets/properties/<?php echo $property->image_one; ?>" alt="" class="gallery-img" style="height:250px;">
                            <?php }?>
                                                    
                               </div>
                               <div class="col-md-9">
                                  <h4 class="card-title model-text"><a href="<?php echo base_url().'properties/'.$slug;?>"><?php echo $property->name;?>, ID: <?php echo $property->id;?> </a></h4> 
                               </div>
                              </div>                                  
                                 
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
                    <input id="form_name" type="text" required name="name" class="form-control" placeholder="Name *">
                    <span class="text-danger"><?php echo form_error('name'); ?></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input id="form_lastname" type="text" name="surname" class="form-control" placeholder="Subject" >
                    <span class="text-danger"><?php echo form_error('surname'); ?></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <input id="form_email" type="email" name="email" class="form-control" placeholder="Email *"  >
                    <span class="text-danger"><?php echo form_error('email'); ?></span>
                </div>
            </div>
            <div class="col-md-6">
                 <div class="form-group">
                    <input id="form_phone" type="text" name="phone" class="form-control" required onkeyup="this.value=this.value.replace(/[^\d]/,'')" maxlength="10" placeholder="Phone *" maxlength="10" >
                    <span class="text-danger"><?php echo form_error('phone'); ?></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="form_message">I am interested in Property ID: <?php echo $property->id;?> </label>
                    <textarea id="form_message" name="message" class="form-control" placeholder="Message" rows="4"></textarea>
                </div>
            </div>
                <div class="col-md-12">
                <div class="g-recaptcha" data-sitekey="6LcmZ6IaAAAAAAVFDvjv2W1P2oAVBKXUcDB7NKiQ"></div>
                <span class="text-danger"><?php echo form_error('emailkkkk'); ?></span>
                <div style="margin-top: 5px;color: red;"><?php echo
                form_error('g-recaptcha-response'); ?></div>
                </div>            
            <div class="submitbtn col-md-12 text-center">
                <input type="submit" name="submit" class="btn btn-success btn-send" value="Send message">
            </div>
            
        </div>
    </div>

</form>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <?php }}else{
               echo '<div class="text-center col-sm-12"><h2 class="text-danger"> Result not found</h2></div>';
               } ?>
         </div>
      </div>
   </div>
</div>
<link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/slick-lightbox/0.2.12/slick-lightbox.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-lightbox/0.2.12/slick-lightbox.min.js"></script>
<script>
   // Get the modal
   var modal = document.getElementById("myModal");
   
   // Get the button that opens the modal
   var btn = document.getElementById("myBtn");
   
   // Get the <span> element that closes the modal
   var span = document.getElementsByClassName("close")[0];
   
   // When the user clicks the button, open the modal 

   jQuery('.contact-btn').click(function(){
       var pid=jQuery(this).data('id');
       var modals = document.getElementById("myModal"+pid);
       modals.style.display = "block";
   });
   // When the user clicks on <span> (x), close the modal
   
jQuery('.close').click(function(){
      jQuery('.modal').css('display','none');
   });
   
   // When the user clicks anywhere outside of the modal, close it
   window.onclick = function(event) {
     if (event.target == modal) {
       modal.style.display = "none";
     }
   }
   $(document).ready(function(){
     $('.js-gallery').slick({
       slidesToShow: 1,
       slidesToScroll: 1,
       prevArrow: '<span class="gallery-arrow mod-prev">Prev</span>',
       nextArrow: '<span class="gallery-arrow mod-next">Next</span>'
     });
     
     $('.js-gallery').slickLightbox({
       src: 'src',
       itemSelector: '.js-gallery-popup img',
       background: 'rgba(0, 0, 0, .7)'
     });
   });
</script>
<style>
   .content
   position: relative
   display: block
   width: 100%
   padding: 20px
   .content-title
   display: block
   margin-bottom: 40px
   font-size: 25px
   line-height: 27px
   font-family: Helvetica, sans-serif
   .gallery
   position: relative
   display: block
   max-width: 500px
   max-height: 300px
   margin: auto
   border-radius: 4px
   overflow: hidden
   .slick-list
   overflow: hidden
   .slick-slide
   outline: none !important
   .gallery-arrow
   position: absolute
   top: 50%
   transform: translateY(-50%)
   width: 40px
   height: 40px
   font-size: 14px
   font-family: Helvetica, sans-serif
   line-height: 40px
   text-align: center
   background-color: #E6E6E6
   z-index: 10
   cursor: pointer
   transition: background .3s ease
   &:hover
   background: #D0DFE6
   &.mod-prev
   left: 0
   border-radius: 0 4px 4px 0
   &.mod-next
   right: 0
   border-radius: 4px 0 0 4px
   .gallery-item
   position: relative
   float: left
   vertical-align: middle
   text-align: center
   .gallery-img-holder
   display: inline-block
   width: auto
   height: auto
   max-width: 500px
   max-height: 500px
   .gallery-img
   width: 100%
   height: 100%
   .slick-lightbox
   .slick-arrow
   z-index: 10
</style>

