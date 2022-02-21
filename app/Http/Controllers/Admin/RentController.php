<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use App\Models\Item;
use App\Models\Rent;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rents = Rent::query()->with(['item', 'customer']);
        if($request->from && $request->to){
            $rents->where('book_date', '<=', date($request->from))->where('deliver_date', '>=', date($request->from))
                ->orWhere(function ($query) use ($request){
                    $query->where('book_date', '<=', date($request->to))->where('deliver_date', '>=', date($request->to));
                })
                ->orWhere(function ($query) use ($request){
                    $query->where('book_date', '>=', date($request->from))->where('deliver_date', '<=', date($request->to));
                });
        }
        $rents = $rents->get();
        return view('Admin.rents.index', compact(['rents']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = Item::all();
        $customers = Customer::all();
        return view('Admin.rents.create', compact(['customers', 'items']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'total_amount' => 'required',
            'book_amount' => 'required',
            'book_date' => 'required',
            'pick_date' => 'required',
            'deliver_date' => 'required',
            'status' => 'required',
            'item_id' => 'required',
            'customer_id' => 'required',
        ]);
        $rent = new Rent();
        $rent->total_amount = $request->total_amount;
        $rent->book_amount = $request->book_amount;
        $rent->book_date = $request->book_date;
        $rent->pick_date = $request->pick_date;
        $rent->deliver_date = $request->deliver_date;
        $rent->item_id = $request->item_id;
        $rent->customer_id = $request->customer_id;
        $rent->status = $request->status;
        $rent->save();

        $report=new Report;
        $report->entity_id=$rent->id;
        $report->type='rent';
        $report->status='in';
        $report->payment_type='cash';
        $report->amount=$rent->book_amount;
        $report->save();

        return redirect(route('admin.rents.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function show(Rent $rent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function edit(Rent $rent)
    {
        return view('Admin.rents.edit', compact(['rent']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rent $rent)
    {
        if($rent->status == 'reserved'){
            $request->validate([
                'pick_amount' => 'required',
                'insurance_amount' => 'required',
                'attach_url' => 'required',
                'status' => 'required',
            ]);
            $rent->pick_amount = $request->pick_amount;
            $rent->insurance_amount = $request->insurance_amount;
            $rent->status = $request->status;
            $rent->save();
            $report=Report::where('type', 'rent')->where('entity_id',$rent->id)->first();
            $report->entity_id=$rent->id;
            $report->type='rent';
            $report->status='in';
            $report->payment_type='cash';
            $report->amount= ($report->amount + $rent->pick_amount);
            $report->save();

            $report=new Report;
            $report->entity_id=$rent->id;
            $report->type='insurance';
            $report->status='in';
            $report->payment_type='cash';
            $report->amount=$rent->insurance_amount;
            $report->save();

            foreach ($request->attach_url as $image) {
                $image_new_name = time() . $image->getClientOriginalName();
                $image->move(public_path('rent'), $image_new_name);
                DB::table('rent_attachments')->insert([
                    'attach_url' => '/rent/' . $image_new_name,
                    'rent_id' => $rent->id
                ]);
            }
        }
        elseif ($rent->status == 'taken'){
            $request->validate([
                'status' => 'required',
                'insurance_status' => 'required',
            ]);
            $rent->status = $request->status;
            $rent->insurance_status = $request->insurance_status;
            if($request->insurance_status == "return"){
                $report=Report;
                $report->entity_id=$rent->id;
                $report->type='refund_insurance';
                $report->status='out';
                $report->payment_type='cash';
                $report->amount=$rent->insurance_amount;
                $report->save();
            }


            if($request->has('penalty_amount')){
                $rent->penalty_amount = $request->penalty_amount;
                $report=Report::where('type', 'rent')->where('entity_id',$rent->id)->first();
                $report->entity_id=$rent->id;
                $report->type='rent';
                $report->status='in';
                $report->payment_type='cash';
                $report->amount= ($report->amount + $request->penalty_amount);
                $report->save();
            }
            if($request->has('comment')){
                $rent->comment = $request->comment;
            }
            $rent->save();
        }
        return redirect(route('admin.rents.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rent $rent)
    {
        //
    }

    public function checkDate($dateFrom, $dateTo, $dress, $id = null)
    {
        $rent = Rent::query();
        if($id != null){
            $rent->whereNot('id', $id);
        }

        $data = $rent->whereHas('item', function($query) use ($dress) {
            $query->where('id', $dress);
        })->where('book_date', '<=', date($dateFrom))->where('deliver_date', '>=', date($dateFrom))
            ->orWhere(function ($query) use ($dateFrom, $dateTo){
                $query->where('book_date', '<=', date($dateTo))->where('deliver_date', '>=', date($dateTo));
            })
            ->orWhere(function ($query) use ($dateFrom, $dateTo){
                $query->where('book_date', '>=', date($dateFrom))->where('deliver_date', '<=', date($dateTo));
            })->count();
        if($data > 0){
            $available = 'not';
        }else{
            $available = 'available';
        }
        return response()->json([
            'msg' => $available
        ]);
    }
}
