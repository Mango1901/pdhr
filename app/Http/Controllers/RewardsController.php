<?php

namespace App\Http\Controllers;

use App\Repository\RewardsRepository;
use App\Validation\Validation;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RewardsController extends Controller
{
    protected $_RewardsRepository;

    public function __construct(RewardsRepository $rewardsRepository)
    {
        $this->_RewardsRepository = $rewardsRepository;
    }

    public function getRewards(){
        if(Gate::allows("is-admin")){
            $getAllRewards = $this->_RewardsRepository->getAllRewards(Auth::user()->company_id);
            return view("Rewards.view",compact("getAllRewards"));
        }
       abort(403);
    }

    public function createRewards(Request $request){
        $requestData = $request->all();
        $validator = Validation::CreateRewards($request);
        if ($validator->fails()) {
            return redirect(route('rewards.view'))
                ->withErrors($validator)
                ->withInput();
        }
        $this->_RewardsRepository->createRewards(Auth::user()->id,$requestData["name"],$requestData["value"],Auth::user()->company_id);
        return redirect(route("rewards.view"))->with("message","Create Rewards successfully");
    }

    public function getEditRewards(Request $request,$id){
        $getEditRewards = $this->_RewardsRepository->getRewardsById($id);
        if($getEditRewards){
            if($request->user()->can("update",$getEditRewards)){
                $getEditRewards = $this->_RewardsRepository->getRewardsById($id);
                return view("Rewards.edit",compact("getEditRewards"));
            }
            abort(403);
        }
       return redirect(route("rewards.view"))->with("error","this rewards did not exist");
    }

    public function UpdateRewards(Request $request,$id){
        $requestData = $request->all();
        $validator = Validation::CreateRewards($request);
        if ($validator->fails()) {
            return redirect(route('rewards.edit',["id"=>$id]))
                ->withErrors($validator)
                ->withInput();
        }
        $this->_RewardsRepository->UpdateRewards($id,$requestData["name"],$requestData["value"]);
        return redirect(route("rewards.view"))->with("message","update rewards successfully");
    }

    public function DeleteRewards(Request $request,$id){
        $getRewardsById = $this->_RewardsRepository->getRewardsById($id);
        if($getRewardsById){
            if($request->user()->can("delete",$getRewardsById)){
            $this->_RewardsRepository->DeleteRewards($id,Auth::user()->company_id);
            return redirect(route("rewards.view"))->with("message","delete rewards successfully");
            }
            abort(403);
        }
       return redirect("rewards.view")->with("error","this rewards did not exist");
    }
}
