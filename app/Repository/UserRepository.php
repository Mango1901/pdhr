<?php

namespace App\Repository;

use App\Api\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    protected $_UserModel;

    /**
     * UserRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->_UserModel = $user;
    }

    /**
     * @param int $id
     * @return User
     */

    public function getUserById($id)
    {
        return $this->_UserModel->where("id",$id)->where("status",0)->first();
    }

    /**
     * @param int $companyId
     * @return User
     */

    public function getAllUser($companyId)
    {
        return $this->_UserModel->orderBy("id","DESC")->where("company_id",$companyId)->where("status",0)->get();
    }

    /**
     * @param string $email
     * @param string $password
     * @param string $username
     * @param int $active
     * @param int $companyId
     * @return User
     */

    public function createUser($email,$password,$username,$active,$companyId){
        return $this->_UserModel->create(
            array("email"=>$email,"password"=>bcrypt($password),'username'=>$username,"active"=>$active,"company_id"=>$companyId)
        );
    }

    /**
     * @param string $email
     * @param int $companyId
     * @return User
     */
   public function checkEmail($email,$companyId)
   {
       return $this->_UserModel->where("email",$email)->where("company_id",$companyId)->where("status",0)->first();
   }

    /**
     * @param string $username
     * @param int $companyId
     * @return User
     */
    public function CheckUsername($username,$companyId){
       return $this->_UserModel->where("username",$username)->where("company_id",$companyId)->where("status",0)->first();
    }

    /**
     * @param int $id
     * @param string $email
     * @param string $username
     * @return User
     */
    public function UpdateUser($id,$email, $username)
    {
       return $this->_UserModel->where("id",$id)->update([
          "email"=>$email,"username"=>$username
       ]);
    }

    /**
     * @param int $id
     * @param string $email
     * @param string $username
     * @param $active
     * @return User
     */
    public function UpdateUserAdmin($id,$email, $username,$active)
    {
        return $this->_UserModel->where("id",$id)->update([
            "email"=>$email,"username"=>$username ,"active"=>$active
        ]);
    }

    /**
     * @param string $username
     * @param int $id
     * @return User
     */
    public function checkEditUserName($username, $id)
    {
       return $this->_UserModel->where("username",$username)->whereNotIn("id",[$id])->where("status",0)->first();
    }

    /**
     * @param string $email
     * @param int $id
     * @return User
     */

    public function checkEditEmail($email, $id)
    {
        return $this->_UserModel->where("email",$email)->whereNotIn("id",[$id])->where("status",0)->first();
    }

    /**
     * @param int $id
     * @param int $companyId
     * @return User
     */
    public function DeleteUser($id, $companyId)
    {
        return $this->_UserModel->where("id",$id)->where("company_id",$companyId)->update(["status"=>1]);
    }

    /**
     * @param int $id
     * @param int $companyId
     * @return User
     */
    public function getEditUser($id, $companyId)
    {
        return $this->_UserModel->orderBy("id","DESC")->where("company_id",$companyId)->whereNotIn("id",[$id])->get();
    }

}
