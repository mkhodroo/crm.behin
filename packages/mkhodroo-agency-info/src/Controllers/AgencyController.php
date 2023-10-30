<?php

namespace Mkhodroo\AgencyInfo\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mkhodroo\AgencyInfo\Models\AgencyInfo;

class AgencyController extends Controller
{
    public static function view($parent_id)
    {
        $agency_fields =  AgencyInfo::where('parent_id', $parent_id)->get();
        return view('AgencyView::edit')->with(['agency_fields' => $agency_fields]);
    }

    public static function edit(Request $r)
    {
        $agency_fields =  AgencyInfo::where('parent_id', $r->id)->get();
        $data = $r->except('id');
        foreach ($data as $key => $value) {
            $row = $agency_fields->where('key', $key)->first();
            if ($row) {
                $row->update([
                    'value' => $value
                ]);
            } else {
                $row = new AgencyInfo();
                $row->key = $key;
                $row->value = $value;
                $row->parent_id = $r->id;
                $row->save();
            }
        }
        return $agency_fields->first();
        // return view('AgencyView::edit')->with([ 'agency_fields' => $agency_fields ]);
    }

    public static function finEdit(Request $r)
    {
        $agency_fields =  AgencyInfo::where('parent_id', $r->id)->get();
        $data = $r->except('id');
        foreach ($data as $key => $value) {
            //files
            if(gettype($r->$key) === 'object'){
                $value = FileController::store($r->file($key), config('agency_info.fin_uploads'));
            }
            $row = $agency_fields->where('key', $key)->first();
            if ($row) {
                $row->update([
                    'value' => str_replace(',', '', $value)
                ]);
            } else {
                $row = new AgencyInfo();
                $row->key = $key;
                $row->value = str_replace(',', '', $value);
                $row->parent_id = $r->id;
                $row->save();
            }
        }
        return $agency_fields->first();
        // return view('AgencyView::edit')->with([ 'agency_fields' => $agency_fields ]);
    }

    public static function create($parent_id, $key, $value, $des = null)
    {
        AgencyInfo::updateOrCreate(
            [
                'key' => $key,
                'parent_id' => $parent_id,
            ],
            [
                'value' => $value,
                'description' => $des
            ]
        );
    }

    public static function deleteByKey(Request $r){
        $row = GetAgencyController::getByKey($r->parent_id, $r->key);
        $row->delete();
        return $row;
    }
}
