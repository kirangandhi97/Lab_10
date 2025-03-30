<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Well extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'well_name',
        'field_location',
        'depth_meters',
        'status',
        'production_bpd',
        'commissioned_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'depth_meters' => 'integer',
        'production_bpd' => 'decimal:2',
        'commissioned_date' => 'date',
    ];
}