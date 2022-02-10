<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;
    // protected $table = 'customers';
    protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\Models\User')->select('id','name','email');

    }
}
