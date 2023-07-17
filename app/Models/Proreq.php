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
    protected $dates = ['estimasi'];
    protected $fillable = [
        'id', 'nama', 'napro','progress','dokumen','estimasi','deadline','status','harga','biayatambahan','alasan','statusbayar','metodepembayaran','metode','buktipembayaran','tanggalpembayaran'
    ];

        public function fitur()
    {
        return $this->hasMany(Fitur::class);
    }

    public function projectchat() {
        return $this->hasMany(Chat::class, 'project_id');
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
