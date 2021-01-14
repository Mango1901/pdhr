<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSheet extends Model
{
    use HasFactory;

    protected $primaryKey="id";

    protected $fillable=[
      "user_id","employee_id","in_date","out_date",'company_id',"status"
    ];

    protected $table="time_sheets";

    public function Employee(){
        return $this->belongsTo(Employee::class,"employee_id","id");
    }
}
