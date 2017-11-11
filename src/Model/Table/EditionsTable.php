<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Editions Model
 *
 * @property \Cake\ORM\Association\HasMany $Offers
 * @property \Cake\ORM\Association\HasMany $Settings
 * @property \Cake\ORM\Association\HasMany $Speakers
 * @property \Cake\ORM\Association\HasMany $Submissions
 *
 * @method \App\Model\Entity\Edition get($primaryKey, $options = [])
 * @method \App\Model\Entity\Edition newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Edition[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Edition|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Edition patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Edition[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Edition findOrCreate($search, callable $callback = null, $options = [])
 */
class EditionsTable extends Table
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

        $this->table('editions');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->hasMany('Offers', [
            'foreignKey' => 'edition_id'
        ]);
        $this->hasMany('Settings', [
            'foreignKey' => 'edition_id'
        ]);
        $this->hasMany('Speakers', [
            'foreignKey' => 'edition_id'
        ]);
        $this->hasMany('Submissions', [
            'foreignKey' => 'edition_id'
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
            ->notEmpty('name')
            ->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['name']));

        return $rules;
    }

    public function getAPIData()
    {
        $editionsData = $this->find('all', [
            'contain' => [],
            'order' => ['Editions.name' => 'DESC'],
        ]);

        $data = $editionsData->toArray();

        foreach ($data as $mKey => $mValue) {
            unset($data[$mKey]['speakers_list']);
            $data[$mKey]['vimeos'] = explode(PHP_EOL, $data[$mKey]['vimeos']);
        }

        return $data;
    }
}
