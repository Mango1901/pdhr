<?php

namespace App\Http\Controllers;

use App\Repository\InsuranceRepository;
use Illuminate\Support\Facades\Gate;
use App\Validation\Validation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InsuranceController extends Controller
{
    protected $_InsuranceRepository;

    public function __construct(InsuranceRepository $insuranceRepository)
    {
        $this->_InsuranceRepository = $insuranceRepository;
    }

    public function getInsurance(){
        if(Gate::allows("is-admin")){
        $getInsurance = $this->_InsuranceRepository->getInsurance(Auth::user()->company_id);
        return view("Insurance.view",compact("getInsurance"));
        }
        abort(403);
    }

    public function createInsurance(Request $request){
        $requestData = $request->all();
        $validator = Validation::CreateInsurance($request);
        if ($validator->fails()) {
            return redirect(route('insurance.view'))
                ->withErrors($validator)
                ->withInput();
        }
        $this->_InsuranceRepository->createInsurance(Auth::user()->id,$requestData["percent"],$requestData["date"],Auth::user()->company_id);
        return redirect(route("insurance.view"))->with("message","create Insurance successfully");
    }

    public function getEditInsurance(Request $request,$id){
        $getInsuranceById = $this->_InsuranceRepository->getInsuranceById($id);
        if($getInsuranceById){
            if($request->user()->can("update",$getInsuranceById)){
                $getEditInsurance = $this->_InsuranceRepository->getInsuranceById($id);
                return view("Insurance.edit",compact("getEditInsurance"));
            }
            abort(403);
        }
        return redirect(route("insurance.view"))->with("error","this insurance does not exist");
    }

    public function UpdateInsurance(Request $request,$id){
        $requestData = $request->all();
        $validator = Validation::CreateInsurance($request);
        if ($validator->fails()) {
            return redirect(route('insurance.edit',["id"=>$id]))
                ->withErrors($validator)
                ->withInput();
        }
        $this->_InsuranceRepository->UpdateInsurance($id,$requestData["percent"],$requestData["date"]);
        return redirect(route("insurance.view"))->with("message","update insurance successfully");
    }

    public function DeleteInsurance(Request $request,$id){
        $getInsuranceById = $this->_InsuranceRepository->getInsuranceById($id);
        if($getInsuranceById){
            if($request->user()->can("delete",$getInsuranceById)){
                $this->_InsuranceRepository->DeleteInsurance($id,Auth::user()->company_id);
                return redirect(route("insurance.view"))->with("message","delete insurance successfully");
            }
            abort(403);
        }
        return redirect(route("insurance.view"))->with("error","this insurance does not exist");
    }

}
