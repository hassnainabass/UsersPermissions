# UsersPermissions plugin for CakePHP
The **UsersPermissions plugin** is for allowing admins to add user permissions for each module in Cakephp. It provides a basic interface to manage user permissions and check upon each request.
It provides check box based user permissions in a form like magento. The plugin uses bootstrap by default but you can change that. 
It will automatically get all controllers and actions from Your Cakephp application and in a GUI you can select the permissions for all controller or actions inside a controller.

![Image of UsersPermissions](http://i66.tinypic.com/2k0uiv.png)

## Requirements

* CakePHP 3.0+
* [Cakephp Migration Plugin](https://book.cakephp.org/3.0/en/migrations.html)
* [Simple Cakephp 3 Authentication](https://book.cakephp.org/3.0/en/tutorials-and-examples/blog-auth-example/auth.html)
* PHP 5.2.8+

## Installation

You can install this plugin into your CakePHP 3 application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

```
composer require hassnainabass/UsersPermissions
```
Or download the files and move to root/plugins and paste it there, Please rename the folder to **UsersPermissions**

### After successfull steps above, Please follow the following:

* Load Plugin in config/bootstrap.php
	```
	Plugin::load('UsersPermissions', ['routes' => true]);
	```
* Open console/terminal and run the following migration,please make sure to load migration plugin first
	```
	bin/cake migrations migrate -p UsersPermissions
	```
    Or create the following table in database:

    ```
    CREATE TABLE user_permissions (
      id int(11) NOT NULL AUTO_INCREMENT,
      user_id int(11) DEFAULT NULL,
      permissions text DEFAULT NULL,
      created_on timestamp NULL DEFAULT CURRENT_TIMESTAMP,
      updated_on date DEFAULT NULL,
      PRIMARY KEY (id)
    )
    ENGINE = INNODB
    AUTO_INCREMENT = 1
    CHARACTER SET latin1
    COLLATE latin1_swedish_ci;
    ```
	It will create a table named "user_permissions" in database using default database connection configured in config/app.php of your cakephp installation.

* Change the route for your plugin GUI in **plugins/UserPermissions/config/routes.php** , By default it is domain.com/users-permissions

	```
	Router::plugin(
	    'UsersPermissions',
	    ['path' => '/users-permissions'],
	    function ($routes) {
	        $routes->fallbacks('DashedRoute');
	    }
	);
	```
* Update call back url if user does not have permision for a particular action. To update the url, replace 'dashboard' in plugins/UsersPermissions/src/controller/component/ResourceComponent.php
	```
	return  $this->_registry->getController()->redirect('/dashboard');
	```
* Update composer, Go to the root directory for your cakephp installation and run the following command:
	```
	composer dumpautoload
	```

**Thats all your plugin has been installed, yay :)**

You can access the GUI if you have 'admin' role in Users table in user authentication and authorization of cakephp application.

### Usage

* If you want to load the plugin and permissions for all actions of all controllers and routes. Add the following code in cakephpapp/src/controller/AppController.php
	```
	public function initialize()
    {
        parent::initialize();
        // Some code
        // Load Resource Component
        $this->loadComponent('UsersPermissions.Resource');
    }

    public function beforeFilter(Event $event)
    {
    	parent::beforeFilter($event);
    	// Some code
    	// Load permissions check function from Resource component
        $this->Resource->checkPermision();
    }

	```

* If you want to load the plugin and permissions for all actions of only one controllers. Add the following code in desired controller (same as above) cakephpapp/src/controller/ExampleController.php
	```
	public function initialize()
    {
        parent::initialize();
        // Some code
        // Load Resource Component
        $this->loadComponent('UsersPermissions.Resource');
    }

    public function beforeFilter(Event $event)
    {
    	parent::beforeFilter($event);
    	// Some code
    	// Load permissions check function from Resource component
        $this->Resource->checkPermision();
    }

	```
* If you want to load the plugin and permissions for only one actions of only one controllers. Add the following code in desired controller and in the start of desired action/function in cakephpapp/src/controller/ExampleController.php
	```
	public function initialize()
    {
        parent::initialize();
        // Some code
        // Load Resource Component
        $this->loadComponent('UsersPermissions.Resource');
    }

    public function exampleAction($param = null)
    {
    	// Load permissions check function from Resource component
        $this->Resource->checkPermision();

    	// Some code
    	
    }

	```
*The plugin uses bootstrap as front-end styling but you can update the views. To do that you can update the following files.

	plugins/UsersPermissions/src/template/Permissions/index.ctp
	plugins/UsersPermissions/src/template/Permissions/userpermission.ctp

## Author

Developed by [Hassnain Abass](https://www.linkedin.com/in/hussnain-abass-b041b578/) - Senior Web Developer and [Freelancer](https://www.freelancer.com/u/Hussnain0163.html)

## Contributing

This repository follows the [CakePhp Plugin Standards](https://book.cakephp.org/3.0/en/plugins.html). If you'd like to contribute new features, enhancements or bug fixes to the plugin, please feel free to pull or report/open issues.

## License

Copyright 2017-2020 [Hassnain Abass](https://www.linkedin.com/in/hussnain-abass-b041b578/). All rights reserved.

Licensed under the [MIT](http://www.opensource.org/licenses/mit-license.php) License. Redistributions of the source code included in this repository must retain the copyright notice found in each file.

**Goodluck And Happy Coding.**