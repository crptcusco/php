<?php
// src/Model/Table/TrabajadoresTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class TrabajadoresTable extends Table
{

    public function validationDefault(Validator $validator)
    {
        return $validator
            ->notEmpty('usuario', 'A username is required')
            ->notEmpty('password', 'A password is required');
            
    }

}
