<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ListaTareas;

class Fotos extends Model
{
        use hasfactory;
        protected $guarded=[];
        public $timestamps = false;
        protected $table = 'tareas_fotos';

        public function fotos()
        {
            return $this->belongsTo(ListaTareas::class);
        }
    
}