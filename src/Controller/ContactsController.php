<?php

namespace App\Controller;

use App\Controller\AppController;

class ContactsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
       
        $this->loadModel("Contacts");
    }

    public function add()
    {
        $contact = $this->Contacts->newEmptyEntity();

        if ($this->request->is('post')) {
            $contact = $this->Contacts->patchEntity($contact, $this->request->getData());
            if ($this->Contacts->save($contact)) {
                $this->Flash->success(__('O contato foi cadastrado'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Falha ao cadastrar contato'));
        }

        $this->set("title", "Add");
        $this->set(compact("contact"));
    }

    public function index()
    {
        $contacts = $this->Contacts->find()->toList();
        $this->set("title", "List");
        $this->set(compact("contacts"));
    }

    public function edit($id = null)
    {
        $contact = $this->Contacts->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $contact = $this->Contacts->patchEntity($contact, $this->request->getData());
            if ($this->Contacts->save($contact)) {
                $this->Flash->success(__('O contato foi atualizado'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Falha ao atualizar contato'));
        }

        $this->set("title", "Edit");
        $this->set(compact('contact'));
    }

    public function delete($id = null)
    {
        //$this->request->allowMethod(['post', 'delete']);
        $contact = $this->Contacts->get($id);

        if ($this->Contacts->delete($contact)) {
            $this->Flash->success(__('O contato foi excluído'));
        } else {
            $this->Flash->error(__('Falha ao excluir contato'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
