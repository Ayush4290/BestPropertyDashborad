<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Whatsapp_api extends CI_Controller {

    private $VERIFY_TOKEN = "W@fffs@pp_AP5_Vedr1fy_T0Ken_#2325";
    private $ACCESS_TOKEN = "EAARGvMRMpHEBO4p5iCsPkZB14bZAnmsqk2HrwCaiFNq1ApElMZAofcDyaKZAZAuXC921nSwPrWldrhbnlF1myVakQw4xSwHxdGqt8ivx24hLrvQbbeWaluPOQv7jet7pNEoV3dC8ZBoMmkmJoZC6eYJiDId9qZAYzEaRelPcpnjnI250wyCd0hCHgMncbAaXMgtX9QZDZD"; // trimmed for privacy
   public function __construct() {
    parent::__construct();
    $this->load->model('AdminModel');
}

public function index() {
    // STEP 1: VERIFY WEBHOOK (GET)
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $mode = $_GET['hub_mode'] ?? '';
        $token = $_GET['hub_verify_token'] ?? '';
        $challenge = $_GET['hub_challenge'] ?? '';

        if ($mode === 'subscribe' && $token === $this->VERIFY_TOKEN) {
            echo $challenge;
        } else {
            http_response_code(403);
            echo 'Verification failed';
        }
        exit;
    }

    // STEP 2: HANDLE INCOMING MESSAGES (POST)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $input = file_get_contents("php://input");
        $data = json_decode($input, true);

        // Log raw input
        file_put_contents(FCPATH . "log.txt", $input . "\n", FILE_APPEND);

        $phone_number_id = $data['entry'][0]['changes'][0]['value']['metadata']['phone_number_id'] ?? '';
        $messageData = $data['entry'][0]['changes'][0]['value']['messages'][0] ?? null;

        if ($messageData) {
            $from = $messageData['from'] ?? '';
            $type = $messageData['type'] ?? '';
            $message_id = $messageData['id'] ?? '';
            $log = date("Y-m-d H:i:s") . " | From: $from | Phone ID: $phone_number_id | Type: $type | ";

            $msgText = '';
            $imgPath = '';
            $relativePath = '';

            switch ($type) {
                case 'text':
                    $msgText = $messageData['text']['body'] ?? '';
                    $log .= "Text: $msgText\n";
                    break;

                case 'image':
                    $imgPath = $this->downloadMedia($messageData['image']['id'], 'image');
                    if (!empty($imgPath)) {
                        $relativePath = 'media/' . basename($imgPath);
                        $log .= "Image saved to: $relativePath\n";
                    } else {
                        $log .= "Image download failed\n";
                    }
                    break;

                default:
                    $log .= "Unhandled type\n";
                    break;
            }

            file_put_contents(FCPATH . "messages.txt", $log, FILE_APPEND);

            // Extract contact info
            $contactName = '';
            $contactNumber = $from;

            if (isset($data['entry'][0]['changes'][0]['value']['contacts'][0])) {
                $contactName = $data['entry'][0]['changes'][0]['value']['contacts'][0]['profile']['name'] ?? '';
                $contactNumber = $data['entry'][0]['changes'][0]['value']['contacts'][0]['wa_id'] ?? $from;
            }

           $alreadyExists = $this->AdminModel->get_row('whatsapp_api', ['message_id' => $message_id]);

if (empty($alreadyExists)) {
            $insertData = [
                 'message_id' => $message_id,
                'message' => $msgText,
                'whatsapp_image' => $relativePath,
                'r_date' => date("Y-m-d H:i:s"),
                'r_type' => $type,
                // 'phone_number_id' => $phone_number_id,
                'contact_number' => $contactNumber // <-- Added this line
            ];
            $this->AdminModel->addDataInTable($insertData, 'whatsapp_api');
}

            // INSERT INTO whatsapp_info (only once)
            if (!empty($contactNumber)) {
                $existing = $this->AdminModel->get_row('whatsapp_info', ['contact_number' => $contactNumber]);
                if (empty($existing)) {
                    $infoData = [
                        'r_name' => $contactName,
                        'contact_number' => $contactNumber,
                        'phone_number_id' => $phone_number_id
                    ];
                    $this->AdminModel->addDataInTable($infoData, 'whatsapp_info');
                }
            }

            http_response_code(200);
            echo "OK";
            exit;
        }
    }
}

    private function downloadMedia($media_id, $type) {
        $access_token = $this->ACCESS_TOKEN;
        $meta_url = "https://graph.facebook.com/v19.0/$media_id";
        $headers = [
            "Authorization: Bearer $access_token"
        ];

        // Step 1: Get media URL
        $ch = curl_init($meta_url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $media_info = json_decode(curl_exec($ch), true);
        curl_close($ch);

        if (!isset($media_info['url'])) {
            return "Failed to get media URL";
        }

        $media_url = $media_info['url'];

        // Step 2: Download media
        $ch = curl_init($media_url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $media_data = curl_exec($ch);
        curl_close($ch);

        // Step 3: Save file
        $ext = match ($type) {
            'image' => '.jpg',
            default => ''
        };

        $filename = $type . time() . uniqid() . $ext;
        $save_path = FCPATH . "media";

        if (!file_exists($save_path)) {
            mkdir($save_path, 0777, true);
        }

        $file_path = "$save_path/$filename";
        file_put_contents($file_path, $media_data);

        return $file_path;
    }
}
