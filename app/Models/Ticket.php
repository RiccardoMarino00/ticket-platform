<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //
    public function operator()
    {
        return $this->belongsTo(Operator::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
