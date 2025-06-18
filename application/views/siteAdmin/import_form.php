<div class="col main pt-5 mt-3">
    <h1 class="d-sm-block heading">Import Properties Data</h1>
    <div class="clearfix"></div>

    <?php
    $message = $this->session->flashdata('message');
    if ($message != '') {
        echo '<div class="alert alert-success">' . $message . '</div>';
    }
    $this->session->set_flashdata('message', '');
    echo validation_errors();
    ?>

    <div class="clearfix"></div>

    <div class="row mt-3">
        <div class="col-sm-8">
            <form method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/properties/import_data'); ?>">

                <div class="form-group">
                    <label for="table_name">Select Table <span class="text-danger">*</span></label>
                    <select name="table_name" class="form-control" required>
                        <option value="">-- Choose Table --</option>
                        <option value="properties">Properties</option>
                        <option value="properties_clone">Properties Clone</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="import_file">Choose CSV File <span class="text-danger">*</span></label>
                    <input type="file" name="import_file" class="form-control-file" accept=".csv" required>
                </div>

                 <button type="submit" class="btn btn-primary">Import</button>


                <div class="alert alert-info mt-3">
                    <strong>Note:</strong> CSV file must include the following headers:<br>
                    <code>
                        id, userid, json, fillter, name, property_builder, description, property_for, project_n, built, land, carpet, additional, additional_value, address, person, phone, person_address, city, state, zip_code, property_type, bhk, budget, budget_in_words, amenities, type, updated_at, created_at, is_deleted, image_one, image_two, image_three, image_four, status, approvel, show_in_slider, show_in_gallery, icon, bathrooms, bedrooms, sqft, measureUnit, services, verified, residential, commercial, hot_deals, main_site, property_url, current_datetime, live_table
                    </code>
                </div>


            </form>
        </div>
    </div>
</div>
