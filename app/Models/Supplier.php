<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'material_type',
        'quantity',
    ];

    protected $casts = [
        'quantity' => 'integer',
    ];

    public function getMaterialTypeDisplayAttribute()
    {
        return match($this->material_type) {
            'clt' => 'CLT',
            'glt' => 'GLT',
            default => $this->material_type,
        };
    }
}