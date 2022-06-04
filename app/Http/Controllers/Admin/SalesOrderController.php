<?php

namespace App\Http\Controllers\Admin;

use App\Models\Item;
use App\Models\Report;
use App\Models\SalesPayment;
use App\Models\Customer;
use App\Models\SalesOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SalesOrder\CreateRequest;

class SalesOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salesorders = SalesOrder::orderBy('id', 'DESC')->get();
        return view('Admin.salesOrders.index', compact('salesorders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        $items = Item::join('inventory_item','inventory_item.item_id','=','items.id')
        ->where('inventory_item.quantity','!=',0)->select('items.*')->get();
        return view('Admin.salesOrders.create', compact('customers', 'items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        //dd($request->input('remaining'));

        if($request->input('name')||$request->input('mobile')){
            $request->validate([
                'name' => 'required',
                'mobile' => 'required|size:11|regex:/(01)[0-9]{9}/|unique:customers,mobile',
            ]);
            $customer =Customer::insertGetId(['name' => $request->name, 'mobile' => $request->mobile]);
        }
        $subTotal = 0;
        $tax = 0;
        $total = 0;
        //dd($request->input('item_id'));
        $salesorder = new SalesOrder;
        if($request->input('customer_id')){
            $salesorder->customer_id = $request->input('customer_id');
        }
        elseif ($request->input('name') && $request->input('mobile')){
            $salesorder->customer_id = $customer;
        }

        $salesorder->payment_type = $request->input('payment_type');
        $salesorder->paid = $request->input('paid');
        $salesorder->expected_on = $request->input('expected_on');
        $salesorder->user_id = auth()->user()->id;
        foreach ($request->input('item_id') as $key => $value) {
            $item = Item::Find($value);
            foreach ($request->input('quantity') as $index => $row) {
                if ($key == $index) {
                    $subTotal += $row * $item->price;
                    $tax += $item->price * $row * $item->category->tax->percentage / 100;
                    $total = $subTotal + $tax;
                    $salesorder->sub_total_amount = $subTotal;
                    $salesorder->total_taxes = $tax;
                    $salesorder->total_amount = $total;
                    $salesorder->remaining = $total - $request->input('paid');
                    $salesorder->save();
                    $salesorder->items()->attach($item->id, ['quantity' => $row]);

                    $stock = DB::table('inventory_item')->where('item_id', $item->id)->first();
                    if ($row > $stock->quantity) {
                        $salesorder->delete();
                        return redirect(route('admin.salesOrders.create'))->with('error', __('general.no_data'));
                    } else {
                        $stock->quantity -= $row;
                        $stock = DB::table('inventory_item')->where('item_id', $item->id)->update(['quantity' => $stock->quantity]);
                    }
                }
            }
        }
        $salesPayment = new SalesPayment;
        $salesPayment->so_id = $salesorder->id;
        $salesPayment->paid = $salesorder->paid;
        $salesPayment->remaining = $salesorder->remaining;
        $salesPayment->comments = $salesorder->comments;
        $salesPayment->user_id = $salesorder->user_id;
        $salesPayment->payment_type = $request->input('payment_type');
        $salesPayment->file_attachment = $request->input('file_attachment');
        $salesPayment->save();

        $paymentReport = new Report;
        $paymentReport->amount = $salesPayment->paid;
        $paymentReport->payment_type = $salesPayment->payment_type;
        $paymentReport->status = 'in';
        $paymentReport->type = 'sales_payment';
        $paymentReport->entity_id = $salesPayment->id;
        $paymentReport->save();

//        $report = new Report;
//        $report->entity_id = $salesorder->id;
//        $report->type = 'sales_order';
//        $report->status = 'in';
//        $report->payment_type = $salesorder->payment_type;
//        $report->amount = $salesorder->total_amount;
//        $report->save();

        return redirect(route('admin.salesOrders.index'));
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
        $ids = SalesPayment::where('so_id', $id)->pluck('id')->toArray();
        Report::where('type', 'sales_payment')->whereIn('entity_id', $ids)->delete();
        $all_quantity = DB::table('item_sales_order')->where('so_id', $id)->get();
        foreach($all_quantity as $oneItem){
            $old_quantity = DB::table('inventory_item')->where('item_id', $oneItem->item_id)->first();
            DB::table('inventory_item')->where('item_id', $oneItem->item_id)->update(['quantity' => $old_quantity->quantity + $oneItem->quantity]);
        }
        DB::table('item_sales_order')->where('so_id', $id)->delete();
        SalesPayment::where('so_id', $id)->delete();
        SalesOrder::where('id', $id)->delete();
        return redirect(route('admin.salesOrders.index'));
    }
}
