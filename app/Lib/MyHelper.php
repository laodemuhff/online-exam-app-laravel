<?php
namespace App\Lib;

use App\Http\Requests;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Guzzle\Http\EntityBody;
use Guzzle\Http\Message\Request;
use Guzzle\Http\Message\Response;
use Guzzle\Http\Exception\ServerErrorResponseException;

use Illuminate\Support\Facades\URL;
use DateTime;
use File;
use Image;
use DB;
use Storage;

class MyHelper
{
    public static function hasAccess($granted, $features){
        foreach($granted as $g){
            if(!is_array($features)) $features = session('granted_features');
            if(in_array($g, $features)) return true;
        }

        return false;
    }

    public static function encodeImage($image){
        $size   = $image->getSize();
        $encoded;
        if( $size < 90000000 ) {
            $encoded = base64_encode(fread(fopen($image, "r"), filesize($image)));
        }
        else {
            return false;
        }

        return $encoded;
    }

    // upload Image to AWS
    public static function uploadPhotoAWS($foto, $path, $resize=1000, $name=null, $ext=null) {
        // kalo ada foto
        $decoded = base64_decode($foto);
        //dd($decoded);

        // cek extension
        if (!isset($ext)) {
            $ext = MyHelper::checkExtensionImageBase64($decoded);
        }

        // set picture name
        if($name != null)
            $pictName = $name.$ext;
        else
            $pictName = mt_rand(0, 1000).''.time().''.$ext;

        if(!File::exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }

        // path
        $upload = $path.$pictName;


        $img    = Image::make($decoded);

        $width  = $img->width();
        $height = $img->height();

        if($width > 1000){
            $img->resize(1000, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }

        $img->resize($resize, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        if(env('STORAGE') &&  env('STORAGE') == 's3'){
            $resource = $img->stream()->detach();

            $save = Storage::disk('s3')->put($upload, $resource, 'public');
            if ($save) {
                    $result = [
                        'status' => 'success',
                        'path'  => $upload
                    ];
            }
            else {
                $result = [
                    'status' => 'fail'
                ];
            }
        } else{
			if (!$img->save($upload)) {
				return response()->json([
	                'status'     => 'fail',
	                'messages'   => ['Upload image gagal']
	            ]);
			}

            $result = [
                'status' => 'success',
                'path'  => $upload
            ];
        }
        return $result;
    }

    public static function uploadImagePublic($dir){
        $target_dir = $dir;
        $target_file = public_path(). $target_dir .basename($_FILES["photo"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["photo"]["tmp_name"]);
            if($check == false) {
                return  ['status' => 'fail', 'message' => "File is not an image."];
            }
        }

        // // Check if file already exists
        // if (file_exists($target_file)) {
        //     unlink($target_file);
        // }

        // Check file size
        if ($_FILES["photo"]["size"] > 500000) {
            return  ['status' => 'fail', 'message' => "Sorry, your file is too large."];
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            return  ['status' => 'fail', 'message' => "Sorry, only JPG, JPEG, PNG & GIF files are allowed."];
        }

        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            return  ['status' => 'success', 'filename' => $target_dir .basename($_FILES["photo"]["name"]), 'message' => "The file has been uploaded."];
        } else {
            return  ['status' => 'fail', 'message' => "Sorry, there was an error uploading your file."];
        }
    
    }

    // check extension untuk gambar type base 64
	public static function checkExtensionImageBase64($imgdata){
        $f = finfo_open();
        $imagetype = finfo_buffer($f, $imgdata, FILEINFO_MIME_TYPE);

        if(empty($imagetype)) return '.jpg';
        switch($imagetype)
        {
            case 'image/bmp': return '.bmp';
            case 'image/cis-cod': return '.cod';
            case 'image/gif': return '.gif';
            case 'image/ief': return '.ief';
            case 'image/jpeg': return '.jpg';
            case 'image/pipeg': return '.jfif';
            case 'image/tiff': return '.tif';
            case 'image/x-cmu-raster': return '.ras';
            case 'image/x-cmx': return '.cmx';
            case 'image/x-icon': return '.ico';
            case 'image/x-portable-anymap': return '.pnm';
            case 'image/x-portable-bitmap': return '.pbm';
            case 'image/x-portable-graymap': return '.pgm';
            case 'image/x-portable-pixmap': return '.ppm';
            case 'image/x-rgb': return '.rgb';
            case 'image/x-xbitmap': return '.xbm';
            case 'image/x-xpixmap': return '.xpm';
            case 'image/x-xwindowdump': return '.xwd';
            case 'image/png': return '.png';
            case 'image/x-jps': return '.jps';
            case 'image/x-freehand': return '.fh';
            default: return false;
        }
    }

    // untuk enkrip slug
    public static function encSlug ($id)
    {
        // create random char awal 1-9
        $randfirst = self::createrandom(1, null, '123456789');

        // bikin switch case untuk char 1-9
        switch($randfirst) {
        case 1: $firstRand  = self::createrandom(3, null, '123456789');
            $lastRand   = self::createrandom(4, null, '123456789');
            break;
        case 2: $firstRand  = self::createrandom(2, null, '123456789');
            $lastRand   = self::createrandom(3, null, '123456789');
            break;
        case 3: $firstRand  = self::createrandom(4, null, '123456789');
            $lastRand   = self::createrandom(4, null, '123456789');
            break;
        case 4: $firstRand  = self::createrandom(1, null, '123456789');
            $lastRand   = self::createrandom(4, null, '123456789');
            break;
        case 5: $firstRand  = self::createrandom(5, null, '123456789');
            $lastRand   = self::createrandom(1, null, '123456789');
            break;
        case 6: $firstRand  = self::createrandom(3, null, '123456789');
            $lastRand   = self::createrandom(3, null, '123456789');
            break;
        case 7: $firstRand  = self::createrandom(2, null, '123456789');
            $lastRand   = self::createrandom(4, null, '123456789');
            break;
        case 8: $firstRand  = self::createrandom(3, null, '123456789');
            $lastRand   = self::createrandom(2, null, '123456789');
            break;
        case 9: $firstRand  = self::createrandom(2, null, '123456789');
            $lastRand   = self::createrandom(2, null, '123456789');
            break;
        }
        return $randfirst . implode('', [$firstRand, $id, $lastRand]);
    }

    // untuk dekrip slug
    public static function decSlug ($id)
    {
        // ambil char pertama
        $randfirst = substr($id, 0, 1);

        // hilangkan char pertama
        $id = substr($id, 1);

        // bikin switch case untuk char 1-9
        switch($randfirst) {
        case 1: $firstString = substr($id, 3);
            $string = substr($firstString, 0, -4);
            break;
        case 2: $firstString = substr($id, 2);
            $string = substr($firstString, 0, -3);
            break;
        case 3: $firstString = substr($id, 4);
            $string = substr($firstString, 0, -4);
            break;
        case 4: $firstString = substr($id, 1);
            $string = substr($firstString, 0, -4);
            break;
        case 5: $firstString = substr($id, 5);
            $string = substr($firstString, 0, -1);
            break;
        case 6: $firstString = substr($id, 3);
            $string = substr($firstString, 0, -3);
            break;
        case 7: $firstString = substr($id, 2);
            $string = substr($firstString, 0, -4);
            break;
        case 8: $firstString = substr($id, 3);
            $string = substr($firstString, 0, -2);
            break;
        case 9: $firstString = substr($id, 2);
            $string = substr($firstString, 0, -2);
            break;
        }
        return $string;
    }

    // create random
    public static function createrandom($digit, $custom = null, $chars = null) {
        if ($chars == null)
        $chars = "abcdefghjkmnpqrstuvwxyzBCDEFGHJKLMNPQRSTUVWXYZ12356789";

        if($custom != null){
            if($custom == 'Angka')
                $chars = "0123456789";
            if($custom == 'Besar Angka')
                $chars = "BCDEFGHJKLMNPQRSTUVWXYZ12356789";
            if($custom == 'Kecil Angka')
                $chars = "abcdefghjkmnpqrstuvwxyz123456789";
            if($custom == 'Kecil')
                $chars = "abcdefghjkmnpqrstuvwxyz";
            if($custom == 'Besar')
                $chars = "ABCDEFGHJKLMNPQRSTUVWXYZ";
            if ($custom == 'PromoCode')
                $chars = "ABCDEFGHJKLMNPQRTUVWXY23456789";
        }
        $i = 0;
        $generatedstring = '';
        $tmp = '';

        while ($i < $digit) {
            $charsbaru = str_replace($tmp, "", $chars);
            $num = rand() % strlen($charsbaru);
            $tmp = substr($charsbaru, $num, 1);
            $generatedstring = $generatedstring . $tmp;
            $i++;
        }

        return $generatedstring;
    }

}
?>
