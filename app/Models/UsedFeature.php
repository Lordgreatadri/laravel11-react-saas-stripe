<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Feature;
use App\Models\User;

class UsedFeature extends Model
{
    use HasFactory;
    protected $fillable = ['credits', 'user_id', 'feature_id','data', 'used_at', 'result'];


    protected function casts() : array {
        return [
            'data' => 'array',
        ];
    }

    public function feature()
    {
        return $this->belongsTo(Feature::class, 'feature_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
