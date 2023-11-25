<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoPage extends Model
{
    use HasFactory;

    protected $table = 'info_pages';

    public function template()
    {
        return $this->belongsTo(InfoPageTemplate::class);
    }
}
