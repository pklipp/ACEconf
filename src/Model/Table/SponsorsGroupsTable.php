<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SponsorsGroups Model
 *
 * @method \App\Model\Entity\SponsorsGroup get($primaryKey, $options = [])
 * @method \App\Model\Entity\SponsorsGroup newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SponsorsGroup[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SponsorsGroup|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SponsorsGroup patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SponsorsGroup[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SponsorsGroup findOrCreate($search, callable $callback = null, $options = [])
 */
class SponsorsGroupsTable extends Table
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

        $this->table('sponsors_groups');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->hasMany('Sponsors', [
            'foreignKey' => 'sponsor_group'
        ]);
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        return $validator;
    }

    public function getAPIData()
    {
        $sponsorsGroups = $this->find('all', [
            'contain' => ['Sponsors'],
        ]);

        $data = $sponsorsGroups->toArray();

        foreach ($data as $sgKey => $sgValue) {
            foreach ($data[$sgKey]['sponsors'] as $sKey => $sValue) {
                unset($data[$sgKey]['sponsors'][$sKey]['id']);
                unset($data[$sgKey]['sponsors'][$sKey]['active']);
                unset($data[$sgKey]['sponsors'][$sKey]['sponsor_group']);
                $data[$sgKey]['sponsors'][$sKey]['photo'] = '/files/Sponsors/photo/' . $data[$sgKey]['sponsors'][$sKey]['photo'];
            }
        }

        return $data;
    }
}
