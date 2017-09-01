<?php

namespace App\Managers;

class ManagerFactory
{
    const TodoManager = 'App\Managers\TodoManager';
	
	private static $todoManager;

	public static function createManger($value)
	{
		switch ($value) {

			case self::PlayerManager:
				if(self::$pm == null){
					$pm = self::PlayerManager;
					self::$pm = new $pm;
				} 				
				return self::$pm;

			default:
				return null;
		}
	}

}