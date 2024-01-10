<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountCon extends Controller
{
    public function index(){
        $parchase = Account::all();
        return response()->json(["data"=>$parchase]);
    }
    public function store(Request $request){
        $date = $request->input('date');
        $data = $request->input('sales_data'); // Assuming 'sales_data' is the key containing the array of data

        // Modify the 'date' value for each row in the data array
        foreach ($data as &$row) {
            $row['date'] = $date;
        }

        // Perform a single insert for all rows in the $data array
        DB::table('accounts')->insert($data);

        return response()->json(["data"=>$data,'message' => 'Sales data inserted successfully']);
    }
    public function report(Request $request) {
        $item = $request->input('item');
        $fromDate = $request->input('date');
        $toDate = $request->input('date');
        $query = Account::where('item', $item);

        if($item){
            $query->where('item', $item);
        }
        if($fromDate && $toDate){
            $query->whereBetween('parchase_date',[ $fromDate, $toDate]);
        }
        $totalCost = $query->sum('total');
        return response()->json(['totalPrice'=>$totalCost]);
    }
}
