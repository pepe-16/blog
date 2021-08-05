<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

class User extends Entity
{
    // Hacer que todos los campos sean asignables en masa por ahora.
    protected $_accessible =
        [
            '*' => true
        ];

    protected function _setPassword($password) 
    {
        if(strlen($password) > 0)
        {
            $hasher = new DefaultPasswordHasher();
            return $hasher->hash($password);
        }
    }
}