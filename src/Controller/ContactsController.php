<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Validation\Validator;

class ContactsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadModel("Contacts");
    }

    public function add()
    {
        $validator = new Validator();

        $validator->requirePresence('name', 'O nome deve ser informado.')
        ->notEmptyString('name', 'O nome deve ser informado.')
        ->add('name', [
            'minLength' => [
                'rule'    => ['minLength', 3],
                'last'    => true,
                'message' => 'O nome informado é muito curto. O nome deve ter no mínimo 3 caracteres.'
            ],
            'maxLength' => [
                'rule'    => ['maxLength', 255],
                'message' => 'O nome informado é muito longo. O nome deveter no máximo 255 caracteres.'
            ]
        ])
        ->notBlank('email', "O e-mail deve ser infomado.")
        ->email('email', "E-mail informado inválido.")
        ->notBlank('phone', "O telefone deve ser infomado.");

        $errors = $validator->errors($this->request->getData());

        $contact = $this->Contacts->newEmptyEntity();

        if (empty($errors) && $this->request->is('post')) {
            $contact = $this->Contacts->patchEntity($contact, $this->request->getData());

            if ($this->Contacts->save($contact)) {
                $this->Flash->success(__('O contato foi cadastrado'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('Falha ao cadastrar contato'));
        } 
        elseif (!empty($errors) && $this->request->is('post')) {
            foreach($errors as $error){
                foreach($error as $msg){
                    $this->Flash->error(__($msg));
                }
            }
        }

        $this->set("title", "Add");
        $this->set(compact("contact"));
    }

    public function index()
    {
        $contacts = $this->Contacts->find()->order(["name" => "ASC", "id" => "ASC"])->toList();

        $this->set("title", "List");
        $this->set(compact("contacts"));
    }

    public function edit($id = null)
    {
        $validator = new Validator();

        $validator->requirePresence('name', 'O nome deve ser informado.')
        ->notEmptyString('name', 'O nome deve ser informado.')
        ->add('name', [
            'minLength' => [
                'rule'    => ['minLength', 3],
                'last'    => true,
                'message' => 'O nome informado é muito curto. O nome deve ter no mínimo 3 caracteres.'
            ],
            'maxLength' => [
                'rule'    => ['maxLength', 255],
                'message' => 'O nome informado é muito longo. O nome deveter no máximo 255 caracteres.'
            ]
        ])
        ->notBlank('email', "O e-mail deve ser infomado.")
        ->email('email', "E-mail informado inválido.")
        ->notBlank('phone', "O telefone deve ser infomado.");

        $errors = $validator->errors($this->request->getData());

        $contact = $this->Contacts->get($id, [
            'contain' => [],
        ]);

        if (empty($errors) && $this->request->is(['patch', 'post', 'put'])) {
            $contact = $this->Contacts->patchEntity($contact, $this->request->getData());

            if ($this->Contacts->save($contact)) {
                $this->Flash->success(__('O contato foi atualizado'));

                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('Falha ao atualizar contato'));
        }
        elseif (!empty($errors) && $this->request->is(['patch', 'post', 'put'])) {
            foreach($errors as $error){
                foreach($error as $msg){
                    $this->Flash->error(__($msg));
                }
            }
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
