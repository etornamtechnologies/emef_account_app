<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Expendicture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ExpendictureController extends Controller
{
    public function index(Request $request)
    {
        $expendictures = Expendicture::when($request->query('filter'), function($query){
            $query->where('payee_name', $request->query('filter'));
        })->with(['expendicture_type'])
        ->get();   
        return response()->json(['code'=> 200, 'expendictures'=> $expendictures]);        
    }

    

    public function store(Request $request)
    {
        $res = [];
        $entries = $request->all();
        try{
            foreach($entries as $entry) {
                $expendictures = Expendicture::create([
                    'payment_date'=> new Carbon($entry['payment_date']),
                    'payee_name'=> $entry['payee_name'],
                    'pv_no'=> $entry['pv_no'],
                    'code'=> $entry['code'],
                    'expendicture_type_id'=> $entry['expendicture_type_id'],
                    'amount'=> $entry['amount'],
                    'tax'=> $entry['tax'],
                    'net'=> $entry['net'],
                    'cheque_no'=> $entry['cheque_no'],
                    'tax_status'=> $entry['tax_status']
                ]);
            }
            $res['code'] = 200;
            $res['expendictures'] = Expendicture::all();
            $res['message'] = "Successful";
        } catch(Exception $e) {
            $res['code'] = 500;
            $res['message'] = "Server error";
        }
        return response()->json($res);
    }



    public function update(Request $request, $id)
    {
        $expendicture = Expendicture::where('id', $id)->update([
            'payment_date'=> new Carbon($request['payment_date']),
            'payee_name'=> $request['payee_name'],
            'pv_no'=> $request['pv_no'],
            'code'=> $request['code'],
            'expendicture_type_id'=> $request['expendicture_type_id'],
            'amount'=> $request['amount'],
            'tax'=> $request['tax'],
            'net'=> $request['net'],
            'cheque_no'=> $request['cheque_no'],
            'tax_status'=> $request['tax_status']
        ]);
        $res['code'] = 200;
        $res['expendicture'] = $expendicture;
        $res['message'] = "Successful";
    }

    public function destroy($id)
    {
        Expendicture::destroy($id);
        return response()->json(['code'=>200, 'message'=>'Delete successful']);
    }
}
