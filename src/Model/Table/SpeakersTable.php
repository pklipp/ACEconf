<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Speakers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Offers
 * @property \Cake\ORM\Association\BelongsTo $Editions
 *
 * @method \App\Model\Entity\Speaker get($primaryKey, $options = [])
 * @method \App\Model\Entity\Speaker newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Speaker[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Speaker|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Speaker patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Speaker[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Speaker findOrCreate($search, callable $callback = null, $options = [])
 */
class SpeakersTable extends Table
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

        $this->table('speakers');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Offers', [
            'foreignKey' => 'offer_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Editions', [
            'foreignKey' => 'edition_id',
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
            ->requirePresence('first_name', 'create')
            ->notEmpty('first_name');

        $validator
            ->requirePresence('last_name', 'create')
            ->notEmpty('last_name');

        $validator
            ->allowEmpty('about');

        $validator
            ->allowEmpty('twitter_link');

        $validator
            ->allowEmpty('facebook_link');

        $validator
            ->allowEmpty('linkedin_link');

        $validator
            ->allowEmpty('google_link');

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
        $rules->add($rules->existsIn(['offer_id'], 'Offers'));
        $rules->add($rules->existsIn(['edition_id'], 'Editions'));

        return $rules;
    }

    public function getAPIData()
    {

        $speakers = $this->find('all', [
            'fields' => [],
            'contain' => [
                'Offers' => [
                    'fields' => ['id'],
                ],
                'Offers.Sponsors' => [
                    'fields' => ['id', 'link', 'name'],
                ],
            ],
            'conditions' => [
                'is_active' => 1,
            ]
        ]);

        $data = $speakers->toArray();

        foreach ($data as $key => $value) {
            $data[$key]['photo'] = '/files/Speakers/photo/' . $data[$key]['photo'];
        }

        return $data;
    }
}
