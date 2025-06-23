<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="col main pt-5 mt-3">
    <a href= <?php echo base_url('admin/subtask/'.$this->uri->segment(4).'/'.$this->uri->segment(5)); ?>
 style="float: right;margin: 14px 2px;" class="btn btn-sm btn-info back-btn">Back</a>

    <h1 class="d-sm-block heading"><?php echo $title; ?></h1>

    <?php
    $message = $this->session->flashdata('message');
    if($message != '') {
        $this->session->set_flashdata('message','');
        echo '<div class="alert alert-success">'.$message.'</div>';
    }
    echo validation_errors(); // Display validation errors, if any
    ?>

    <div class="clearfix"></div>

   <form class="form" method="post" action="<?php echo base_url('admin/subtask/add/').$this->uri->segment(4).'/'.$this->uri->segment(5); ?>" enctype="multipart/form-data">

        <div class="row">

            <div class="col-sm-12">
                <div class="form-group">
                    <label>Sub Task</label>
                    <input type="text" name="task" value="" required class="form-control">
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label>Start Date</label>
                    <input type="date" class="form-control"  name="start_date">
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label>Complete Date</label>
                    <input type="date" class="form-control"  name="complete_date">
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status" class="form-control">
                        <option value="">Status</option>
                        <option value="new">New</option>
                        <option value="hold">Hold</option>
                        <option value="pending">Pending</option>
                        <option value="inprogress">Inprogress</option>
                        <option value="qa">QA</option>
                        <option value="fail">Fail</option>
                        <option value="tbd">TBD</option>
                        <option value="client_review">Client Review</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group">
                    <label>Sub Task Detail</label>
                    <textarea name="task_detail" class="form-control" placeholder="Task Detail" rows="4"></textarea>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group">
                    <label>Special Instruction</label>
                    <textarea name="special_instruction" class="form-control" placeholder="Special Instruction" rows="4"></textarea>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label>Picture</label>
                    <input type="file" name="image" class="form-control">
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-sm-12 text-center">
                <input type="submit" value="Submit" name="save" class="btn btn-primary">
            </div>
        </div>
    </form>

</div>
