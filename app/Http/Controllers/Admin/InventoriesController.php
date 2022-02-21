<?php

namespace App\Http\Controllers\Admin;

use App\Models\Employee;
use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Inventory\CreateInventoryRequest;
use App\Http\Requests\Admin\Inventory\UpdateInventoryRequest;

class InventoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventories = Inventory::latest()->get();

        return view('Admin.inventories.index', compact('inventories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::all();
        return view('Admin.inventories.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateInventoryRequest $request)
    {
        //dd($request->all());
        $inventory = Inventory::create($request->all());
        return redirect(route('admin.inventories.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $inventory = Inventory::findOrFail($id);
        $employees = Employee::all();
        $item_inventories = Inventory::join('inventory_item','inventory_item.inventory_id','=','inventories.id')
        ->select('inventory_item.item_id','inventory_item.quantity','inventory_item.unit','inventory_item.av_cost','inventory_item.inventory_id')
        ->where('inventory_item.inventory_id',$id)->get();

        return view('Admin.inventories.show', compact('employees', 'inventory','item_inventories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $inventory = Inventory::findOrFail($id);
        $employees = Employee::all();
        return view('Admin.inventories.edit', compact('employees', 'inventory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInventoryRequest $request, $id)
    {

        $inventory = Inventory::findOrFail($id);
        $inventory->update($request->all());
        return redirect(route('admin.inventories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inventory = Inventory::findOrFail($id);
        $inventory->delete();
        return back();
    }
}
