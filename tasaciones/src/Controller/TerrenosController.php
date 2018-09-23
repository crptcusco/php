<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Terrenos Controller
 *
 * @property \App\Model\Table\TerrenosTable $Terrenos
 */
class TerrenosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $terrenos = $this->paginate($this->Terrenos);

        $this->set(compact('terrenos'));
        $this->set('_serialize', ['terrenos']);
    }

    /**
     * View method
     *
     * @param string|null $id Terreno id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $terreno = $this->Terrenos->get($id, [
            'contain' => []
        ]);

        $this->set('terreno', $terreno);
        $this->set('_serialize', ['terreno']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $terreno = $this->Terrenos->newEntity();
        if ($this->request->is('post')) {
            $terreno = $this->Terrenos->patchEntity($terreno, $this->request->data);
            if ($this->Terrenos->save($terreno)) {
                $this->Flash->success(__('The terreno has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The terreno could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('terreno'));
        $this->set('_serialize', ['terreno']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Terreno id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $terreno = $this->Terrenos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $terreno = $this->Terrenos->patchEntity($terreno, $this->request->data);
            if ($this->Terrenos->save($terreno)) {
                $this->Flash->success(__('The terreno has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The terreno could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('terreno'));
        $this->set('_serialize', ['terreno']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Terreno id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $terreno = $this->Terrenos->get($id);
        if ($this->Terrenos->delete($terreno)) {
            $this->Flash->success(__('The terreno has been deleted.'));
        } else {
            $this->Flash->error(__('The terreno could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
