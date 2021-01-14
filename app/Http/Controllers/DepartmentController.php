<?php

namespace App\Http\Controllers;

use App\Repository\DepartmentRepository;
use App\Validation\Validation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    protected $_DepartmentRepository;

    public function __construct(DepartmentRepository $departmentRepository)
    {
        $this->_DepartmentRepository = $departmentRepository;
    }

    public function getDepartment(){
        $getDepartment = $this->_DepartmentRepository->getAllDepartment(Auth::user()->company_id);
        return view("Department.view",compact("getDepartment"));
    }

    public function createDepartment(Request $request){
        $requestData = $request->all();
        $validator = Validation::CreateDepartment($request);
        if ($validator->fails()) {
            return redirect(route('department.view'))
                ->withErrors($validator)
                ->withInput();
        }
        $this->_DepartmentRepository->createDepartment(Auth::user()->id,$requestData["name"],$requestData["description"],Auth::user()->company_id);
        return redirect(route("department.view"))->with("message","create Department successfully");
    }

    public function getEditDepartment(Request $request,$id){
        $getEditDepartment = $this->_DepartmentRepository->getDepartmentById($id);
        if($request->user()->can("update",$getEditDepartment)){
            $getEditDepartment = $this->_DepartmentRepository->getDepartmentById($id);
            return view("Department.edit",compact("getEditDepartment"));
        }
        return redirect(route("department.view"))->with("error","this department does not exist");
    }

    public function UpdateDepartment(Request $request,$id){
        $requestData =$request->all();
        $validator = Validation::CreateDepartment($request);
        if ($validator->fails()) {
            return redirect(route('department.edit',["id"=>$id]))
                ->withErrors($validator)
                ->withInput();
        }
        $this->_DepartmentRepository->UpdateDepartment($id,$requestData["name"],$requestData["description"]);
        return redirect(route("department.view"))->with("message","update department successfully");
    }

    public function DeleteDepartment(Request$request,$id)
    {
        $getEditDepartment = $this->_DepartmentRepository->getDepartmentById($id);
        if ($request->user()->can("update", $getEditDepartment)) {
            $this->_DepartmentRepository->DeleteDepartment($id, Auth::user()->company_id);
            return redirect(route("department.view"))->with("message", "delete department successfully");
        }
        abort(403);
    }
}
