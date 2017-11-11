<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Speakers Controller
 *
 * @property \App\Model\Table\SpeakersTable $Speakers
 */
class SpeakersController extends AdminController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {

        $speakers = $this->Speakers->find('all', [
            'contain' => ['Offers', 'Editions'],
        ]);

        $this->set(compact('speakers'));
        $this->set('_serialize', ['speakers']);
    }

    /**
     * View method
     *
     * @param string|null $id Speaker id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $speaker = $this->Speakers->get($id, [
            'contain' => ['Offers', 'Editions']
        ]);

        $this->set('speaker', $speaker);
        $this->set('_serialize', ['speaker']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $speaker = $this->Speakers->newEntity();
        if ($this->request->is('post')) {
            $speaker = $this->Speakers->patchEntity($speaker, $this->request->data);
            if ($this->Speakers->save($speaker)) {
                $this->Flash->success(__('The speaker has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The speaker could not be saved. Please, try again.'));
        }
        $offers = $this->Speakers->Offers->find('list', ['limit' => 200]);
        $editions = $this->Speakers->Editions->find('list', ['limit' => 200]);
        $this->set(compact('speaker', 'offers', 'editions'));
        $this->set('_serialize', ['speaker']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Speaker id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $speaker = $this->Speakers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {

            if (!is_array($this->request->data['photo']) || !$this->request->data['photo']['tmp_name']) {
                unset($this->request->data['photo']);
            }

            $speaker = $this->Speakers->patchEntity($speaker, $this->request->data);
            if ($this->Speakers->save($speaker)) {
                $this->Flash->success(__('The speaker has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The speaker could not be saved. Please, try again.'));
        }
        $offers = $this->Speakers->Offers->find('list', ['limit' => 200]);
        $editions = $this->Speakers->Editions->find('list', ['limit' => 200]);
        $this->set(compact('speaker', 'offers', 'editions'));
        $this->set('_serialize', ['speaker']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Speaker id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $speaker = $this->Speakers->get($id);
        if ($this->Speakers->delete($speaker)) {
            $this->Flash->success(__('The speaker has been deleted.'));
        } else {
            $this->Flash->error(__('The speaker could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
