<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livre extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'genre_id',
        'collection',
        'isbn',
        'released_date',
        'page_numbers',
        'emplacement',
        'statut'
    ];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}
