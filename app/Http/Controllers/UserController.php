<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use App\Repository\CompanyRepository;
use App\Repository\EmployeeRepository;
use App\Repository\UserRepository;
use App\Validation\Validation;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    protected $_userRepository;
    protected $_CompanyRepository;

    public function __construct(UserRepository $userRepository,CompanyRepository $companyRepository)
    {
        $this->_userRepository = $userRepository;
        $this->_CompanyRepository = $companyRepository;
    }

    public function getAllUser()
    {
        $getAllUser = $this->_userRepository->getAllUser(Auth::user()->company_id);
        return view("user.view")->with(compact("getAllUser"));
    }

    public function register(Request $request)
    {
        $requestData = $request->all();
        if (!isset($requestData["active"])) {
            $requestData["active"] = 0;
        }
        $validator = Validation::Register($request);
        if ($validator->fails()) {
            return redirect(route('user.view'))
                ->withErrors($validator)
                ->withInput();
        }
        if ($this->_userRepository->CheckUsername($requestData["username"], Auth::user()->company_id)) {
            return redirect(route("user.view"))->with("error", "this username had already been existed");
        }
        if ($this->_userRepository->CheckEmail($requestData["email"], Auth::user()->company_id)) {
            return redirect(route("user.view"))->with("error", "this email had already been existed");
        }
        $this->_userRepository->createUser($requestData["email"], $requestData["password"], $requestData["username"], $requestData["active"], Auth::user()->company_id);
        return redirect(route("user.view"))->with("message", "create User successfully");
    }

    public function getEditUser(Request $request, $id)
    {
        $user = $this->_userRepository->getUserById($id);
        if($user){
            $getCompany = $this->_CompanyRepository->getCompanyById($user->company_id);
            if($request->user()->can("update",$getCompany)){
                $getEditUser = $this->_userRepository->getUserById($id);
                return view("user.edit", compact("getEditUser"));
            }
            abort(403);
        }
        return redirect(route("user.view"))->with("error","this user does not exist");
    }

    public function UpdateUser(Request $request, $id)
    {
        $requestData = $request->all();
        if (!isset($requestData["active"])) {
            $requestData["active"] = 0;
        }
        if ($this->_userRepository->checkEditUserName($requestData["username"], $id)) {
            return redirect(route("user.view"))->with("error", "this username had already been existed");
        }
        if ($this->_userRepository->checkEditEmail($requestData["email"], $id)) {
            return redirect(route("user.view"))->with("error", "this email had already been existed");
        }
        if(Gate::allows("is-admin")){
            $this->_userRepository->UpdateUserAdmin($id, $requestData["email"], $requestData["username"], $requestData["active"]);
        }else{
            $this->_userRepository->UpdateUser($id, $requestData["email"], $requestData["username"]);
        }


        return redirect(route("user.view"))->with("message", "Update user successfully");
    }

    public function DeleteUser(Request $request, $id)
    {
        $user = $this->_userRepository->getUserById($id);
        if($user){
            $getCompany = $this->_CompanyRepository->getCompanyById($user->company_id);
            if($request->user()->can("delete",$getCompany)){
                $this->_userRepository->DeleteUser($id, Auth::user()->company_id);
                return redirect(route("user.view"))->with("message", "delete user successfully");
            }
            abort(403);
        }
        return redirect(route("user.view"))->with("error","this user did not exist");

    }
}
