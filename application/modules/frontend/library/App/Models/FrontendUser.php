<?php
/**
 * Model that manages the users within the application
 *
 * @category frontend
 * @package frontend_models
 * @copyright RCWEB
 */

class FrontendUser extends BaseUser
{

    const ROLE_FRONTEND_EXEMPLE        = 'frontend_exemple';

    /**
     * Column for the primary key
     *
     * @var string
     * @access protected
     */
    protected $_primary = 'id';

    /**
     * Holds the table's name
     *
     * @var string
     * @access protected
     */
    protected $_name = 'frontend_users';

    /**
     * Holds the associated model class
     *
     * @var string
     * @access protected
     */
    protected $_rowClass = 'App_Table_FrontendUser';

    /**
     * Hashes a password using the salt in the app.ini
     *
     * @param string $password
     * @static
     * @access public
     * @return string
     */
    public static function hashPassword($password){
        $config = App_DI_Container::get('ConfigObject');
        $module = strtolower(CURRENT_MODULE);
        return sha1($config->{$module}->security->passwordsalt . $password);
        //return sha1($password);
    }

    /**
     * Logs an user in the application based on his
     * username and email
     *
     * @param string $username
     * @param string $password
     * @param boolean $rememberMe
     * @access public
     * @return void
     */
    public function login($username, $password, $rememberMe = FALSE){
        // adapter cfg
        $adapter = new Zend_Auth_Adapter_DbTable($this->_db);
        $adapter->setTableName($this->_name);
        $adapter->setIdentityColumn('username');
        $adapter->setCredentialColumn('password');

        // checking credentials
        $adapter->setIdentity($username);
        $adapter->setCredential(self::hashPassword($password));

        try{
            $result = $adapter->authenticate();
        }catch(Zend_Auth_Adapter_Exception $e){
            App_Logger::log(sprintf("Exception catched while login: %s", $e->getMessage()),Zend_Log::ERR);

            return FALSE;
        }

        if($result->isValid()){
            // get the user row
            $loggedUser = $adapter->getResultRowObject(NULL, 'password');

            //Check if the account has been closed
            if($loggedUser->deleted){
                return NULL;
            }

            // clear the existing data
            $auth = App_Auth::getInstance();
            $auth->clearIdentity();

            if(!empty($loggedUser->id)){
                $userModel = new FrontendUser();
                $user = $userModel->findById($loggedUser->id);
                $user->groups = $user->findManyToManyRowset('Group', 'FrontendUserGroup');
                if(count($user->groups) > 1){
                    foreach($user->groups as $group){
                        $user->group[] = $group;
                    }
                }else{
                    $user->group = $user->groups[0];
                }

                $session = new stdClass();

                foreach(get_object_vars($loggedUser) as $k => $v){
                	$session->{$k} = $v;
                }

                if(count($user->groups) > 1){
                	foreach($user->group as $g){
                		$session->group->name[] = $g->name;
                	}
                }else{
                	$session->group->name[] = $user->group->name;
                }

                $auth->getStorage()->write($session);

            }

            $this->update(
                    array(
                            'last_login' => new Zend_Db_Expr('NOW()'),
                			'nb_login' => $user->nb_login + 1
                    ),
                    $this->_db->quoteInto('id = ?', $user->id)
            );

            if($rememberMe){
                Zend_Session::rememberMe(App_DI_Container::get('ConfigObject')->session->remember_me->lifetime);
            }else{
                Zend_Session::forgetMe();
            }

            return TRUE;
        }else{
            return FALSE;
        }
    }

    /**
     * Reload the data of the user in the session
     *
     * @return void
     */
    public static function reloadSession(){
        $auth = App_Auth::getInstance();

        $userModel = new FrontendUser();
        $user = $userModel->findById(self::getSession()->id);
        $user->groups = $user->findManyToManyRowset('Group', 'FrontendUserGroup');
        $user->group = $user->groups[0];

        $session = new stdClass();
        foreach($user as $k => $v){
            $session->{$k} = $v;
        }
        $session->group->name = $user->get('group')->name;

        $auth->getStorage()->write($session);
    }

    /**
     * Updates the user's profile.
     *
     * @param array $data
     * @access public
     * @return void
     */
    public function updateProfile(array $data){
        $user = App_Auth::getInstance()->getIdentity();
        $data['id'] = $user->id;

        $this->save($data);
    }

    /**
     * Overrides save() in App_Model
     *
     * @param array $data
     * @access public
     * @return int
     */
    public function save(array $data){
        $id = parent::save($data);
        if (isset($data['groups']) && is_array($data['groups']) && !empty($data['groups'])) {
            $groups = $data['groups'];
        } else {
            $groups = array();
        }

        $userGroupModel = new FrontendUserGroup();
        $userGroupModel->saveForUser($groups, $id);

        return $id;
    }

    /**
     * Overrides insert() in App_Model
     *
     * @param array $data
     * @access public
     * @return int
     */
    public function insert($data){
        $data['last_password_update'] = new Zend_Db_Expr('NOW()');
        $data['password'] = FrontendUser::hashPassword($data['password']);
        $data['password_valid'] = 0;

        return parent::insert($data);
    }

    /**
     * Overrides getAll() in App_Model
     *
     * @param int $page
     * @access public
     * @return Zend_Paginator
     */
    public function findAll($page = 1){
        $paginator = parent::findAll($page);
        $users = array();

        foreach($paginator as $user){
            $user->groups = $user->findManyToManyRowset('Group', 'FrontendUserGroup');

            foreach($user->groups as $group){
                $user->groupNames[] = $group->name;
                $user->groupIds[] = $group->id;
            }

            $users[] = $user;
        }

        return Zend_Paginator::factory($users);
    }

    /**
     * Overrides findById() in App_Model
     *
     * @param int $userId
     * @access public
     * @return array
     */
    public function findById($userId){
        $user = parent::findById($userId);
        if(!empty($user)){
            $user->groups = $user->findManyToManyRowset('Group', 'FrontendUserGroup');

            foreach($user->groups as $group){
                $user->groupNames[] = $group->name;
                $user->groupIds[] = $group->id;
            }
        }

        return $user;
    }

    /**
     * Overrides delete() in App_Model.
     *
     * When an user is deleted, all associated objects are also
     * deleted
     *
     * @param mixed $where
     * @access public
     * @return int
     */
    public function delete($where){
        if (is_numeric($where)) {
            $where = $this->_primary . ' = ' . $where;
        }

        $select = new Zend_Db_Select($this->_db);
        $select->from($this->_name);
        $select->where($where);

        $rows = $this->_db->fetchAll($select);
        $userGroupModel = new FrontendUserGroup();

        foreach ($rows as $row) {
            $userGroupModel->deleteByUserId($row['id']);
        }

        return parent::delete($where);
    }

    /**
     * Changes the current user's password
     *
     * @param string $password
     * @access public
     * @return void
     */
    public function changePassword($password){
        if (!App_Auth::getInstance()->hasIdentity()) {
            throw new Zend_Exception('You must have one authenticated user in the application in order to be able to call this method');
        }

        $user = App_Auth::getInstance()->getIdentity();

        $password = FrontendUser::hashPassword($password);

        $this->update(
            array(
                'password' => $password,
                'last_password_update' => new Zend_Db_Expr('NOW()'),
                'password_valid' => 1
            ),
            $this->_db->quoteInto('id = ?', $user->id)
        );
    }

}