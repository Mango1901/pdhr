<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaternityLeave extends Model
{
    use HasFactory;

    protected $primaryKey="id";

    protected $fillable=[
      "user_id","employee_id","start_date","end_date",'company_id'
    ];

    protected $table="maternity_leaves";
}
