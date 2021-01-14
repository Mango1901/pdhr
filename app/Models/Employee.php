<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable=[
      'user_id','full_name','date_of_birth','phone_number','address','company_id',"ID_card","avatar","salary_id","salary_value","in_date","out_date","insurance_id","status"
    ];

    protected $table="employees";

    public function User(){
        return $this->belongsTo(User::class,"user_id","id");
    }

    public function Salary(){
        return $this->belongsTo(Salary::class,"salary_id","id");
    }

    public function Insurance(){
        return $this->belongsTo(Insurance::class,"insurance_id","id");
    }
    public function OtherSalary(){
        return $this->belongsTo(OtherSalary::class,"other_salary_id","id");
    }
}
