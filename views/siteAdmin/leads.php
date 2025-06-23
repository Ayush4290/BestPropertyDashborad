<?php
$advanceSearchVisible = !empty($_POST) ? 'block' : 'none';
?>

<div class="col main pt-5 mt-3">
    <div class="top-div">
        <div>
            <h1 class="d-sm-block heading m-0"><?php echo $title; ?></h1>
        </div>
        <div class="top-btn-div">
            <a href="#" class="btn btn-sm btn-info back-btn advance-search-btn">Advance Search</a>
            <a href="<?php echo base_url('admin/leads/add');?>" class="btn btn-sm btn-info back-btn">Add New</a>
            <a href="https://bestpropertiesmohali.com/admin/leads/export_page" style="float: right;margin-left: 4px;" class="btn btn-sm btn-success back-btn">Export</a>
        </div>
    </div>
    <div class="clearfix"></div>

    <script>
      $(document).ready(function() {
        $('.advance-search-btn').click(function(e) {
          e.preventDefault();
          $('.advance-search').slideToggle('fast');
        });
      });
    </script>

<?php
$role = $this->session->userdata('role');
$roles = explode(',', str_replace(' ', '', $role)); 
if (in_array('Admin', $roles)) {
?>

<form method="post" action="" class="mb-3" id="filterForm">
    <div class="row1 advance-search" style="display: <?php echo $advanceSearchVisible; ?>;">
        <div class="row">
            <div class="form-group col-sm-2">
                <label for="start_date">From:</label>
                <input type="date" id="from_date" name="start_date" class="form-control" value="<?php echo isset($_POST['start_date']) ? $_POST['start_date'] : ''; ?>">
            </div>

            <div class="form-group col-sm-2">
                <label for="end_date">To:</label>
                <input type="date" id="to_date" name="end_date" class="form-control" value="<?php echo isset($_POST['end_date']) ? $_POST['end_date'] : ''; ?>">
            </div>

            <div class="form-group col-sm-2">
                <label for="date_filter">Date Filter</label>
                <select id="date_filter" class="form-control">
                    <option value="">-- Select Filter --</option>
                    <option value="today">Today</option>
                    <option value="yesterday">Yesterday</option>
                    <option value="this_week">This Week</option>
                    <option value="this_month">This Month</option>
                </select>
            </div>

            <div class="form-group col-sm-2">
                <label for="uName">Name:</label>
                <input type="text" name="uName" class="form-control" placeholder="Enter Name" value="<?php echo isset($_POST['uName']) ? $_POST['uName'] : ''; ?>">
            </div>

            <div class="form-group col-sm-2">
                <label for="mobile">Mobile:</label>
                <input type="text" name="mobile" class="form-control" placeholder="Mobile" value="<?php echo isset($_POST['mobile']) ? $_POST['mobile'] : ''; ?>">
            </div>

            <div class="form-group col-sm-2">
                <label for="status">Status:</label>
                <select name="status" class="form-control">
                    <option value="">All</option>
                    <?php 
                    $statuses = ["New", "Contacted", "Qualified", "Site Visit Scheduled", "Site Visited", "Negotiation", "Booking Confirmed", "Document Collection", "Loan Under Process", "Finalized / Closed", "Follow-up Later", "Not Interested", "Duplicate", "Invalid Lead"];
                    foreach($statuses as $status) {
                        $selected = (isset($_POST['status']) && $_POST['status'] == $status) ? 'selected' : '';
                        echo "<option value=\"$status\" $selected>$status</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group col-sm-2">
                <label for="leads_type">Leads Type:</label>
                <select name="leads_type" class="form-control">
                    <option value="">All</option>
                    <?php 
                    $leadTypes = ["Seller", "Buyer", "Both", "Investor"];
                    foreach($leadTypes as $type) {
                        $selected = (isset($_POST['leads_type']) && $_POST['leads_type'] == $type) ? 'selected' : '';
                        echo "<option value=\"$type\" $selected>$type</option>";
                    }
                    ?>
                </select>
            </div>

<?php
if ($agents && in_array('Admin', $roles)) {
    $selectedAgent = isset($_POST['agent']) ? $_POST['agent'] : '';
?>
            <div class="form-group col-sm-2">
                <label for="leads_type">Agent:</label>
                <select name="agent" class="form-control">
                    <option value="">All Agents</option>
                    <?php 
                    foreach($agents as $u){ 
                        $selected = ($selectedAgent == $u->id) ? 'selected' : '';
                        echo '<option value="'.$u->id.'" '.$selected.'>'.$u->fullName.'</option>';
                    }
                    ?>
                </select>
            </div>
<?php } ?>

            <div class="form-group align-self-end">
                <button type="submit" class="btn btn-primary btn-sm">Search</button>
                <a href="<?php echo base_url('admin/leads'); ?>" class="btn btn-secondary btn-sm ml-2">Reset</a>
                <button type="button" onclick="export_data()" class="btn btn-primary btn-sm" style="margin:2px;">Export</button>
            </div>
        </div>
    </div>
</form>
<?php } ?>



<?php
    $message = $this->session->flashdata('message1');
    if($message != ''){
        echo '<div class="alert alert-success">'.$message.'</div>';
    }
    $this->session->set_flashdata('message1','');
    echo validation_errors(); 
    ?>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-sm-12">
            <div class="table-responsive">
                <table id="datatable1" class="table table-striped table-bordered table-sm display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Client</th>
                            <th>Mobile</th>
                            <th>Pref. Location</th>
                            <th>Budget</th>
                            <th>Requirement</th>
                             <th>Type</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if(!empty($leads)) { 
                            $i = 1;
                            foreach($leads as $lead){
                                // Check if any of the required fields are empty
                                $showUpdateButton = empty($lead->uName) || empty($lead->preferred_location) || empty($lead->budget) || (empty($lead->residential) && empty($lead->commercial));
                                ?>
                                <tr>
                                    <td><?php echo $i;?></td>
                                    <td><a href="<?php echo base_url().'admin/leads/view/'.$lead->id;?>"><?php echo $lead->uName;?></a></td>
                                    <td><?php echo $lead->mobile;?></td>
                                    <td><?php echo $lead->preferred_location;?></td>
                                    <td><?php echo $lead->budget;?></td>
                                   <td>
                                       <?php
                                       $requirementDisplay = '';

                                       if (!empty($lead->propertyType_sub)) {
                                           
                                           $type = strtolower($lead->propertyType_sub);

                                           if ($type == 'Residential') {
                                       $requirementDisplay .= 'R: ' . $lead->propertyType_sub;
                                            } elseif ($type == 'Commercial') {
                                     $requirementDisplay .= 'C: ' . $lead->propertyType_sub;
                                            } else {
                                      $requirementDisplay .= $lead->propertyType_sub; // fallback
                                           }
                                          }
                                   
                                       echo $requirementDisplay;
                                       ?>
                                   </td>

                                     <td><?php echo $lead->leads_type;?></td>
                                    
                                   <td>
    <?php 
    echo $lead->status;

    $role = $this->session->userdata('role');
    $roles = explode(',', str_replace(' ', '', $role)); // role string to array

    if (!in_array('SalePerson', $roles)) { // remove space if needed in DB field
        if ($lead->status == 'New') {
            echo " (New)";
        } elseif ($lead->status == 'deactive') {
            echo " (Deactive)";
        }
    }
    ?>
</td>

                                  <?php
$role = $this->session->userdata('role');
$roles = explode(',', str_replace(' ', '', $role)); 
?>

<td>
    <!--a href="<?php echo base_url().'admin/leads/view/'.$lead->id;?>" class="btn btn-success btn-sm">Follow Up</a-->

    <a href="<?php echo base_url().'admin/leads/edit/'.$lead->id;?>" class="btn btn-warning btn-sm"> <i class="fas fa-edit"></i></a>

    <?php if (!in_array('Agent', $roles)): ?>
        <a href="<?php echo base_url().'admin/leads/delete/'.$lead->id;?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this lead?');"><i class="fas fa-trash-alt"></i></a>
    <?php endif; ?>
</td>

                                </tr>
                                <?php
                                $i++;
                            } 
                        }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--/row-->
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script> 
<!-- Make sure this is in your <head> tag of the main layout -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script>
    document.getElementById('date_filter').addEventListener('change', function () {
        const filter = this.value;
        const fromInput = document.getElementById('from_date');
        const toInput = document.getElementById('to_date');
        const today = new Date();
        let fromDate, toDate;

        switch (filter) {
            case 'today':
                fromDate = toDate = today;
                break;

            case 'yesterday':
                fromDate = toDate = new Date(today);
                fromDate.setDate(today.getDate() - 1);
                toDate.setDate(today.getDate() - 1);
                break;

            case 'this_week':
                const firstDayOfWeek = new Date(today);
                firstDayOfWeek.setDate(today.getDate() - today.getDay()); // Sunday as start
                fromDate = firstDayOfWeek;
                toDate = today;
                break;

            case 'this_month':
                fromDate = new Date(today.getFullYear(), today.getMonth(), 1);
                toDate = new Date(today.getFullYear(), today.getMonth() + 1, 0);
                break;

            case 'custom':
                fromInput.value = '';
                toInput.value = '';
                return;
        }

        // Format dates to yyyy-mm-dd
        const format = (date) => date.toISOString().split('T')[0];
        fromInput.value = format(fromDate);
        toInput.value = format(toDate);
    });
</script>
<script>
    jQuery(document).ready(function() {
        jQuery('#datatable1').DataTable({
            "dom": '<"top"lf>rt<"bottom"ip><"clear">'
        });
    });


    function export_data(){

          $.ajax({
            url: '<?= base_url("admin/leads/export") ?>',
            method: 'POST',
            data: $('#filterForm').serialize(), // send filters
            xhrFields: {
                responseType: 'blob' // important for file download
            },
            success: function (data, status, xhr) {
                const filename = xhr.getResponseHeader('Content-Disposition')
                    ?.split('filename=')[1]
                    ?.replace(/"/g, '') || 'leads_export.csv';

                const url = window.URL.createObjectURL(data);
                const a = document.createElement('a');
                a.href = url;
                a.download = filename;
                document.body.appendChild(a);
                a.click();
                a.remove();
                window.URL.revokeObjectURL(url);
            },
            error: function (xhr) {
                alert("Error exporting leads.");
            }
    });

    }
</script>

<style>
    /* Flexbox to align the search and show entries */
    div.dataTables_wrapper div.dataTables_length {
        float: right;
        margin-right: 20px;
    }

    div.dataTables_wrapper div.dataTables_filter {
        float: left;
    }
</style>
