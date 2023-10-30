<?php 

namespace Mkhodroo\AgencyInfo\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FileController extends Controller
{
    public static function store($file, $dir = 'docs'){
        $name = Str::random(40) . '.' . $file->getClientOriginalExtension();
        $full_path = public_path($dir);
        if ( ! is_dir($full_path)) {
            mkdir($full_path);
        }
        $full_name = $full_path . '/' . $name;
        $result = move_uploaded_file($file,$full_name);
        if($result){
            return $dir . '/' . $name;
        }
        // $a = Storage::disk('ticket')->put($ticket_id,$file);
        // $return_path = "/public". config('ATConfig.ticket-uploads-folder') . "/$a";
        // return $return_path;
    }
}
