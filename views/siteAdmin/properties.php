<?php
$advanceSearchVisible = !empty($_POST) ? 'block' : 'none';
?>


<div class="col main pt-5 mt-3">
    <div class="top-div">
        <div class="">
<h1 class="d-sm-block heading m-0"><?php echo $title?></h1>

        </div>
        <div class="top-btn-div">
            <a href="<?php echo base_url ('admin/properties/add');?>" class="btn btn-sm"></a>
        </div>
    </div>
</div>


<div class="col main pt-5 mt-3">

    <a href="<?php echo base_url('admin/properties/add'); ?>" style="float: right;margin: 14px 2px;" class="btn btn-sm btn-info back-btn">Add New</a>
    <?php if ($this->session->userdata('role') == 'Admin'): ?>
        <a href="<?php echo base_url('admin/approvel'); ?>" style="float: right; margin: 14px 2px;" class="btn btn-sm btn-info back-btn">
            Approval
        </a>
        <a href="<?php echo base_url('admin/properties/export_page'); ?>" style="float: right; margin: 14px 2px;" class="btn btn-sm btn-success back-btn">Export</a>


        <a href="<?php echo base_url('admin/properties/import_page'); ?>" style="float: right; margin: 14px 2px;" class="btn btn-sm btn-success back-btn">Import</a>
        <a href="javascript:void(0);" style="float: right;margin: 14px 2px;" class="btn btn-sm btn-info back-btn advance-search-toggle">Advance Search</a>

    <?php endif; ?>
    <h1 class="d-sm-block heading"><?php echo $title; ?></h1>
    <div class="clearfix"></div>

    <?php
    $message = $this->session->flashdata('message');
    if ($message != '') {

        if (strpos($message, 'delete') !== false) {
            echo '<div class="alert alert-danger">' . $message . '</div>';
        } else {

            echo '<div class="alert alert-success">' . $message . '</div>';
        }
    }
    ?>

    <div class="clearfix"></div>
    <form method="post" action="" class="advance-search-form mt-3" style="display: none;">
        <div class="row">
            <!-- Name -->
            <div class="form-group col-sm-2">
                <label>Name:</label>
                <input type="text" name="name" class="form-control" placeholder="Property Name" value="<?= set_value('name', isset($_POST['name']) ? $_POST['name'] : '') ?>">
            </div>


            <!-- Type -->
            <div class="form-group col-sm-2">
                <label>Type:</label>
                <select name="type" class="form-control" id="propertyType">
                    <option value="">Select Type</option>
                    <option value="Kothi" <?= (isset($_POST['type']) && $_POST['type'] == 'Kothi') ? 'selected' : '' ?>>Kothi</option>
                    <option value="Flat" <?= (isset($_POST['type']) && $_POST['type'] == 'Flat') ? 'selected' : '' ?>>Flat</option>
                    <option value="Plot" <?= (isset($_POST['type']) && $_POST['type'] == 'Plot') ? 'selected' : '' ?>>Plot</option>
                </select>
            </div>

            <!-- BHK -->
            <div class="form-group col-sm-2" id="bhkGroup" style="display: none;">
                <label>BHK:</label>
                <select name="bhk" class="form-control">
                    <option value="">Select BHK</option>
                    <?php
                    for ($i = 1; $i <= 5; $i++) {
                        $selected = (isset($_POST['bhk']) && $_POST['bhk'] == $i) ? 'selected' : '';
                        echo "<option value='$i' $selected>{$i} BHK</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Property Purpose -->
            <div class="form-group col-sm-2">
                <label>Property For:</label>
                <select name="property_for" class="form-control">
                    <option value="">Select Property For: </option>
                    <option value="Sale" <?= (isset($_POST['property_for']) && $_POST['property_for'] == 'Sale') ? 'selected' : '' ?>>Sale</option>
                    <option value="Buy" <?= (isset($_POST['property_for']) && $_POST['property_for'] == 'Buy') ? 'selected' : '' ?>>Buy</option>
                    <option value="Rent" <?= (isset($_POST['property_for']) && $_POST['property_for'] == 'Rent') ? 'selected' : '' ?>>Rent</option>
                </select>
            </div>

            <!-- Min Budget -->
            <div class="form-group col-sm-2">
                <label>Min Budget:</label>
                <input type="number" name="min_budget" class="form-control" placeholder="Enter min budget"
                    value="<?= isset($_POST['min_budget']) ? htmlspecialchars($_POST['min_budget']) : '' ?>">
            </div>

            <!-- Max Budget -->
            <div class="form-group col-sm-2">
                <label>Max Budget:</label>
                <input type="number" name="max_budget" class="form-control" placeholder="Enter max budget"
                    value="<?= isset($_POST['max_budget']) ? htmlspecialchars($_POST['max_budget']) : '' ?>">
            </div>

            <div class="form-group col-sm-2">
                <label>Address:</label>
                <input type="text" name="address" class="form-control" placeholder="Enter address"
                    value="<?= isset($_POST['address']) ? htmlspecialchars($_POST['address']) : '' ?>">
            </div>


            <div class="form-group col-sm-12 mt-2">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>

    <?php
    if ($this->input->post()) {
        $filters = $this->input->post();

        // example: fetch leads filtered by "status" and sort New ones first
        $this->db->order_by("FIELD(status, 'New') DESC", false); // for MySQL only
        if (!empty($filters['status'])) {
            $this->db->where('status', $filters['status']);
        }
        // ...more conditions for name, date, mobile, etc.
        $data['leads'] = $this->db->get('leads')->result();
    }
    ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="checkAll" /></th>
                            <th>Sr. No.</th>
                            <th>Property Name</th>
                            <th>Property Address</th>
                            <th>Property For</th>
                            <th>Phone</th>
                            <th>Budget</th>
                            <th>Area</th>
                            <th>Data Source</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($properties)) {
                            $i = 1;
                            foreach ($properties as $property) { ?>
                                <tr>
                                    <td><input type="checkbox" class="property_checkbox" value="<?php echo $property->id; ?>"></td>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $property->name; ?></td>
                                    <td><?php echo $property->address; ?></td>
                                    <td><?php echo $property->property_for; ?></td>
                                    <td><?php echo $property->phone; ?></td>
                                    <td><?php echo $property->budget; ?></td>
                                    <td><?php echo $property->built; ?></td>
                                    <td>
                                        <?php if (!empty($property->main_site)): ?>
                                            <a href="<?= $property->property_url ?>" target="_blank">
                                                <?php echo $property->main_site; ?>
                                            <?php else: ?>
                                                Manual
                                            <?php endif; ?>
                                            </a>
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" value="deactivate" <?php if ($property->status == 'active') { ?>checked<?php } ?> name="status" class="status" data-id="<?php echo $property->id; ?>">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <!-- Include this once in your <head> -->
                                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

                                        <!-- Edit Button -->
                                        <a href="<?php echo base_url() . 'admin/properties/edit/' . $property->id; ?>" class="btn btn-warning btn-sm" style="color:white;">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <!-- Delete Button -->
                                        <?php if ($this->session->userdata('role') !== 'Agent'): ?>
                                            <a href="<?php echo base_url() . 'admin/properties/delete/' . $property->id; ?>" class="btn btn-danger btn-sm" style="color:white;" onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        <?php endif; ?>


                                        <?php if ($this->session->userdata('role') === 'Agent'): ?>
                                            <a href="https://bestpropertiesmohali.com/" target="_blank" class="btn btn-success btn-sm">View</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>

                <!-- Dropdown & Submit -->
                <div class="row">
                    <div class="col-md-3">
                        <select id="bulk_status" class="form-control">
                            <option value="">Select Status</option>
                            <option value="active">Active</option>
                            <option value="deactivate">Deactive</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button id="applyStatus" class="btn btn-primary">Apply to Selected</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--/row-->


    <!-- Import Modal -->
    <div style="margin-top: 28%;" class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?php echo base_url('admin/properties/import'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="importModalLabel">Import Properties (CSV)</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="file" name="import_file" accept=".csv" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </div>
            </form>
        </div>
    </div>



</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script type="text/javascript" src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script>
    $(document).ready(function() {
        $(".advance-search-toggle").click(function() {
            $(".advance-search-form").slideToggle("fast");
        });
    });
</script>

<script>
    jQuery(document).ready(function() {
        jQuery('.status').click(function() {
            var val = jQuery(this).val();
            var dat_id = jQuery(this).data('id');
            var listId = jQuery('.listId' + dat_id).val(dat_id);
            var list_id = jQuery('.listId' + dat_id).val();


            if (jQuery(this).is(':checked')) {
                var statusVal = jQuery('.status').val('active');
                var status = jQuery('.status').val();
            } else if ($(this).not(':checked')) {
                var statusVal = jQuery('.status').val('deactivate');
                var status = jQuery('.status').val();
            }

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Siteadmin/Properties/updateStatus'); ?>",
                //data:"field="+field,
                data: {
                    status: status,
                    list_id: dat_id
                },
                success: function(data) {}
            });
        });

    });
</script>

<script>
    function toggleBHK() {
        const selectedType = $('#propertyType').val();
        if (selectedType === 'Flat') {
            $('#bhkGroup').show();
        } else {
            $('#bhkGroup').hide();
            $('#bhkGroup select').val(''); // Clear selected BHK
        }
    }


    $(document).ready(function() {

        toggleBHK();

        // On change
        $('#propertyType').on('change', function() {
            toggleBHK();
        });
        // Select all checkboxes
        $("#checkAll").click(function() {
            $(".property_checkbox").prop('checked', $(this).prop('checked'));
        });

        // Apply bulk status
        $("#applyStatus").click(function() {
            var status = $("#bulk_status").val();
            if (status == "") {
                alert("Please select a status.");
                return;
            }

            var propertyIds = $(".property_checkbox:checked").map(function() {
                return $(this).val();
            }).get().join(",");

            if (propertyIds == "") {
                alert("Please select at least one property.");
                return;
            }

            $.ajax({
                url: "<?php echo base_url('Siteadmin/Properties/updateBulkStatus'); ?>",
                method: "POST",
                data: {
                    property_ids: propertyIds,
                    status: status
                },
                success: function(response) {
                    alert("Status updated successfully!");
                    location.reload();
                }
            });
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
    .switch input {
        display: none;
    }

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

    input:checked+.slider {
        background-color: #0ba038;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #0ba038;
    }

    input:checked+.slider:before {
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