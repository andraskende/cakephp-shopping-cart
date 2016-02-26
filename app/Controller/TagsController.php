<?php
App::uses('AppController', 'Controller');
class TagsController extends AppController {

////////////////////////////////////////////////////////////

    public $components = array('Paginator');

////////////////////////////////////////////////////////////

    public function admin_index() {

        $this->Paginator->settings = array(
            'recursive' => -1,
            'order' => array(
                'Tag.name' => 'ASC'
            ),
            'limit' => 100,
        );

        $this->set('tags', $this->Paginator->paginate('Tag'));
    }

////////////////////////////////////////////////////////////

    public function admin_view($id = null) {
        if (!$this->Tag->exists($id)) {
            throw new NotFoundException('Invalid tag');
        }
        $options = array('conditions' => array('Tag.id' => $id));
        $this->set('tag', $this->Tag->find('first', $options));
    }

////////////////////////////////////////////////////////////

    public function admin_add() {
        if ($this->request->is('post')) {
            $this->Tag->create();
            if ($this->Tag->save($this->request->data)) {
                $this->Flash->flash('The tag has been saved.');
                return $this->redirect($this->referer());
                // return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->flash('The tag could not be saved. Please, try again.');
            }
        }
    }

////////////////////////////////////////////////////////////

    public function admin_edit($id = null) {
        if (!$this->Tag->exists($id)) {
            throw new NotFoundException('Invalid tag');
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Tag->save($this->request->data)) {
                $this->Flash->flash('The tag has been saved.');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->flash('The tag could not be saved. Please, try again.');
            }
        } else {
            $options = array('conditions' => array('Tag.id' => $id));
            $this->request->data = $this->Tag->find('first', $options);
        }
    }

////////////////////////////////////////////////////////////

    public function admin_delete($id = null) {
        $this->Tag->id = $id;
        if (!$this->Tag->exists()) {
            throw new NotFoundException('Invalid tag');
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Tag->delete()) {
            $this->Flash->flash('The tag has been deleted.');
        } else {
            $this->Flash->flash('The tag could not be deleted. Please, try again.');
        }
        return $this->redirect(array('action' => 'index'));
    }

////////////////////////////////////////////////////////////

}
