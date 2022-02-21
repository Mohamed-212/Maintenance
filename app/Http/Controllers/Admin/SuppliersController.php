<?php

namespace App\Http\Controllers\Admin;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use App\Models\Payment;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Supplier\CreateSupplierRequest;
use App\Http\Requests\Admin\Supplier\UpdateSupplierRequest;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::latest()->get();
        return view('Admin.suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSupplierRequest $request)
    {
        $supplier = Supplier::create($request->all());
        return redirect(route('admin.suppliers.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);
        $tpo = PurchaseOrder::where('supplier_id', $id)->count();
        $tr = PurchaseOrder::where('supplier_id', $id)->whereHas('returns')->count();
        $tt = PurchaseOrder::where('supplier_id', $id)->sum('total_amount');
        $ids = PurchaseOrder::where('supplier_id', $id)->pluck('id');
        $td = PurchaseOrder::where('supplier_id', $id)->where('total_return', '<', 0)->sum('total_return');
        $td = $td * -1;
        $tc = Payment::whereIn('po_id', $ids)->where('remaining', '>', 0)->sum('remaining');
        return view('Admin.suppliers.show', compact(['supplier', 'tpo', 'tr', 'tt', 'td', 'tc']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('Admin.suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSupplierRequest $request, $id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->update($request->all());
        return redirect(route('admin.suppliers.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        return back();
    }
}
