<?php

namespace App\Http\Controllers\Admin;

use App\Models\Loan;
use App\Models\Employee;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Loan\CreateLoanRequest;
use App\Http\Requests\Admin\Loan\UpdateLoanRequest;



class LoansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loans = Loan::latest()->get();
        return view('Admin.loans.index', compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::all();
        return view('Admin.loans.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateLoanRequest $request)
    {
        $loan = new Loan();
        $loan->payments = $request->input('payments');
        $loan->emp_id = $request->input('emp_id');
        $loan->loan_date = $request->input('loan_date');
        $loan->start_date = $request->input('start_date');
        $loan->total = $request->input('total');

        if ($request->input('comments')) {
            $loan->comments = $request->input('comments');
        }
        $loan->user_id = auth()->user()->id;
        $loan->save();

        $report = new Report;
        $report->amount = $loan->total;
        $report->payment_type = 'cash';
        $report->status = 'out';
        $report->type = 'loan';
        $report->entity_id = $loan->id;
        $report->save();

        return redirect(route('admin.loans.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employees = Employee::all();
        $loan = Loan::findOrFail($id);
        return view('Admin.loans.edit', compact('employees', 'loan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLoanRequest $request, $id)
    {
        $loan = Loan::findOrFail($id);
        $loan->payments = $request->input('payments');
        $loan->emp_id = $request->input('emp_id');
        $loan->loan_date = $request->input('loan_date');
        $loan->start_date = $request->input('start_date');
        $loan->total =  $request->input('total');

        if ($request->input('comments')) {
            $loan->comments = $request->input('comments');
        }

        $loan->user_id = auth()->user()->id;
        $loan->save();
        $report = Report::where('type', 'loan')->where('entity_id', $loan->id)->first();
        $report->amount = $loan->total;
        $report->payment_type = 'cash';
        $report->status = 'out';
        $report->save();
        return redirect(route('admin.loans.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        $loan = Loan::findOrFail($id);
//        $loan->delete();
//        return back();
    }
}
