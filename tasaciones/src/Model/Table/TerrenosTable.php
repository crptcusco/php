<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Terrenos Model
 *
 * @method \App\Model\Entity\Terreno get($primaryKey, $options = [])
 * @method \App\Model\Entity\Terreno newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Terreno[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Terreno|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Terreno patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Terreno[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Terreno findOrCreate($search, callable $callback = null)
 */
class TerrenosTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('terrenos');
        $this->displayField('id');
        $this->primaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('coordinacion', 'create')
            ->notEmpty('coordinacion');

        $validator
            ->numeric('area')
            ->requirePresence('area', 'create')
            ->notEmpty('area');

        $validator
            ->numeric('valorunitario')
            ->requirePresence('valorunitario', 'create')
            ->notEmpty('valorunitario');

        $validator
            ->numeric('total')
            ->requirePresence('total', 'create')
            ->notEmpty('total');

        $validator
            ->numeric('longitud')
            ->requirePresence('longitud', 'create')
            ->notEmpty('longitud');

        $validator
            ->numeric('latitud')
            ->requirePresence('latitud', 'create')
            ->notEmpty('latitud');

        $validator
            ->requirePresence('observacion', 'create')
            ->notEmpty('observacion');

        $validator
            ->requirePresence('ruta', 'create')
            ->notEmpty('ruta');

        return $validator;
    }
}
