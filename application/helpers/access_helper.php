<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('check_agent_access')) {
    function check_agent_access($leads, $assignedLead, $role) {
        if ($leads && $role == 'Agent' && !$assignedLead) {
            redirect(base_url('admin/dashboard'));
            exit;
        }
    }
}
