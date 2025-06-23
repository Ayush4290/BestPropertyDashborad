

<!--===============================
=            Hero Area            =
================================-->

<section class="hero-area bg-1 text-center overly">
	<!-- Container Start -->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<!-- Header Contetnt -->
				<div class="content-block">
					<h1>RENT PROPERTIES</h1>

					
				</div>
				<!-- Advance Search -->
				<div class="advance-search">
					<form action="<?php echo base_url('search');?>" method="post">
						<div class="row">
							<!-- Store Search -->
							
							<div class="col-lg-6 col-md-12">
								<div class="block d-flex">
								    <div class="row">
								    <div class="col-md-2">
								    <label>I Want to</label>    
                    					<select name="property_for" class="form-control" required>
                                            <option value="Buy">Buy</option>
                                            <option value="Rent">Rent</option>
                    					</select>
					                </div>    
								    <div class="col-md-2">
								        <label>Property Type</label>  
                    					<select name="type" class="form-control">
                    						<option value="">Any</option>
                                    		<option value="Industrial Property">Industrial Property</option>
                                    		<option value="Factory">Factory</option>
                                    		<option value="Residential Property">Residential Property</option>
                                    		<option value="Bungalows / Villas">Bungalows / Villas</option>
                                    		<option value="Flats & Apartments">Flats & Apartments</option>
                                    		<option value="Residential - Others">Residential - Others</option>
                                    		<option value="Individual House/Home">Individual House/Home</option>
                                    		<option value="Residential Land / Plot">Residential Land / Plot</option>
                                    		<option value="Commercial Property">Commercial Property</option>
                                    		<option value="Commercial Shops">Commercial Shops</option>
                                    		<option value="Commercial Lands & Plots">Commercial Lands & Plots</option>
                                    		<option value="Hotel & Restaurant">Hotel & Restaurant</option>		
                    
                    					</select>								    
                    					</div>  
								    <div class="col-md-2">
								        <label>City</label>  
									<input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" name="city" id="city" value="<?php print_r($city);?>" placeholder="city">
								    </div>  
								    <div class="col-md-2">
								        <label>Locality</label>  
									<input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" name="locality" id="locality" value="<?php print_r($city);?>" placeholder="locality">
								    </div>  
								    <div class="col-md-2">
								        <label>Budget</label>  
								        <div class="row">
								        <div class="col-md-6">
									<input type="number" class="form-control mb-2 mr-sm-2 mb-sm-0" name="budgetmin" id="budget" value="<?php print_r($city);?>" placeholder="Min (Lacs)">
								    
								    </div>
								        <div class="col-md-6">
									<input type="number" class="form-control mb-2 mr-sm-2 mb-sm-0" name="budgetmax" id="budget" value="<?php print_r($city);?>" placeholder="Max (Lacs)">
								    </div>								    
								    </div>
								    </div>  
								    <div class="col-md-2">
								         <label></label>  
									<input type="submit" name="search" class="btn btn-main" value="SEARCH">
								    </div>  								    
								    </div>
									<!-- Search Button -->
								</div>
							</div>
						</div>
					</form>
					
				</div>
				
			</div>
		</div>
	</div>
	<!-- Container End -->
</section>

<!--===================================
=            Client Slider            =
====================================-->


<!--===========================================
=            Popular deals section            =
============================================-->

<section class="popular-deals section bg-gray" id="property_section">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="section-title">
					<h2>PROPERTIES</h2>
					<p>Buy Your Choice Proprites Near By Any Famour or Peaceful Location.</p>
				</div>
			</div>
		</div>
		<div class="row">
			<!-- offer 01 -->
			
                       <?php

                  if(!empty($properties)){
                      $i=1;
                  foreach($properties as $key)
                  {
                     $replace = array("'",","," ",'&','.');
    $replace_with = array("","","-",'','');
    $slug = str_replace($replace,$replace_with,$key->name);
    $slug = strtolower($slug.'-'.$key->id);    
                    ?>
			<div class="col-sm-12 col-lg-4">
				<!-- product card -->
<div class="product-item bg-light">
	<div class="card">
		<div class="thumb-content">
			<!-- <div class="price">$200</div> -->
			<a href="<?php echo base_url().'properties/'.$slug;?>">
			    <?php if(!empty($key->image_one)){?>
            <img class="card-img-top img-fluid" style="height:200px;" alt="Card image cap" src="<?php echo base_url().'assets/properties/'.$key->image_one;?>"   
			 />
			  <?php } else {?>
			  <img class="card-img-top img-fluid" style="height:200px;" alt="Card image cap" src="<?php echo base_url().'assets/images/no-image.jpg'?>"   
			 />
			  <?php } ?>
			
			</a>
		</div>
		<div class="card-body">
		    <h4 class="card-title"><a href="<?php echo base_url().'properties/'.$slug;?>"><?php echo $key->name;?></a></h4>
		    <!--p>Price : Call for Price</p-->
		    <p>Built Up Area: <?php echo $key->built;?>	(Sq.ft)</p>
		    <p>Carpet Area: <?php echo $key->carpet;?>	(Sq.ft)</p>
		    <a class="nav-link add-button" href="<?php echo base_url().'properties/'.$slug;?>">Read more</a>
		</div>
	</div>
</div>



			</div>
		<?php }}?>
			
			
		</div>
	</div>
	
	
	
</section>

