<?php

namespace App\Models;

use App\Models\Bank;
use App\Models\Chat;
use App\Models\Fitur;
use App\Models\EWallet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class proreq extends Model
{
    protected $table = "proreq";
    protected $primarykey = "id";
    protected $guard = "proreq";
    // protected $fillable = [
    //     'id', 'nama', 'napro','dokumen','estimasi','estimasi','deadline','status','harga','alasan','statusbayar'
    // ];

        public function fitur()
    {
        return $this->hasMany(Fitur::class);
    }

    public function projectchat() {
        return $this->hasMany(Chat::class);
    }

    public function bank()
    {
        return $this->hasMany(Bank::class);
    }

    public function ewallet()
    {
        return $this->hasMany(EWallet::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
