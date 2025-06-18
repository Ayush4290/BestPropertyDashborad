<div class="col main pt-5 mt-3">
  <div class="chat-header">
      <a href="<?=base_url('admin/whatsapp')?>" class="btn btn-sm btn-success" style="float: right;"><< Back</a>
    <strong><?= $r_name ?></strong>
  </div>

	<?php 
		if($this->session->flashdata('error') != ''){
		    $this->session->set_flashdata('error','');
			echo '<div class="alert alert-danger">';
			echo '<a class="close" data-dismiss="alert">×</a><strong>Error!</strong> '.$this->session->flashdata('error');
			echo '</div>'; 
		}
	
	?>
  <div class="chat-container">
  <?php 
foreach($messages as $msg){ 
    if($msg['user_id'] == '1'){ $cls = 'user'; }
    else { $cls = 'sender'; } ?>
    <!-- Left message -->
    <div class="chat-message <?=$cls.' '?>">
        <p><?= $msg['message'] ?></p>
        <?php if (!empty($msg['whatsapp_image'])){ ?>
            <?php 
                $img = $msg['whatsapp_image'];
                if (strpos($img, 'http') === 0) {
                    $img_url = $img;
                } else {
                    $img_url = base_url($img);
                }
            ?>
            <!-- 👇 Clickable & Downloadable Image -->
            <a href="<?= $img_url ?>" target="_blank" download>
                <img src="<?= $img_url ?>" class="chat-image" alt="WhatsApp Image" style="max-width: 150px; max-height: 150px; border-radius: 8px;">
            </a>
        <?php } ?>
        <small><?= date('d M Y h:i A', strtotime($msg['r_date'])) ?></small>
    </div>
<?php } ?>


  </div>

<form method="post" action="" class="chat-input-form" enctype="multipart/form-data">
    <input type="hidden" name="receiver_id" value="<?= $user['id'] ?>">

    <input type="text" name="message" class="chat-input" placeholder="Type a message...">

    <!-- Upload Image Button -->
    <button type="button" class="btn btn-sm btn-info" onclick="document.querySelector('input[name=attachment]').click();">
        📷 Upload Atech
    </button>

    <!-- Hidden File Input -->
    <input type="file" name="attachment" style="display: none;">

    <button type="submit" class="send-btn">Send</button>
</form>
<span id="file-name" style="margin-left:10px;color:green;"></span>

<script>
    document.querySelector('input[name=attachment]').addEventListener('change', function() {
        document.getElementById('file-name').innerText = this.files[0]?.name || '';
    });
</script>
</div>

<style>
.chat-header {
    display: block;
    align-items: center;
    padding: 10px 15px;
    background: #f1f1f1;
    border-bottom: 1px solid #ccc;
}
.chat-header .profile-img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-right: 10px;
    object-fit: cover;
}
.chat-container {
    padding: 20px;
    background: #f8f8f8;
    height: 400px;
    overflow-y: auto;
}
.chat-message {
    max-width: 60%;
    padding: 10px;
    border-radius: 10px;
    margin-bottom: 10px;
    position: relative;
    clear: both;
}
.chat-message p {
    margin: 0;
}
.chat-message small {
    display: block;
    margin-top: 5px;
    font-size: 12px;
    color: #ccc;
}
.chat-message.sender {
    background: #ffffe0;
    float: left;
}
.chat-message.user {
    background: #004d40;
    color: white;
    float: right;
    text-align: right;
}
.chat-image {
    max-width: 150px;
    display: block;
    margin-bottom: 5px;
    border-radius: 5px;
}
.chat-input-form {
    display: flex;
    border-top: 1px solid #ccc;
    padding: 10px;
    position: sticky;
    bottom: 0;
    background: #fff;
}
.chat-input {
    flex: 1;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 20px;
}
.send-btn {
    background: #007bff;
    color: white;
    border: none;
    padding: 0 20px;
    margin-left: 10px;
    border-radius: 20px;
    cursor: pointer;
}
</style>

<script>
    jQuery(document).ready(function(){
        var chatBox = jQuery('.chat-container');
        chatBox.scrollTop(chatBox[0].scrollHeight); 
    });
</script>