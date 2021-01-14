<?php

namespace App\Http\Controllers;

use App\Repository\SalaryRepository;
use App\Validation\Validation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class SalaryController extends Controller
{
    protected $_SalaryRepository;

    public function __construct(SalaryRepository $salaryRepository) {
        $this->_SalaryRepository = $salaryRepository;
    }

    public function getSalary(){
        if(Gate::allows("is-admin")){
        $getAllSalary = $this->_SalaryRepository->getAllSalary(Auth::user()->company_id);
        return view("salary.view",compact("getAllSalary"));
        }
        abort(403);
    }

    public function createSalary(Request $request){
        $requestData = $request->all();
        $validator = Validation::CreateSalary($request);
        if ($validator->fails()) {
            return redirect(route('salary.view'))
                ->withErrors($validator)
                ->withInput();
        }
        $this->_SalaryRepository->createSalary(Auth::user()->id,Auth::user()->company_id,$requestData["name"],$requestData["level"],$requestData["value"],$requestData["type"]);
        return redirect(route("salary.view"))->with("message","Create Salary successfully");
    }

    public function getEditSalary(Request $request,$id){
        $salary = $this->_SalaryRepository->getSalaryById($id);
        if($request->user()->can("update",$salary)){
            $getEditSalary = $this->_SalaryRepository->getSalaryById($id);
            return view("salary.edit",compact("getEditSalary"));
        }
       return redirect(route("salary.view"))->with("error","you did not have roles to do that function");
    }

    public function UpdateSalary(Request $request,$id){
        $requestData = $request->all();
        $validator = Validation::CreateSalary($request);
        if ($validator->fails()) {
            return redirect(route('salary.edit',["id"=>$id]))
                ->withErrors($validator)
                ->withInput();
        }
        $this->_SalaryRepository->UpdateSalary($id,$requestData["name"],$requestData["level"],$requestData["value"],$requestData["type"]);
        return redirect(route("salary.view"))->with("message","update salary successfully");
    }

    public function DeleteSalary(Request $request,$id){
        $salary = $this->_SalaryRepository->getSalaryById($id);
        if($request->user()->can("update",$salary)) {
            $this->_SalaryRepository->DeleteSalary($id, Auth::user()->company_id);
            return redirect(route("salary.view"))->with("message", "Delete Salary successfully");
        }
        return redirect(route("salary.view"))->with("error","you did not have roles to do that function");
    }

    public function printValue(Request $request){
        $requestData = $request->all();
        if($requestData['action'] == 'Type'){
            if($requestData["type"] == 0){
                echo '<input type="number" name="value" class="form-control pt-3" value="" required/>';
            }else{
                echo '<input type="text" name="value" class="form-control pt-3" readonly value="0"/>';
            }
        }
    }
    public function printLevel(Request $request){
        $requestData = $request->all();
        if($requestData['action'] == 'Type'){
            if($requestData["type"] == 0){
                echo '<input type="number" name="level" class="form-control pt-3" value="" required/>';
            }else{
                echo '<input type="number" name="level" class="form-control pt-3" readonly value="0"/>';
            }
        }
    }

}
