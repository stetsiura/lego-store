<?php

namespace Engine\Core\Auth;

class Auth
{
	const AUTH_USER_SESSION_KEY = 'auth_user';
	const AUTH_USER_COOKIE_KEY = 'auth_hash';
	const AUTH_COOKIE_TTL = 2592000;
	
	public function __construct(\Engine\DI\DI $di)
	{
		$this->di = $di;
		$this->db = $this->di->get('db');
		$this->qb = $this->di->get('query_builder');
	}
	
	/**
	 * @var \Engine\DI\DI;
	 */
	protected $di;
	
	/**
	 * @var \Engine\Core\Database\Connection
	 */
	protected $db;
	
	/**
	 * @var \Engine\Core\Database\QueryBuilder
	 */
	protected $qb;
	
	/**
	 * @return string
	 */
	private function userCookieHash()
	{
        return \Cookie::get(self::AUTH_USER_COOKIE_KEY);
	}
	
	/**
	 * @param array $user
	 */
	private function setUserCookieHash($user)
	{
		$hash = md5($user['id'] . $user['email'] . $user['password'] . $this->salt());

		$this->db->query(
			$this->qb
				->update('user')
				->set(['hash' => $hash])
				->where('id', $user['id'], '=')
				->limit(1)
				->sql(),
			$this->qb->values
		);

		\Cookie::set(self::AUTH_USER_COOKIE_KEY, $hash, self::AUTH_COOKIE_TTL);
	}
	
	/**
	 * @return string
	 */
	private static function salt()
	{
		return (string) rand(10000000, 99999999);
	}
	
	/**
	 * @param string $password
	 * @param string $salt
	 * @return string
	 */
	public static function encryptPassword($password, $salt = '')
	{
		return md5($password . $salt);
	}
	
	/**
	 * @return mixed
	 */
	public function getUserFromSession()
	{
		$user = \Session::get(self::AUTH_USER_SESSION_KEY);

		return $user;
	}
	
	/**
	 * @param string $hash
	 * @return mixed
	 */
	private function getUserFromDbByHash($hash = '')
	{
		$user = $this->db->query(
			$this->qb
				->select()
				->from('user')
				->where('hash', $hash, '=')
				->limit(1)
				->sql(),
			$this->qb->values
		)->firstOrDefault();

		return $user;
	}
	
	/**
	 * @param string $email
	 * @param string $password
	 * @return mixed
	 */
	private function getUserFromDbByCredentials($email, $password)
	{
		$user = $this->db->query(
			$this->qb
				->select()
				->from('user')
				->where('email', $email, '=')
				->where('password', $this->encryptPassword($password), '=')
				->limit(1)
				->sql(),
			$this->qb->values
		)->firstOrDefault();

		return $user;
	}
	
	/**
	 * @param array $user
	 */
	private function addUserToSession($user)
	{
		\Session::set(self::AUTH_USER_SESSION_KEY, $user);
	}
	
	/**
	 * @param array $user
	 * @param array $roles
	 * @return bool
	 */
	private function checkUserRole($user, $roles = ['user'])
	{
		if (empty($roles)) {
				return true;
		}

		if (in_array($user['role'], $roles)) {
				return true;
		}

		return false;
	}
	
	/**
	 * @param string $role
	 * @return bool
	 */
	public function isAuthorized($roles = ['user'])
	{
		$user = $this->getUserFromSession();

		if (!is_null($user) && $this->checkUserRole($user, $roles)) {
			return true;
		}

		$hash = $this->userCookieHash();

		if (is_null($hash)) {
			return false;
		}

		$user = $this->getUserFromDbByHash($hash);

		if (!is_null($user)) {
			$this->addUserToSession($user);

			if ($this->checkUserRole($user, $roles)) {
				return true;
			}			
		}

		return false;
	}
	
	/**
	 * @param string $email
	 * @param string $password
	 * @param bool $remember
	 * @return bool
	 */
	public function authorize($email, $password, $remember = false)
	{
		$user = $this->getUserFromDbByCredentials($email, $password);

		if (!is_null($user)) {
			$this->addUserToSession($user);

			if ($remember) {
				$this->setUserCookieHash($user);
			}

			return true;
		}

		return false;
	}
	
	/**
	 * @return void
	 */
	public function unauthorize()
	{
		\Cookie::delete(self::AUTH_USER_COOKIE_KEY);
		\Session::delete(self::AUTH_USER_SESSION_KEY);
	}

	public function isInRole($roles = [])
    {
        $user = $this->getUserFromSession();

        return $this->checkUserRole($user, $roles);
    }
}