<?php

namespace Mkhodroo\AgencyInfo\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mkhodroo\AgencyInfo\Models\AgencyInfo;

class AgencyDocsController extends Controller
{
    

    public static function docsEdit(Request $r)
    {
        $agency_fields =  AgencyInfo::where('parent_id', $r->id)->get();
        $data = $r->except('id');
        foreach ($data as $key => $value) {
            $value = FileController::store($r->file($key));
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
}
