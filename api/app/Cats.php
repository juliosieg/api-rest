<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cats extends Model
{
    public $timestamps = false;

    protected $primaryKey = null;

    public $incrementing = false;

    protected $fillable = [
        'id',
        'weight_imperial',
        'weight_metric',
        'name',
        'cfa_url',
        'vetstreet_url', 
        'vcahospitals_url',
        'temperament',
        'origin',
        'country_codes',
        'country_code',
        'description',
        'life_span',
        'indoor',
        'lap',
        'alt_names',
        'adaptability',
        'affection_level',
        'child_friendly',
        'dog_friendly',
        'energy_level',
        'grooming',
        'health_issues',
        'intelligence',
        'shedding_level',
        'social_needs',
        'stranger_friendly',
        'vocalisation',
        'experimental',
        'hairless',
        'natural',
        'rare',
        'rex',
        'suppressed_tail',
        'short_legs',
        'wikipedia_url',
        'hypoallergenic'
    ];
    
    protected $table = 'cats';
}
