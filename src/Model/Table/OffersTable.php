<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Offers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Sponsors
 * @property \Cake\ORM\Association\BelongsTo $Editions
 * @property \Cake\ORM\Association\HasMany $Speakers
 *
 * @method \App\Model\Entity\Offer get($primaryKey, $options = [])
 * @method \App\Model\Entity\Offer newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Offer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Offer|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Offer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Offer[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Offer findOrCreate($search, callable $callback = null, $options = [])
 */
class OffersTable extends Table
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

        $this->table('offers');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->belongsTo('Sponsors', [
            'foreignKey' => 'sponsor_id'
        ]);
        $this->belongsTo('Editions', [
            'foreignKey' => 'edition_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Speakers', [
            'foreignKey' => 'offer_id'
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
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        $validator
            ->requirePresence('bio', 'create')
            ->notEmpty('bio');

        $validator
            ->allowEmpty('vimeo');

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
        $rules->add($rules->existsIn(['sponsor_id'], 'Sponsors'));
        $rules->add($rules->existsIn(['edition_id'], 'Editions'));

        return $rules;
    }
}
