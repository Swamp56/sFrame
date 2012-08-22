<?php

class sframe_io_Loader {
    public static function LoadFile($file) {
        try {
            if (file_exists($file)) {
                require_once($file);
            } else {
                throw new Exception('Invalid file requested for load');
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
}

?>
