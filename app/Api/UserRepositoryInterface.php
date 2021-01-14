<?php
namespace App\Api;

use App\Models\User;

Interface UserRepositoryInterface
{
    /**
     * @param int $id
     * @return User
     */
    public function getUserById($id);

    /**
     * @param int $companyId
     * @return User
     */
    public function getAllUser($companyId);

    /**
     * @param string $email
     * @param string $password
     * @param string $username
     * @param int $active
     * @param int $companyId
     * @return User
     */
    public function createUser($email, $password, $username, $active, $companyId);

    /**
     * @param string $email
     * @param int $companyId
     * @return User
     */
    public function checkEmail($email,$companyId);

    /**
     * @param string $username
     * @param int $companyId
     * @return User
     */
    public function CheckUsername($username,$companyId);

    /**
     * @param int $id
     * @param string $email
     * @param string $username
     * @param int $active
     * @return User
     */
    public function UpdateUserAdmin($id,$email, $username, $active);

    /**
     * @param int $id
     * @param string $email
     * @param string $username
     * @return User
     */
    public function UpdateUser($id,$email, $username);

    /**
     * @param string $username
     * @param int $id
     * @return User
     */
    public function checkEditUserName($username,$id);

    /**
     * @param string $email
     * @param int $id
     * @return User
     */
    public function checkEditEmail($email,$id);

    /**
     * @param int $id
     * @param int $companyId
     * @return User
     */
    public function DeleteUser($id,$companyId);

    /**
     * @param int $id
     * @param int $companyId
     * @return User
     */
    public function getEditUser($id,$companyId);
}
