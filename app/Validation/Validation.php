<?php

namespace App\Validation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class Validation
{
    public static function Register($request){
        $messages = [
            'password.regex' => 'you need to have at least 8 characters(Lowercase,Uppercase and Numbers!)',
        ];
        $rules = [
            'username' => 'required|string|alpha_dash|max:40|',
            'email' => 'bail|required|email|max:50',
            'password' => 'bail|required|min:8|max:255|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/',
            'password_confirm' => 'bail|required|same:password|max:255',
        ];
        return Validator::make($request->all(),$rules,$messages );
    }
    public static function CreateEmployee($request){
        $rules = [
            'full_name' => 'required|string|max:50|',
            'date_of_birth' => 'bail|required|date_format:Y-m-d|before_or_equal:today',
            'phone_number' => 'bail|required|numeric|digits_between:10,14',
            "ID_card"=>"required|numeric|digits_between:11,13",
            'address' => 'bail|required|string|max:255',
            "avatar"=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            "in_date"=>"bail|required|date_format:Y-m-d|before_or_equal:today",
            "out_date"=>"bail|date_format:Y-m-d|before_or_equal:today",
        ];
        return Validator::make($request->all(),$rules);
    }
    public static function CreateSalary($request){
        $messages = [
            'level.digits_between' => 'Enter number from 0 to 99',
        ];
        $rules = [
            'name' => 'required|string|max:50|',
            'level' => 'bail|required|numeric|digits_between:1,2',
            'value' => 'bail|required|numeric',
        ];
        return Validator::make($request->all(),$rules,$messages);
    }
    public static function CreateOtherSalary($request){
        $messages = [
            'type.digits_between' => 'Enter number from 0 to 99',
        ];
        $rules = [
            'name' => 'required|string|max:100|',
            'money' => 'bail|required|max:100',
            'type' => 'bail|required|numeric|digits_between:1,2',
            'value' => 'bail|required|numeric|',
        ];
        return Validator::make($request->all(),$rules,$messages);
    }
    public static function CreateInsurance($request){
        $messages = [
            'percent.digits_between' => 'Enter number from 0 to 100',
        ];
        $rules = [
            'percent' => 'required|numeric|between:0,100|',
            'date' => 'bail|required|date_format:Y-m-d|',
        ];
        return Validator::make($request->all(),$rules,$messages);
    }
    public static function CreateDepartment($request){
        $rules = [
            'name' => 'required|string|max:50|',
            'description' => 'bail|string|max:4294967295',
        ];
        return Validator::make($request->all(),$rules);
    }
    public static function CreateRewards($request){
        $rules = [
            'name' => 'required|string|max:50',
            'value' => 'bail|required|numeric|',
        ];
        return Validator::make($request->all(),$rules);
    }
    public static function createDepartmentEmployee($request){
        $rules = [
            'department_id' => 'required|',
        ];
        return Validator::make($request->all(),$rules);
    }
}
