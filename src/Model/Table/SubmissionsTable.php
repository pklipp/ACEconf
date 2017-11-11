<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Submissions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Talktypes
 * @property \Cake\ORM\Association\BelongsTo $Editions
 *
 * @method \App\Model\Entity\Submission get($primaryKey, $options = [])
 * @method \App\Model\Entity\Submission newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Submission[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Submission|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Submission patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Submission[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Submission findOrCreate($search, callable $callback = null, $options = [])
 */
class SubmissionsTable extends Table
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

        $this->table('submissions');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Talktypes', [
            'foreignKey' => 'talktype_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Editions', [
            'foreignKey' => 'edition_id',
            'joinType' => 'INNER'
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
            ->requirePresence('first_name', 'create')
            ->notEmpty('first_name')
            ->maxLength('first_name', 25);

        $validator
            ->requirePresence('last_name', 'create')
            ->notEmpty('last_name')
            ->maxLength('last_name', 25);

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email')
            ->maxLength('email', 256);

        $validator
            ->requirePresence('topic', 'create')
            ->notEmpty('topic')
            ->maxLength('topic', 512);

        $validator
            ->requirePresence('country', 'create')
            ->maxLength('country', 64);

        $validator
            ->requirePresence('description', 'create')
            ->notEmpty('description')
            ->maxLength('description', 2000);

        $validator
            ->requirePresence('speaker_bio', 'create')
            ->notEmpty('speaker_bio')
            ->maxLength('speaker_bio', 2000);

        $validator
            ->requirePresence('past_events', 'create')
            ->notEmpty('past_events')
            ->maxLength('past_events', 2000);

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
        $rules->add($rules->existsIn(['talktype_id'], 'Talktypes'));
        $rules->add($rules->existsIn(['edition_id'], 'Editions'));

        return $rules;
    }
}
