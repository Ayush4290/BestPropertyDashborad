<?php
defined("BASEPATH") or exit("No direct script access allowed");
class Leads extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library("form_validation");
        $this->load->helper("url");
        $this->load->helper("access_helper");
        $this->load->library("session");
        $this->load->model("AdminModel");
        $sessionLogin = $this->session->userdata("adminLogged");
        if (!$sessionLogin) {
            redirect(base_url("site-admin"));
        }
    }

    public function index()
    {
        $data["title"] = "Leads";

        $filters = [];
        $like = [];
        $agent = "";

        //if ($this->session->userdata('role') == 'Sale Person') {
        if (stristr($this->session->userdata("role"), "Sale Person")) {
            $statuses = [
                "Assigned",
                "Contacted",
                "Interested",
                "Not Interested",
                "Zunk",
            ];
            $this->db->where_in("status", $statuses);
            $data["leads"] = $this->db->get("buyers")->result();
        } else {
            // Base filter
            $filters["id >"] = "1";

            // Role-based filter
            if ($this->session->userdata("role") == "Agent") {
                $filters["userid"] = $this->session->userdata("id");
            }

            // Filters from POST
            if ($this->input->server("REQUEST_METHOD") === "POST") {
                $post = $this->input->post();

                if (!empty($post["start_date"]) && !empty($post["end_date"])) {
                    $filters["DATE(rDate) >="] = $post["start_date"];
                    $filters["DATE(rDate) <="] = $post["end_date"];
                }

                if (!empty($post["uName"])) {
                    $like["uName"] = $post["uName"];
                }

                if (!empty($post["mobile"])) {
                    $like["mobile"] = $post["mobile"];
                }

                if (!empty($post["status"])) {
                    $filters["status"] = $post["status"];
                }

                if (!empty($post["leads_type"])) {
                    $filters["leads_type"] = $post["leads_type"];
                }
                if (isset($post["agent"]) && $post["agent"] != "") {
                    $agent = $post["agent"];
                    $filters["userid"] = $agent;
                }
            }

            $data["leads"] = $this->AdminModel->getFilteredLeads(
                $filters,
                $like,
                "buyers",
                "*",
                "id",
                "desc"
            );
        }

        // Agent-specific logic
        //if ($this->session->userdata('role') == 'Agent' || $agent != '') {
        if (
            stristr($this->session->userdata("role"), "Agent") ||
            $agent != ""
        ) {
            if ($agent > 0) {
                $userid = $agent;
            } else {
                $userid = $this->session->userdata("id");
            }
            $data["assignleads"] = $this->AdminModel->getAgentLead($userid);

            if (!empty($data["assignleads"])) {
                $data["leads"] = array_merge(
                    $data["leads"],
                    $data["assignleads"]
                );
                $data["leads"] = array_map(
                    "unserialize",
                    array_unique(array_map("serialize", $data["leads"]))
                );
            }
        }

        $data["agents"] = $this->AdminModel->getDataByMultipleColumns(
            ["role" => "Agent"],
            "adminLogin",
            "id,fullName"
        );
        $data["mainContent"] = "siteAdmin/leads";
        $this->load->view("includes/admin/template", $data);
    }

    public function meeting()
    {
        $data["meeting_tasks"] = $this->AdminModel->get_tasks_with_conditions(
            "meeting"
        );
        $data["mainContent"] = "siteAdmin/meeting_tasks_view";
        $this->load->view("includes/admin/template", $data);
    }

    public function follow()
    {
        $data["lead_tasks"] = $this->AdminModel->get_tasks_with_conditions(
            "Followup"
        );

        $data["mainContent"] = "siteAdmin/follow_ups";
        $this->load->view("includes/admin/template", $data);
    }

    public function updateFollowUpStatus()
    {
        $id = $this->input->post("followUpId");
        $updateData = [
            "status" => $this->input->post("status"),
        ];
        $result = $this->AdminModel->updateTable(
            $id,
            "id",
            "leads_comment",
            $updateData
        );
    }

    public function Addleads()
    {
        $data["title"] = "Add Leads";

        if ($this->input->post("save")) {
            $this->form_validation->set_rules(
                "phone",
                "Phone",
                "trim|required|numeric|exact_length[10]"
            );
            $this->form_validation->set_rules("name", "Name", "trim|required");
            $this->form_validation->set_rules(
                "propertyType_sub",
                "propertyType_sub",
                "trim|required"
            );
            $this->form_validation->set_error_delimiters(
                '<div class="alert alert-danger">',
                "</div>"
            );

            if ($this->form_validation->run() != false) {
                $payment_methods = $this->input->post("Payment_Method");
                if (!is_array($payment_methods)) {
                    $payment_methods = [];
                }

                $insertData = [
                    "userid" => $this->session->userdata("id"),
                    "userType" => $this->input->post("buyer"),
                    "uName" => $this->input->post("name"),
                    "preferred_location" => $this->input->post(
                        "preferred_location"
                    ),
                    "address" => $this->input->post("address"),
                    "email" => $this->input->post("email"),
                    "city" => $this->input->post("city"),
                    "mobile" => $this->input->post("phone"),
                    "budget" => $this->input->post("budget"),
                    "propertyType_sub" => $this->input->post(
                        "propertyType_sub"
                    ),
                    "propertyType" => $this->input->post("propertyType"),
                    "max_budget" => $this->input->post("max_budget"),
                    "Project_Builder" => $this->input->post("Project_Builder"),
                    "Profession" => $this->input->post("Profession"),
                    "Payment_Method" => implode(", ", $payment_methods),
                    "description" => $this->input->post("description"),
                    "requirement" => $this->input->post("requirement"),
                    "leads_type" => $this->input->post("leads_type"),
                    "status" => $this->input->post("status"),
                    "source" => $this->input->post("source"),
                    "priority" => $this->input->post("priority"),
                    "timeline" => $this->input->post("timeline"),
                ];

                $result = $this->AdminModel->addDataInTable(
                    $insertData,
                    "buyers"
                );
                if ($result == true) {
                    $leadId = $this->db->insert_id();
                    $userId = $this->session->userdata("id");

                    // Assigned leads table me entry
                    $assignData = [
                        "leadid" => $leadId,
                        "userid" => $userId,
                        "rdate" => date("Y-m-d"),
                    ];
                    $this->AdminModel->addDataInTable(
                        $assignData,
                        "assigned_leads"
                    );

                    // Notification insert
                    $notificationData = [
                        "userid" => $userId,
                        "message" =>
                            "Lead: " .
                            $insertData["uName"] .
                            " (" .
                            $insertData["mobile"] .
                            ") added new lead",
                        "notiKey" => "buyers_" . $leadId,
                        "status" => 0,
                        "date" => date("Y-m-d H:i:s"),
                    ];
                    $this->AdminModel->addDataInTable(
                        $notificationData,
                        "notification"
                    );

                    $this->session->set_flashdata(
                        "message1",
                        "Leads added successfully."
                    );
                    redirect(base_url("admin/leads/add"));
                }
            }
        }

        $data["selected_payment_method"] =
            $this->input->post("Payment_Method") ?? [];
        $data["mainContent"] = "siteAdmin/leadsAdd";
        $this->load->view("includes/admin/template", $data);
    }

    public function editLeads()
    {
        $data["title"] = "Edit Leads";
        $id = $this->uri->segment(4);
        $userId = $this->session->userdata("id");

        $data["leads"] = $this->AdminModel->getDataFromTableByField(
            $id,
            "buyers",
            "id"
        );
        $data["assignedLead"] = $this->AdminModel->getDataByMultipleColumns(
            ["leadid" => $id, "userid" => $userId],
            "assigned_leads"
        );

        $role = $this->session->userdata("role");
        check_agent_access($data["leads"], $data["assignedLead"], $role);

        $username = $this->session->userdata("fullName");

        if ($this->input->post("save")) {
            $this->form_validation->set_rules(
                "email",
                "Email",
                "trim|max_length[40]"
            );
            $this->form_validation->set_error_delimiters(
                '<div class="alert alert-danger">',
                "</div>"
            );

            if ($this->form_validation->run() != false) {
                $updateData = [
                    "budget" => $this->input->post("budget"),
                    "max_budget" => $this->input->post("budgetmax"),
                    "preferred_location" => $this->input->post(
                        "preferred_location"
                    ),
                    "Project_Builder" => $this->input->post("Project_Builder"),
                    "propertyType_sub" => $this->input->post(
                        "propertyType_sub"
                    ),
                    "propertyType" => $this->input->post("propertyType"),
                    "requirement" => $this->input->post("requirement"),
                    "Profession" => $this->input->post("Profession"),
                    "description" => $this->input->post("description"),
                    "status" => $this->input->post("status"),
                    "city" => $this->input->post("city"),
                    "source" => $this->input->post("source"),
                    "priority" => $this->input->post("priority"),
                    "timeline" => $this->input->post("timeline"),
                    "leads_type" => $this->input->post("leads_type"),
                ];

                $currentData = $data["leads"][0];
                $logContent = [];

                if ($currentData->requirement != $updateData["requirement"]) {
                    $logContent["requirement"] = [
                        "old" => $currentData->requirement,
                        "new" => $updateData["requirement"],
                    ];
                }
                if ($currentData->status != $updateData["status"]) {
                    $logContent["status"] = [
                        "old" => $currentData->status,
                        "new" => $updateData["status"],
                    ];
                }
                if (
                    $currentData->location != $updateData["preferred_location"]
                ) {
                    $logContent["location"] = [
                        "old" => $currentData->location,
                        "new" => $updateData["preferred_location"],
                    ];
                }

                if (!empty($logContent)) {
                    $logData = [
                        "userId" => $this->session->userdata("id"),
                        "username" => $username,
                        "leadId" => $id,
                        "ip" => $this->input->ip_address(),
                        "content" => json_encode($logContent),
                    ];
                    $this->AdminModel->addDataInTable($logData, "logs");
                }

                $result = $this->AdminModel->updateTable(
                    $id,
                    "id",
                    "buyers",
                    $updateData
                );

                //  Notification
                $assignedUsers = $this->AdminModel->getDataFromTableByField(
                    $id,
                    "assigned_leads",
                    "leadid"
                );
                if (!empty($assignedUsers)) {
                    foreach ($assignedUsers as $assign) {
                        $notifyData = [
                            "userid" => $assign->userid,
                            "message" =>
                                "Lead: " .
                                $currentData->uName .
                                " (" .
                                $currentData->mobile .
                                ") updated",
                            "notiKey" => "buyers_" . $id,
                            "status" => 0,
                            "date" => date("Y-m-d H:i:s"),
                        ];
                        $this->AdminModel->addDataInTable(
                            $notifyData,
                            "notification"
                        );
                    }
                }

                // Insert in properties if seller & qualified
                if (
                    strtolower($updateData["leads_type"]) == "seller" &&
                    strtolower($updateData["status"]) == "qualified"
                ) {
                    $leadData = $this->AdminModel->getDataFromTableByField(
                        $id,
                        "buyers",
                        "id"
                    );
                    if (!empty($leadData)) {
                        $lead = $leadData[0];

                        // Check if property with same lead_id already exists
                        $existingProperty = $this->AdminModel->getDataFromTableByField(
                            $lead->id,
                            "properties",
                            "lead_id"
                        );

                        // Also check if requirement matches with any existing property name
                        $requirementMatch = $this->db
                            ->where('name', $lead->requirement)
                            ->get('properties')
                            ->result();

                        if (empty($existingProperty) && empty($requirementMatch)) {
                            // Default new_properties_id
                            $new_properties_id = "";

                            // Process city code only if it matches allowed list
                            $city = strtolower(trim($lead->city));
                            $city_code = "";
                            switch ($city) {
                                case "chandigarh":
                                    $city_code = "CH";
                                    break;
                                case "punjab":
                                    $city_code = "PB";
                                    break;
                                case "panchkula":
                                    $city_code = "PA";
                                    break;
                                case "mohali":
                                    $city_code = "MO";
                                    break;
                                case "kharar":
                                    $city_code = "KH";
                                    break;
                                case "pinjor":
                                    $city_code = "PJ";
                                    break;
                                case "zirakpur":
                                    $city_code = "ZP";
                                    break;
                                default:
                                    $city_code = "";
                                    break;
                            }

                            // If city matched, then generate new_properties_id
                            if ($city_code != "") {
                                $source_raw = strtolower(
                                    $lead->main_site ?? ""
                                );
                                if (strpos($source_raw, "99acres") !== false) {
                                    $source_code = "99";
                                } elseif (
                                    strpos($source_raw, "magicbricks") !== false
                                ) {
                                    $source_code = "MG";
                                } else {
                                    $source_code = "BP";
                                }

                                // $last_id ka use nahi ho raha yaha, kyunki insert baad me ho raha hai
                                // Isliye new_properties_id blank chhodna best rahega — baad me update karna ho to kar sakte ho
                                $new_properties_id =
                                    $city_code . $source_code . $lead->id;
                            }

                            // Final insert
                            $propertyData = [
                                "userid" => $this->session->userdata("id"),
                                "lead_id" => $lead->id,
                                "name" => $lead->requirement,
                                "property_builder" => $lead->Project_Builder,
                                "property_type" => $lead->propertyType,
                                "type" => $lead->propertyType_sub,
                                "property_for" => "sale",
                                "address" => $lead->address,
                                "city" => $lead->city,
                                "state" => "",
                                "zip_code" => "",
                                "budget" => $lead->budget,
                                "status" => "deactive",
                                "approvel" => "approvel",
                                "description" => $lead->description,
                                "person" => $lead->uName,
                                "phone" => $lead->mobile,
                                "new_properties_id" => $new_properties_id, // Add here
                            ];

                            $this->AdminModel->addDataInTable(
                                $propertyData,
                                "properties"
                            );
                        }
                    }
                }

                $this->session->set_flashdata(
                    "message1",
                    "Leads updated successfully."
                );
                redirect(base_url("admin/leads/edit") . "/" . $id);
            }
        }

        if ($this->input->post("submit")) {
            $this->form_validation->set_rules(
                "comment",
                "Comment",
                "trim|required|min_length[3]|max_length[250]"
            );
            $this->form_validation->set_rules("choice", "Choice", "trim");
            $this->form_validation->set_error_delimiters(
                '<div class="alert alert-danger">',
                "</div>"
            );

            if ($this->form_validation->run() != false) {
                $choice = $this->input->post("choice");
                $insertData = [
                    "leadId" => $id,
                    "comment" => $this->input->post("comment"),
                    "nextdt" => $this->input->post("nextdt"),
                    "choice" => $choice,
                    "status" => "Active",
                ];

                $this->AdminModel->addDataInTable($insertData, "leads_comment");

                if ($choice == "Meeting") {
                    $sDate = $this->input->post("nextdt") ?: date("Y-m-d");
                    $sDate = date("Y-m-d", strtotime($sDate));

                    $addData = [
                        "subjectId" => $id,
                        "task" => $this->input->post("comment"),
                        "task_detail" => $this->input->post("comment"),
                        "start_date" => $sDate,
                        "choice" => "meeting",
                        "status" => "active",
                    ];

                    $this->AdminModel->addDataInTable($addData, "leadTask");
                }

                $this->session->set_flashdata(
                    "message2",
                    "Leads comment added successfully."
                );
                redirect(base_url("admin/leads/edit") . "/" . $id);
            }
        }
        $property = $this->AdminModel->getDataFromTableByField(
            $id,
            "properties",
            "lead_id"
        );
        $data["property"] = !empty($property) ? $property[0] : null;
        $data["leadscomment"] = $this->AdminModel->getDataFromTableByField(
            $id,
            "leads_comment",
            "leadId"
        );
        $data["logs"] = $this->AdminModel->getDataFromTableByField(
            $id,
            "logs",
            "leadId",
            "id",
            "desc"
        );

        $data["mainContent"] = "siteAdmin/leadsEdit";
        $this->load->view("includes/admin/template", $data);
    }

    public function deleteLeads()
    {
        $id = $this->uri->segment("4");
        $role = $this->session->userdata("role");
        $buyers = $this->AdminModel->getDataFromTableByField(
            $id,
            "buyers",
            "id"
        );
        if ($buyers && $role == "Agent") {
            if ($buyers[0]->userid != $this->session->userdata("id")) {
                redirect(base_url("admin/dashboard"));
            }
        }
        $data["leads"] = $this->AdminModel->deleteRow($id, "buyers", "id");
        $data["comment"] = $this->AdminModel->deleteRow(
            $id,
            "leadTask_comment",
            "leadtaskId"
        );
        $data["task"] = $this->AdminModel->deleteRow($id, "leadTask", "id");
        redirect(base_url("admin/leads"));
    }
    public function deleteComment()
    {
        $id = $this->uri->segment("4");
        $lid = $this->uri->segment("5");
        $data["leadscomment"] = $this->AdminModel->deleteRow(
            $id,
            "leads_comment",
            "id"
        );
        $data["leads"] = $this->AdminModel->deleteRow($id, "buyers", "id");
        redirect(base_url("admin/leads/edit") . "/" . $lid);
    }

    public function remove_unwanted_words($input)
    {
        $unwantedWords = [
            "area",
            "good location in",
            "near",
            "main",
            "market",
            "road side",
            "or",
            "side",
            ".",
            "any",
            "and",
        ];

        $normalized = strtolower($input); // Make lowercase for consistent matching

        // Remove unwanted phrases/words
        foreach ($unwantedWords as $word) {
            $pattern = "/\b" . preg_quote($word, "/") . "\b/i"; // \b ensures whole word match
            $normalized = preg_replace($pattern, "", $normalized);
        }

        // Clean up extra spaces
        $cleaned = trim(preg_replace("/\s+/", " ", $normalized));

        return $cleaned; // Output: chandigarh university
    }

    /**
     * Get recommended properties based on lead data
     * @param array $lead_data
     * @return array
     */
    public function get_recommended_properties($lead_data)
    {
        $property_type = isset($lead_data["property_type"])
            ? strtolower(trim($lead_data["property_type"]))
            : null;
        $max_budget = isset($lead_data["max_budget"])
            ? (float) $lead_data["max_budget"]
            : null;
        $preferred_location = isset($lead_data["preferred_location"])
            ? strtolower(trim($lead_data["preferred_location"]))
            : null;
        $status = isset($lead_data["status"])
            ? strtolower(trim($lead_data["status"]))
            : null;
        $lead_description = isset($lead_data["description"])
            ? strtolower(trim($lead_data["description"]))
            : "";

        $filtered_location = $this->remove_unwanted_words($preferred_location);

        $this->db->select("property_url");
        $this->db->from("properties_clone");

        // Only start group if at least one filter exists
        $has_condition = false;

        if (
            !empty($lead_description) ||
            $property_type ||
            $max_budget ||
            $preferred_location ||
            $status
        ) {
            if ($property_type) {
                $this->db->where("LOWER(property_type) = '$property_type'");
            }

            $this->db->group_start(); // Start dynamic condition group
            $has_condition = true;

            if (!empty($filtered_location)) {
                $filtered_location = preg_replace(
                    "/[^a-zA-Z0-9\s]/",
                    "",
                    $filtered_location
                );
                $this->db->or_like("address", $filtered_location);
                $this->db->or_like("description", $filtered_location);
                $this->db->or_like("name", $filtered_location);
                $this->db->or_like("project_n", $filtered_location);
            }

            if (preg_match("/(sector\s*\d+)/i", $text, $matches)) {
                $this->db->or_like("address", $matches[1]);
                $this->db->or_like("description", $matches[1]);
                $this->db->or_like("name", $matches[1]);
                $this->db->or_like("project_n", $matches[1]);
            }

            /*  if ($property_type) {
            $this->db->or_where("LOWER(property_type) = '$property_type'");
        }

        if ($max_budget) {
            $this->db->where('budget <=', $max_budget);
        }


        if ($status) {
            $this->db->or_where("LOWER(property_for) = '$status'");
        }*/

            $this->db->group_end(); // End group only if started
        }

        $this->db->order_by("created_at", "DESC"); // Sort latest first
        $this->db->limit(20); // Return only 20 records

        $query = $this->db->get();
        return array_column($query->result_array(), "property_url");
    }

    public function export_page()
    {
        $role = $this->session->userdata("role");
        if (!check_permission($role, "contact")) {
            redirect(base_url("admin/dashboard"));
        }

        $data["title"] = "Export Properties Data";
        $data["mainContent"] = "siteAdmin/leads_export_form"; // View path: views/siteAdmin/leads_export_form.php
        $this->load->view("includes/admin/template", $data);
    }

    public function export_data()
    {
        $role = $this->session->userdata("role");
        if (!check_permission($role, "contact")) {
            redirect(base_url("admin/dashboard"));
        }

        $table = "buyers";
        $from = $this->input->post("from_date");
        $to = $this->input->post("to_date");
        $leads_type = $this->input->post("leads_type");

        // Fetch records
        $this->db->from($table);
        if (!empty($leads_type)) {
            $this->db->where("leads_type", $leads_type);
        }

        if (!empty($from) && !empty($to)) {
            $this->db->where("DATE(rDate) >=", date("Y-m-d", strtotime($from)));
            $this->db->where("DATE(rDate) <=", date("Y-m-d", strtotime($to)));
        }

        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            $this->session->set_flashdata(
                "message",
                "No data found for the selected date range."
            );
            redirect("admin/leads/export_page");
        }

        $leads = $query->result_array();

        // Generate CSV manually
        $delimiter = ",";
        $newline = "\r\n";
        $filename = "leads_export_" . date("Ymd_His") . ".csv";
        $csv_data = "";
        $header_written = false;

        foreach ($leads as $lead) {
            // If property_type is 'buyer', fetch recommended properties
            if (
                isset($lead["leads_type"]) &&
                strtolower($lead["leads_type"]) === "buyer"
            ) {
                $lead_input = [
                    "property_type" => $lead["property_type"] ?? "",
                    "max_budget" =>
                        $lead["max_budget"] ?? ($lead["budget"] ?? ""),
                    "preferred_location" =>
                        $lead["preferred_location"] ?? ($lead["city"] ?? ""),
                    "status" =>
                        $lead["status"] ?? ($lead["property_for"] ?? ""),
                    "description" => $lead["description"] ?? "",
                ];

                $recommended = $this->get_recommended_properties($lead_input);
                $lead["recommended_urls"] = implode(",", $recommended);
            } else {
                $lead["recommended_urls"] = "[]";
            }

            // Write header only once
            if (!$header_written) {
                $csv_data .= implode($delimiter, array_keys($lead)) . $newline;
                $header_written = true;
            }

            // Escape values for CSV
            $escaped = array_map(function ($val) {
                return '"' . str_replace('"', '""', $val) . '"';
            }, $lead);

            $csv_data .= implode($delimiter, $escaped) . $newline;
        }

        $this->load->helper("download");
        force_download($filename, $csv_data);
    }

    public function export_leads()
    {
        $this->load->helper("download");

        $filters = [];
        $like = [];
        $agent = "";
        $leads = [];

        // Check for Sale Person role
        if (stristr($this->session->userdata("role"), "Sale Person")) {
            $statuses = [
                "Assigned",
                "Contacted",
                "Interested",
                "Not Interested",
                "Zunk",
            ];
            $this->db->where_in("status", $statuses);
            $leads = $this->db->get("buyers")->result_array(); // already array
        } else {
            $filters["id >"] = "1";

            if ($this->session->userdata("role") == "Agent") {
                $filters["userid"] = $this->session->userdata("id");
            }

            if ($this->input->method() === "post") {
                $post = $this->input->post();

                if (!empty($post["start_date"]) && !empty($post["end_date"])) {
                    $filters["DATE(rDate) >="] = $post["start_date"];
                    $filters["DATE(rDate) <="] = $post["end_date"];
                }

                if (!empty($post["uName"])) {
                    $like["uName"] = $post["uName"];
                }

                if (!empty($post["mobile"])) {
                    $like["mobile"] = $post["mobile"];
                }

                if (!empty($post["status"])) {
                    $filters["status"] = $post["status"];
                }

                if (!empty($post["leads_type"])) {
                    $filters["leads_type"] = $post["leads_type"];
                }

                if (!empty($post["agent"])) {
                    $agent = $post["agent"];
                    $filters["userid"] = $agent;
                }
            }

            // Get filtered leads (likely objects)
            $leads = $this->AdminModel->getFilteredLeads(
                $filters,
                $like,
                "buyers",
                "*",
                "id",
                "desc"
            );

            // Convert to array
            if (!empty($leads)) {
                $leads = array_map(function ($item) {
                    return (array) $item;
                }, $leads);
            }
        }

        // Assigned leads for Agent role
        if (
            stristr($this->session->userdata("role"), "Agent") ||
            $agent != ""
        ) {
            $userid = $agent ?: $this->session->userdata("id");
            $assignleads = $this->AdminModel->getAgentLead($userid);

            // Convert to array
            if (!empty($assignleads)) {
                $assignleads = array_map(function ($item) {
                    return (array) $item;
                }, $assignleads);

                $leads = array_merge($leads, $assignleads);
                $leads = array_map(
                    "unserialize",
                    array_unique(array_map("serialize", $leads))
                );
            }
        }

        // No leads found
        if (empty($leads)) {
            header("HTTP/1.1 204 No Content");
            exit();
        }

        // CSV headers
        $filename = "leads_export_" . date("Ymd_His") . ".csv";
        $csv_string = "";

        $header = array_keys($leads[0]);
        $csv_string .= '"' . implode('","', $header) . "\"\n";

        foreach ($leads as $row) {
            $csv_string .=
                '"' .
                implode('","', array_map("trim", array_values($row))) .
                "\"\n";
        }

        force_download($filename, $csv_string);
    }

    /*Deal function start*/

    public function addDeal()
    {
        $leadId = $this->uri->segment("4");
        if ($this->input->post("save")) {
            $this->form_validation->set_rules("phone", "phone", "trim");
            $this->form_validation->set_error_delimiters(
                '<div class="alert alert-danger">',
                "</div>"
            );
            if ($this->form_validation->run() != false) {
                $propertyId = $this->input->post("addProperty");
                $idWhere = ["id" => $propertyId, "status" => "active"];
                $checkpropertyID = $this->AdminModel->getDataByMultipleColumns(
                    $idWhere,
                    "properties",
                    "id,status"
                );

                if ($checkpropertyID) {
                    $where = ["id" => $leadId];
                    $current_deal = $this->AdminModel->getDataByMultipleColumns(
                        $where,
                        "buyers",
                        "deal"
                    );
                    $currentPropertyId = $current_deal[0]->deal;

                    // Convert the current deal to an array if it's a comma-separated string
                    $current_deal_array =
                        $currentPropertyId != ""
                            ? explode(",", $currentPropertyId)
                            : [];

                    // Check if property is already added
                    if (in_array($propertyId, $current_deal_array)) {
                        $this->session->set_flashdata(
                            "error",
                            "Error: Property is already added."
                        );
                    } else {
                        $updated_deal =
                            $currentPropertyId != ""
                                ? $currentPropertyId . "," . $propertyId
                                : $propertyId;
                        $updateData = [
                            "deal" => $updated_deal,
                        ];
                        $result = $this->AdminModel->updateTable(
                            $leadId,
                            "id",
                            "buyers",
                            $updateData
                        );
                        $this->session->set_flashdata(
                            "message1",
                            "Property added successfully."
                        );

                        // Insert into leadDeal table
                        $propertyData = $this->AdminModel->getDataByMultipleColumns(
                            $idWhere,
                            "properties",
                            "name"
                        );
                        $dataToInsert = [
                            "name" => $propertyData[0]->name,
                            "lead_id" => $leadId,
                            "properties_id" => $propertyId,
                            "status" => "Interested",
                            "date" => date("Y-m-d H:i:s"),
                        ];
                        $this->AdminModel->insertLeadDeal($dataToInsert);
                    }
                } else {
                    $this->session->set_flashdata(
                        "error",
                        "Sorry! This property does not exist."
                    );
                }
            }
        }

        $where1 = ["id" => $leadId];
        $allDeals = $this->AdminModel->getDataByMultipleColumns(
            $where1,
            "buyers",
            "deal"
        );
        if ($allDeals) {
            if ($allDeals[0]->deal != "") {
                $dealString = $allDeals[0]->deal;
                $dealArray = explode(",", $dealString);
                $whereLead = ["p.id" => $dealArray, "l.lead_id" => $leadId];
                // $data['propertyDeal'] = $this->AdminModel->getDataFromTableByWhereIn('id', $dealArray, 'properties', 'id,name,address,city,state');
                $data["propertyDeal"] = $this->AdminModel->getDealProperties(
                    $whereLead
                );
            }
        }
        $data["mainContent"] = "siteAdmin/addDeal";
        $this->load->view("includes/admin/template", $data);
    }

    public function updateDealStatus()
    {
        $pid = $this->input->post("propertyId");
        $leadId = $this->input->post("leadId");
        $updateData = [
            "Status" => $this->input->post("status"),
        ];
        $where = ["properties_id" => $pid, "lead_id" => $leadId];
        $result = $this->AdminModel->updateLeadStatus(
            $where,
            "leadDeal",
            $updateData
        );
    }
}
