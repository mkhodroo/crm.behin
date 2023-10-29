<?php 

namespace Mkhodroo\UserRoles\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Mkhodroo\UserRoles\Models\Access;
use Mkhodroo\UserRoles\Models\Method;

class AccessController extends Controller
{
    private $method_name;
    public function __construct(string $method_name) {
        $this->method_name = $method_name;
    }

    function check() {
        $method = Method::where('name', $this->method_name)->first();
        if(!$method){
            $method = Method::create([
                'name' => $this->method_name,
                'disable' => 1
            ]);
        }
        return Access::where('role_id', Auth::user()?->role_id)->where('method_id', $method->id)->first()?->access;
    }
}