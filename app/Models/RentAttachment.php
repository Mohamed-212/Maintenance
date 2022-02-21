<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class RentAttachment extends Model
{
    protected $table = 'rent_attachments';
    public $timestamps = false;
    protected $fillable = [
        'attach_url', 'item_id'
    ];
}
