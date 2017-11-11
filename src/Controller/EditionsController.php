<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Editions Controller
 *
 * @property \App\Model\Table\EditionsTable $Editions
 */
class EditionsController extends AdminController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $editions = $this->paginate($this->Editions);

        $this->set(compact('editions'));
        $this->set('_serialize', ['editions']);
    }

    /**
     * View method
     *
     * @param string|null $id Edition id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $edition = $this->Editions->get($id, [
            'contain' => ['Offers', 'Settings', 'Speakers', 'Submissions']
        ]);

        $this->set('edition', $edition);
        $this->set('_serialize', ['edition']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $edition = $this->Editions->newEntity();
        if ($this->request->is('post')) {
            $edition = $this->Editions->patchEntity($edition, $this->request->data);
            if ($this->Editions->save($edition)) {
                $this->Flash->success(__('The edition has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The edition could not be saved. Please, try again.'));
        }
        $this->set(compact('edition'));
        $this->set('_serialize', ['edition']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Edition id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $edition = $this->Editions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $edition = $this->Editions->patchEntity($edition, $this->request->data);
            if ($this->Editions->save($edition)) {
                $this->Flash->success(__('The edition has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The edition could not be saved. Please, try again.'));
        }
        $this->set(compact('edition'));
        $this->set('_serialize', ['edition']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Edition id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $edition = $this->Editions->get($id);
        if ($this->Editions->delete($edition)) {
            $this->Flash->success(__('The edition has been deleted.'));
        } else {
            $this->Flash->error(__('The edition could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
