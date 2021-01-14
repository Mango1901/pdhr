<?php

namespace App\Http\Controllers;

use App\Repository\DepartmentEmployeeRepository;
use App\Repository\DepartmentRepository;
use App\Repository\EmployeeOtherSalaryHistoryRepository;
use App\Repository\EmployeeOtherSalaryRepository;
use App\Repository\EmployeeRepository;
use App\Repository\InsuranceRepository;
use App\Repository\OtherSalaryRepository;
use App\Repository\SalaryRepository;
use App\Repository\UserRepository;
use App\Validation\Validation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    protected $_EmployeeRepository;
    protected $_UserRepository;
    protected $_SalaryRepository;
    protected $_InsuranceRepository;
    protected $_DepartmentRepository;
    protected $_DepartmentEmployeeRepository;
    protected $_OtherSalaryRepository;
    protected $_EmployeeOtherSalaryRepository;
    protected $_EmployeeOtherSalaryHistoryRepository;

    public function __construct(EmployeeRepository $employeeRepository,UserRepository $userRepository,SalaryRepository $salaryRepository,InsuranceRepository $insuranceRepository,DepartmentRepository $departmentRepository,DepartmentEmployeeRepository $departmentEmployeeRepository,OtherSalaryRepository $otherSalaryRepository,EmployeeOtherSalaryRepository $employeeOtherSalaryRepository,EmployeeOtherSalaryHistoryRepository $employeeOtherSalaryHistoryRepository)
    {
        $this->_EmployeeRepository = $employeeRepository;
        $this->_UserRepository = $userRepository;
        $this->_SalaryRepository = $salaryRepository;
        $this->_InsuranceRepository = $insuranceRepository;
        $this->_DepartmentRepository = $departmentRepository;
        $this->_DepartmentEmployeeRepository = $departmentEmployeeRepository;
        $this->_OtherSalaryRepository = $otherSalaryRepository;
        $this->_EmployeeOtherSalaryRepository = $employeeOtherSalaryRepository;
        $this->_EmployeeOtherSalaryHistoryRepository = $employeeOtherSalaryHistoryRepository;
    }

    public function getAllEmployee()
    {
        $getAllEmployee = $this->_EmployeeRepository->getAllEmployee(Auth::user()->company_id);
        $getAllUser = $this->_UserRepository->getAllUser(Auth::user()->company_id);
        $getAllSalary = $this->_SalaryRepository->getAllSalary(Auth::user()->company_id);
        $getAllInsurance = $this->_InsuranceRepository->getInsurance(Auth::user()->company_id);
        $getAllDepartment = $this->_DepartmentRepository->getAllDepartment(Auth::user()->company_id);
        $getAllOtherSalary = $this->_OtherSalaryRepository->getAllOtherSalary(Auth::user()->company_id);
        return view("Employee.view",compact("getAllEmployee","getAllUser","getAllSalary","getAllInsurance","getAllDepartment","getAllOtherSalary"));
    }

    public function createEmployee(Request $request)
    {
        $requestData = $request->all();
        if($requestData["insurance_id"] == 0){
            $requestData["insurance_id"] = NULL;
        }
        if(isset($requestData["out_date_checkbox"])){
            $requestData["out_date"] = $requestData["out_date_checkbox"];
        }
        if($requestData["out_date"] == 1){
            $requestData["out_date"] = NULL;
        }
        $validator = Validation::CreateEmployee($request);
        if ($validator->fails()) {
            return redirect(route('employee.view'))
                ->withErrors($validator)
                ->withInput();
        }
        $check_phone_number = $this->_EmployeeRepository->CheckPhoneExist(Auth::user()->company_id,$requestData["phone_number"]);
        $check_user_exists = $this->_EmployeeRepository->getEmployeeByUserId($requestData["user_id"],Auth::user()->company_id);
        $check_ID_card_exists = $this->_EmployeeRepository->CheckIdCardExist(Auth::user()->company_id,$requestData["ID_card"]);
        if($check_phone_number){
            return redirect(route("employee.view"))->with("error","This phone number had already been existed");
        }
        if($check_user_exists){
            return redirect(route("employee.view"))->with("error","This user had already been used by employees");
        }
        if($check_ID_card_exists){
            return redirect(route("employee.view"))->with("error","This ID card had already been used");
        }
        if(!isset($requestData["salary_value"])){
            $getSalaryValue = $this->_EmployeeRepository->getEmployeeBYSalaryId($requestData["salary_id"],Auth::user()->company_id);
            $requestData["salary_value"] = $getSalaryValue->Salary()->value;
        }
        if($request->hasFile("avatar")){
            $get_name_image = $request->file('avatar')->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.str::random(60).'.'.$request->file('avatar')->getClientOriginalExtension();
            $request->file('avatar')->move('storage/',$new_image);
            $this->_EmployeeRepository->CreateEmployee($requestData["user_id"],$requestData['full_name'],$requestData['date_of_birth'],$requestData['phone_number'],$requestData["ID_card"],$requestData["address"],Auth::user()->company_id
                ,$new_image,$requestData["salary_id"],$requestData["salary_value"],$requestData["in_date"],$requestData["out_date"],$requestData["insurance_id"]);
        }else{
            $this->_EmployeeRepository->CreateEmployeeWithoutAvatar($requestData["user_id"],$requestData['full_name'],$requestData['date_of_birth'],$requestData['phone_number'],$requestData["ID_card"],$requestData["address"],Auth::user()->company_id
                ,$requestData["salary_id"],$requestData["salary_value"],$requestData["in_date"],$requestData["out_date"],$requestData["insurance_id"]);
        }
        $getEmployeeById = $this->_EmployeeRepository->getEmployeeByUserId($requestData["user_id"],Auth::user()->company_id);
        $departments = array();
        $departments[] = $requestData["department_id"];
        foreach($departments as $department){
            foreach($department as $value){
                $this->_DepartmentEmployeeRepository->createDepartmentEmployee(Auth::user()->id,$value,$getEmployeeById->id,Auth::user()->company_id);
            }
        }
        $otherSalary = array();
        $otherSalary[] = $requestData["other_salary_id"];
        foreach($otherSalary as $otherSalaries){
            foreach($otherSalaries as $value){
                $this->_EmployeeOtherSalaryRepository->createEmployeeOtherSalary(Auth::user()->id,$getEmployeeById->id,$value,Auth::user()->company_id);
            }
        }
        return redirect(route("employee.view"))->with("message","create Employee successfully");
    }

    public function getEditEmployee(Request $request,$id)
    {
        $CheckEmployeeById = $this->_EmployeeRepository->getEmployeeById($id);
        if($CheckEmployeeById){
            if($request->user()->can("update",$CheckEmployeeById)){
                $getEmployeeById = $this->_EmployeeRepository->getEmployeeById($id);
                $getEditUser = $this->_UserRepository->getEditUser($CheckEmployeeById->user_id,Auth::user()->company_id);
                $getEditSalary = $this->_SalaryRepository->getEditSalary($CheckEmployeeById->salary_id,Auth::user()->company_id);
                if($CheckEmployeeById->insurance_id === NULL){
                    $getEditInsurance = $this->_InsuranceRepository->getEditInsurance(0,Auth::user()->company_id);
                }else{
                    $getEditInsurance = $this->_InsuranceRepository->getEditInsurance($CheckEmployeeById->insurance_id,Auth::user()->company_id);
                }
                $getDepartmentByEmployeeId = $this->_DepartmentEmployeeRepository->getDepartmentEditByEmployee($CheckEmployeeById->id,Auth::user()->company_id);
                $getAllDepartment = $this->_DepartmentRepository->getAllDepartment(Auth::user()->company_id);
                $getEmployeeOtherSalaryByEmployeeId = $this->_EmployeeOtherSalaryRepository->getEmployeeOtherSalaryByEmployeeId($CheckEmployeeById->id,Auth::user()->company_id);
                $getOtherSalary = $this->_OtherSalaryRepository->getAllOtherSalary(Auth::user()->company_id);
                return view("Employee.edit",compact("getEmployeeById","getEditUser","getEditSalary","getEditInsurance","getDepartmentByEmployeeId","getAllDepartment","getEmployeeOtherSalaryByEmployeeId","getOtherSalary"));
            }else{
                return redirect(route("employee.view"))->with("error","You did not have roles to do that function");
            }
        }
       return redirect(route("employee.view"))->with("error","this employee does not exist");
    }
    public function UpdateEmployee(Request $request,$id){
        $requestData = $request->all();


        if($requestData["insurance_id"] == 0){
            $requestData["insurance_id"] = NULL;
        }
        if(isset($requestData["out_date_checkbox"])){
            $requestData["out_date"] = $requestData["out_date_checkbox"];
        }
        if($requestData["out_date"] == 1){
            $requestData["out_date"] = NULL;
        }

        $validator = Validation::CreateEmployee($request);
        if ($validator->fails()) {
            return redirect(route('employee.edit',["id"=>$id]))
                ->withErrors($validator)
                ->withInput();
        }

        if($this->_EmployeeRepository->CheckPhoneUpdateExist($id,Auth::user()->company_id,$requestData["phone_number"])){
            return redirect(route("employee.edit",["id"=>$id]))->with("error","this phone number had already been existed");
        }
        if($this->_EmployeeRepository->CheckUserEditExist($id,$requestData["user_id"],Auth::user()->company_id)){
            return redirect(route("employee.edit",["id"=>$id]))->with("error","this phone number had already been existed");
        }
        if($this->_EmployeeRepository->CheckIdCardExistUpdate($id,Auth::user()->company_id,$request["ID_card"])){
            return redirect(route("employee.edit",["id"=>$id]))->with("error","this ID card had already been existed");
        }
        if($requestData["insurance_id"] == 0){
            $requestData["insurance_id"] = NULL;
        }
        if($request->hasFile("avatar")){
            $get_name_image = $request->file('avatar')->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.str::random(60).'.'.$request->file('avatar')->getClientOriginalExtension();
            $request->file('avatar')->move('storage/',$new_image);
            $this->_EmployeeRepository->UpdateEmployee($id,$requestData["user_id"],$requestData['full_name'],$requestData['date_of_birth'],$requestData['phone_number'],$requestData["ID_card"],$requestData["address"],$new_image,$requestData["salary_id"],$requestData["salary_value"],$requestData["in_date"],$requestData["out_date"],$requestData["insurance_id"]);
        }else{
            $this->_EmployeeRepository->UpdateEmployeeWithoutAvatar($id,$requestData["user_id"],$requestData['full_name'],$requestData['date_of_birth'],$requestData['phone_number'],$requestData["ID_card"],$requestData["address"],$requestData["salary_id"],$requestData["salary_value"],$requestData["in_date"],$requestData["out_date"],$requestData["insurance_id"]);
        }

        $getEmployeeBySalaryId = $this->_EmployeeRepository->getEmployeeBYSalaryId($requestData["salary_id"],Auth::user()->company_id);
        if(!isset($requestData["salary_value"])){
            $requestData["salary_value"] = $getEmployeeBySalaryId->Salary->value;
        }
        $getEmployeeById = $this->_EmployeeRepository->getEmployeeByUserId($requestData["user_id"],Auth::user()->company_id);
        $this->_DepartmentEmployeeRepository->DeleteDepartmentEmployee($getEmployeeById->id,Auth::user()->company_id);
        $this->_EmployeeOtherSalaryRepository->DeleteEmployeeOtherSalary($getEmployeeById->id,Auth::user()->company_id);
        $validator = Validation::createDepartmentEmployee($request);
        if ($validator->fails()) {
            return redirect(route('employee.edit',["id"=>$id]))
                ->withErrors($validator)
                ->withInput();
        }

        $departments = array();
        $departments[] = $requestData["department_id"];
        foreach($departments as $department){
            foreach($department as $value){
                $this->_DepartmentEmployeeRepository->createDepartmentEmployee(Auth::user()->id,$value,$getEmployeeById->id,Auth::user()->company_id);
            }
        }
        $otherSalary = array();
        $otherSalary[] = $requestData["other_salary_id"];
        foreach($otherSalary as $otherSalaries){
            foreach($otherSalaries as $value){
                $this->_EmployeeOtherSalaryRepository->createEmployeeOtherSalary(Auth::user()->id,$getEmployeeById->id,$value,Auth::user()->company_id);
            }
        }
        return redirect(route("employee.view"))->with("message","update Employee successfully");
    }

    public function DeleteEmployee(Request $request,$id){
        $getEmployeeById = $this->_EmployeeRepository->getEmployeeById($id);
        if($getEmployeeById){
            if($request->user()->can("delete",$getEmployeeById)){
                $this->_EmployeeRepository->DeleteEmployee($id,Auth::user()->company_id);
                return redirect(route("employee.view"))->with("message","Delete employee successfully");
            }else{
                return redirect(route("employee.view"))->with("error","You did not have roles to do that function");
            }
        }
        return redirect(route("employee.view"))->with("error","this employee does not exist");
    }

    public function printEmployee(Request $request){
        $requestData = $request->all();
        if($requestData['action'] == 'SalaryId'){
         $print_salary_value = $this->_SalaryRepository->getSalaryById($requestData["salary_id"]);
         if($print_salary_value->type == 0){
             echo '<input type="number" name="salary_value" readonly value="' .$print_salary_value->value . '"/>';
         }else{
             echo '<input type="number" name="salary_value" required/>';
         }

        }
    }
}
