<?php

namespace App\Http\Controllers\Admin;

use App\Models\Expense;
use App\Models\PurchaseOrder;
use App\Models\Report;
use App\Models\SalesOrder;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportsController extends Controller
{
    public function safe(Request $request)
    {
        $safes = Report::where('type', '!=', 'purchase_order')->orderBy('id', 'DESC');
        if($request->from && $request->to){
            $safes->where('created_at', '>=', date($request->from))->where('created_at', '<=', date($request->to));
        }
        if($request->status){
            $safes->where('status', $request->status);
        }
        $totalAmount = $safes->sum('amount');
        $safes = $safes->get();
        $cashIncome = 0;
        $cashOutcome = 0;
        $wireTransferOutcome = 0;
        $wireTransferIncome = 0;
        $checkIncome = 0;
        $checkOutcome = 0;
        foreach ($safes as $safe) {
            if ($safe->status == 'in') {

                if ($safe->payment_type == 'cash') {
                    $cashIncome += $safe->amount;
                } elseif ($safe->payment_type == 'check') {
                    $checkIncome += $safe->amount;
                }else{
                    $wireTransferIncome += $safe->amount;
                }
            } else {

                if ($safe->payment_type == 'cash') {
                    $cashOutcome += $safe->amount;
                } elseif ($safe->payment_type == 'check') {
                    $checkOutcome += $safe->amount;
                }else{
                    $wireTransferOutcome += $safe->amount;
                }
            }
        }
        $cashSafe = $cashIncome - $cashOutcome;
        $checkSafe = $checkIncome - $checkOutcome;
        $wireTransferSafe = $checkIncome - $checkOutcome;
        $currentSafe = $cashIncome + $checkIncome + $wireTransferIncome - $cashOutcome - $checkOutcome - $wireTransferOutcome;
        return view('Admin.Reports.safe', compact('safes', 'currentSafe', 'cashSafe', 'checkSafe', 'wireTransferSafe', 'totalAmount'));
    }
    public function safeCash(Request $request)
    {
        $safes = Report::where('type', '!=', 'purchase_order')->where('payment_type', 'cash')->orderBy('id', 'DESC');
        if($request->from && $request->to){
            $safes->where('created_at', '>=', date($request->from))->where('created_at', '<=', date($request->to));
        }
        if($request->status){
            $safes->where('status', $request->status);
        }
        $totalAmount = $safes->sum('amount');
        $safes = $safes->get();
        return view('Admin.Reports.safeCash', compact('safes', 'totalAmount'));
    }
    public function safeCheck(Request $request)
    {
        $safes = Report::where('type', '!=', 'purchase_order')->where('payment_type', 'check')->orderBy('id', 'DESC');
        if($request->from && $request->to){
            $safes->where('created_at', '>=', date($request->from))->where('created_at', '<=', date($request->to));
        }
        if($request->status){
            $safes->where('status', $request->status);
        }
        $totalAmount = $safes->sum('amount');
        $safes = $safes->get();
        return view('Admin.Reports.safeCheck', compact('safes', 'totalAmount'));
    }
    public function safeWireTransfer(Request $request)
    {
        $safes = Report::where('type', '!=', 'purchase_order')->where('payment_type', 'wire_transfer')->orderBy('id', 'DESC');
        if($request->from && $request->to){
            $safes->where('created_at', '>=', date($request->from))->where('created_at', '<=', date($request->to));
        }
        if($request->status){
            $safes->where('status', $request->status);
        }
        $totalAmount = $safes->sum('amount');
        $safes = $safes->get();
        return view('Admin.Reports.safeWireTransfer', compact('safes', 'totalAmount'));
    }
    public function profits()
    {
        $total_in = 0;
        $total_out = 0;
        $reports = Report::where('type', '!=', 'payment')->get();
        foreach ($reports as  $value) {
            if ($value->status == 'in') {
                $total_in += $value->amount;
            }
            if ($value->status == 'out') {
                $total_out += $value->amount;
            }
            $total = $total_in - $total_out;
        }
        return view('Admin.Reports.profit', compact('reports', 'total'));
    }

    public function purchases(Request $request)
    {
        $purchaseOrders = PurchaseOrder::orderBy('id', 'DESC');
        if($request->from && $request->to){
            $purchaseOrders->where('created_at', '>=', date($request->from))->where('created_at', '<=', date($request->to));
        }
        $purchaseOrders = $purchaseOrders->get();
        return view('Admin.Reports.purchase', compact('purchaseOrders'));
    }

    public function expenses(Request $request)
    {
        $expenses = Expense::orderBy('id', 'DESC');
        if($request->from && $request->to){
            $expenses->where('created_at', '>=', date($request->from))->where('created_at', '<=', date($request->to));
        }
        $expenses = $expenses->get();
        return view('Admin.Reports.expenses', compact('expenses'));
    }

    public function returns(Request $request)
    {
        $purchaseOrders = PurchaseOrder::orderBy('id', 'DESC')->whereHas('returns');
        if($request->from && $request->to){
            $purchaseOrders->where('updated_at', '>=', date($request->from))->where('updated_at', '<=', date($request->to));
        }
        $purchaseOrders = $purchaseOrders->get();
        return view('Admin.Reports.returnPurchase', compact('purchaseOrders'));
    }

    public function sales(Request $request)
    {
        $salesorders = SalesOrder::orderBy('id', 'DESC');
        if($request->from && $request->to){
            $salesorders->where('created_at', '>=', date($request->from))->where('created_at', '<=', date($request->to));
        }
        if($request->cat){
            $catID = $request->cat;
            $salesorders->whereHas('items', function ($q) use ($catID){
                $q->where('sub_category_id', $catID);
            });
        }
        $salesorders = $salesorders->get();
        $subCats = SubCategory::orderBy('id', 'DESC')->get();
        return view('Admin.Reports.sales', compact(['salesorders', 'subCats']));
    }

    public function salesItem(Request $request)
    {
        $salesorders = SalesOrder::orderBy('id', 'DESC');
        if($request->from && $request->to){
            $salesorders->where('created_at', '>=', date($request->from))->where('created_at', '<=', date($request->to));
        }
        if($request->cat){
            $catID = $request->cat;
            $salesorders->whereHas('items', function ($q) use ($catID){
                $q->where('sub_category_id', $catID);
            });
        }
        $salesorders = $salesorders->get();
        $subCats = SubCategory::orderBy('id', 'DESC')->get();
        return view('Admin.Reports.salesItems', compact(['salesorders', 'subCats']));
    }
}
