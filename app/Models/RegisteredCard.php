<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RegisteredCard extends Model
{
    use HasFactory;
    
    protected $fillable = ['card_id','nim', 'name', 'prodi', 'tgl_lahir'];

}
