<div class="col main pt-5 mt-3">
    <h1 class="d-sm-block heading"><?php echo $title ?? 'Export Leads Data'; ?></h1>
    <div class="clearfix"></div>

    <?php
    $message = $this->session->flashdata('message');
    if (!empty($message)) {
        echo '<div class="alert alert-success">' . $message . '</div>';
    }
    $this->session->set_flashdata('message', '');
    echo validation_errors('<div class="alert alert-danger">', '</div>');
    ?>

    <div class="clearfix"></div>

    <div class="row mt-3">
        <div class="col-sm-8">
            <div class="card p-4 shadow-sm">
                <form method="post" action="<?php echo base_url('admin/leads/export_data'); ?>">

                     <div class="form-group">
                        <label for="table_name">Table</label>
                        <input type="text" name="buyers" class="form-control" value="Leads" disabled>
                    </div>

                     <div class="form-group ">
                        <label for="leads_type">Leads Type:</label>
                        <select name="leads_type" class="form-control">
                            <option value="">All</option>
                            <option value="Seller" <?php if(isset($_POST['leads_type']) && $_POST['leads_type'] == 'Seller') echo 'selected'; ?>>Seller</option>
                            <option value="Buyer" <?php if(isset($_POST['leads_type']) && $_POST['leads_type'] == 'Buyer') echo 'selected'; ?>>Buyer</option>
                            <option value="Both" <?php if(isset($_POST['leads_type']) && $_POST['leads_type'] == 'Both') echo 'selected'; ?>>Both</option>
                            <option value="Investor" <?php if(isset($_POST['leads_type']) && $_POST['leads_type'] == 'Investor') echo 'selected'; ?>>Investor</option>
                        </select>
                    </div>


                    <!-- Updated Dropdown for Date Filter -->
                    <div class="form-group">
                        <label for="date_filter">Date Filter</label>
                        <select id="date_filter" class="form-control">
                            <option value="">-- Select Filter --</option>
                            <option value="today">Today</option>
                            <option value="yesterday">Yesterday</option>
                            <option value="this_week">This Week</option>
                            <option value="this_month">This Month</option>
                         <!--   <option value="custom">Custom Range</option>-->
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="from_date">From Date <span class="text-danger">*</span></label>
                        <input type="date" name="from_date" id="from_date" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="to_date">To Date <span class="text-danger">*</span></label>
                        <input type="date" name="to_date" id="to_date" class="form-control">
                    </div>

                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-download"></i> Export
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

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
