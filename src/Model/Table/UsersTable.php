<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{
    public function validationDefault(Validator $validator)
    {
        return $validator
        ->notEmpty('username','A username is required') // No se puede dejar el campo vacio.
        ->notEmpty('password','A password is required') // No se puede dejar el campo vacio.
        ->notEmpty('role','A role is required') // No se puede dejar el campo vacio.
        ->add('role','inList',[
            'rule'=>['inList',['admin','author']],
            'message'=>'Please enter avalid role'
            ]);
    }

}

?>

