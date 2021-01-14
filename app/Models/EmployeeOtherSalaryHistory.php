<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeOtherSalaryHistory extends Model
{
    use HasFactory;

    protected $primaryKey="id";

    protected $fillable=[
      'user_id','employee_id','other_salary_id','company_id',"value","start_date","end_date"
    ];

    protected $table="employee_other_salary_histories";

    public function OtherSalary(){
        return $this->belongsTo(OtherSalary::class,"other_salary_id","id");
    }
}
