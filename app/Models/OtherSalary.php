<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherSalary extends Model
{
    use HasFactory;

    protected $primaryKey="id";

    protected $fillable=[
      "user_id","name","money","type","value",'company_id'
    ];

    protected $table="other_salaries";
}
