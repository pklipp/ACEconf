<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Sponsors Model
 *
 * @property \Cake\ORM\Association\HasMany $Offers
 *
 * @method \App\Model\Entity\Sponsor get($primaryKey, $options = [])
 * @method \App\Model\Entity\Sponsor newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Sponsor[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Sponsor|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Sponsor patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Sponsor[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Sponsor findOrCreate($search, callable $callback = null, $options = [])
 */
class SponsorsTable extends Table
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

        $this->table('sponsors');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->hasMany('Offers', [
            'foreignKey' => 'sponsor_id'
        ]);

        $this->belongsTo('SponsorsGroups', [
            'foreignKey' => 'sponsor_group',
            'joinType' => 'INNER'
        ]);

        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'photo' => [
                'nameCallback' => function ($data, $settings) {
                    $nameParts = explode('.', $data['name']);
                    return uniqid() . '.' . array_pop($nameParts);
                },
            ],
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

        $validator
            ->requirePresence('link', 'create')
            ->notEmpty('link');

        $validator
            ->integer('sponsor_group')
            ->requirePresence('sponsor_group', 'create')
            ->notEmpty('sponsor_group');

        $validator
            ->boolean('active')
            ->requirePresence('active', 'create')
            ->notEmpty('active');

        return $validator;
    }
}
