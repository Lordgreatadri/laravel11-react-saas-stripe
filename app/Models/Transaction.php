<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Package;
use App\Models\User;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['credits', 'user_id', 'package_id', 'status', 'price', 'session_id'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
