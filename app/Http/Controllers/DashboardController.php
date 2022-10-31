<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            $supplier = DB::table('suppliers')
            ->select(DB::raw('COUNT(id) as sumOfSupplier'), DB::raw('DATE_FORMAT(created_at, "%M") as month'))
            ->whereBetween(DB::raw('DATE(created_at)'), [$request->supplierDate.'-01', '2022-12-31'])
            ->groupBy(DB::raw('DATE_FORMAT(created_at, "%M")'))
            ->orderBy('created_at', 'asc')
            ->get();
            return response()->json(['supplier'=> $supplier]);
        }
        return view('dashboard');
    }

}
