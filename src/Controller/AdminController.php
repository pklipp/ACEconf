<?php

namespace App\Controller;

use Cake\Event\Event;

class AdminController extends AppController
{

    public function initialize()
    {
        parent::initialize();
    }

    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
    }
}
