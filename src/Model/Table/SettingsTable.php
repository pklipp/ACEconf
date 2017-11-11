<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\I18n\Time;
use Cake\Chronos\Date;
use Cake\Chronos\Chronos;

/**
 * Settings Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Editions
 *
 * @method \App\Model\Entity\Setting get($primaryKey, $options = [])
 * @method \App\Model\Entity\Setting newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Setting[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Setting|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Setting patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Setting[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Setting findOrCreate($search, callable $callback = null, $options = [])
 */
class SettingsTable extends Table
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

        $this->table('settings');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->belongsTo('Editions', [
            'foreignKey' => 'edition_id',
            'joinType' => 'INNER'
        ]);

        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'header_photo' => [
                'nameCallback' => function ($data, $settings) {
                    $nameParts = explode('.', $data['name']);
                    return uniqid() . '.' . array_pop($nameParts);
                },
            ],
            'offer_file_sponsors' => [
                'nameCallback' => function ($data, $settings) {
                    $nameParts = explode('.', $data['name']);
                    return uniqid() . '.' . array_pop($nameParts);
                },
            ],
            'offer_file_speakers' => [
                'nameCallback' => function ($data, $settings) {
                    $nameParts = explode('.', $data['name']);
                    return uniqid() . '.' . array_pop($nameParts);
                },
            ],
            'code_of_conduct_file' => [
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
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->dateTime('start_date')
            ->requirePresence('start_date', 'create')
            ->notEmpty('start_date');

        $validator
            ->requirePresence('place', 'create')
            ->notEmpty('place');

        $validator
            ->requirePresence('icon_type_1', 'create')
            ->notEmpty('icon_type_1');

        $validator
            ->requirePresence('icon_type_2', 'create')
            ->notEmpty('icon_type_2');

        $validator
            ->requirePresence('icon_edition', 'create')
            ->notEmpty('icon_edition');

        $validator
            ->requirePresence('icon_speakers', 'create')
            ->notEmpty('icon_speakers');

        $validator
            ->requirePresence('icon_workshops', 'create')
            ->notEmpty('icon_workshops');

        $validator
            ->requirePresence('icon_attendees', 'create')
            ->notEmpty('icon_attendees');

        $validator
            ->requirePresence('icon_videos', 'create')
            ->notEmpty('icon_videos');

        $validator
            ->requirePresence('icon_talk', 'create')
            ->notEmpty('icon_talk');

        $validator
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->requirePresence('newsletter_text', 'create')
            ->notEmpty('newsletter_text');

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
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['edition_id'], 'Editions'));

        return $rules;
    }

    public function getEmail()
    {
        $settingsData = $this->get(1, [
            'fields' => ['email']
        ]);

        return $settingsData->email;
    }

    public function getCurrentEditionId()
    {
        return $this->get(1)->edition_id;
    }

    public function getEmailFormSubmissionData()
    {
        $settingsData = $this->get(1);
        return [
            'title' => $settingsData->email_after_submission_title,
            'content' => $settingsData->email_after_submission,
        ];
    }

    public function getAPIData()
    {
        $settingsData = $this->get(1);

        $data = [
            'about_description' => $settingsData->about_description,
            'additional_info' => $settingsData->additional_info,
            'header_primary' => $settingsData->header_primary,
            'header_secondary' => $settingsData->header_secondary,
            'button_text' => $settingsData->button_text,
            'confetti' => $settingsData->confetti,
            'countdown_end' => $settingsData->countdown_end,

            'edition_id' => $settingsData->edition_id,
            'header_photo' => '/files/Settings/header_photo/' . $settingsData->header_photo,

            'icon_attendees' => $settingsData->icon_attendees,
            'icon_edition' => $settingsData->icon_edition,
            'icon_speakers' => $settingsData->icon_speakers,
            'icon_talk' => $settingsData->icon_talk,
            'icon_type_1' => $settingsData->icon_type_1,
            'icon_type_2' => $settingsData->icon_type_2,
            'icon_videos' => $settingsData->icon_videos,
            'icon_workshops' => $settingsData->icon_workshops,

            'offer_file_speakers' => '/files/Settings/offer_file_speakers/' . $settingsData->offer_file_speakers,
            'offer_file_sponsors' => '/files/Settings/offer_file_sponsors/' . $settingsData->offer_file_sponsors,
            'code_of_conduct_file' => '/files/Settings/code_of_conduct_file/' . $settingsData->code_of_conduct_file,

            'place_and_date' => $settingsData->place_and_date,
            'site_bs_description' => $settingsData->site_bs_description,
            'site_bs_title' => $settingsData->site_bs_title,
            'site_description' => $settingsData->site_description,
            'site_title' => $settingsData->site_title,
            'speakers_description' => $settingsData->speakers_description,
            'speakers_sliders_title' => $settingsData->speakers_sliders_title,

            'title' => $settingsData->title,
        ];

        $timelineData = [[
            'name' => $settingsData->timeline_name_1,
            'date' => $settingsData->timeline_date_1,
            'active' => false,
            'percent' => 0,
        ], [
            'name' => $settingsData->timeline_name_2,
            'date' => $settingsData->timeline_date_2,
            'active' => false,
            'percent' => 0,
        ], [
            'name' => $settingsData->timeline_name_3,
            'date' => $settingsData->timeline_date_3,
            'active' => false,
            'percent' => 0,
        ], [
            'name' => $settingsData->timeline_name_4,
            'date' => $settingsData->timeline_date_4,
            'active' => false,
            'percent' => 0,
        ]];

        foreach ($timelineData as $key => $value) {
            $isPast = $value['date']->isPast();
            if ($isPast) {
                $timelineData[$key]['active'] = true;

                if (isset($timelineData[$key + 1])) {
                    $nextDate = $timelineData[$key + 1];
                    if ($nextDate['date']->isPast()) {
                        $percent = 100;
                    } else {
                        $diffTotal = $timelineData[$key]['date']->diffInSeconds($nextDate['date']);
                        $diffCurrent = $timelineData[$key]['date']->diffInSeconds(Time::now());
                        $percent = (int)(100 * $diffCurrent / $diffTotal);
                    }

                    $timelineData[$key]['percent'] = $percent;
                }
            }
        }
        $counterData = [
            'speakers' => $settingsData->counter_speakers,
            'attendees' => $settingsData->counter_attendees,
            'lectures' => $settingsData->counter_lectures,
            'workshops' => $settingsData->counter_workshops,
        ];

        $splitBy = '/\n|\r\n?/';
        $becomeSpeakerTexts = [
            'title' => $settingsData->bs_title,
            'top_text' => preg_split($splitBy, $settingsData->bs_title),
            'left_list' => preg_split($splitBy, $settingsData->bs_list_left),
            'right_list' => preg_split($splitBy, $settingsData->bs_list_right),
            'middle_text' => preg_split($splitBy, $settingsData->bs_middle_text),
            'secondary_list' => preg_split($splitBy, $settingsData->bs_secondary_list),
            'bottom_text' => preg_split($splitBy, $settingsData->bs_bottom_text),
        ];

        $mailchimpData = [
            'api_key' => $settingsData->mailchimp_api_key,
            'list_id' => $settingsData->mailchimp_list_id,
        ];

        return [
            'settings' => $data,
            'timeline' => $timelineData,
            'counter' => $counterData,
            'become_speaker_texts' => $becomeSpeakerTexts,
            'mailchimp_data' => $mailchimpData,
        ];
    }
}
