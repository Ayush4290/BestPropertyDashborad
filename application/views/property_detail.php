<style>
.donate_organ .btn{padding: .375rem .75rem;}
     
</style>
<div class="container inner_page_content detail-page-created">
	<?php if($properties){
        foreach ($properties as $property) {
        	# code...
		?>
		<h2 class="heading_main text-center"><?php echo $property->name ;?></h2>
    <div class="row result_deatils_sections">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="well well-sm result_detail_comp">
                <div class="row">
                       <div class="col-sm-12 col-md-12 col-xs-12 result_image_main">
                          
    <div class="row">
       
            <div id="custCarousel" class="carousel slide" data-ride="carousel" align="center">
                <!-- slides -->
                <div class="carousel-inner">
                    <?php if(!empty($property->image_one)){?>
                    <div class="carousel-item active"> <img src="<?php echo base_url();?>assets/properties/<?php echo $property->image_one; ?>" alt="Hills"> </div>
                    <?php } if(!empty($property->image_two)){?>
                    <div class="carousel-item"> <img src="<?php echo base_url();?>assets/properties/<?php echo $property->image_two; ?>" alt="Hills"> </div>
                    <?php } if(!empty($property->image_three)){ ?>
                    <div class="carousel-item"> <img src="<?php echo base_url();?>assets/properties/<?php echo $property->image_three; ?>" alt="Hills"> </div>
                    <?php } if(!empty($property->image_four)){ ?>
                    <div class="carousel-item"> <img src="<?php echo base_url();?>assets/properties/<?php echo $property->image_four; ?>" alt="Hills"> </div>
                    <?php }?>
                </div> <!-- Left right --> <a class="carousel-control-prev" href="#custCarousel" data-slide="prev"> <span class="carousel-control-prev-icon"></span> </a> <a class="carousel-control-next" href="#custCarousel" data-slide="next"> <span class="carousel-control-next-icon"></span> </a> <!-- Thumbnails -->
                <ol class="carousel-indicators list-inline">
                    <?php if(!empty($property->image_one)){?>
                    <li class="list-inline-item active"> <a id="carousel-selector-0" class="selected" data-slide-to="0" data-target="#custCarousel"> <img src="<?php echo base_url();?>assets/properties/<?php echo $property->image_one; ?>" class="img-fluid"> </a> </li>
                    <?php } if(!empty($property->image_two)){?>
                    <li class="list-inline-item"> <a id="carousel-selector-1" data-slide-to="1" data-target="#custCarousel"> <img src="<?php echo base_url();?>assets/properties/<?php echo $property->image_two;?>" class="img-fluid"> </a> </li>
                    <?php } if(!empty($property->image_three)){ ?>
                    <li class="list-inline-item"> <a id="carousel-selector-2" data-slide-to="2" data-target="#custCarousel"> <img src="<?php echo base_url();?>assets/properties/<?php echo $property->image_three;?>" class="img-fluid"> </a> </li>
                    <?php } if(!empty($property->image_four)){ ?>
                    <li class="list-inline-item"> <a id="carousel-selector-2" data-slide-to="3" data-target="#custCarousel"> <img src="<?php echo base_url();?>assets/properties/<?php echo $property->image_four;?>" class="img-fluid"> </a> </li>
                    <?php }?>
                </ol>
            </div>
        
    </div>

                    </div>
                                        
                   <div class="col-xs-12 col-sm-12 col-md-12 detail-address-gallery">
                                           <h3>Property Address</h3>
                     
                         <div class="property-address-content"><span><?php echo $property->address;?></span></div>  
                             
                   <h4>Additional Details</h4>
                   <table>
                   <tbody>
                   <tr>
                   <td>
                   <table>
                       <tbody>
                       <tr>
                       <td><b>Property ID</b>:</td>
                       <td><?php echo $property->id;?></td>
                       </tr>
                       
                       <tr>
                       <td><b>Property For </b>:</td>
                       <td><?php echo $property->property_for;?></td>
                       </tr>
                       <?php if($property->built!=0){?>
                       
                       
                       <tr>
                       <td><b>Built Up Area</b>: </td>
                       <td>
                       <span><?php echo $property->built;?> (Sq.ft)</span>
                       </td>
                       </tr>
                       <?php }?>
                       <?php if($property->land!=0){ ?>
                       
                       
                       <tr>
                       <td><b>Land / Plot Area</b>: </td>
                       <td>
                       <span><?php echo $property->land;?> (Sq.ft)</span>
                       </td>
                       </tr>
                       <?php }?>
                       <?php if($property->carpet!=0){ ?>
                       
                       
                       <tr>
                       <td><b>Carpet Area</b>: </td>
                       <td>
                       <span><?php echo $property->carpet;?> (Sq.ft)</span>
                       </td>
                       </tr>
                       <?php }?>
                       
                   <?php if(!empty($property->additional)){
                   $addition=explode('~~--~~',$property->additional); $custom_value=explode('~~--~~',$property->additional_value);?>

                   
                      <?php foreach($addition as $key=>$addit) {?>
                     <tr>
                      <td><b><?php echo $addit;?>: </td>                         
					  <td>
                       <span><?php echo $custom_value[$key];?></span> 
					   </td> 
</tr>					   
                       <?php }?>
                       
                   <?php }?>

                       </tbody></table>
                        </td>
                       </tr>
                   </tbody></table>
                   </div>
                 
                   <div class="col-sm-12 col-md-12 col-xs-12 result_image_main ">
                       <p><?php echo $property->description; ?></p>
                       </div>  
                       


                   <?php if(!empty($property->amenities)){
                   $amenities=explode('~-~',$property->amenities);?>

                    <div class="col-sm-12 col-md-12 col-xs-12 amenities-deatils-setting">
					   <h3>Amenities</h3>
					   <ul>
					   <?php foreach($amenities as $amenity) {?>
					   
					   <li><?php echo $amenity;?></li> 
					   
                        <?php }?>
                        </ul>
                    </div>
                    <?php }?>
                        <!--div class="col-sm-12 col-md-12 col-xs-12">
                            <h3>Location Map</h3>
                            <?php $state=$property->state; $city=$property->city;
                               $address=$state.'+'.$city;
                              // echo $address;
                               $replace = array(" ");
                               $replace_with = array("+");
                               $slug = str_replace($replace,$replace_with,$address);
                            ?>
                            <a target="_blank" class="btn btn-sm btn-primary" href="https://www.google.co.in/maps/place/<?php echo $address;?>">map</a>
                        </div-->
                    <!--div class="col-sm-12 col-md-12">
					<h3>Property Seller Detail</h3>
					<table>
					<tbody>
					<tr>
					<td>
					<table>
						<tbody>
						<tr>
						<td><b>Contact Person</b>:</td>
						<td><?php echo $property->person;?></td>
						</tr>
						<tr><td colspan="3"><p class="hr"></p></td></tr>
						<tr>
						<td><b>Mobile </b>:</td>
						<td><?php echo $property->phone;?></td>
						</tr>
						<tr><td colspan="3"><p class="hr"></p></td></tr>
						
						<tr>
						<td><b>Contact Address</b>: </td>
						
						<td>
						<span><?php echo $property->person_address;?></span>
						</td>
						</tr>
					
						
						<tr><td colspan="3"><p class="hr"></p></td></tr>
						</tbody></table>
					     </td>
						</tr>
					</tbody></table>
					</div-->                        
                </div>
            </div>
            <div class="property-details-show">
                <h4>Property Description</h4>
                <h6>

Ready to Move, 2BHK and 3BHK is available for sale. It has a covered Parking, Elevator and Gated Society, opposite CGC College and upcoming Medi-City. Power Back Up, Lift, Rain Water Harvesting, Club House, Park, Reserved Parking, Security, Water Storage, Vaastu Compliant, Visitor Parking, Maintenance Staff, Piped Gas, Jogging and Strolling Track and Other Amenities - 5 minutes drive from Quark City - 3 minutes drive from Judicial Court - 4 minutes drive from Sohana Hospital - Loan Facility Available from all banks - Limited Flats, Families are already moved, Please contact for more details.
</h6>
                <h4>Overview</h4>
                <ul>
                    <li>Property Type <span class="float-right">Kothi</span></li>
                    <li>Bedrooms <span class="float-right">4</span></li>
                    <li>Floor <span class="float-right">0, 1</span></li>
                    <li>Living Room <span class="float-right">1</span></li>
                 </ul>
                 <h4>Kitchen</h4>
                <p>Old Kitchen <span class="float-right">1</span></p>
                 </ul>
                 <h4>Amenities</h4>
                <p>Car parking</p>
                <p>Water supply</p>
            </div>
        </div>
        <!-- div class="col-xs-12 col-sm-12 col-md-4">
            <div class="well well-sm result_detail_comp">
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
            
            <div class="col-md-12">
                <div class="form-group">
                    <label for="form_name"></label>
                    <input id="form_name" type="text" name="name" required class="form-control" placeholder="Your Name">
                    <span class="text-danger"><?php echo form_error('name'); ?></span>
                </div>
            </div>
 
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="form_email"></label>
                    <input id="form_email" type="email" required name="email" class="form-control" placeholder="Email"  >
                    <span class="text-danger"><?php echo form_error('email'); ?></span>
                </div>
            </div>
            <div class="col-md-12">
                 <div class="form-group">
                    <label for="form_phone"></label>
                    <input id="form_phone" type="text" required name="phone" class="form-control" onkeyup="this.value=this.value.replace(/[^\d]/,'')" maxlength="10" placeholder="Phone" maxlength="10" >
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
            </div -->
    </div>
<?php } } else{?>
<h4> No Result found</h4>
<?php } ?>

			</div>
			<script>
			    var index = 0;
var slides = document.querySelectorAll(".slides");
var dot = document.querySelectorAll(".dot");

function changeSlide(){

  if(index<0){
    index = slides.length-1;
  }
  
  if(index>slides.length-1){
    index = 0;
  }
  
  for(let i=0;i<slides.length;i++){
    slides[i].style.display = "none";
    dot[i].classList.remove("active");
  }
  
  slides[index].style.display= "block";
  dot[index].classList.add("active");
  
  index++;
  
  setTimeout(changeSlide,2000);
  
}

changeSlide();
			</script>
