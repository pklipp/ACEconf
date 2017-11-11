<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Network\Exception\BadRequestException;
use Cake\Mailer\Email;
use Cake\Cache\Cache;

class APIController extends Controller
{
    private $allowedOrigin = '*';
    private $clientId = 'e4cc1e36e2e4edd69924806accbadf2d1796d42a';
    private $clientSecret = 'wHZmQapMbx3Px2lpjPZa0w8QhecetCjCSzqNg2l0bCUnAuq1F5cEmQfXQCJuTb3WAslJ2sbqGJQTdmp/cyqIhp1RGdb6l/5iZB9rW2IzWpXG54biAV7p6PDY17RlGwGx';

    public function beforeFilter(Event $event)
    {

        if (!$this->request->is(['post', 'options'])) {
            throw new BadRequestException();
        }

        header('Access-Control-Allow-Origin: ' . $this->allowedOrigin);
        header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
        header_remove('X-Powered-By');
        header_remove('Server');

        $this->autoRender = false;
        $this->eventManager()->off($this->Csrf);
        $actions = ['subscribe', 'sendSubmission', 'sendEmail'];
        $this->Security->config('unlockedActions', $actions);

        //////
        $this->loadModel('Settings');
        $this->loadModel('Speakers');
        $this->loadModel('Sponsors');
        $this->loadModel('SponsorsGroups');
        $this->loadModel('Editions');

        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->type('json');
    }

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Security');
        $this->loadComponent('Csrf');
    }

    public function getMainData()
    {
        $settingsData = $this->Settings->getAPIData();

        $data = [
            'global' => [
                'button_text' => $settingsData['settings']['button_text'],
                'site_bs_description' => $settingsData['settings']['site_bs_description'],
                'site_bs_title' => $settingsData['settings']['site_bs_title'],
                'site_description' => $settingsData['settings']['site_description'],
                'site_title' => $settingsData['settings']['site_title'],
            ],
            'code_of_conduct_file' => $settingsData['settings']['code_of_conduct_file'],
            'copyright_data' => 'Copyright 2009 - ' . date('Y'),
        ];

        $this->response->type('json');
        $this->response->body(json_encode($data));
    }

    public function getHomeData()
    {
        $settingsData = $this->Settings->getAPIData();
        $sponsorsGroups = $this->SponsorsGroups->getApiData();
        $editions = $this->Editions->getApiData();
        $speakers = $this->Speakers->getApiData();


        $data = [
            'settings' => $settingsData['settings'],
            'speakers' => $speakers,
            'sponsors_groups' => $sponsorsGroups,
            'editions' => $editions,
            'counter_data' => $settingsData['counter'],
            'timeline_data' => $settingsData['timeline'],
        ];

        $this->response->type('json');
        $this->response->body(json_encode($data));
    }

    public function getBecomeSpeakerData()
    {
        $settingsData = $this->Settings->getAPIData();


        $data = [
            'texts' => $settingsData['become_speaker_texts'],
        ];

        $this->response->type('json');
        $this->response->body(json_encode($data));
    }

    public function subscribe()
    {
        if ($this->request->is(['post'])) {
            $email = $this->request->data['email'];
            $data = [];

            //validate email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $data['error_message'] = 'Incorrect email';
            } else {
                $settingsData = $this->Settings->getAPIData();
                $apikey = $settingsData['mailchimp_data']['api_key'];
                $listId = $settingsData['mailchimp_data']['list_id'];

                $serverPrefix = explode('-', $apikey)[1];
                $auth = base64_encode('user:' . $apikey);

                $mailChimpData = array(
                    'apikey' => $apikey,
                    'email_address' => $email,
                    'status' => 'subscribed',
                );
                $json_data = json_encode($mailChimpData);

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://' . $serverPrefix . '.api.mailchimp.com/3.0/lists/' . $listId . '/members/');
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Basic ' . $auth));
                curl_setopt($ch, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_TIMEOUT, 10);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
                $result = curl_exec($ch);

                $resultData = json_decode($result, true);

                if ($resultData['status'] === 400) {
                    $data['error_message'] = 'Email is already on list.';
                } else if ($resultData['status'] !== 'subscribed') {
                    $data['error_message'] = 'Error occurred. Please try again later.';
                }
            }

            $this->response->type('json');
            $this->response->body(json_encode($data));
        }
    }

    public function sendSubmission()
    {
        if ($this->request->is(['post'])) {
            $requestData = $this->request->data;
            $currentEditionId = $this->Settings->getCurrentEditionId();
            $data = [];
            /*$requestData = [
                'first_name' => '',
                'last_name' => '',
                'email' => '',
                'type' => 1,
                'title' => '',
                'country' => '',
                'description' => '',
                'bio' => '',
                'experience' => '',
            ];*/

            $newSubmission = [
                'first_name' => isset($requestData['first_name']) ? $requestData['first_name'] : '',
                'last_name' => isset($requestData['last_name']) ? $requestData['last_name'] : '',
                'email' => isset($requestData['email']) ? $requestData['email'] : '',
                'talktype_id' => isset($requestData['type']) ? (int)$requestData['type'] : '',
                'topic' => isset($requestData['title']) ? $requestData['title'] : '',
                'country' => isset($requestData['country']) ? $requestData['country'] : '',
                'edition_id' => $currentEditionId,
                'description' => isset($requestData['description']) ? $requestData['description'] : '',
                'speaker_bio' => isset($requestData['bio']) ? $requestData['bio'] : '',
                'past_events' => isset($requestData['experience']) ? $requestData['experience'] : '',
            ];

            $this->loadModel('Submissions');

            $submission = $this->Submissions->newEntity($newSubmission);
            $saveData = $this->Submissions->save($submission);
            if ($saveData) {
                $data = [
                    'success_message' => 'Thank you for your submission! We will come back to you soon!',
                ];

                $emailData = $this->Settings->getEmailFormSubmissionData();
                $dataToReplace = [
                    '{{NAME}}' => $newSubmission['first_name'] . ' ' . $newSubmission['last_name'],
                    '{{EMAIL}}' => $newSubmission['email'],
                    '{{TITLE}}' => $newSubmission['topic'],
                ];
                $find = array_keys($dataToReplace);
                $replace = array_values($dataToReplace);
                $preparedEmailContent = str_ireplace($find, $replace, $emailData['content']);

                $email = new Email();
                $email
                    ->from(['contact@aceconf.com' => 'ACECONF'])
                    ->to($requestData['email'])
                    ->subject($emailData['title'])
                    ->send($preparedEmailContent);
            } else if ($submission->errors()) {
                $errors = $submission->errors();

                $names = [
                    'first_name' => 'First name',
                    'last_name' => 'Last name',
                    'email' => 'Email',
                    'talktype_id' => 'Track',
                    'topic' => 'Title',
                    'country' => 'Country',
                    'description' => 'Description',
                    'speaker_bio' => 'Speaker bio',
                    'past_events' => 'Events description',
                ];
                $errorMessage = 'Please correct errors:<br/><br/>';

                foreach ($errors as $fieldKey => $fieldErrors) {
                    $errorMessage .= '<strong>' . $names[$fieldKey] . ':</strong> ' . array_values($fieldErrors)[0] . '<br/>';
                }

                $data = [
                    'error_code' => $errorMessage,
                ];
            } else {
                $data = [
                    'error_code' => 'Error occurred. Please try again later.',
                ];
            }

            $this->response->type('json');
            $this->response->body(json_encode($data));
        }
    }

    public function sendEmail()
    {
        if ($this->request->is(['post'])) {
            $data = [
                'success_message' => 'The message has been sent.',
            ];
            $requestData = $this->request->data;
            $emailReceivers = $this->Settings->getEmail();

            $emailReceivers = explode('|', $emailReceivers);

            $email = new Email();
            $email
                ->from(['contact@aceconf.com' => 'ACECONF'])
                ->to($emailReceivers);

            $contactMessage = '
            Message from contact form:
            
            Name: ' . $requestData['name'] . '
            Email: ' . $requestData['email'] . '
            Message: ' . $requestData['message'] . '
            ';

            $email
                ->subject('ACECONF - contact form')
                ->send($contactMessage);

            $this->response->type('json');
            $this->response->body(json_encode($data));
        }
    }

    public function getAcePastVideos()
    {
        $editionsVideos = Cache::read('editions_videos');
        if ($editionsVideos === false) {
            $lib = new \Vimeo\Vimeo($this->clientId, $this->clientSecret);
            $data = [
                'editions' => [],
            ];

            $editions = $this->Editions->getAPIData();
            foreach ($editions as $edition) {
                $data['editions'][$edition->name] = [];
                $response = $lib->request('/me/albums/' . $edition->vimeo_album_id . '/videos', [], 'GET');
                $editionVimeoData = $response['body'];

                foreach ($editionVimeoData['data'] as $videoData) {
                    $data['editions'][$edition->name][] = [
                        'name' => $videoData['name'],
                        'link' => $videoData['link'],
                        'picture_url' => $videoData['pictures']['sizes'][2]['link'],
                    ];
                }
            }

            Cache::write('editions_videos', $data);
        } else {
            $data = Cache::read('editions_videos');
        }

        $this->response->type('json');
        $this->response->body(json_encode($data));
    }
}
