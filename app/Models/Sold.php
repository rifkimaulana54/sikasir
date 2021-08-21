<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sold extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $casts = ['tanggal' => 'date'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function menu()
    {
        return $this->belongsTo('App\Models\Menu');
    }
}
