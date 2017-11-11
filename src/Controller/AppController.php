<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

class AppController extends Controller
{

    public $sidebarItems = [
        [
            'icon' => 'home',
            'name' => 'Dashboard',
            'link' => ['controller' => 'Pages', 'action' => 'home']
        ],
        [
            'icon' => 'money',
            'name' => 'Payments',
            'link' => ['controller' => 'Pages', 'action' => 'payments']
        ],
        [
            'icon' => 'cog',
            'name' => 'Settings',
            'link' => ['controller' => 'Settings', 'action' => 'index']
        ],
        [
            'icon' => 'microphone',
            'name' => 'Speakers',
            'link' => false,
            'children' => [
                [
                    'name' => 'Submissions',
                    'link' => ['controller' => 'Submissions', 'action' => 'index']
                ],
                [
                    'name' => 'List of speakers',
                    'link' => ['controller' => 'Speakers', 'action' => 'index']
                ],
                [
                    'name' => 'Add speaker',
                    'link' => ['controller' => 'Speakers', 'action' => 'add']
                ],
            ]
        ],
        [
            'icon' => 'handshake-o',
            'name' => 'Sponsors',
            'link' => false,
            'children' => [
                [
                    'name' => 'List',
                    'link' => ['controller' => 'Sponsors', 'action' => 'index']
                ],
                [
                    'name' => 'Add',
                    'link' => ['controller' => 'Sponsors', 'action' => 'add']
                ],
            ]
        ],
        [
            'icon' => 'file-text',
            'name' => 'Speakers subpage',
            'link' => false,
            'children' => [
                [
                    'name' => 'List',
                    'link' => ['controller' => 'Offers', 'action' => 'index']
                ],
                [
                    'name' => 'Add',
                    'link' => ['controller' => 'Offers', 'action' => 'add']
                ],
            ]
        ],
        [
            'icon' => 'certificate',
            'name' => 'Editions',
            'link' => false,
            'children' => [
                [
                    'name' => 'List',
                    'link' => ['controller' => 'Editions', 'action' => 'index']
                ],
                [
                    'name' => 'Add',
                    'link' => ['controller' => 'Editions', 'action' => 'add']
                ]
            ]
        ],
    ];

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Security');
        $this->loadComponent('Csrf');
    }

    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }

    private function checkActiveLink($data)
    {
        return $this->request->params['controller'] === $data['controller'] && $this->request->params['action'] === $data['action'];
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $sidebarItems = $this->sidebarItems;
        $active = false;
        foreach ($sidebarItems as $key => $item) {
            if (isset($item['children'])) {
                foreach ($item['children'] as $cKey => $children) {
                    if ($this->checkActiveLink($children['link'])) {
                        $sidebarItems[$key]['children'][$cKey]['active'] = true;
                        $active = true;
                        break;
                    }
                }
            } else if ($this->checkActiveLink($item['link'])) {
                $active = true;
            }

            if ($active) {
                $sidebarItems[$key]['active'] = true;
                break;
            }
        }

        $this->set(compact('sidebarItems'));
    }
}
