<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-12">
            <div class="content-box py-4 px-5">
                <h6 class="section-title">Follow Up</h6>
                <?php if (!empty($lead_tasks)): ?>
                <div class="table-main-div">
                    <table id="datatable1" class="table table-striped table-bordered table-sm display">
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
                            $task_limit = min(100, count($lead_tasks)); // Limit tasks to 100
                            if (!empty($lead_tasks)) {
                                for ($i = 0; $i < $task_limit; $i++) {
                                    $task = $lead_tasks[$i]; ?>
                            <tr>
                                <td>
                                    <?php echo $i + 1; ?>
                                </td>
                                <td>
                                    <a href="<?php echo base_url('admin/leads/view/' . $task['leadId']); ?>">
                                        <?php echo ($task['comment']); ?>
                                    </a>
                                </td>
                                <td>
                                    <?php echo ($task['uName']); ?>
                                </td>
                                <td>
                                    <?php echo ($task['location']); ?>
                                </td>
                                <td>
                                    <?php echo ($task['budget']); ?>
                                </td>
                                <td>
                                    <?php 
                                            if (!empty($task['residential'])) {
                                                echo '<span class="badge badge-info">R: ' . ($task['residential']) . '</span>';
                                            }
                                            if (!empty($task['commercial'])) {
                                                if (!empty($task['residential'])) {
                                                    echo '<br>';
                                                }
                                                echo '<span class="badge badge-success">C: ' . ($task['commercial']) . '</span>';
                                            }
                                            ?>
                                </td>
                                <td>
                                    <?php echo  date('d M Y h:iA',strtotime($task['nextdt'])); ?>
                                </td>


                            </tr>
                            <?php }
                            } else { ?>
                            <tr>
                                <td colspan="6" class="text-center">No tasks found</td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <?php else: ?>
                <p class="text-muted text-center">No tasks found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Add custom CSS -->
<style>
    .container {
        max-width: 1200px;
    }

    .content-box {
        background-color: #ffffff;
        border-radius: 10px;
        padding-right:0 !important;
        /*box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);*/
    }

    .section-title {
        color: #2c3e50;
        font-weight: bold;
        margin-bottom: 20px;
        font-size: 1.5rem;
        text-align: center;
    }

    .table {
        margin-top: 20px;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table th,
    .table td {
        padding: 15px;
        text-align: left;
    }

    .table thead th {
        background-color: #3498db;
        color: #ffffff;
        font-weight: bold;
    }

    .table tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .table tbody tr:hover {
        background-color: #e1e1e1;
    }

    .table a {
        color: #2980b9;
        text-decoration: none;
    }

    .table a:hover {
        text-decoration: underline;
    }

    .badge-info {
        background-color: #17a2b8;
        color: #ffffff;
        padding: 5px 10px;
        border-radius: 5px;
    }

    .badge-success {
        background-color: #28a745;
        color: #ffffff;
        padding: 5px 10px;
        border-radius: 5px;
    }

    .text-center {
        text-align: center;
    }

    .text-muted {
        color: #6c757d;
    }
</style>