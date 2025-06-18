<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="col-md-3 col-lg-2 sidebar-offcanvas bg-light pl-0" id="sidebar" role="navigation">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsingNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="nav flex-column sticky-top pl-0 pt-5 mt-3" id="collapsingNavbar">
        
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a></li>
			
			 <?php
        $role = $this->session->userdata('role');
        if (strpos($role, 'Admin')!==false) { ?>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/properties'); ?>">Properties</a></li>
            
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/projects'); ?>">Properties Projects</a></li>
             <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/whatsapp'); ?>">Whatsapp</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/rent'); ?>">Rent</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/leads'); ?>">Leads</a></li>
            
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/follow-up'); ?>">Follow Ups</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/meetings'); ?>">Meetings</a></li>
            
            
        <?php
        }
        $role = $this->session->userdata('role');
if (!empty($role)) {
    $roles = explode(',', str_replace(' ', '', $role));
}

if (in_array('Admin', $roles) || in_array('Manager', $roles)) { ?>
      
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/customers'); ?>">Customers</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/properties'); ?>">Properties</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/leads'); ?>">Leads</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/contact'); ?>">Contact Us</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/category'); ?>">Category</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/tag'); ?>">Tag</a></li>

        <?php
        }
        if (strpos($role, 'Admin')!==false) { ?>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/deal'); ?>">Deal</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/user'); ?>">Users</a></li>
            
            <?php
        }
        if (strpos($role, 'Sale Person')!==false) { ?>
            
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/properties'); ?>">Properties</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/leads'); ?>">Leads</a></li>
             <?php
        }
        if (strpos($role,'Agent')!==false) { ?>
           
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/properties'); ?>">Properties</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/leads'); ?>">Leads</a></li>
            <?php

          $userid = $_SESSION['id']; 
          if (strpos($role, 'Agent') !==false && $userid == 28) { ?>
        
    
 
    <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/whatsapp'); ?>">Whatsapp</a></li>

<?php } ?>
        
            
        <?php } ?>
		
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/logout'); ?>">Logout</a></li>
    </ul>
</div>