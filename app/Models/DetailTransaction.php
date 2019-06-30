<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{
    protected $fillable = ['transaction_id', 'type_id', 'qty', 'subtotal'];

    public function transaction() {
        return $this->belongsTo(Transaction::class);
    }

    public function type() {
        return $this->belongsTo(Type::class);
    }
}
