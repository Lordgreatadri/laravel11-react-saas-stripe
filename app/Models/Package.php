<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;

class Package extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'credits'];

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }
}
