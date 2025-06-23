<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

        <div class="col main pt-5 mt-3 dashboard_main">
            <h1 class="heading d-sm-block">
           Dashboard
            </h1>
            
            <div class="alert alert-warning fade collapse" role="alert" id="myAlert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>Holy guacamole!</strong> It's free.. this is an example theme.
            </div>
			<div class="row mb-3">
<div class="col-xl-3 col-sm-6 py-2">
    <div class="card text-white bg-info h-100">
        <div class="card-body bg-info">
            <a href="<?php echo base_url('admin/leads'); ?>">
                <div class="rotate">
                    <i class="fa fa-list fa-4x"></i>
                </div>
                <h6 class="text-uppercase">LEADS</h6>
            </a>
            <div class="li-css">
            <ul>
                <!-- Status-wise count dikhane ke liye -->
                <li><a href="#">New (<?php echo isset($new_leads) ? $new_leads : 0; ?>)</a></li>
                <li><a href="#">Assigned (<?php echo isset($assigned_leads) ? $assigned_leads : 0; ?>)</a></li>
                <li><a href="#">Hot Deal (<?php echo isset($hot_deal_leads) ? $hot_deal_leads : 0; ?>)</a></li>
                <li><a href="#">Contacted (<?php echo isset($contacted_leads) ? $contacted_leads : 0; ?>)</a></li>
                <li><a href="#">Interested (<?php echo isset($interested_leads) ? $interested_leads : 0; ?>)</a></li>
                <li><a href="#">Not Interested (<?php echo isset($not_interested_leads) ? $not_interested_leads : 0; ?>)</a></li>
                <li><a href="#">Junk (<?php echo isset($junk_leads) ? $junk_leads : 0; ?>)</a></li>
               
                
            </ul>
            </div>
            <hr>
            <h6>Total Leads: <?php echo isset($total_leads) ? $total_leads : 0; ?></h6>
        </div>
    </div>
</div>


                <div class="col-xl-3 col-sm-6 py-2">
                    <div class="card text-white bg-danger h-100">
                        <div class="card-body bg-danger">
                            <a href="<?php echo base_url('admin/properties');?>">
                            <div class="rotate">
                                <i class="fa fa-list fa-4x"></i>
                            </div>
                            <h6 class="text-uppercase">For Sale Property</h6> 
                            </a>
                              <div class="li-css">
                              <ul>
                <!-- Status-wise count dikhane ke liye -->
                <li><a href="#">Residential (<?php echo isset($residential) ? $residential : 0; ?>)</a></li>
                <li><a href="#">Commercial (<?php echo isset($commercial) ? $commercial : 0; ?>)</a></li>
            </ul></div>
            <hr>
            <h6>Total Property: <?php echo isset($total_properties) ? $total_properties : 0; ?></h6>
							<!--ul>
							<li><a href="#"> Add New </a></li>
							<li><a href="#"> total (200)</a></li>
							<li><a href="#"> New Leads (10)</a></li>
							<li><a href="#"> Assigned (190)</a></li>
							</ul-->
                        </div>
                    </div>
                </div>
                
                
<?php 
$role = $this->session->userdata('role');

if ($role == 'Agent' && !empty($notifications)) {
    ?>
    <div class="notification-box">
        <h4>Recent Notifications</h4>
        <ul>
            <?php foreach ($notifications as $note): ?>
                <li>
                    <strong><?= $note['message'] ?></strong><br>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php
}
?>



            
            
                 
				<?php
$role = $this->session->userdata('role');
$roles = [];

if (!empty($role)) {
    $roles = explode(',', str_replace(' ', '', $role));
}

if (in_array('Manager', $roles) || in_array('Admin', $roles)) {
?>
				 
				 
                <div class="col-xl-3 col-sm-6 py-2">
                    <div class="card bg-success text-white h-100">
                        <div class="card-body bg-success">
                          
                            <div class="rotate">
                                <i class="fa fa-users fa-4x"></i>
                            </div>
                            <a href="<?php echo base_url('admin/rent');?>"><h6 class="text-uppercase">TOLET Service</h6>  </a>
                            <hr>
                            <h6>Total Service: <?php echo isset($total_services) ? $total_services : 0; ?></h6>
							<!--ul>
							<li><a href="#"> Add New </a></li>
							<li><a href="#"> total (200)</a></li>
							<li><a href="#"> New Leads (10)</a></li>
							<li><a href="#"> Assigned (190)</a></li>
							</ul-->
                        </div>
                    </div>
                </div>
				 <div class="col-xl-3 col-sm-6 py-2">
                    <div class="card text-white bg-danger h-100">
                        <div class="card-body bg-danger">
                            <a href="<?php echo base_url('admin/user/');?>">
                            <div class="rotate">
                                <i class="fa fa-list fa-4x"></i>
                            </div>
                            <h6 class="text-uppercase"> Agents</h6> 
                            </a>
                              <div class="li-css">
                                   <ul>
                <!-- Status-wise count dikhane ke liye -->
                <li><a href="#">Admin (<?php echo isset($admin) ? $admin : 0; ?>)</a></li>
                <li><a href="#">Agent (<?php echo isset($agent) ? $agent : 0; ?>)</a></li>
                 <li><a href="#">Manager (<?php echo isset($manager) ? $manager : 0; ?>)</a></li>
            </ul></div>
            <hr>
            <h6>Total Admin: <?php echo isset($total_admin) ? $total_admin : 0; ?></h6>
							<!--ul>
							<li><a href="#"> Add New </a></li>
							<li><a href="#"> total (50)</a></li>
							<li><a href="#"> Tolet (10)</a></li>
							<li><a href="#"> Property Sale (20)</a></li>
							<li><a href="#"> Both (20)</a></li>
							</ul-->
                        </div>
                    </div>
                </div>
		<!--/div>
            <div class="row mb-3"-->
                <div class="col-xl-3 col-sm-6 py-2">
                    <div class="card bg-success text-white h-100">
                        <div class="card-body bg-success">
                          <a href="<?php echo base_url('admin/contact');?>">
                            <div class="rotate">
                                <i class="fa fa-users fa-4x"></i>
                            </div>
                            <h6 class="text-uppercase">Contact Us</h6> 
                          </a>
                          <hr>
                            <h6>Total Contact: <?php echo isset($total_contact) ? $total_contact : 0; ?></h6>
                        </div>
                    </div>
                </div>
                 
                 <!--<div class="col-xl-3 col-sm-6 py-2">
                    <div class="card text-white bg-danger h-100">
                        <div class="card-body bg-danger">
                            <a href="<?php echo base_url('admin/projects/');?>">
                            <div class="rotate">
                                <i class="fa fa-list fa-4x"></i>
                            </div>
                            <h6 class="text-uppercase">Projects</h6> 
                            </a>
                              <div class="li-css"><ul>
             <li><a href="#">Admin (<?php echo isset($new) ? $new : 0; ?>)</a></li>
             <li><a href="#">Agent (<?php echo isset($inprogress) ? $inprogress : 0; ?>)</a></li>
             <li><a href="#">Manager (<?php echo isset($completed) ? $completed : 0; ?>)</a></li>
            </ul>
            <hr>
            <h6>Total Admin: <?php echo isset($total_project) ? $total_project : 0; ?></h6>
                        </div>  </div>
                    </div>
                </div> --->
                
                
                    <div class="col-xl-3 col-sm-6 py-2">
                     <div class="card text-white bg-danger h-100">
                        <div class="card-body bg-danger">
                          <a href="<?php echo base_url('admin/projects');?>">
                            <div class="rotate">
                                <i class="fa fa-users fa-4x"></i>
                            </div>
                            <h6 class="text-uppercase">Properties Projects</h6> 
                          </a>
                           <div class="li-css">
            <ul>
                <!-- Status-wise count dikhane ke liye -->
                <li><a href="#">Activate (<?php echo isset($active) ? $active : 0; ?>)</a></li>
                <li><a href="#">Deactivate (<?php echo isset($deactivate) ? $deactivate : 0; ?>)</a></li>
            </ul>
            </div>
                          <hr>
                            <h6>Total Properties Projects: <?php echo isset($Properties_Projects) ? $Properties_Projects : 0; ?></h6>
                        </div>
                    </div>
                </div>
               
  <?php if (!empty($notifications)): ?>
    <div class="notification-box">
        <h4>Recent Notifications</h4>
        <ul>
        <?php foreach ($notifications as $note): ?>
            <li>
                <strong><?= $note['message'] ?></strong><br>
                
            </li>
        <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

                 </div>
                 
                   
                 
<div class="row mb-3">
<?php if (!empty($lead_tasks)): ?>
<div class="col-xl-12 col-sm-12 py-2" >
    <h6 style="color: #333; font-weight: bold; margin-bottom: 10px; font-size: 1.25rem;">Follow Up</h6>
    <div class="table-scroll-div">
    <table id="datatable1" class="table table-striped table-bordered table-sm display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Sr. No.</th>
                <th>Task Name</th>
                <th>Name</th>
                <th>Pref. Location</th>
                <th>Budget</th>
                <th>Requirement</th>
                <th>Date /Time</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $i = 1;
            foreach ($lead_tasks as $task) { ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td>
                        <a href="<?php echo base_url('admin/leads/view/' . $task['leadId']); ?>" style="color: #3498db; text-decoration: none;">
                            <?php echo $task['comment']; ?>
                        </a>
                    </td>
                    <td><?php echo $task['uName']; ?></td>
                    <td><?php echo $task['location']; ?></td>
                    <td><?php echo $task['budget']; ?></td>
                    <td>
                        <?php 
                        if (!empty($task['residential'])) {
                            echo 'R: ' . $task['residential'];
                        }
                        if (!empty($task['commercial'])) {
                            if (!empty($task['residential'])) {
                                echo '<br>';
                            }
                            echo 'C: ' . $task['commercial'];
                        }
                        ?>
                    </td>
                    <td><?php echo date('d M Y h:iA', strtotime($task['nextdt'])); ?></td>
                </tr>
                <?php $i++;
            } ?>
        </tbody>
    </table></div>
</div>
<?php endif; ?>

 </div>
<?php if (!empty($meeting_tasks)): ?>
<div class="col-xl-12 col-sm-12 py-2">
    <h6 style="color: #333; font-weight: bold; margin-bottom: 10px; font-size: 1.25rem; text-align: center;">Meetings</h6>
    <div class="table-scroll-div">
    <table id="datatable1" class="table table-striped table-bordered table-sm display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Sr. No.</th>
                <th>Task Name</th>
                <th>Name</th>
                <th>Pref. Location</th>
                <th>Budget</th>
                <th>Requirement</th>
                <th>Date /Time</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $i = 1;
            foreach ($meeting_tasks as $task) { ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td>
                        <a href="<?php echo base_url('admin/leads/view/' . $task['leadId']); ?>" style="color: #3498db; text-decoration: none;">
                            <?php echo $task['comment']; ?>
                        </a>
                    </td>
                    <td><?php echo $task['uName']; ?></td>
                    <td><?php echo $task['location']; ?></td>
                    <td><?php echo $task['budget']; ?></td>
                    <td>
                        <?php 
                        if (!empty($task['residential'])) {
                            echo 'R: ' . $task['residential'];
                        }
                        if (!empty($task['commercial'])) {
                            if (!empty($task['residential'])) {
                                echo '<br>';
                            }
                            echo 'C: ' . $task['commercial'];
                        }
                        ?>
                    </td>
                    <td><?php echo date('d M Y h:iA', strtotime($task['nextdt'])); ?></td>
                </tr>
                <?php $i++;
            } ?>
        </tbody>
    </table></div>
</div>
<?php endif; ?>
 <?php } ?>

        <div class="col-xl-6 col-sm-12 py-2">
        <div class="card h-100">
            <div class="card-body">
                <h6 class="text-uppercase text-center">Leads Pie Chart</h6>
                <div id="piechart_3d" style="width: 100%; height: 350px;"></div>
            </div>
        </div>
    </div>



</div>
</div>
    
 
</div>
            </div-->
      

           
          
         </div>
   <!-- Google Charts Script -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Task', 'Leads Count'],
            ['New', <?php echo isset($new_leads) ? $new_leads : 0; ?>],
            ['Assigned', <?php echo isset($assigned_leads) ? $assigned_leads : 0; ?>],
            ['Contacted', <?php echo isset($contacted_leads) ? $contacted_leads : 0; ?>],
            ['Interested', <?php echo isset($interested_leads) ? $interested_leads : 0; ?>],
            ['Not Interested', <?php echo isset($not_interested_leads) ? $not_interested_leads : 0; ?>],
            ['Junk', <?php echo isset($junk_leads) ? $junk_leads : 0; ?>],
            ['Deactivate', <?php echo isset($deactivate_leads) ? $deactivate_leads : 0; ?>]
        ]);

        var options = {
            title: 'Leads Distribution',
            is3D: true
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
    }
</script>