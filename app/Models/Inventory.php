<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = ['address', 'tel_no', 'emp_id','name'];

    public function employee()
    {
        return $this->belongsTo('App\Models\Employee','emp_id');
    }

    public function purchaseOrders()
    {
        return $this->hasMany('App\Models\PurchaseOrder');
    }

    public function items()
    {
        return $this->belongsToMany('App\Models\Item');
    }
    public static function boot() {
        parent::boot();

        static::deleting(function($inventory) { // before delete() method call this
             $inventory->items()->delete();
             // do the rest of the cleanup...
        });
    }
}
