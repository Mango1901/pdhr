<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSalaryHisotry extends Model
{
    use HasFactory;

    protected $primaryKey ="id";

    protected $fillable=[
      "user_id","salary_value","employee_id","start_date","end_date",'company_id'
    ];

    protected $table = "employee_salary_histories";
}
