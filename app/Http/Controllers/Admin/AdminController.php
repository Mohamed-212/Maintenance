<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\PurchaseOrder;
use App\Models\Rent;
use App\Models\SalesOrder;
use App\Models\SalesPayment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Admin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function dues()
    {
        $rents = Rent::where('status', 'taken')->where('deliver_date', '<=', Carbon::now())->get();
        $saleID = SalesPayment::where('remaining', 0)->pluck('so_id');
        $sales = SalesOrder::whereNotIn('id', $saleID)->where('expected_on', '<=', Carbon::now())->get();
        $purchaseID = Payment::where('remaining', 0)->pluck('po_id');
        $purchases = PurchaseOrder::whereNotIn('id', $purchaseID)->where('expected_on', '<=', Carbon::now())->get();
        return view('Admin.dues.index', compact(['rents', 'sales', 'purchases']));
    }
}
