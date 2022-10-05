<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bahanbaku_keluar extends Model
{
    use HasFactory;
    use \App\Traits\TraitUuid;
    protected $table = 'bahanbaku_keluars';

    public function bahanbaku()
    {
        return $this->belongsTo(Bahanbaku::class, 'bahanbakus_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class, 'periodes_id', 'id');
    }

    public function produksi()
    {
        return $this->belongsTo(Produksi::class, 'produksis_id', 'id');
    }
}
