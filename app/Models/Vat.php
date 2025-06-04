<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Vat extends Model
{
    protected $table = 'vat_numbers';

    public $fillable = [
        'custom_id',
        'number',
        'country_code',
        'is_valid',
        'status',
    ];

    public function scopeSearch(Builder $query, string $status): void
    {
        $query->where('status', $status);
    }
}
