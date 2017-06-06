# UsersPermissions plugin for CakePHP
The **UsersPermissions plugin** is for allowing admins to add user permissions for each module in Cakephp. It provides a basic interface to manage user permissions and check upon each request.
It provides check box based user permissions in a form like magento.

## Requirements

* CakePHP 3.0+
* [Cakephp Migration Plugin](https://book.cakephp.org/3.0/en/migrations.html)
* [Simple Cakephp 3 Authentication](https://book.cakephp.org/3.0/en/tutorials-and-examples/blog-auth-example/auth.html)
* PHP 5.2.8+

## Installation

You can install this plugin into your CakePHP 3 application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

```
composer require hassnainTechKnox/UsersPermissions
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
	It will create a table named "user_permissions" in database using default database connection configured in config/app.php of your cake php installation.

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
**Thats all your plugin has been installed, yay :)**

### Usage

## Author

Developed by [Hassnain Abass](https://www.linkedin.com/in/hussnain-abass-b041b578/) - Senior Web Developer and [Freelancer](https://www.freelancer.com/)

##Contributing

This repository follows the [CakePhp Plugin Standard](https://book.cakephp.org/3.0/en/plugins.html). If you'd like to contribute new features, enhancements or bug fixes to the plugin, please feel free to pull.

##License

Copyright 2017-2020 [Hassnain Abass](https://www.linkedin.com/in/hussnain-abass-b041b578/). All rights reserved.

Licensed under the [MIT](http://www.opensource.org/licenses/mit-license.php) License. Redistributions of the source code included in this repository must retain the copyright notice found in each file.