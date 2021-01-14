<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentEmployment extends Model
{
    use HasFactory;

    protected $primaryKey = "id";

    protected $fillable=[
      'user_id','department_id','employee_id','company_id'
    ];

    protected $table="department_employments";

    public function Department(){
        return $this->belongsTo(Department::class,"department_id","id");
    }
}
