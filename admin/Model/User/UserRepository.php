<?php

namespace Admin\Model\User;

use \Engine\Model;

class UserRepository extends Model
{
    const ITEMS_PER_PAGE = 15;

	public function users($role, $pageParams)
	{
        $sort = ($pageParams['sort'] == 'name') ? 'name' : 'register_date';
        $order = ($pageParams['order'] == 'asc') ? 'ASC' : 'DESC';

        $offset = ($pageParams['page'] - 1) * self::ITEMS_PER_PAGE;

		$sql = $this->qb
			->select()
			->from('user')
            ->where('role', $role, '=')
			->orderBy($sort, $order)
            ->limitOffset($offset, self::ITEMS_PER_PAGE)
			->sql();

		return $this->db->query($sql, $this->qb->values)->all();
	}

    public function usersCount($role = 'admin')
    {
        $count = $this->db->query(
            $this->qb
                ->select("count(id) AS 'count'")
                ->from('user')
                ->where('role', $role, '=')
                ->sql(),
            $this->qb->values
        )->firstOrDefault();

        return $count['count'];
    }

    public function search($pageParams)
    {
        $sort = ($pageParams['sort'] == 'name') ? 'name' : 'register_date';
        $order = ($pageParams['order'] == 'asc') ? 'ASC' : 'DESC';

        $offset = ($pageParams['page'] - 1) * self::ITEMS_PER_PAGE;

        $users = $this->db->query(
            $this->qb
                ->select()
                ->from('user')
                ->where('name', '%' . trim($pageParams['term']) . '%', 'LIKE')
                ->orWhere('email', trim($pageParams['term']), '=')
                ->orderBy($sort, $order)
                ->limitOffset($offset, self::ITEMS_PER_PAGE)
                ->sql(),
            $this->qb->values
        )->all();

        return $users;
    }

    public function searchCount($term)
    {
        $count = $this->db->query(
            $this->qb
                ->select("count(id) AS 'count'")
                ->from('user')
                ->where('name', '%' . trim($term) . '%', 'LIKE')
                ->orWhere('email', trim($term), '=')
                ->sql(),
            $this->qb->values
        )->firstOrDefault();

        return $count['count'];
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
                    'name' => trim($params['name']),
                    'email' => trim($params['email']),
                    'role' => $params['role'],
                    'register_date' => date('Y-m-d H:i:s'),
                    'password' => $this->auth->encryptPassword($params['password'])
                ])
                ->sql(),
            $this->qb->values
        );
    }

    public function editUser($params)
    {
        $this->db->query(
            $this->qb
                ->update('user')
                ->set([
                    'name' => $params['name'],
                    'email' => $params['email'],
                    'role' => $params['role']
                ])
                ->where('id', $params['id'], '=')
                ->limit(1)
                ->sql(),
            $this->qb->values
        );
    }

    public function delete($id)
    {
        $this->load->model('Wishlist');

        $this->model->wishlist->deleteWishListOfUser($id);

        $this->db->query(
            $this->qb
                ->delete('user')
                ->where('id', $id, '=')
                ->limit(1)
                ->sql(),
            $this->qb->values
        );
    }

    public function emptyUser()
    {
        return [
            'id' => -1,
            'name' => '',
            'email' => '',
            'role' => 'user'
        ];
    }
}
