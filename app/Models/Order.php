<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'status',
        'total'
    ];

    public function getInvoiceNoAttribute()
    {
        return '#' . str_pad($this->id, 6, '0', STR_PAD_LEFT);
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }

    public function getStatusOrderAttribute()
    {
        if ($this->deleted_at != null) {
            return '<div class="badge badge-danger">Cancelled</span>';
        }

        if ($this->status == 'pending') {
            return '<div class="badge badge-warning">Pending</span>';
        } else if ($this->status == 'completed') {
            return '<div class="badge badge-success">Completed</span>';
            return 'Success';
        }
    }
}
