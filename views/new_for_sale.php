<div class="container mt-4">
    <h2 class="property-header">PROPERTIES FOR RENT</h2>
    <div class="row mb-4">
      <!-- Search Section -->
      <div class="col-md-2">
        <input type="text" class="form-control" placeholder="Search..." style="border-style: solid; border-color: green; border-radius: 0;">
      </div>
      <div class="col-md-3">
        <select class="form-select" style="border-style: solid; border-color: green; border-radius: 0%;">
          <option selected>Select Property</option>
          <option>1BHK</option>
          <option>2BHK</option>
          <option>3BHK</option>
          <option>1 Room Only</option>
          <option>1 Room With Kitchen</option>
          <option>2 Rooms Only</option>
         </select>
      </div>
      <div class="col-md-3">
        <select class="form-select" style="border-style: solid; border-color: green; border-radius: 0%;">
          <option selected>Sort By:</option>
          <option>Low to High</option>
          <option>High to Low</option>
        </select>
      </div>
      <div class="col-md-3">
        <select class="form-select" style="border-style: solid; border-color: green; border-radius: 0%;">
            <option selected>Mohali</option>
          <option>Zirakpur</option>
          <option>Kharar</option>
          <option>Chandigarh</option>
        </select>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <div class="container mt-4">
   
    <div class="row">
      <!-- Sidebar -->
      <div class=" card col-md-2 pt-4">
        <div class="mb-3">
          <button class="btn btn-danger w-100">Buy</button>
        </div>
        <div class="  p-3 mb-3" style="border-style: solid; border-width: 1px;">
          <h5 class="sidebar-heading">Select Property</h5>
          <input type="range" id="priceRange" class="filter-price-range" min="100000" max="100000000" step="50000" value="100000">
          <span id="rangeValue" class="filter-price-range-value">1,00,000</span>
        </div>
        <div class=" p-3 mb-3">
          <h5>Property Type</h5>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="industrialProperty">
            <label class="form-check-label" for="industrialProperty">1 BHK</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="factoryProperty">
            <label class="form-check-label" for="factoryProperty">2 BHK</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="residentialProperty">
            <label class="form-check-label" for="residentialProperty">3 BHK</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="residentialProperty">
            <label class="form-check-label" for="residentialProperty">1 Room Only</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="residentialProperty">
            <label class="form-check-label" for="residentialProperty">1 Room with Kitchen</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="residentialProperty">
            <label class="form-check-label" for="residentialProperty">2 Rooms Only</label>
          </div>

          <h5>Amenities</h5>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="residentialProperty">
            <label class="form-check-label" for="residentialProperty">Car parking</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="residentialProperty">
            <label class="form-check-label" for="residentialProperty">Restaurants</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="residentialProperty">
            <label class="form-check-label" for="residentialProperty">Swimming pool</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="residentialProperty">
            <label class="form-check-label" for="residentialProperty">Security services</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="residentialProperty">
            <label class="form-check-label" for="residentialProperty">Water supply</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="residentialProperty">
            <label class="form-check-label" for="residentialProperty">Party hall</label>
          </div>

           <!-- Add more checkboxes as needed -->
        </div>
      </div>
      <!-- Main Content -->
      <div class="col-md-9">
        <div class="row">
          <!-- Card 1 -->
          <div class="col-md-4 mb-4">
            <div class="card">
              <img src="assets/properties/2024021512153981.jpg" class="card-img-top" alt="Property Image">
              <div class="card-body">
                <h5 class="card-title">Furnished</h5>
                <p class="card-text">
                  <i class="fa-solid fa-indian-rupee-sign fa-lg" style="color: #25511f;"></i>14K
                  || Sector: 68<br>
                  <i class="fa-solid fa-location-dot fa-xl" style="color: #27511f;"></i> 68 <br> 1 BHK 
                </p>
              </div>
            </div>
          </div>
          <!-- Card 2 -->
          <div class="col-md-4 mb-4">
            <div class="card">
              <img src="assets/properties/2024021513033351.jpg" class="card-img-top" alt="Property Image">
              <div class="card-body">
                <h5 class="card-title">Furnished</h5>
                <p class="card-text">
                  <i class="fa-solid fa-indian-rupee-sign fa-lg" style="color: #25511f;"></i> 22K
                  || Sector: 68<br>
                  <i class="fa-solid fa-location-dot fa-xl" style="color: #27511f;"></i></i> 68<br> 2 BHK
                </p>
                <i class="fa-solid fa-shower fa-lg" style="color: #00d5ff;"></i> 2
              </div>
            </div>
          </div>
          <!-- Card 3 -->
   <div class="col-md-4 mb-4">
            <div class="card">
              <img src="assets/properties/2024021513114059.jpg" class="card-img-top" alt="Property Image">
              <div class="card-body">
                <h5 class="card-title">un-Furnished</h5>
                <p class="card-text">
                  <i class="fa-solid fa-indian-rupee-sign fa-lg" style="color: #25511f;"></i>25K
                  ||Sector: 68<br>
                  <i class="fa-solid fa-location-dot fa-xl" style="color: #27511f;"></i> 68<br> 3 BHK
                </p>
                <i class="fa-solid fa-shower fa-lg" style="color: #00d5ff;"></i> 2
              </div>
            </div>
          </div>
          <!-- Card 4 -->
     <div class="col-md-4 mb-4">
            <div class="card">
              <img src="assets/properties/2024021513210338.jpg" class="card-img-top" alt="Property Image">
              <div class="card-body">
                <h5 class="card-title">Semi-Furnished</h5>
                <p class="card-text">
                  <i class="fa-solid fa-indian-rupee-sign fa-lg" style="color: #25511f;"></i>22K
                  ||Sector: 79<br>
                  <i class="fa-solid fa-location-dot fa-xl" style="color: #27511f;"></i> 79 <br>2 BHK
                </p>
                <i class="fa-solid fa-shower fa-lg" style="color: #00d5ff;"></i> 2
              </div>
            </div>
          </div>
          <!-- Card 5 -->
     <div class="col-md-4 mb-4">
            <div class="card">
              <img src="assets/properties/2024021513262326.jpg" class="card-img-top" alt="Property Image">
              <div class="card-body">
                <h5 class="card-title">un-Furnished</h5>
                <p class="card-text">
                  <i class="fa-solid fa-indian-rupee-sign fa-lg" style="color: #25511f;"></i> 18K
                  ||
                  Sector: 80<br>
                  <i class="fa-solid fa-location-dot fa-xl" style="color: #27511f;"></i> 80 <br> 3 BHK
                </p>
                <i class="fa-solid fa-shower fa-lg" style="color: #00d5ff;"></i> 2
              </div>
            </div>
          </div>
          <!-- card 6 -->
     <div class="col-md-4 mb-4">
            <div class="card">
              <img src="assets/properties/2024021513344785.jpg" class="card-img-top" alt="Property Image">
              <div class="card-body">
                <h5 class="card-title">un-Furnished</h5>
                <p class="card-text">
                  <i class="fa-solid fa-indian-rupee-sign fa-lg" style="color: #25511f;"></i> 22K
                  ||
                  Sector: 70<br>
                  <i class="fa-solid fa-location-dot fa-xl" style="color: #27511f;"></i> 79 <br> 2 BHK
                </p>
                <i class="fa-solid fa-shower fa-lg" style="color: #00d5ff;"></i> 1
              </div>
            </div>
          </div>
          
          
          
          <!-- Add more cards as needed -->
        </div>
      </div>
    </div>
  </div>

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
  
  <section class="bottom-section mt-5 pb-5" >
    <div class="container">
      <h1 class="title-end-note" style="text-align: center;">Searching for Dream Home?</h1>
    <center><button class="btn-talk-to-us">Contact us</button>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
jQuery(document).ready(function(){
    jQuery(".filter-price-range").on("input", function() {
        let rangeValue = jQuery(this).val();
        let formattedValue = new Intl.NumberFormat('en-IN').format(rangeValue);
        
        jQuery(".filter-price-range-value").text(formattedValue);

        jQuery.ajax({
            url: "<?php echo base_url('for-sale'); ?>",
            type: "POST",
            data: { range: rangeValue },
            headers: { "X-Requested-With": "XMLHttpRequest" },
            success: function(response) {
                console.log("Server response:", response);
            },
            error: function() {
                console.log("Error in AJAX request");
            }
        });
    });
});
</script>