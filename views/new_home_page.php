    <section class="hero-area bg-1 text-center overly">
	<!-- Container Start -->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<!-- Header Contetnt -->
				<div class="content-block">
					<h1>Best Properties In Mohali </h1>
					<p>Dreaming to own a dream home in Mohali & Chandigarh - We have it..  </p>
					
					
				</div>
				<!-- Advance Search -->
				<div class="advance-search">
					<form action="http://himachalproperties.co.in/search">
						<div class="row">
							<!-- Store Search -->
							
							<div class="col-lg-6 col-md-12">
								<div class="block d-flex">
									<input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" name="search" id="search" value="" placeholder="search properties">
									<!-- Search Button -->
									<button type="submit" name="search" class="btn btn-main">SEARCH</button>
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
	<!-- View Code -->
<div class="col-sm-12 col-lg-4">
    <h2 style="text-align: center;">PROPERTIES</h2>

    <!-- Display the single property data -->
    <?php if (!empty($property)):
 $property = $property[0];?>
        <div class="product-item bg-light">
            <div class="card">
                <div class="thumb-content">
                    <!-- Dynamic image -->
                    <a href="category/<?php echo $property->name; ?>.html">
                        <img class="card-img-top img-fluid" alt="Card image cap" src="assets/properties/<?php echo $property->image_one; ?>" />
                    </a>
                </div>
                <div class="card-body">
                    <!-- Dynamic property name and address -->
                    <h4 class="card-title"><a href="category/<?php echo $property->name; ?>.html"><?php echo $property->name; ?></a></h4>
                    <p class="card-text"><?php echo $property->address; ?></p>
                    <!-- You can add more fields here if needed -->
                </div>
            </div>
        </div>
    <?php else: ?>
        <p>No property found.</p>
    <?php endif; ?>
</div>


			
<div class="col-sm-12 col-lg-4">
    <h2 style="text-align:center">HOT DEALS</h2>
    <div class="owl-carousel hot-deals-slider">
        <?php if (!empty($propertyhot)): ?>
            <?php foreach ($propertyhot as $property): ?>
                <div class="product-item bg-light">
                    <div class="card">
                        <div class="thumb-content">
                            <a href="category/residential.html">
                                <img class="card-img-top img-fluid" alt="Card image cap" src="/assets/properties/<?php echo $property->image_one; ?>" />
                            </a>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="category/residential.html"><?php echo $property->name; ?></a>
                            </h4>
                            <p><?php echo $property->address; ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hot deals available.</p>
        <?php endif; ?>
    </div>
</div>


					<div class="col-sm-12 col-lg-4">
						<h2 style="text-align: center;">RENT</h2>
						 <div class="owl-carousel rent-deals-slider">
						 <?php if (!empty($propertyrent)): ?>
            <?php foreach ($propertyrent as $propertyren): ?>
				<!-- product card -->
        <div class="product-item bg-light">
     	<div class="card">
  		<div class="thumb-content">
			<!-- <div class="price">$200</div> -->
			<a href="category/land.html">
			              	  <img class="card-img-top img-fluid" alt="Card image cap" src="assets/properties/<?php echo $propertyren->image_one; ?>" />
			  			
			</a>
		</div>
		<div class="card-body">
		    <h4 class="card-title"><a href="category/land.html"><?php echo $propertyren->name; ?> </a></h4>
		    <p>Sector: <?php echo $propertyren->sector; ?></p>
		    <p>Per Month Rent: <?php echo $propertyren->budget; ?></p>
		   
		</div>
	</div>
</div>
 <?php endforeach; ?>
        <?php else: ?>
            <p>No rent available.</p>
        <?php endif; ?>
			</div>
			</div>
				
					
			
		</div>
	</div>
	
	
	
	<section class=" section" id="category_section">
	<!-- Container Start -->
	<div class="container">
	<div class="row">
                <div class="col-12">
                    <!-- Section title -->
                    <div class="section-title">
                        <h2>All Categories</h2>
                        
                    </div>
                    <div class="row">
                        <!-- Category list -->
                        <div class="col-lg-3 offset-lg-0 col-md-5 offset-md-1 col-sm-6 col-6">
                            <div class="category-block">
                                <div class="header">
                                    <i class="fa fa-laptop icon-bg-1"></i> 
                                    <h4>Plot For Sale</h4>
                                </div>
                                <ul class="category-list" style="text-align: center;">
                                    <li><a href="/contact-us">Chandigarh </a></li>
                                    <li><a href="/contact-us">Mohali </a></li>
                                    <li><a href="/contact-us">Kharar  </a></li>
                                    <li><a href="/contact-us">Zirakpur </a></li>
                                </ul>
                            </div>
                        </div> <!-- /Category List -->
                        <!-- Category list -->
                        <div class="col-lg-3 offset-lg-0 col-md-5 offset-md-1 col-sm-6 col-6">
                            <div class="category-block">
                                <div class="header">
                                    <i class="fa fa-home icon-bg-3"></i> 
                                    <h4>Built Up Home</h4>
                                </div>
                               <ul class="category-list" style="text-align: center;">
                                    <li><a href="/contact-us">Chandigarh </a></li>
                                    <li><a href="/contact-us">Mohali </a></li>
                                    <li><a href="/contact-us">Kharar  </a></li>
                                    <li><a href="/contact-us">Zirakpur </a></li>
                                </ul>
                            </div>
                        </div> <!-- /Category List -->
                        <!-- Category list -->
                        <div class="col-lg-3 offset-lg-0 col-md-5 offset-md-1 col-sm-6 col-6">
                            <div class="category-block">
                                <div class="header">
                                    <i class="fa fa-home icon-bg-3"></i> 
                                    <h4>Agriculture Land</h4>
                                </div>
                               <ul class="category-list" style="text-align: center;">
                                    <li><a href="/contact-us">Chandigarh </a></li>
                                    <li><a href="/contact-us">Mohali </a></li>
                                    <li><a href="/contact-us">Kharar  </a></li>
                                    <li><a href="/contact-us">Zirakpur </a></li>
                                </ul>
                            </div>
                        </div> <!-- /Category List -->
                        <!-- Category list -->
                        <div class="col-lg-3 offset-lg-0 col-md-5 offset-md-1 col-sm-6 col-6">
                            <div class="category-block">
                                <div class="header">
                                    <i class="fa fa-shopping-basket icon-bg-4"></i> 
                                    <h4>Commercial</h4>
                                </div>
                                 <ul class="category-list" style="text-align: center;">
                                    <li><a href="/contact-us">Chandigarh </a></li>
                                    <li><a href="/contact-us">Mohali </a></li>
                                    <li><a href="/contact-us">Kharar  </a></li>
                                    <li><a href="/contact-us">Zirakpur </a></li>
                                </ul>
                            </div>
                        </div> <!-- /Category List -->
                        <!-- Category list -->
                        <div class="col-lg-3 offset-lg-0 col-md-5 offset-md-1 col-sm-6 col-6">
                            <div class="category-block">
                                <div class="header">
                                    <i class="fa fa-briefcase icon-bg-5"></i> 
                                    <h4>Industrial</h4>
                                </div>
                                 <ul class="category-list" style="text-align: center;">
                                    <li><a href="/contact-us">Chandigarh </a></li>
                                    <li><a href="/contact-us">Mohali </a></li>
                                    <li><a href="/contact-us">Kharar  </a></li>
                                    <li><a href="/contact-us">Zirakpur </a></li>
                                </ul>
                            </div>
                        </div> <!-- /Category List -->
                        <!-- Category list -->
                        <div class="col-lg-3 offset-lg-0 col-md-5 offset-md-1 col-sm-6 col-6">
                            <div class="category-block">
                                <div class="header">
                                    <i class="fa fa-car icon-bg-6"></i> 
                                    <h4>Project / Organization </h4>
                                </div>
                                <ul class="category-list" style="text-align: center;">
                                    <li><a href="/contact-us">Chandigarh </a></li>
                                    <li><a href="/contact-us">Mohali </a></li>
                                    <li><a href="/contact-us">Kharar  </a></li>
                                    <li><a href="/contact-us">Zirakpur </a></li>
                                </ul>
                            </div>
                        </div> <!-- /Category List -->
                        <!-- Category list -->
                        <div class="col-lg-3 offset-lg-0 col-md-5 offset-md-1 col-sm-6 col-6">
                            <div class="category-block">
                                <div class="header">
                                    <i class="fa fa-home icon-bg-3"></i> 
                                    <h4>Shop / Hotel</h4>
                                </div>
                                <ul class="category-list" style="text-align: center;">
                                    <li><a href="/contact-us">Chandigarh </a></li>
                                    <li><a href="/contact-us">Mohali </a></li>
                                    <li><a href="/contact-us">Kharar  </a></li>
                                    <li><a href="/contact-us">Zirakpur </a></li>
                                </ul>
                            </div>
                        </div> <!-- /Category List -->
                        <!-- Category list -->
                        <div class="col-lg-3 offset-lg-0 col-md-5 offset-md-1 col-sm-6 col-6">
                            <div class="category-block">
                                <div class="header">
                                    <i class="fa fa-laptop icon-bg-8"></i> 
                                    <h4>Misc</h4>
                                </div>
                                <ul class="category-list" style="text-align: center;">
                                    <li><a href="/contact-us">Chandigarh </a></li>
                                    <li><a href="/contact-us">Mohali </a></li>
                                    <li><a href="/contact-us">Kharar  </a></li>
                                    <li><a href="/contact-us">Zirakpur </a></li>
                                </ul>
                            </div>
                        </div> <!-- /Category List -->
                        
                        
                    </div>
                </div>
            </div>

	
	<div class="contact_btn">
	    <div class="container"> 
	    <h3> For More Information Please 
	    <a class="btn btn-primary" href="contact.html">Contact Us</a>
	    or call us <a href="tel:9816716143">+91-8360979762</a></h3> </div> 
	</div>
	
	
</section>



<!--==========================================
=            All Category Section            =
===========================================-->

<section>
    <h1 class="services-heading">Our Services</h1>
    <div class="container">
        <div class="row mt-5">
            <!-- Residential -->
            <div class="col-sm-12 col-lg-4">
                <div class="service-box">
                    <div class="owl-carousel servicesimg-deals-slider">
                        <?php foreach ($residential_images as $image): ?>
                            <img src="https://bestpropertiesmohali.com/assets/properties/<?php echo $image->image_one; ?>" width="100%" height="250px">
                        <?php endforeach; ?>
                    </div>
                    <div class="service-text">Residential</div>
                </div>
            </div>

            <!-- Office Space -->
            <div class="col-sm-12 col-lg-4">
                <div class="service-box">
                    <div class="owl-carousel servicesimg-deals-slider">
                        <?php foreach ($office_space_images as $image): ?>
                            <img src="https://bestpropertiesmohali.com/assets/properties/<?php echo $image->image_one; ?>" width="100%" height="250px">
                        <?php endforeach; ?>
                    </div>
                    <div class="service-text">Office Space</div>
                </div>
            </div>

            <!-- Flats and Plots -->
            <div class="col-sm-12 col-lg-4">
                <div class="service-box">
                    <div class="owl-carousel servicesimg-deals-slider">
                        <?php foreach ($flats_and_plots_images as $image): ?>
                            <img src="https://bestpropertiesmohali.com/assets/properties/<?php echo $image->image_one; ?>" width="100%" height="250px">
                        <?php endforeach; ?>
                    </div>
                    <div class="service-text">Flats and Plots</div>
                </div>
            </div>
        </div>
    </div>
</section>



<section class="bottom-section mt-5" >
	<div class="container">
		<h1 class="bottom-heading" style="text-align: center;">Searching for Dream Home?</h1>
	<center><button class="button">Contact us</button>
	</div>
</section>

<script>
$(document).ready(function () {
    $(".hot-deals-slider").owlCarousel({
        loop: true,             // Infinite loop
        margin: 10,             // Gap between slides
        nav: false,             // Next/Prev buttons hide
        autoplay: true,         // Auto scroll enable
        autoplayTimeout: 3000,  // Delay time (3 sec)
        autoplaySpeed: 1000,    // Speed of transition
        autoplayHoverPause: false, // Mouse hover pe bhi na ruke
        items: 1,               // One slide at a time
        slideTransition: 'linear', // Smooth continuous transition
        autoplaySpeed: 1500,    // Speed of movement
        smartSpeed: 2000,       // Speed for smart animation
    });
});
</script>

<script>
$(document).ready(function () {
    $(".rent-deals-slider").owlCarousel({
        loop: true,             // Infinite loop
        margin: 10,             // Gap between slides
        nav: false,             // Next/Prev buttons hide
        autoplay: true,         // Auto scroll enable
        autoplayTimeout: 4000,  // Delay time (3 sec)
        autoplaySpeed: 1500,    // Speed of transition
        autoplayHoverPause: false, // Mouse hover pe bhi na ruke
        items: 1,               // One slide at a time
        slideTransition: 'linear', // Smooth continuous transition
        autoplaySpeed: 3000,    // Speed of movement
        smartSpeed: 2000,       // Speed for smart animation
    });
});
</script>

<script>
$(document).ready(function () {
    $(".servicesimg-deals-slider").owlCarousel({
        loop: true,             // Infinite loop
        margin: 10,             // Gap between slides
        nav: false,             // Next/Prev buttons hide
        autoplay: true,         // Auto scroll enable
        autoplayTimeout: 4000,  // Delay time (3 sec)
        autoplaySpeed: 1500,    // Speed of transition
        autoplayHoverPause: false, // Mouse hover pe bhi na ruke
        items: 1,               // One slide at a time
        slideTransition: 'linear', // Smooth continuous transition
        autoplaySpeed: 1500,    // Speed of movement
        smartSpeed: 2000,       // Speed for smart animation
    });
});
</script>
