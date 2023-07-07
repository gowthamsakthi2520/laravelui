<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Services;
class Subservices extends Model
{
    use HasFactory;

    protected $table = 'subservices';

    protected $guarded = [];

    public function services(){
        return $this->belongsTo(Services::class,'service_id','id');
    }
}
