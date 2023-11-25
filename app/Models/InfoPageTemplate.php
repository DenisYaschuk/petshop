<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoPageTemplate extends Model
{
    use HasFactory;

    public function template()
    {
        return $this->hasMany(InfoPage::class);
    }
}