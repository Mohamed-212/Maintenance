<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['name', 'job_id', 'salary', 'start_date'];

    public function job()
    {
        return $this->belongsTo('App\Models\Job');
    }

    public function inventories()
    {
        return $this->hasMany('App\Models\Inventory','emp_id');
    }

    public function salaries()
    {
        return $this->hasMany('App\Models\Salary');
    }
    public function loans()
    {
        return $this->hasMany('App\Models\Loan');
    }
    public static function boot() {
        parent::boot();

        static::deleting(function($employee) { // before delete() method call this
             $employee->inventories()->delete();
             // do the rest of the cleanup...
        });
    }
}
