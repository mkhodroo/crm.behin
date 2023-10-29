<?php 

namespace Mkhodroo\UserRoles\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mkhodroo\UserRoles\Models\Access;
use Mkhodroo\UserRoles\Models\Role;

class GetRoleController extends Controller
{
    function listForm() {
        return view('URPackageView::roles.list');
    }

    function list() {
        return [
            'data' => Role::get(),
        ];
    }

    public static function getAll() {
        return Role::get();
    }


    function get(Request $r) {
        return view('URPackageView::roles.edit')->with([
            'role' => Role::find($r->id),
            'methods' => GetMethodsController::getByRoleAccess($r->id),
        ]);
    }

    function edit(Request $r) {
        foreach(GetMethodsController::getAll() as $method){
            Access::updateOrCreate(
                [
                    'role_id' => $r->role_id,
                    'method_id' => $method->id
                ],
                [
                    'access' => $r->input("$method->id") ? 1 : 0
                ]
            );
        }
        return response('ok');
    }

    function changeUserRole(Request $r) {
        User::where('id', $r->user_id)->update([
            'role_id' => $r->role_id
        ]);
        return response('ok');
    }

    public static function getByName($name){
        return Role::where('name', $name)->first();
    }
}