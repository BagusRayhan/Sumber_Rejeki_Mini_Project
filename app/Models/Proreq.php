<?php

namespace App\Models;

use App\Models\Bank;
use App\Models\Chat;
use App\Models\Fitur;
use App\Models\EWallet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Proreq extends Model
{
    protected $table = "proreq";
    protected $primarykey = "id";
    protected $dates = ['estimasi'];
    protected $fillable = [
        'id', 'nama', 'napro','progress','dokumen','estimasi','deadline','status','harga','biayatambahan','alasan','listrevisi','statusbayar','metodepembayaran','metode','buktipembayaran','tanggalpembayaran','status2','metodeRefund','layananRefund','nomorRefund','buktiRefund','webaddress','ipaddress','repository','adminemail','adminpassword','cpanelusername','cpanelpassword'
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

    public function notification() {
        return $this->hasMany(Notification::class, 'project_id');
    }
}
