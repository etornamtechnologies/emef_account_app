<?php

namespace App\Http\Controllers;

use App\Revenue;
use Carbon\Carbon;
use App\RevenueType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RevenueController extends Controller
{
    public function index(Request $request)
    {
        $revenues = Revenue::with(['revenue_type'])->get();      
        return response()->json(['code'=> 200, 'revenues'=> $revenues]);        
    }

    

    public function store(Request $request)
    {
        $res = [];
        $entries = $request->all();
        try{
            foreach($entries as $entry) {
                $revenues = Revenue::create([
                    'date'=> new Carbon($entry['date']),
                    'payee_name'=> $entry['payee_name'],
                    'registration_no'=> $entry['registration_no'],
                    'revenue_type_id'=> $entry['revenue_type_id'],
                    'amount'=> $entry['amount']
                ]);
            }
            $res['code'] = 200;
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
        $request->validate([
            'registration_no'=> 'required'
        ]);
        try{
            $revenue = Revenue::where('id', $id)->update([
                'date'=> new Carbon($request['date']),
                'payee_name'=> $request['payee_name'],
                'registration_no'=> $request['registration_no'],
                'revenue_type_id'=> $request['revenue_type_id'],
                'amount'=> $request['amount']
            ]);
            $res['code'] = 200;
            $res['revenues'] = Revenue::with(['revenue_type'])->get();
            $res['message'] = "Successful";
        } catch(Exception $e) {
            $res['code'] = 500;
            $res['message'] = "Server error";
        }
        return response()->json($res);
    }

    public function destroy($id)
    {
        Revenue::destroy($id);
        return response()->json(['code'=>200, 'message'=>'Delete successful']);
    }
}
