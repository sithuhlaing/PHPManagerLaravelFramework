<?php

namespace App\Managers;

class ManagerFactory
{
    const TodoManager = 'App\Managers\TodoManager';
	
	private static $todoManager;

	public static function createManger($value)
	{
		switch ($value) {

			case self::TodoManager:
				if(self::$todoManager == null){
					$todoManager = self::TodoManager;
					self::$todoManager = new $todoManager;
				} 				
				return self::$todoManager;

			default:
				return null;
		}
	}

}