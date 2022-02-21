<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesPayment extends Model
{
    protected $fillable = ['so_id', 'paid', 'remaining', 'file_attachment', 'comments', 'user_id', 'payment_type'];

    public function salesOrder()
    {
        return $this->belongsTo('App\Models\SalesOrder', 'so_id');
    }
}
