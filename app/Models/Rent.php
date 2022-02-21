<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    protected $table = 'rents';
    public $timestamps = false;
    protected $fillable = [
        'total_amount', 'pick_amount', 'book_amount', 'book_date', 'pick_date', 'deliver_date', 'penalty_amount', 'comment', 'status', 'customer_id', 'item_id'
    ];
    protected $appends = [
        'over_due'
    ];

    public function getOverDueAttribute()
    {
        if(Carbon::parse($this->attributes['deliver_date'])->lt(Carbon::now()))
        {
            return 'Danger';
        }else{
            return 'Safe';
        }
    }

    public function attachments()
    {
        return $this->hasMany(RentAttachment::class, 'rent_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
}
