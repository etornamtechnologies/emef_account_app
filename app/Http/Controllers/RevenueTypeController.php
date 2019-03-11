<?php

namespace App\Http\Controllers;

use App\RevenueType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RevenueTypeController extends Controller
{

    public function index(Request $request)
    {
        $types = DB::table('revenue_types')
                        ->when($request->query('filter'), function($query){
                            $query->where('label', $request->query('filter'));
                        })
                        ->get();      
        return response()->json(['code'=> 200, 'revenue_types'=> $types]);                
    }


    public function store(Request $request)
    {
        $res = [];
        $entries = $request->all();
        try{
            foreach($entries as $entry) {
                $revenueTypes = RevenueType::create([
                    'label'=> $entry['label']
                ]);
            }
            $res['code'] = 200;
            $res['revenue_types'] = RevenueType::all();
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
            $revenueType = RevenueType::findOrFail($id);
            $revenueType->label = $request->label;
            $revenueType->update();
            $res['code'] = 200;
            $res['revenue_type'] = $revenueType;
            $res['message'] = "Successful";
        } catch(Exception $e) {
            $res['code'] = 500;
            $res['message'] = "Server error";
        }
        return response()->json($res);
    }

    public function destroy($id)
    {
        RevenueType::destroy($id);
        return response()->json(['code'=>200, 'message'=>"deleted successfuly"]);
    }
}
