<?php
App::uses('AppController', 'Controller');
class OrdersController extends AppController {

////////////////////////////////////////////////////////////

    public function admin_index() {

        $this->Paginator = $this->Components->load('Paginator');

        $this->Paginator->settings = [
            'Order' => [
                'recursive' => -1,
                'contain' => [
                ],
                'conditions' => [
                ],
                'order' => [
                    'Order.created' => 'DESC'
                ],
                'limit' => 20,
                'paramType' => 'querystring',
            ]
        ];
        $orders = $this->Paginator->paginate();

        $this->set(compact('orders'));
    }

////////////////////////////////////////////////////////////

    public function admin_view($id = null) {
        $order = $this->Order->find('first', [
            'recursive' => 1,
            'conditions' => [
                'Order.id' => $id
            ]
        ]);
        if (empty($order)) {
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('order'));
    }

////////////////////////////////////////////////////////////

    public function admin_edit($id = null) {
        $this->Order->id = $id;
        if (!$this->Order->exists()) {
            throw new NotFoundException('Invalid order');
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Order->save($this->request->data)) {
                $this->Flash->flash('The order has been saved');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->flash('The order could not be saved. Please, try again.');
            }
        } else {
            $this->request->data = $this->Order->read(null, $id);
        }
    }

////////////////////////////////////////////////////////////

    public function admin_delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Order->id = $id;
        if (!$this->Order->exists()) {
            throw new NotFoundException('Invalid order');
        }
        if ($this->Order->delete()) {
            $this->Flash->flash('Order deleted');
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->flash('Order was not deleted');
        return $this->redirect(['action' => 'index']);
    }

////////////////////////////////////////////////////////////

}
