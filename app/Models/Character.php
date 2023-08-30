<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    
    use HasFactory;
    protected $fillable =[
    'image' => 'mimes:jpeg,jpng,png|max:10240',
    'name',
    'status',
    'species',
    'type',
    'gender',
    'origin',
    'location',
    'episode',
    'url',
    'created'];
}
