<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Developer extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'desenvolvedores';
    protected $fillable = ['nome', 'sexo',  'hobby', 'datanascimento'];

    public function getIdadeAttribute()
    {
        return Carbon::parse($this->datanascimento)->age;
    }
    
    public function getIdade()
    {
        return Carbon::parse($this->datanascimento)->age;
    }

    public function scopeIdade()
    {
        return Carbon::parse($this->datanascimento)->age;
    }
}
