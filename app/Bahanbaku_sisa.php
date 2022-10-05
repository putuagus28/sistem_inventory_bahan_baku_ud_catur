<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bahanbaku_sisa extends Model
{
    use HasFactory;
    use \App\Traits\TraitUuid;
    protected $table = 'bahanbaku_sisas';

    public function bahanbaku()
    {
        return $this->belongsTo(Bahanbaku::class, 'bahanbakus_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function produksi()
    {
        return $this->belongsTo(Produksi::class, 'produksis_id', 'id');
    }
}
