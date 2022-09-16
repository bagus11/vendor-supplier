<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suppliers;
use App\Models\Product;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Suppliers::all();
        return view('suppliers.supplier-index', ['suppliers' => $suppliers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('suppliers.supplier-create', ['products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplierName' => 'required',
            'supplierPhone' => 'numeric',
            'email' => 'email|unique:users',
            'supplierDescription' => 'required',
            'supplierNPWP' => 'required',
            'supplierSIUP' => 'required',
            'ProductId' => 'required'
        ]);
        if($validated) {
            // dd($request->supplierName);
            Suppliers::create([
                'supplierName' => $request->supplierName,
                'supplierPhone' => $request->supplierPhone,
                'email' => $request->email,
                'supplierDescription' => $request->supplierDescription,
                'supplierNPWP' => $request->supplierNPWP,
                'supplierNPWPFile' => 'dummy npwp file',
                'supplierSIUP' => $request->supplierSIUP,
                'supplierSIUPFile' => 'dummy siup file',
                'ProductId' => $request->ProductId,
            ]);
        }

        return redirect()->route('suppliers.index')->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
