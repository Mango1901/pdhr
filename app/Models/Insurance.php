<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    use HasFactory;

    protected $primaryKey="id";

    protected $fillable=[
      "user_id","percent","date",'company_id'
    ];

    protected $table="insurances";
}
