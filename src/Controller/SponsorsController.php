<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Sponsors Controller
 *
 * @property \App\Model\Table\SponsorsTable $Sponsors
 */
class SponsorsController extends AdminController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $sponsors = $this->Sponsors->find('all', [
            'contain' => ['SponsorsGroups'],
        ]);

        $this->set(compact('sponsors'));
        $this->set('_serialize', ['sponsors']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $sponsor = $this->Sponsors->newEntity();
        if ($this->request->is('post')) {
            $sponsor = $this->Sponsors->patchEntity($sponsor, $this->request->data);
            if ($this->Sponsors->save($sponsor)) {
                $this->Flash->success(__('The sponsor has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sponsor could not be saved. Please, try again.'));
        }
        $groups = $this->Sponsors->SponsorsGroups->find('list', ['limit' => 200]);

        $this->set(compact('sponsor', 'groups'));
        $this->set('_serialize', ['sponsor']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Sponsor id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $sponsor = $this->Sponsors->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {

            if (!is_array($this->request->data['photo']) || !$this->request->data['photo']['tmp_name']) {
                unset($this->request->data['photo']);
            }

            $sponsor = $this->Sponsors->patchEntity($sponsor, $this->request->data);
            if ($this->Sponsors->save($sponsor)) {
                $this->Flash->success(__('The sponsor has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sponsor could not be saved. Please, try again.'));
        }
        $groups = $this->Sponsors->SponsorsGroups->find('list', ['limit' => 200]);

        $this->set(compact('sponsor', 'groups'));
        $this->set('_serialize', ['sponsor']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Sponsor id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $sponsor = $this->Sponsors->get($id);
        if ($this->Sponsors->delete($sponsor)) {
            $this->Flash->success(__('The sponsor has been deleted.'));
        } else {
            $this->Flash->error(__('The sponsor could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
