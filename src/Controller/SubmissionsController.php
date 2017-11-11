<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\BadRequestException;

/**
 * Submissions Controller
 *
 * @property \App\Model\Table\SubmissionsTable $Submissions
 */
class SubmissionsController extends AdminController
{
    public function index()
    {
        $submissions = $this->Submissions->find('all', [
            'contain' => ['Talktypes', 'Editions'],
        ]);

        $summary = [
            'all' => [
                'count' => 0
            ],
            'ux' => [
                'count' => 0
            ],
            'agile' => [
                'count' => 0
            ],
            'workshops' => [
                'count' => 0
            ]
        ];

        foreach ($submissions as $key => $submission) {
            $talktypeName = strtolower($submission->talktype->name);
            $summary[$talktypeName]['count'] += 1;
            $summary['all']['count'] += 1;
        }

        foreach ($summary as $key => $group) {
            if (!$summary[$key]['count']) {
                $this->Flash->default(__('No submissions.'), [
                    'key' => $key
                ]);
            }
        }

        $this->set(compact('submissions', 'summary'));
        $this->set('_serialize', ['submissions']);
    }

    public function export($type = 'all')
    {
        $this->response->download('submissions.csv');

        if (!in_array($type, ['all', 'ux', 'agile'])) {
            throw new BadRequestException();
        }

        $conditions = [];
        if ($type === 'ux') {
            $conditions['talktype_id'] = 2;
        } else if ($type === 'agile') {
            $conditions['talktype_id'] = 1;
        } else if ($type === 'workshops') {
            $conditions['talktype_id'] = 3;
        }

        $data = $this->Submissions->find('all', [
            'contain' => ['Talktypes', 'Editions'],
            'conditions' => $conditions
        ]);
        $data = $data->toArray();

        $_serialize = 'data';
        $_header = [
            'id',
            'first_name',
            'last_name',
            'talk_type_name',
            'topic',
            'country',
            'edition',
            'description',
            'speaker_bio',
            'past_events'
        ];
        $_extract = [
            'id',
            'first_name',
            'last_name',
            function ($row) {
                return $row['talktype']['name'];
            },
            'topic',
            'country',
            function ($row) {
                return $row['edition']['name'];
            },
            'description',
            'speaker_bio',
            'past_events'
        ];

        $this->set(compact('data', '_serialize', '_header', '_extract'));
        $this->viewBuilder()->className('CsvView.Csv');

        return;
    }
}
