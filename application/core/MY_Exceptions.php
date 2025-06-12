<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Exceptions extends CI_Exceptions
{

    public function show_404($page = '', $log_error = TRUE)
    {
        // if ($log_error) {
        //     log_message('error', '404 Page Not Found --> ' . $page);
        // }

        $this->send_json_error(404, 'endpoint not found');
    }

    public function show_error($heading, $message, $template = 'error_general', $status_code = 500)
    {
        $this->send_json_error($status_code, strip_tags($message));
    }

    public function show_exception($exception)
    {
        $message = $exception->getMessage();
        $code = $exception->getCode() ?: 500;
        $this->send_json_error($code, $message);
    }

    private function send_json_error($code, $message)
    {
        if (ob_get_length()) ob_clean();
        http_response_code($code);
        header('Content-Type: application/json');

        echo json_encode([
            'metadata' => [
                'code' => $code,
                'message' => $message
            ]
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        exit;
    }
}
