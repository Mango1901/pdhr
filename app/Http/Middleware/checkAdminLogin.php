<?php

namespace App\Http\Middleware;

use App\Models\Employee;
use App\Models\EmployeeOtherSalary;
use App\Models\EmployeeOtherSalaryHistory;
use App\Models\TimeSheet;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class checkAdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check())
        {
            $user = Auth::user();

            $now = Carbon::now();
            // nếu level =1 (admin), status = 1 (actived) thì cho qua.
            if ($user->active == 1 && $user->status == 0)
            {
                $getAllEmployee = Employee::orderby("id","ASC")->where("company_id",Auth::user()->company_id)->get();
                foreach($getAllEmployee as $employees){
                    $array[] = $employees->id;
                }
                if(isset($array)){
                   foreach($array as $employeeId){
                       $checkTimeSheetExist = TimeSheet::wheredate("created_at",date("Y-m-d"))->where("employee_id",$employeeId)->where("company_id",Auth::user()->company_id)->first();
                       if(!$checkTimeSheetExist){
                                $createTimeSheet = new TimeSheet();
                                $createTimeSheet->create([
                                   "user_id"=>Auth::user()->id,"employee_id"=>$employeeId,"company_id"=>Auth::user()->company_id
                                ]);
                       }
                       $getAllEmployeeOtherSalary = EmployeeOtherSalary::orderBy("id","DESC")->where("employee_id",$employeeId)->where("company_id",Auth::user()->company_id)->get();
                       $checkEmployeeOtherSalaryHistory = EmployeeOtherSalaryHistory::where("employee_id",$employeeId)->whereYear('created_at', '=', $now->year)->whereMonth('created_at', '=', $now->month)->first();
                       if(!$checkEmployeeOtherSalaryHistory){
                           foreach($getAllEmployeeOtherSalary as $getAllEmployeeOtherSalaries){
                                   if($getAllEmployeeOtherSalaries->OtherSalary->value == 0){
                                       $value = NULL;
                                   }else{
                                       $value = $getAllEmployeeOtherSalaries->OtherSalary->value;
                                   }
                                   $createOtherSalaryHistory = new EmployeeOtherSalaryHistory();
                                   $createOtherSalaryHistory->create([
                                       "user_id"=>Auth::user()->id,"employee_id"=>$employeeId,"other_salary_id"=>$getAllEmployeeOtherSalaries->other_salary_id,"value"=>$value,"company_id"=>Auth::user()->company_id
                                   ]);
                           }
                       }
                   }
                }

                return $next($request);
            }
            else
            {
                Auth::logout();
                return redirect('login')->with('error','Your account did not have permission to login');
            }
        } else
            return redirect('login')->with("error","Please login to go to the dashboard");
    }
}
