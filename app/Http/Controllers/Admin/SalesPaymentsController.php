<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tax;
use App\Models\SalesPayment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SalesPayment\CreateSalesPaymentRequest;
use App\Http\Requests\Admin\SalesPayment\UpdateSalesPaymentRequest;
use App\Models\SalesOrder;
use App\Models\Report;

class SalesPaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salesPayments = SalesPayment::latest()->get();
        //dd($payments);
        //dd($payments->purchaseOrder);
        return view('Admin.salesPayments.index', compact('salesPayments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $salesOrders = SalesOrder::all();
        return view('Admin.salesPayments.create', compact('salesOrders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSalesPaymentRequest $request)
    {
        $total = SalesPayment::where('so_id', $request->input('so_id'))->orderBy('created_at', 'DESC')->first();

        $salesPayment = new SalesPayment;
        $salesPayment->so_id = $request->input('so_id');
        $salesPayment->payment_type = $request->input('payment_type');
        $salesPayment->user_id = auth()->user()->id;
        $salesPayment->paid = $request->input('paid');
        $remaining = $total->remaining - $salesPayment->paid;
        if ($remaining < 0) {
            return redirect(route('admin.salesPayments.create'))->withErrors('You have Paid More Than The Needed');
        }
        //dd($request->hasFile('file_attachment'));
        if ($request->file_attachment) {
            $image = $request->file_attachment;
            $image_new_name = time() . $image->getClientOriginalName();
            $image->move(public_path('attachment'), $image_new_name);
            $salesPayment->file_attachment = '/attachment/' . $image_new_name;
        }
        $salesPayment->remaining = $remaining;
        $salesPayment->comments = $request->input('comments');
        $salesPayment->save();

        $paymentReport = new Report;
        $paymentReport->amount = $salesPayment->paid;
        $paymentReport->payment_type = $salesPayment->payment_type;
        $paymentReport->status = 'in';
        $paymentReport->type = 'sales_payment';
        $paymentReport->entity_id = $salesPayment->id;
        $paymentReport->save();

        return redirect(route('admin.salesPayments.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $salesPayment = SalesPayment::findOrFail($id);
        return view(('Admin.salesPayments.show'), compact('salesPayment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     $salesPayment = SalesPayment::findOrFail($id);
    //     return view(('Admin.salesPayments.edit'), compact('salesPayment'));
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(UpdateSalesPaymentRequest $request, $id)
    // {
    //     $total = SalesOrder::where('id', $request->input('so_id'))->first();
    //     $salesPayment = SalesPayment::findOrFail($id);
    //     $salesPayment->so_id = $request->input('so_id');
    //     $salesPayment->payment_type = $request->input('payment_type');
    //     $salesPayment->user_id = auth()->user()->id;
    //     $salesPayment->paid = $request->input('paid');
    //     $remaining = $total->remaining - $salesPayment->paid;
    //     if ($remaining < 0) {
    //         return redirect(route('admin.payments.edit', ['salesPayment' => $salesPayment->id]))->withErrors('You have Paid More Than The Needed');
    //     }
    //     //dd($request->hasFile('file_attachment'));
    //     if ($request->file_attachment) {
    //         $image = $request->file_attachment;
    //         $image_new_name = time() . $image->getClientOriginalName();
    //         $image->move(public_path('attachment'), $image_new_name);
    //         $salesPayment->file_attachment = '/attachment/' . $image_new_name;
    //     }

    //     $salesPayment->remaining = $remaining;
    //     $salesPayment->comments = $request->input('comments');
    //     $salesPayment->save();
    //     return redirect(route('admin.salesPayments.index'));
    // }

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
