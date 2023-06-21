<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectDisetujuiAdmin extends Model
{
    use HasFactory;

    protected $table = 'projectdisetujuiadmin';
    protected $fillable = ['namaclient', 'namaproject', 'progressproject', 'hargaproject', 'dokumenpendukung', 'deadline', 'estimasi'];
}
