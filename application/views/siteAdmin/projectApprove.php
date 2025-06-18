 <div class="col main pt-5 mt-3">
       
            <a href="<?php echo base_url('admin/projects/');?>" style="float: right;margin: 14px 2px;" class="btn btn-sm btn-info back-btn">Back</a>
            
            <h1 class="d-sm-block heading"><?php echo $title; ?></h1>
            <div class="clearfix"></div>
           <?php
      $info = $Properties_Projects[0];
	  $message = $this->session->flashdata('message');
	  if($message != ''){
	      echo '<div class="alert alert-success">'.$message.'</div>';
		  // Clear flash data after displaying it once
			$this->session->set_flashdata('message', '');
	  }
	  echo validation_errors(); ?>    
            <div class="clearfix"></div>
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
		              <table class="table table-striped">
                         <thead>
						    <tr>
							   <th>Sr. No.</th>
							  <!-- <th>Property ID</th>-->
							   <th>Project Name</th>
							   <th>Addresss</th>
							   <th>Bankers</th>
							  <!-- <th>Built Up Area</th>-->
							  
							   <th>Approvel</th>
							  
							</tr>
						 </thead>
						  <tbody>
						      <?php 
						      if(!empty($Properties_Projects)) {
						          $i = 1;
						          foreach($Properties_Projects as $project){?>
						          <tr>
						                <td><?php echo $i;?></td>
						              <!--  <td><a href="<?php echo base_url().'admin/properties/edit/'.$project->id;?>"><?php echo $project->id;?></a></td> -->
						                <td><?php echo $project->Project_Name;?></td>
						                   <td><?php echo $project->Address;?></td>
						                <td><?php echo $project->	Bankers;?></td>
						               
						              <td>
                                      <label class="switch">
                                          <input type="checkbox" value="not approvel" 
                                  <?php if ($project->Project_Approvel == 'approvel') { ?> checked <?php } ?> 
                                                 class="approvel" data-id="<?php echo $project->id; ?>">
                                          <span class="slider round"></span>
                                     </label>
                                  </td>
                                  
						    
                          
						              </tr>
						              <?php 
						              $i++;
						          }
						      } ?>
						  </tbody>
					  </table>
					 </div>
                </div>
            </div>
            <!--/row-->

           
          
         </div>
<script>
$(document).on('change', '.approvel', function () {
    let projectId = $(this).data('id');
    let status = $(this).is(':checked') ? 'approvel' : 'not approvel';

    $.ajax({
        url: '<?php echo base_url("Siteadmin/PropertiesProject/updateApprovalStatus"); ?>',
        type: 'POST',
        data: { projectId: projectId, status: status },
        dataType: 'json',
        success: function (response) {
            if (response.status === 'success') {
                alert(response.message);
            } else {
                alert(response.message);
            }
        },
        error: function () {
            alert('Something went wrong. Please try again.');
        }
    });
});
</script>

 <style>
/* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 72px;
  height: 20px;
}

/* Hide default HTML checkbox */
.switch input {display:none;}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #888888;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 20px;
  width: 20px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
  
  /* svg pattern */
background-color: #ffffff;
}

input:checked + .slider {
  background-color: #0ba038;
}

input:focus + .slider {
  box-shadow: 0 0 1px #0ba038;
}

input:checked + .slider:before {
  -webkit-transform: translateX(52px);
  -ms-transform: translateX(52px);
  transform: translateX(52px);
  
  /* svg pattern */
background-color: #ffffff;
background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%230ba038' fill-opacity='0.4' fill-rule='evenodd'/%3E%3C/svg%3E");
}

/* Rounded sliders */
.slider.round {
  border-radius: 68px;
}

.slider.round:before {
  border-radius: 50%;
}

.search_btn {
    background: #2ed8b6;
    border-color: #2ed8b6;
    padding: 2px 15px;
    transition: all 0.5s ease;
    color: #fff;
    font-size: 14px;
}
</style>