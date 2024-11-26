<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //
    protected $fillable = [
        'title',
        'description',

    ];
    public function operator()
    {
        return $this->belongsTo(Operator::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
