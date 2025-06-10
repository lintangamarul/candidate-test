<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BuildingPart extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'name',
        'building_part_type_id',
        'material_id',
        'supplier_id',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function buildingPartType(): BelongsTo
    {
        return $this->belongsTo(BuildingPartType::class);
    }

    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }
}