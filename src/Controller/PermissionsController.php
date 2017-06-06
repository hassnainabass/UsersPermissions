<?php
namespace UsersPermissions\Controller;

use UsersPermissions\Controller\AppController;

use Cake\ORM\TableRegistry;
use OAuth;
use Cake\Event\Event;

class PermissionsController extends AppController
{
	public function initialize()
    {
        parent::initialize();
        // Load Resource Component
        $this->loadComponent('UsersPermissions.Resource');
    }

    public function beforeFilter(Event $event)
    {
    	parent::beforeFilter($event);
        $this->Resource->checkPermision();
    }

    /**
     * Loads all users to manage permissions for
     * @return none
     */
    public function index()
    {
    	$this->loadModel('Users');

        $all_users = $this->Users->find('all', [
		    'order' => 'Users.username ASC'
		]);

		$this->set('all_users', $all_users);

    }

    /**
     * Manage user permissions for a particula user id
     * @param  [Integer] $user_id [A user id to manage permissions for, related to Users Model]
     * @return [Http]          [Redirect to the main page]
     */
    public function userpermission($user_id = null)
    {
    	$permissionsTable = TableRegistry::get('UsersPermissions.Permissions');
    	

    	if($this->request->is(['patch', 'post', 'put']))
    	{
    		
    		$applied_permissions = implode(",",$this->request->data['permission']);

			$query = $permissionsTable->find('all', [
				    'conditions' => ['Permissions.user_id' => $user_id ]
				]);

    		if($query->count()>0)
    		{
    			$permissions = $permissionsTable->get($query->first()->id);
    		}
    		else
    		{
    			$permissions = $permissionsTable->newEntity();
    		}
			
			$permissions->user_id = $user_id;
			$permissions->permissions = $applied_permissions;

			if ($permissionsTable->save($permissions))
			{
			    $this->Flash->success(__('User Permissions has been updated.'));
			}
			else
			{
				$this->Flash->error(__("User Permissions can't be updated. Try again!"));
			}

    	}
    	
    	$this->loadModel('Users');
        $get_users = $this->Users->find()->where(['id' => $user_id])->toArray();
        $user = $get_users[0];
        $this->set('user', $user);

        $query = $permissionsTable->find('all', [
				    'conditions' => ['Permissions.user_id' => $user_id ]
				]);
        if($query->count()>0)
        {
        	$this->set('permissions', $query->first()->permissions);
        }
        else
        {
        	$this->set('permissions', false);
        }

        $result = $this->Resource->getResources();
    	$this->set('result', $result);
    }

    /**
     * To check the plugin
     * @return none
     */
    public function check()
    {
    	$this->Resource->checkPermision();
    }
}