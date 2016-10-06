<?php
    class Forms_model extends CI_Model {

        public function __construct()
        {

        }
        public function download_one_file($fileID)
        {
            $file = $this->db->select('*')->from('downloads')->where('id', $fileID)->get();
            if($file->num_rows() > 0)
            {
                $file = $file->row_array();
                $xxx  = str_replace(' ', '-', $file['title']) . '.' . $file['mimeType'];
                $file_path  = $file['title'] . '.' . $file['mimeType'];
                $path_parts = pathinfo($file_path);
                $file_name  = $path_parts['basename'];
                $file_ext   = $path_parts['extension'];
                $file_path  = dirname(dirname(dirname(dirname(__FILE__)))) . '/myFiles/' . $fileID . '.' . $file['mimeType'];

                $ctype_default = "application/octet-stream";
                $content_types = array(
                "zip" => "application/zip",
                "pdf" => "application/pdf",
                "jpg" => "image/jpeg",
                "jpg" => "image/pjpeg",
                "jpeg" => "image/pjpeg",
                "jpeg" => "image/pjpeg",
                "xlsx" => "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                );
                $ctype = isset($content_types[$file_ext]) ? $content_types[$file_ext] : $ctype_default;
                
                
                if (file_exists($file_path)) {
                    header('Content-Description: File Transfer');
                    header('Content-Type: ' . $ctype);
                    header('Content-Disposition: attachment; filename='."$xxx");
                    header('Content-Transfer-Encoding: binary');
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize($file_path));
                    ob_clean();
                    flush();
                    readfile($file_path);
                    exit;
                }

                /*$is_attachment = TRUE;

                if (is_file($file_path))
                {
                $file_size  = filesize($file_path);
                $file = @fopen($file_path,"rb");
                if ($file)
                {
                header("Pragma: public");
                header("Expires: -1");
                header("Cache-Control: public, must-revalidate, post-check=0, pre-check=0");
                header("Content-Disposition: attachment; filename=\"$xxx\"");

                if ($is_attachment) {
                header("Content-Disposition: attachment; filename=\"$xxx\"");
                }
                else {
                header('Content-Disposition: inline;');
                header('Content-Transfer-Encoding: binary');
                }

                $ctype_default = "application/octet-stream";
                $content_types = array(
                "zip" => "application/zip",
                "pdf" => "application/pdf",
                "jpg" => "image/jpeg",
                "jpg" => "image/pjpeg",
                "jpeg" => "image/pjpeg",
                "jpeg" => "image/pjpeg",
                "xlsx" => "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                );
                $ctype = isset($content_types[$file_ext]) ? $content_types[$file_ext] : $ctype_default;
                header("Content-Type: " . $ctype);


                if(isset($_SERVER['HTTP_RANGE']))
                {
                list($size_unit, $range_orig) = explode('=', $_SERVER['HTTP_RANGE'], 2);
                if ($size_unit == 'bytes')
                {
                list($range, $extra_ranges) = explode(',', $range_orig, 2);
                }
                else
                {
                $range = '';
                header('HTTP/1.1 416 Requested Range Not Satisfiable');
                exit;
                }
                }
                else
                {
                $range = '';
                }

                list($seek_start, $seek_end) = explode('-', $range, 2);

                $seek_end   = (empty($seek_end)) ? ($file_size - 1) : min(abs(intval($seek_end)),($file_size - 1));
                $seek_start = (empty($seek_start) || $seek_end < abs(intval($seek_start))) ? 0 : max(abs(intval($seek_start)),0);

                if ($seek_start > 0 || $seek_end < ($file_size - 1))
                {
                header('HTTP/1.1 206 Partial Content');
                header('Content-Range: bytes '.$seek_start.'-'.$seek_end.'/'.$file_size);
                header('Content-Length: '.($seek_end - $seek_start + 1));
                }
                else
                header("Content-Length: $file_size");

                header('Accept-Ranges: bytes');

                set_time_limit(0);
                fseek($file, $seek_start);

                while(!feof($file)) 
                {
                print(@fread($file, 1024*8));
                ob_flush();
                flush();
                if (connection_status()!=0) 
                {
                @fclose($file);
                exit;
                }            
                }

                @fclose($file);
                exit; 
                }
                else 
                {
                header("HTTP/1.0 500 Internal Server Error");
                exit;
                }
                }
                else
                {
                header("HTTP/1.0 404 Not Found");
                exit;
                }*/
            }
        }
}