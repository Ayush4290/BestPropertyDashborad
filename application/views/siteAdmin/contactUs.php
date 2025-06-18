

        <div class="col main pt-5 mt-3">
            

            <h1 class="d-sm-block heading"><?php echo $title; ?></h1>
            <div class="clearfix"></div>
            <?php
        	  $message = $this->session->flashdata('message');
        	  if($message != ''){
        	      echo '<div class="alert alert-success">'.$message.'</div>';
        	  }
        	  
        	  ?>             
            <div class="clearfix"></div>
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
		              <table class="table table-striped">
                         <thead>
						    <tr>
							   <th>Sr. No.</th>
							   <th>Name</th>
							   <th>Email</th>
							   <th>Phone</th>
							   <th>Property</th>
							   <th>Message</th>
							</tr>
						 </thead>
						  <tbody>
						      <?php 
						      if(!empty($contacts)) {
						          $i = 1;
						          foreach($contacts as $contact){
						              echo '<tr>
						                <td>'.$i.'</td>
						                <td>'.$contact->fname.'</td>
						                <td>'.$contact->email.'</td>
						                <td>'.$contact->phone.'</td>
						                <td>'.$contact->property_url.'</td>
						                <td>'.$contact->message.'</td>
						              </tr>';
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
