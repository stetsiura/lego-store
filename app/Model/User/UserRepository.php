<?php

namespace App\Model\User;

use \Engine\Model;

class UserRepository extends Model
{
    public function userById($id)
    {
        $user = $this->db->query(
            $this->qb
                ->select()
                ->from('user')
                ->where('id', $id, '=')
                ->limit(1)
                ->sql(),
            $this->qb->values
        )->firstOrDefault();

        return $user;
    }

    public function userByEmail($email)
    {
        $user = $this->db->query(
            $this->qb
                ->select()
                ->from('user')
                ->where('email', $email, '=')
                ->limit(1)
                ->sql(),
            $this->qb->values
        )->firstOrDefault();

        return $user;
    }

    public function userByResetHash($hash)
    {
        $user = $this->db->query(
            $this->qb
                ->select()
                ->from('user')
                ->where('reset_hash', $hash, '=')
                ->limit(1)
                ->sql(),
            $this->qb->values
        )->firstOrDefault();

        return $user;
    }

    public function checkEmail($email)
    {
        $user = $this->userByEmail($email);

        return is_null($user);
    }

    public function createUser($params)
    {
        $this->db->query(
            $this->qb
                ->insert('user')
                ->set([
                    'name' => $params['name'],
                    'email' => $params['email'],
                    'role' => 'user',
                    'register_date' => date('Y-m-d H:i:s'),
                    'password' => $this->auth->encryptPassword($params['password'])
                ])
                ->sql(),
            $this->qb->values
        );
    }

    public function setResetHashForUser($id)
    {
        $hash = md5(rand(100000, 999999) . date('Y-m-d H:i:s'));

        $this->db->query(
            $this->qb
                ->update('user')
                ->set([
                    'reset_hash' => $hash
                ])
                ->where('id', $id, '=')
                ->limit(1)
                ->sql(),
            $this->qb->values
        );

        return $hash;
    }

    public function resetPassword($id, $password)
    {
        $this->db->query(
            $this->qb
                ->update('user')
                ->set([
                    'password' => $this->auth->encryptPassword($password),
                    'reset_hash' => null
                ])
                ->where('id', $id, '=')
                ->limit(1)
                ->sql(),
            $this->qb->values
        );
    }
}