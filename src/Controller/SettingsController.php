<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Filesystem\File;

/**
 * Settings Controller
 *
 * @property \App\Model\Table\SettingsTable $Settings
 */
class SettingsController extends AdminController
{
    public function index()
    {
        $setting = $this->Settings->get(1);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $filesNames = ['header_photo', 'offer_file_sponsors', 'offer_file_speakers', 'code_of_conduct_file'];
            $filesUploaded = [];

            foreach ($filesNames as $fileName) {
                if (!is_array($this->request->data[$fileName]) || !$this->request->data[$fileName]['tmp_name']) {
                    unset($this->request->data[$fileName]);
                } else {
                    $filesUploaded[] = $fileName;
                }
            }

            $lastFiles = [
                'header_photo' => $setting->header_photo,
                'offer_file_sponsors' => $setting->offer_file_sponsors,
                'offer_file_speakers' => $setting->offer_file_speakers,
                'code_of_conduct_file' => $setting->code_of_conduct_file,
            ];

            $setting = $this->Settings->patchEntity($setting, $this->request->data);
            if ($this->Settings->save($setting)) {
                $this->Flash->success(__('The settings has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The settings could not be saved. Please, try again.'));
        }
        $editions = $this->Settings->Editions->find('list', ['limit' => 200]);
        $this->set(compact('setting', 'editions'));
        $this->set('_serialize', ['setting']);
    }
}
