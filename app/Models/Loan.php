<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = ['emp_id', 'payments', 'actual', 'loan_date', 'start_date', 'total', 'comments', 'user_id', 'status'];

    public function employee()
    {
        return $this->belongsTo('App\Models\Employee', 'emp_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
