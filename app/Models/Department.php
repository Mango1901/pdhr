<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $primaryKey = "id";

    protected $fillable=[
      "user_id",'name','description','company_id'
    ];

    protected $table = "departments";
}
