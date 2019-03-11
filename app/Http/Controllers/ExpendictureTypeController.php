<?php

namespace App\Http\Controllers;

use App\ExpendictureType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ExpendictureTypeController extends Controller
{
    public function index(Request $request)
    {
        $types = DB::table('expendicture_types')
                        ->when($request->query('filter'), function($query){
                            $query->where('label', $request->query('filter'));
                        })
                        ->get();      
        return response()->json(['code'=> 200, 'expendicture_types'=> $types]);                
    }


    public function store(Request $request)
    {
        $res = [];
        $entries = $request->all();
        try{
            foreach($entries as $entry) {
                $expendictureTypes = ExpendictureType::create([
                    'label'=> $entry['label']
                ]);
            }
            $res['code'] = 200;
            $res['expendicture_types'] = ExpendictureType::all();
            $res['message'] = "Successful";
        } catch(Exception $e) {
            $res['code'] = 500;
            $res['message'] = "Server error";
        }
        return response()->json($res);
    }



    public function update(Request $request, $id)
    {
        $res = [];
        try{
            $expendictureType = ExpendictureType::findOrFail($id);
            $expendictureType->label = $request->label;
            $expendictureType->update();
            $res['code'] = 200;
            $res['expendicture_type'] = $expendictureType;
            $res['message'] = "Successful";
        } catch(Exception $e) {
            $res['code'] = 500;
            $res['message'] = "Server error";
        }
        return response()->json($res);
    }

    public function destroy($id)
    {
        ExpendictureType::destroy($id);
        return response()->json(['code'=>200, 'message'=>"deleted successfuly"]);
    }
}
