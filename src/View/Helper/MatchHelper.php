<?php

namespace UsersPermissions\View\Helper;

use Cake\View\Helper;

class MatchHelper extends Helper
{
    public function matchPermission($key, $value)
    {
        if($value==false)
        {
        	return false;
        }

        if (strpos($value, $key) !== false) {
		    return true;
		}

		return false;
    }
}