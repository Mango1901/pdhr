<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeOtherSalary extends Model
{
    use HasFactory;

    protected $primaryKey="id";

    protected $fillable=[
      "user_id","employee_id","other_salary_id",'company_id'
    ];

    protected $table="employee_other_salaries";

    public function OtherSalary(){
        return $this->belongsTo(OtherSalary::class,"other_salary_id","id");
    }
}
