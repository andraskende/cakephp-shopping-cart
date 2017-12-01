<?php
App::uses('AppController', 'Controller');
/**
 * Libraries Controller
 *
 * @property Library $Library
 * @property PaginatorComponent $Paginator
 */
class LibrariesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Library->recursive = 0;
		$this->set('libraries', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Library->exists($id)) {
			throw new NotFoundException(__('Invalid library'));
		}
		$options = array('conditions' => array('Library.' . $this->Library->primaryKey => $id));
		$this->set('library', $this->Library->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Library->create();
			if ($this->Library->save($this->request->data)) {
				$this->Flash->success(__('The library has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The library could not be saved. Please, try again.'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Library->exists($id)) {
			throw new NotFoundException(__('Invalid library'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Library->save($this->request->data)) {
				$this->Flash->success(__('The library has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The library could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Library.' . $this->Library->primaryKey => $id));
			$this->request->data = $this->Library->find('first', $options);
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Library->id = $id;
		if (!$this->Library->exists()) {
			throw new NotFoundException(__('Invalid library'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Library->delete()) {
			$this->Flash->success(__('The library has been deleted.'));
		} else {
			$this->Flash->error(__('The library could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
