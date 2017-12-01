<?php
App::uses('AppController', 'Controller');
class ProductmodsController extends AppController {

////////////////////////////////////////////////////////////

    public $components = [
        'Paginator'
    ];

////////////////////////////////////////////////////////////

    public function admin_index() {
        $this->Productmod->recursive = 0;
        $this->set('productmods', $this->Paginator->paginate());
    }

////////////////////////////////////////////////////////////

    public function admin_view($id = null) {
        if (!$this->Productmod->exists($id)) {
            throw new NotFoundException('Invalid productmod');
        }
        $options = [
            'recursive' => 0,
            'conditions' => [
                'Productmod.id' => $id
            ]
        ];
        $this->set('productmod', $this->Productmod->find('first', $options));
    }

////////////////////////////////////////////////////////////

    public function admin_add($id) {
        if ($this->request->is('post')) {
            $this->Productmod->create();
            if ($this->Productmod->save($this->request->data)) {
                $this->Flash->flash('The productmod has been saved.');
                return $this->redirect(['controller' => 'products', 'action' => 'edit', $id]);
            } else {
                $this->Flash->flash('The productmod could not be saved. Please, try again.');
            }
        }
        $products = $this->Productmod->Product->find('list', [
            'conditions' => [
                'Product.id' => $id
            ]
        ]);
        $this->set(compact('products'));
    }

////////////////////////////////////////////////////////////

    public function admin_edit($id = null) {
        if (!$this->Productmod->exists($id)) {
            throw new NotFoundException('Invalid productmod');
        }
        if ($this->request->is(['post', 'put'])) {
            if ($this->Productmod->save($this->request->data)) {
                $this->Flash->flash('The productmod has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->flash('The productmod could not be saved. Please, try again.');
            }
        } else {
            $options = [
                'conditions' => [
                    'Productmod.id' => $id
                ]
            ];
            $this->request->data = $this->Productmod->find('first', $options);
        }
        $products = $this->Productmod->Product->find('list');
        $this->set(compact('products'));
    }

////////////////////////////////////////////////////////////

    public function admin_delete($id = null) {
        $this->Productmod->id = $id;
        if (!$this->Productmod->exists()) {
            throw new NotFoundException('Invalid productmod');
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Productmod->delete()) {
            $this->Flash->flash('The productmod has been deleted.');
        } else {
            $this->Flash->flash('The productmod could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }

////////////////////////////////////////////////////////////

}