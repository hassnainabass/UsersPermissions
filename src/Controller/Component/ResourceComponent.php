<?php

namespace UsersPermissions\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use ReflectionClass;
use ReflectionMethod;
use OAuth;

class ResourceComponent extends Component
{
    // The other component your component uses
    public $components = ['Auth', 'Flash', 'RequestHandler'];

    /**
     * Get List of All controllers in the system
     * @return [Array] [Array of all the conntrollers in the application]
     */
    public function getControllers()
    {
  	    $files = scandir('../src/Controller/');
  	    $results = [];
  	    $ignoreList = [
  	        '.', 
  	        '..', 
  	        'Component', 
  	        'AppController.php',
  	        'Api',
            'ErrorController.php'
  	    ];
  	    foreach($files as $file){
  	        if(!in_array($file, $ignoreList)) {
  	            $controller = explode('.', $file)[0];
  	            array_push($results, str_replace('Controller', '', $controller));
  	        }            
  	    }
  	    return $results;
  	}

	/**
	 * Get List of all Actions for a particular controller
	 * @param  [String] $controllerName [Controller name to find actions for]
	 * @return [Array]                 [Array list of actions]
	 */
	public function getActions($controllerName) 
	{
	    $className = 'App\\Controller\\'.$controllerName.'Controller';
	    $class = new ReflectionClass($className);
	    $actions = $class->getMethods(ReflectionMethod::IS_PUBLIC);
	    $results = [$controllerName => []];
	    $ignoreList = ['beforeFilter', 'afterFilter', 'initialize'];
	    foreach($actions as $action){
	        if($action->class == $className && !in_array($action->name, $ignoreList)){
	            array_push($results[$controllerName], $action->name);
	        }   
	    }
	    return $results;
	}

	/**
	 * Putting getControllers and getActions functions together.
	 * This function will put some sense in those above functions.
	 * @return [Array] [Array of resources]
	 */
	public function getResources()
	{
	    $controllers = $this->getControllers();
	    $resources = [];
	    foreach($controllers as $controller){
	        $actions = $this->getActions($controller);
	        array_push($resources, $actions);
	    }
	    return $resources;
	}

  /**
     * Print provided value to the screen to debug
     * @param  [Any] $value [A value to print on screen]
     * @return None
     */
    public function debugme($value)
    {
      echo "<pre>";
      print_r($value);
      echo "</pre>";
      die;
    }

    public function checkPermision()
    {
      $userId = $this->Auth->user('id');
      $userName = $this->Auth->user('username');
      $userRole = $this->Auth->user('role');

      $permissionsTable = TableRegistry::get('UsersPermissions.Permissions');
      
      $key = $this->request->params['controller'].'-'.$this->request->params['action'];

      $query = $permissionsTable->find('all', [
            'conditions' => ['Permissions.user_id' => $userId ],
            'Limit' => 1
        ]);
      if($query->count()>0)
      {
        if (strpos($query->first()->permissions, $key) !== false || $userRole=='admin') {
            
        }
        else
        {
          $this->Flash->error(__('You do not have permissions to visit this page.'));
          return  $this->_registry->getController()->redirect('/dashboard');
        }
      }
      else
      {
        $this->Flash->error(__('No permisions are defined for the '.$userName));
        return  $this->_registry->getController()->redirect('/dashboard');
      }
    }
    
}