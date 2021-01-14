<?php

namespace App\Http\Controllers;

use App\Repository\OtherSalaryRepository;
use App\Validation\Validation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtherSalaryController extends Controller
{
    protected $_OtherSalaryRepository;

    public function __construct(OtherSalaryRepository $otherSalaryRepository)
    {
        $this->_OtherSalaryRepository = $otherSalaryRepository;
    }

    public function getOtherSalary(){
        $getAllOtherSalary = $this->_OtherSalaryRepository->getAllOtherSalary(Auth::user()->company_id);
        return view("OtherSalary.view",compact("getAllOtherSalary"));
    }

    public function CreateOtherSalary(Request $request){
        $requestData = $request->all();
        if(!isset($requestData["value"])){
            $requestData["value"] = 0;
        }
        $validator = Validation::CreateOtherSalary($request);
        if ($validator->fails()) {
            return redirect(route('OtherSalary.view'))
                ->withErrors($validator)
                ->withInput();
        }
        $this->_OtherSalaryRepository->CreateOtherSalary(Auth::user()->id,$requestData["name"],$requestData["money"],$requestData["type"],$requestData["value"],Auth::user()->company_id);
        return redirect(route("OtherSalary.view"))->with("message","Create Other Salary successfully");
    }

    public function getEditOtherSalary(Request $request,$id){
        $getEditOtherSalary = $this->_OtherSalaryRepository->getEditOtherSalary($id);
        if($getEditOtherSalary){
            if($request->user()->can("update",$getEditOtherSalary)){
                $getEditOtherSalary = $this->_OtherSalaryRepository->getEditOtherSalary($id);
                return view("OtherSalary.edit",compact("getEditOtherSalary"));
            }
            abort(403);
        }
        return redirect(route("OtherSalary.view"))->with("error","This Other Salary did not exist");
    }

    public function UpdateOtherSalary(Request $request,$id){
        $requestData = $request->all();
        $validator = Validation::CreateOtherSalary($request);
        if ($validator->fails()) {
            return redirect(route('OtherSalary.edit',["id"=>$id]))
                ->withErrors($validator)
                ->withInput();
        }
        $this->_OtherSalaryRepository->UpdateOtherSalary($id,$requestData["name"],$requestData["money"],$requestData["type"],$requestData["value"]);
        return redirect(route("OtherSalary.view"))->with("message","edit Other Salary successfully");
    }

    public function DeleteOtherSalary(Request $request,$id){
        $getDeleteOtherSalary = $this->_OtherSalaryRepository->getEditOtherSalary($id);
        if($getDeleteOtherSalary) {
            if($request->user()->can("delete",$getDeleteOtherSalary)){
            $this->_OtherSalaryRepository->DeleteOtherSalary($id, Auth::user()->company_id);
            return redirect(route("OtherSalary.view"))->with("message", "Delete Other Salary successfully");
            }
            abort(403);
        }
        return redirect(route("OtherSalary.view"))->with("error","this Other Salary did not exist");
    }
    public function printValue(Request $request){
        $requestData = $request->all();
        if($requestData['action'] == 'Type'){
            if($requestData["type"] == 0){
                echo '<input type="number" name="value" class="form-control pt-3" value="" required/>';
            }else{
                echo '<input type="number" name="value" class="form-control pt-3" readonly value="0"/>';
            }
        }
    }
}
