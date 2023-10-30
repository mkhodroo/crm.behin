<?php

namespace Mkhodroo\AgencyInfo\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mkhodroo\AgencyInfo\Models\AgencyInfo;
use Mkhodroo\Cities\Controllers\CityController;
use Mkhodroo\DateConvertor\Controllers\SDate;

class AgencyListController extends Controller
{
    public static function view()
    {
        return view('AgencyView::list');
    }

    public static function list()
    {
        return [
            'data' => []
        ];
    }
    public static function filterList(Request $r)
    {
        $main_field = config('agency_info.main_field_name');
        if($r->field_value === null and $r->$main_field === null){
            $agencies =  AgencyInfo::where('parent_id', DB::raw('id'))->get();
        }else{
            if($r->field_value == null){
                $agencies =  AgencyInfo::where('value', $r->$main_field)->groupBy('parent_id')->get();
            }
            elseif($r->$main_field == null){
                $agencies =  AgencyInfo::where('value', 'like', "%". $r->field_value. "%")->groupBy('parent_id')->get();
            }else{
                $parent_ids =  AgencyInfo::where('value', 'like', "%". $r->field_value. "%")->groupBy('parent_id')->pluck('parent_id');
                $agencies = AgencyInfo::whereIn('id', $parent_ids)->where('value', $r->$main_field)->groupBy('parent_id')->get();
            }
            

        }
        // return $agencies;
        $agencies =  $agencies->each(function ($agency) {
            $agency->file_number = GetAgencyController::getByKey($agency->parent_id, 'file_number')?->value;
            $agency->firstname = GetAgencyController::getByKey($agency->parent_id, 'firstname')?->value;
            $agency->lastname = GetAgencyController::getByKey($agency->parent_id, 'lastname')?->value;
            $agency->customer_type = __(GetAgencyController::getByKey($agency->parent_id, 'customer_type')?->value);
            $agency->catagory = __(GetAgencyController::getByKey($agency->parent_id, 'catagory')?->value);
            $agency->national_id = GetAgencyController::getByKey($agency->parent_id, 'national_id')?->value;
            $agency->status = GetAgencyController::getByKey($agency->parent_id, 'status')?->value;
            $agency->province_detail = CityController::getById(GetAgencyController::getByKey($agency->parent_id, 'province')?->value);
            $agency->created_at = (new SDate())->toShaDate(explode(" ", $agency->created_at)[0]);

        });
        return ['data' => $agencies];
    }

}
