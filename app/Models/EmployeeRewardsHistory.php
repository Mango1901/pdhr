<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeRewardsHistory extends Model
{
    use HasFactory;

    protected $primaryKey = "id";

    protected $fillable=[
      "user_id","employee_id","rewards_id",'company_id'
    ];

    protected $table="employee_rewards_histories";

    public function Reward(){
        return $this->belongsTo(Reward::class,"rewards_id","id");
    }
}
