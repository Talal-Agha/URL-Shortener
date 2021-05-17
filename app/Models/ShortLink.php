<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShortLink extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'code', 'link', 'created_by'
    ];

    /**
     * Scope a query to only loggedin's user data.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
    */
    public function scopeOwn($query)
    {
        return $query->whereCreatedBy(Auth::id());
    }
}
