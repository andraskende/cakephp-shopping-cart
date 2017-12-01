<?php
App::uses('AppController', 'Controller');
class BrandsController extends AppController {

////////////////////////////////////////////////////////////

    public function index() {
        $brands = $this->Brand->find('all', [
            'recursive' => -1,
            'conditions' => [
                'Brand.active' => 1
            ],
            'order' => [
                'Brand.name' => 'ASC'
            ]
        ]);
        $this->set(compact('brands'));
    }

////////////////////////////////////////////////////////////

    public function view($slug = null) {
        $brand =  $this->Brand->find('first', [
            'conditions' => [
                'Brand.active' => 1,
                'Brand.slug' => $slug
            ]
        ]);
        if(empty($brand)) {
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('brand'));

        $this->Paginator = $this->Components->load('Paginator');

        $this->Paginator->settings = [
            'Product' => [
                'recursive' => -1,
                'contain' => [
                    'Brand'
                ],
                'limit' => 40,
                'conditions' => [
                    'Product.active' => 1,
                    'Product.brand_id' => $brand['Brand']['id'],
                    'Brand.active' => 1,

                ],
                'order' => [
                    'Product.name' => 'ASC'
                ],
                'paramType' => 'querystring',
            ]
        ];
        $products = $this->Paginator->paginate($this->Brand->Product);

        $this->set(compact('products'));

    }

////////////////////////////////////////////////////////////

    public function admin_index() {
        $this->Paginator = $this->Components->load('Paginator');
        $this->set('brands', $this->Paginator->paginate());
    }

////////////////////////////////////////////////////////////

    public function admin_view($id = null) {
        if (!$this->Brand->exists($id)) {
            throw new NotFoundException('Invalid brand');
        }
        $brand = $this->Brand->find('first', [
            'conditions' => [
                'Brand.id'
            ]
        ]);
        $this->set(compact('brand'));
    }

////////////////////////////////////////////////////////////

    public function admin_add() {
        if ($this->request->is('post')) {
            $this->Brand->create();
            if ($this->Brand->save($this->request->data)) {
                $this->Flash->flash('The brand has been saved');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->flash('The brand could not be saved. Please, try again.');
            }
        }
    }

////////////////////////////////////////////////////////////

    public function admin_edit($id = null) {
        if (!$this->Brand->exists($id)) {
            throw new NotFoundException('Invalid brand');
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Brand->save($this->request->data)) {
                $this->Flash->flash('The brand has been saved');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->flash('The brand could not be saved. Please, try again.');
            }
        } else {
            $brand = $this->Brand->find('first', [
                'conditions' => [
                    'Brand.id' => $id
                ]
            ]);
            $this->request->data = $brand;
        }
    }

////////////////////////////////////////////////////////////

    public function admin_delete($id = null) {
        $this->Brand->id = $id;
        if (!$this->Brand->exists()) {
            throw new NotFoundException('Invalid brand');
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Brand->delete()) {
            $this->Flash->flash('Brand deleted');
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->flash('Brand was not deleted');
        return $this->redirect(['action' => 'index']);
    }

////////////////////////////////////////////////////////////

}