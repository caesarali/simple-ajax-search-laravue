<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Code;
use DateTime;

class Transaction extends Model
{
    use Code;

    protected $fillable = ['customer_id', 'user_id', 'amount', 'start_date', 'end_date', 'status'];
    protected $dates = ['start_date', 'end_date'];
    protected $codes = ['prefix' => 'TRX-', 'length' => 3];
    protected $appends = ['days'];

    public function getStartDateAttribute($value) {
        return date('d/m/Y', strtotime($value));
    }

    public function getEndDateAttribute($value) {
        return date('d/m/Y', strtotime($value));
    }

    public function getDaysAttribute() {
        $start = new DateTime($this->getOriginal('start_date'));
        $end = new DateTime($this->getOriginal('end_date'));
        return $start->diff($end)->d;
    }

    public function details() {
        return $this->hasMany(DetailTransaction::class, 'transaction_id', 'id');
    }

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
