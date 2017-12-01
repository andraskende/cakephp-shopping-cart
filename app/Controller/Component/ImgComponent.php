<?php
class ImgComponent extends Component {

    public $allowed_ext = array('jpg', 'jpeg', 'png', 'gif');
    public $min_filesize = 5000;
    public $max_filesize = 20000000;

////////////////////////////////////////////////////////////

    public function upload($source, $targetdir, $targetfile) {

        $filesize = filesize($source);
        if(($filesize < $this->min_filesize) || ($filesize > $this->max_filesize)) {
            return 'Image filesize must be between ' . $this->human_filesize($this->min_filesize) . ' and ' . $this->human_filesize($this->max_filesize);
        }

        $data = getimagesize($source);

        if (empty($data) || !is_array($data)) {
            return 'Image is invalid';
        }

        list($srcWidth, $srcHeight, $type) = $data;

        $ext = $this->_image_type_to_extension($type);

        if (!in_array($ext, $this->allowed_ext)) {
            return 'Image filetype not allowed.';
        }

        if (!$srcWidth || !$srcHeight) {
            return 'Image size invalid';
        }

        if ($srcWidth < 100 || $srcHeight < 100) {
            return 'Image size must be at least 100x100';
        }

        $this->mkdir($targetdir);

        if(move_uploaded_file($source, $targetdir . '/' . $targetfile)) {
            return 'Success';
        }

        return 'Image upload is invalid';
    }

////////////////////////////////////////////////////////////

    public function human_filesize($bytes, $decimals = 0) {
        $sz = 'BKMGTP';
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1000, $factor)) . @$sz[$factor] . 'B';
    }

////////////////////////////////////////////////////////////

    public function ext($file) {
        return mb_strtolower(trim(mb_strrchr($file, '.'), '.'));
    }

////////////////////////////////////////////////////////////

    public function cropimage($src, $dst, $width, $height, $start_width, $start_height, $scale) {
        $newImageWidth = ceil($width * $scale);
        $newImageHeight = ceil($height * $scale);
        $newImage = imagecreatetruecolor($newImageWidth, $newImageHeight);
        $source = imagecreatefromjpeg($src);
        imagecopyresampled($newImage, $source, 0, 0, $start_width, $start_height, $newImageWidth, $newImageHeight, $width, $height);
        imagejpeg($newImage,$dst, 100);
        @chmod($thumb_image_name, 0777);
        //return $thumb_image_name;
    }

////////////////////////////////////////////////////////////

    public function mkdir($targetdir) {
        if(!is_dir($targetdir)) {
            App::uses('Folder', 'Utility');
            $dir = new Folder($targetdir, true, 0777);
            if(!$dir) {
                return false;
            }
        }
        return true;
    }

////////////////////////////////////////////////////////////

    public function resampleIM($srcPath, $targetdir, $image, $dst_w = null, $dst_h = null, $fixedSize = false, $centerCrop = false) {

        //$im = '/usr/bin/convert -auto-orient -quality 100 -resample 72x72 -resize 600 "' . WWW_ROOT . 'images/original/' . $origFile . '[0]" ' . WWW_ROOT . 'images/' . $dst;
        //exec($im);

    }

////////////////////////////////////////////////////////////

    public function resampleGD($srcPath, $targetdir, $image, $dst_w = null, $dst_h = null, $fixedSize = false, $centerCrop = false) {

        $dstPath = $targetdir . $image;
        $this->mkdir($targetdir);

        list($src_w, $src_h, $type) = getimagesize($srcPath);

        $scale = min($dst_w / $src_w, $dst_h / $src_h);
        $new_w = (int) ($src_w * $scale);
        $new_h = (int) ($src_h * $scale);

        if($fixedSize) {
            $dst_x = (int) (($dst_w - $new_w) / 2);
            $dst_y = (int) (($dst_h - $new_h) / 2);
        }

        if(!$fixedSize && !$centerCrop) {
            $dst_w = $new_w;
            $dst_h = $new_h;
            $dst_x = 0;
            $dst_y = 0;
        }

        if($centerCrop) {

            $original_aspect = $src_w / $src_h;
            $thumb_aspect = $dst_w / $dst_h;

            if ( $original_aspect >= $thumb_aspect ) {
                $new_h = $dst_h;
                $new_w = (int) $src_w / ($src_h / $dst_h);
            } else {
                $new_w = $dst_w;
                $new_h = (int) $src_h / ($src_w / $dst_w);
            }
            $dst_x = (int) 0 - ($new_w - $dst_w) / 2;
            $dst_y = (int) 0 - ($new_h - $dst_h) / 2;

        }

        $dst = ImageCreateTrueColor($dst_w, $dst_h);
        $backColor = ImageColorAllocate($dst, 255, 255, 255);
        ImageFilledRectangle($dst, 0, 0, $dst_w, $dst_h, $backColor);

        $ext = $this->_image_type_to_extension($type);

        switch($ext) {
        case 'gif' :
            $src = imagecreatefromgif($srcPath);
            break;
        case 'png' :
            $src = imagecreatefrompng($srcPath);
            break;
        case 'jpg' :
        case 'jpeg' :
            $src = imagecreatefromjpeg($srcPath);
            break;
        default :
            return false;
            break;
        }

        ImageCopyResampled($dst, $src, $dst_x, $dst_y, 0, 0, $new_w, $new_h, $src_w, $src_h);
        imagejpeg($dst, $dstPath, 100);

        @chmod($dst, 0777);

        return true;
    }

////////////////////////////////////////////////////////////

    private function _image_type_to_extension($imagetype) {
        if(empty($imagetype)) {
            return false;
        }
        switch($imagetype) {
            case IMAGETYPE_GIF      : return 'gif';
            case IMAGETYPE_JPEG     : return 'jpg';
            case IMAGETYPE_PNG      : return 'png';
            case IMAGETYPE_SWF      : return 'swf';
            case IMAGETYPE_PSD      : return 'psd';
            case IMAGETYPE_BMP      : return 'bmp';
            case IMAGETYPE_TIFF_II  : return 'tiff';
            case IMAGETYPE_TIFF_MM  : return 'tiff';
            case IMAGETYPE_JPC      : return 'jpc';
            case IMAGETYPE_JP2      : return 'jp2';
            case IMAGETYPE_JPX      : return 'jpf';
            case IMAGETYPE_JB2      : return 'jb2';
            case IMAGETYPE_SWC      : return 'swc';
            case IMAGETYPE_IFF      : return 'aiff';
            case IMAGETYPE_WBMP     : return 'wbmp';
            case IMAGETYPE_XBM      : return 'xbm';
            default                 : return false;
        }
    }

////////////////////////////////////////////////////////////

}
