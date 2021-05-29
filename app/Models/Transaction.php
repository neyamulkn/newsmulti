<?php

namespace App\Models;

use App\Admin;
use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = [];

  
    public function paymentGateway(){
        return $this->belongsTo(PaymentGateway::class, 'payment_method');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function addedBy(){
        return $this->belongsTo(User::class, 'created_by');
    }
}
