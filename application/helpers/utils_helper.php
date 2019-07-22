<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('print_r')) {
    function print_r($array, $continue = FALSE)
    {
        echo '<pre style="color: #000; border: 4px dashed #ddd; padding: 20px; width: 95%; margin: 20px auto; background-color: #f0f0f0;">' . print_r($array, TRUE) . '</pre>';
        if ($array === FALSE) {
            die;
            exit;
        }
    }
}

if (!function_exists('avatar_url')) {
    function avatar_url($arg = null)
    {
        return base_url('/public/images/avatar/' . $arg);
    }
}

if (!function_exists('avatar_path')) {
    function avatar_path()
    {
        return FCPATH . 'public/images/avatar/';
    }
}


if (!function_exists('error_upload')) {
    function error_upload($err_no = 0)
    {
        $phpFileUploadErrors = array(
            0 => 'There is no error, the file uploaded with success',
            1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
            2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
            3 => 'The uploaded file was only partially uploaded',
            4 => 'No file was uploaded',
            6 => 'Missing a temporary folder',
            7 => 'Failed to write file to disk.',
            8 => 'A PHP extension stopped the file upload.',
        );
        return $phpFileUploadErrors[$err_no];
    }
}

if (!function_exists('flash_msg')) {
    function flash_msg($args)
    {
        if(isset($args['status']) && $args['status'] !== null){
            echo '<div class="alert '.(($args['status']) ? 'alert-success' : 'alert-error') . '"><button class="close" data-dismiss="alert">×</button><strong>'.(($args['status']) ? 'Sukses!' : 'Error!').'</strong> '.(isset($args['msg']) ? $args['msg'] : '').'</div>';
        }
    }
}