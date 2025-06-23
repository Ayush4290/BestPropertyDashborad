<?php
$latestMessages = [];
foreach (array_reverse($whatsapp) as $info) {
    $contact = $info['contact_number'];
    if (!isset($latestMessages[$contact])) {
        $latestMessages[$contact] = $info;
    }
}
?>
<div class="col main pt-5 mt-3">
    <a href="<?php echo base_url('admin/whatsapp-new-user/');?>" style="float: right;margin: 14px 2px;" class="btn btn-sm btn-info back-btn">New chat</a>
    <h1 class="d-sm-block heading">Whatsapp</h1>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Contact Number</th>
                <th>Message</th>
                <th>Image</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($latestMessages as $info): ?>
                <tr>
                    <td><?= $info["r_name"] ?></td>
                    <td><?= '+' . $info["contact_number"] ?></td>
                    <td><?= $info["message"] ?></td>
                 <td>
    <?php 
        if (!empty($info["whatsapp_image"])) {
            echo "WhatsApp Image";
            // Check if it's a valid URL
            $img_url = $info["whatsapp_image"];
            echo '<br><img src="' . $img_url . '" alt="Image" style="width:100px; display:none;" onload="this.style.display=\'block\'" onerror="this.style.display=\'none\'">';
        } else {
            echo $info["message"];
        }
    ?>
</td>



                    <td><?= date('d M Y h:i A',strtotime($info["r_date"])) ?></td>
                    <td><?php if($info['contact_number'] != '') { echo '<a href="'.base_url('admin/whatsapp/' . $info['contact_number']).'" class="btn btn-success btn-sm">View chat</a>'; } ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
