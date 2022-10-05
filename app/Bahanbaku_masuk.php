<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bahanbaku_masuk extends Model
{
    use HasFactory;
    use \App\Traits\TraitUuid;
    protected $table = 'bahanbaku_masuks';

    public function bahanbaku()
    {
        return $this->belongsTo(Bahanbaku::class, 'bahanbakus_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'suppliers_id', 'id');
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class, 'periodes_id', 'id');
    }
}
