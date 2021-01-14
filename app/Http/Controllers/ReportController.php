<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeOtherSalary;
use App\Models\EmployeeOtherSalaryHistory;
use App\Repository\DepartmentEmployeeRepository;
use App\Repository\EmployeeOtherSalaryHistoryRepository;
use App\Repository\DepartmentRepository;
use App\Repository\EmployeeOtherSalaryRepository;
use App\Repository\EmployeeRepository;
use App\Repository\EmployeeRewardHistoryRepository;
use App\Repository\OtherSalaryRepository;
use App\Repository\RewardsRepository;
use App\Repository\SalaryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ReportController extends Controller
{
    protected $_employeesRepository;
    protected $_SalaryRepository;
    protected $_OtherSalaryRepository;
    protected $_RewardsRepository;
    protected $_DepartmentRepository;
    protected $_EmployeeOtherSalaryRepository;
    protected $_EmployeeRewardsHistoryRepository;
    protected $_DepartmentEmployeeRepository;
    protected $_EmployeeOtherSalaryHistoryRepository;

    public function __construct(EmployeeRepository $employeeRepository, SalaryRepository $salaryRepository,
                                OtherSalaryRepository $otherSalaryRepository, RewardsRepository $rewardsRepository,
                                DepartmentRepository $departmentRepository, EmployeeOtherSalaryRepository $employeeOtherSalaryRepository,
                                EmployeeRewardHistoryRepository $employeeRewardHistoryRepository,
                                DepartmentEmployeeRepository $departmentEmployeeRepository,EmployeeOtherSalaryHistoryRepository $employeeOtherSalaryHistoryRepository)
    {
        $this->_employeesRepository = $employeeRepository;
        $this->_SalaryRepository = $salaryRepository;
        $this->_OtherSalaryRepository = $otherSalaryRepository;
        $this->_RewardsRepository = $rewardsRepository;
        $this->_DepartmentRepository = $departmentRepository;
        $this->_EmployeeOtherSalaryRepository = $employeeOtherSalaryRepository;
        $this->_EmployeeRewardsHistoryRepository = $employeeRewardHistoryRepository;
        $this->_DepartmentEmployeeRepository = $departmentEmployeeRepository;
        $this->_EmployeeOtherSalaryHistoryRepository = $employeeOtherSalaryHistoryRepository;

    }

    public function getReport(Request $request){
        \Debugbar::startMeasure('render','Time for rendering');
        \Debugbar::stopMeasure("render");
        $requestData = $request->all();
        if(isset($requestData["search_account_report"])){
            $getAllEmployees = $this->_employeesRepository->getAllEmployeeBySearchReport($requestData["search_account_report"],Auth::user()->company_id);
        }else{
            $getAllEmployees = $this->_employeesRepository->getAllEmployee(Auth::user()->company_id);
        }
        $getAllSalary = $this->_SalaryRepository->getAllSalary(Auth::user()->company_id);
        $getOtherSalary = $this->_OtherSalaryRepository->getAllOtherSalary(Auth::user()->company_id);
        $getRewards = $this->_RewardsRepository->getAllRewards(Auth::user()->company_id);
        $getAllEmployeeRewardsHistory = $this->_EmployeeRewardsHistoryRepository->getAllEmployeeRewards(Auth::user()->company_id);
        $getDepartmentEmployee = $this->_DepartmentEmployeeRepository->getDepartmentEmployee(Auth::user()->company_id);
            $getAllOtherEmployeeSalaryHistory = $this->_EmployeeOtherSalaryHistoryRepository->getAllEmployeeOtherSalaryHistory(Auth::user()->company_id);
        $getAllOtherEmployeeSalaryHistoryWithStatus = $this->_EmployeeOtherSalaryHistoryRepository->getAllEmployeeOtherSalaryHistoryWithoutStatus(Auth::user()->company_id);
        return view("Report.view",compact("getAllEmployees","getAllSalary","getOtherSalary","getRewards","getAllEmployeeRewardsHistory","getDepartmentEmployee","getAllOtherEmployeeSalaryHistory","getAllOtherEmployeeSalaryHistoryWithStatus"));
    }

    public function UpdateReport(Request $request,$id){
        $requestData = $request->all();

        $rewards = array();

        if(isset($requestData["other_rewards"])){
            $rewards[] = $requestData["other_rewards"];
            if ($this->_EmployeeRewardsHistoryRepository->CheckEmployeeRewardsExists($id, Auth::user()->company_id)) {
                $this->_EmployeeRewardsHistoryRepository->DeleteEmployeeRewards($id, Auth::user()->company_id);
            }
            foreach($rewards as $reward){
                foreach($reward as $rewards1){
                    $this->_EmployeeRewardsHistoryRepository->createEmployeeRewards(Auth::user()->id,$id,$rewards1,Auth::user()->company_id);
                }
            }
        }else{
            if ($this->_EmployeeRewardsHistoryRepository->CheckEmployeeRewardsExists($id, Auth::user()->company_id)) {
                $this->_EmployeeRewardsHistoryRepository->DeleteEmployeeRewards($id, Auth::user()->company_id);
            }
        }
        if(isset($requestData["other_salary"])) {

            $otherSalary = array();
            $otherSalary[] = $requestData["other_salary"];
            $checkValue = $this->_EmployeeOtherSalaryHistoryRepository->getEmployeeOtherSalaryHistoryByEmployeeId($id, Auth::user()->company_id);
            foreach ($checkValue as $values) {
                $checkExistOtherSalary[] = (int)$values->other_salary_id;
            }

            foreach($otherSalary as $salaries) {
                foreach ($salaries as $salary) {
                    foreach ($checkValue as $values) {
                        if ($values->other_salary_id != $salary) {
                            $this->_EmployeeOtherSalaryHistoryRepository->DeleteEmployeeOtherSalaryHistoryByOtherSalary($id, $values->other_salary_id, Auth::user()->company_id);
                        }
                    }
                }
            }
            foreach($otherSalary as $salaries){
                foreach($salaries as $salary) {
                        if(in_array($salary,$checkExistOtherSalary)){
                            foreach ($checkValue as $values) {
                            if ($values->value != NULL) {
                                $this->_EmployeeOtherSalaryHistoryRepository->ActiveEmployeeOtherSalaryHistoryByOtherSalary($id, $salary, Auth::user()->company_id);
                            } else {
                                if (isset($requestData["value"])) {
                                    $value = $requestData["value"];
                                } else {
                                    $value = NULL;
                                }
                                $this->_EmployeeOtherSalaryHistoryRepository->UpdateEmployeeOtherSalaryValue($id, $salary, $value, Auth::user()->company_id);
                              }
                            }
                        }else{
                        $otherSalaryValue = $this->_OtherSalaryRepository->GetValueFromEmployee($salary,Auth::user()->company_id);
                            if (isset($requestData["value"])) {
                                $value = $requestData["value"];
                            } else {
                                $value = $otherSalaryValue->value;
                            }
                        $this->_EmployeeOtherSalaryHistoryRepository->updateEmployeeOtherSalaryHistory(Auth::user()->id,$id,$salary,$value,Auth::user()->company_id);
                    }
                }
            }
        }else{
            $checkValue = $this->_EmployeeOtherSalaryHistoryRepository->getEmployeeOtherSalaryHistoryByEmployeeId($id, Auth::user()->company_id);
            if($checkValue){
                $this->_EmployeeOtherSalaryHistoryRepository->DeleteEmployeeOtherSalaryHistory($id,Auth::user()->company_id);
            }
        }
           Session::put("value",NULL);
           return redirect(route("report.view"))->with("message","update successfully");
    }
    public function printValue(Request $request){
        $requestData = $request->all();
        if($requestData['action'] == 'checkNull'){
            $print_text_value = $this->_OtherSalaryRepository->getEditOtherSalary($requestData["other_salary_id"]);
            if($print_text_value->value == 0){
                echo '<input type="checkbox" checked onclick="return false;" name="other_salary[]" value="'.$print_text_value->id.'" required/>NULL';
                echo '<input type="number" name="value" class="form-control pt-3" value="" required/>';
            }
        }
    }
}
