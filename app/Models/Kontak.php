<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    use HasFactory;


    protected $table = 'tb_kontak';

    protected $fillable = [
        'id_kontak',
        'id_user',
        'nomor_hp_kontak',
        'email_kontak'
    ];
}
