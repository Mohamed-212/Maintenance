<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Models\Item;
use App\Models\Supplier;
use App\Models\Inventory;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use App\Models\Report;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PurchaseOrder\CreateRequest;


class PurchaseOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $purchaseOrders = PurchaseOrder::latest()->get();
        return view('Admin.purchaseOrders.index', compact('purchaseOrders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Supplier::all();
        $inventories = Inventory::all();
        $items = Item::all();
        return view('Admin.purchaseOrders.create', compact('suppliers', 'inventories', 'items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $total = 0;

        //dd($request->input('item_id'));
        $purchaseorder = new PurchaseOrder;
        $purchaseorder->supplier_id = $request->input('supplier_id');
        $purchaseorder->inventory_id = $request->input('inventory_id');
        $purchaseorder->expected_on = $request->input('expected_on');
        $purchaseorder->paid = $request->input('paid');
        $purchaseorder->comments = $request->input('comments');
        $purchaseorder->payment_type = $request->input('payment_type');

        $purchaseorder->user_id = auth()->user()->id;
        foreach ($request->input('item_id') as $key => $value) {
            $item = Item::Find($value);
            foreach ($request->input('quantity') as $index => $row) {
                foreach ($request->input('cost') as $costIndex => $cost) {

                    if ($key == $index && $index == $costIndex) {
                        if ($key != 0) {
                            //dd($key);
                        }
                        $total += $row * $cost;
                        $purchaseorder->total_amount = $total;
                        $purchaseorder->remaining = $total - $request->input('paid');
                        $purchaseorder->save();
                        $purchaseorder->items()->attach($item->id, ['quantity' => $row, 'cost' => $cost]);

                        $stock = DB::table('inventory_item')->where('inventory_id', $purchaseorder->inventory_id)->where('item_id', $item->id)->first();
                        //dd($stock);
                        if ($stock) {
                            $oldcost = $stock->quantity * $stock->av_cost;
                            $comingcost = $row * $cost;
                            $av_total = $oldcost + $comingcost;
                            $stock->quantity += $row;
                            $av_cost = $av_total / $stock->quantity;
                            $stock = DB::table('inventory_item')->where('inventory_id', $purchaseorder->inventory_id)->where('item_id', $item->id)->update(['quantity' => $stock->quantity, 'av_cost' => $av_cost]);
                        } else {
                            $stockQtn = $row;
                            $stockAvCost = $cost;
                            $stockInventory = $purchaseorder->inventory_id;
                            $stockItem = $item->id;
                            $stockItemUnit = $item->unit;

                            DB::table('inventory_item')->insert(
                                array(
                                    'inventory_id' => $stockInventory,
                                    'item_id' => $stockItem,
                                    'unit' => $stockItemUnit,
                                    'quantity' => $stockQtn,
                                    'av_cost' => $stockAvCost
                                )
                            );
                        }
                    } else {
                        //dd($key, $index, $costIndex);
                    }
                }
            }
        }
        $payment = new Payment;
        $payment->po_id = $purchaseorder->id;
        $payment->paid = $purchaseorder->paid;
        $payment->remaining = $purchaseorder->remaining;
        $payment->comments = $purchaseorder->comments;
        $payment->user_id = $purchaseorder->user_id;
        $payment->payment_type = $request->input('payment_type');
        $payment->file_attachment = $request->input('file_attachment');
        $payment->save();

        $paymentReport = new Report;
        $paymentReport->amount = $payment->paid;
        $paymentReport->payment_type = $payment->payment_type;
        $paymentReport->status = 'out';
        $paymentReport->type = 'payment';
        $paymentReport->entity_id = $payment->id;
        $paymentReport->save();

        $PoReport = new Report;
        $PoReport->amount = $purchaseorder->total_amount;
        $PoReport->payment_type = $purchaseorder->payment_type;
        $PoReport->status = 'out';
        $PoReport->type = 'purchase_order';
        $PoReport->entity_id = $purchaseorder->id;
        $PoReport->save();

        return redirect(route('admin.purchaseOrders.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $purchaseorder=PurchaseOrder::find($id);
        $item_PurchaseOrders=PurchaseOrder::join('item_purchase_order','item_purchase_order.po_id','=','purchase_orders.id')
            ->join('suppliers','purchase_orders.supplier_id','=','suppliers.id')
            ->select('purchase_orders.id as purchase_id','purchase_orders.total_amount','purchase_orders.paid','purchase_orders.remaining','purchase_orders.user_id','purchase_orders.created_at as Date','item_purchase_order.item_id as item','item_purchase_order.quantity as quantity','item_purchase_order.cost as cost','item_purchase_order.return as return','suppliers.company_name as supplier_name')
            ->where('purchase_orders.id',$id)->get();
        return view('Admin.purchaseOrders.show',compact('purchaseorder','item_PurchaseOrders'));

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

    public function returns()
    {
        $purchaseOrders = PurchaseOrder::latest()->whereHas('returns')->get();
        return view('Admin.returnPurchaseOrders.index', compact('purchaseOrders'));
    }

    public function returnsCreate()
    {
        $purchaseOrders = PurchaseOrder::latest()->pluck('id');
        return view('Admin.returnPurchaseOrders.edit', compact('purchaseOrders'));
    }

    public function getItems($id)
    {
        $items = PurchaseOrder::with('items')->find($id);
        return response()->json([
            'data' => $items->items->toArray()
        ]);
    }

    public function returnsShow($id)
    {
        $purchaseOrder = PurchaseOrder::with('items')->find($id);
        return view('Admin.returnPurchaseOrders.show', compact('purchaseOrder'));
    }

    public function returnsStore(Request $request)
    {
        $items = PurchaseOrder::find($request->order_id);
            foreach ($items->items as $index => $item){
                if($request->return[$index] != null && $request->return[$index] > 0){
    
                    $nq = 0;
                    $stock = DB::table('inventory_item')->where('inventory_id', $items->inventory_id)->where('item_id', $item->id)->first();
                    $nq = $stock->quantity;
                    if ($stock) {
                        $oldcost = $stock->quantity * $stock->av_cost;
                        $comingcost = $request->return[$index] * $item->pivot->cost;
                        $av_total = $oldcost - $comingcost;
                        $nq -= $request->return[$index];
                        $av_cost = $av_total / $nq;
                        $stock = DB::table('inventory_item')->where('inventory_id', $items->inventory_id)->where('item_id', $item->id)->update(['quantity' => $nq, 'av_cost' => $av_cost]);
    
                        $item->pivot->return = $request->return[$index];
                        $item->pivot->comment = $request->comment;
                        $item->pivot->quantity = $item->pivot->quantity - $request->return[$index];
                        $item->pivot->updated_at = Carbon::now();
                        $item->pivot->save();
                    }
                }
            }
            if($request->total > 0){
               $items->updated_at = Carbon::now(); 
            }
            
            $total = Payment::where('po_id', $items->id)->orderBy('created_at', 'DESC')->first();
    
            if ($total->remaining > 0 && $request->total > 0) {
                if($total->remaining - $request->total == 0){
                    $payment = new Payment;
                    $payment->po_id = $items->id;
                    $payment->paid = $total->remaining;
                    $payment->remaining = 0;
                    $payment->comments = 'returned items';
                    $payment->user_id = $items->user_id;
                    $payment->payment_type = $items->payment_type;
                    $payment->save();
                }
                elseif($total->remaining - $request->total < 0){
                    $payment = new Payment;
                    $payment->po_id = $items->id;
                    $payment->paid = $total->remaining;
                    $payment->remaining = 0;
                    $payment->comments = 'returned items';
                    $payment->user_id = $items->user_id;
                    $payment->payment_type = $items->payment_type;
                    $payment->save();
                    
                    $items->total_return = $items->total_return + ($total->remaining - $request->total);
                    if($request->paid != null && $request->paid > 0){
                        $items->total_return = $items->total_return + $request->paid;
                        $paymentReport = new Report;
                        $paymentReport->amount = $request->paid;
                        $paymentReport->payment_type = $items->payment_type;
                        $paymentReport->status = 'in';
                        $paymentReport->type = 'refund_purchase_item';
                        $paymentReport->entity_id = $items->id;
                        $paymentReport->save();
                    }
                }else{
                    $payment = new Payment;
                    $payment->po_id = $items->id;
                    $payment->paid = $request->total;
                    $payment->remaining = $total->remaining - $request->total;
                    $payment->comments = 'returned items';
                    $payment->user_id = $items->user_id;
                    $payment->payment_type = $items->payment_type;
                    $payment->save();
                }
            }else{
                
                if($request->total > 0){
                    $items->total_return = $items->total_return + ($total->remaining - $request->total);
                    if($request->paid != null && $request->paid > 0){
                        $items->total_return = $items->total_return + $request->paid;
                        $paymentReport = new Report;
                        $paymentReport->amount = $request->paid;
                        $paymentReport->payment_type = $items->payment_type;
                        $paymentReport->status = 'in';
                        $paymentReport->type = 'refund_purchase_item';
                        $paymentReport->entity_id = $items->id;
                        $paymentReport->save();
                    }
                }
            }
            $items->save();
        return redirect()->route('admin.returns.index');
    }

}
