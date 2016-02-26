<?php
App::uses('AppController', 'Controller');
class CategoriesController extends AppController {

////////////////////////////////////////////////////////////

    public function index() {
        $this->helpers[] = 'Tree';
        $categories = $this->Category->find('all', array(
            'recursive' => -1,
            'order' => array(
                'Category.lft' => 'ASC'
            ),
            'conditions' => array(
            ),
        ));
        $this->set(compact('categories'));
    }

////////////////////////////////////////////////////////////

    public function view($slug = null) {
        $category = $this->Category->find('first', array(
            'recursive' => -1,
            'conditions' => array(
                'Category.slug' => $slug
            )
        ));
        if(empty($category)) {
            return $this->redirect(array('action' => 'index'));
        }
        $this->set(compact('category'));

        // $parent = $this->Category->getParentNode($category['Category']['id']);
        // debug($parent);

        $parents = $this->Category->getPath($category['Category']['id']);
        // debug($parents);
        $this->set(compact('parents'));

         // $totalChildren = $this->Category->childCount($category['Category']['id']);
         // debug($totalChildren);

        $directChildren = $this->Category->children($category['Category']['id']);
        // debug($directChildren);

        $directChildrenIds = Hash::extract($directChildren, '{n}.Category.id');
        array_push($directChildrenIds, $category['Category']['id']);

        //debug($parents);

        $products = $this->Category->Product->find('all', array(
            'recursive' => -1,
            'conditions' => array(
                'Product.category_id' => $directChildrenIds
            ),
            'order' => array(
                'Product.name' => 'ASC'
            ),
            'limit' => 50
        ));
        $this->set(compact('products'));
    }

////////////////////////////////////////////////////////////

    public function admin_index() {
        $this->Paginator = $this->Components->load('Paginator');
        $this->Paginator->settings = array(
            'Category' => array(
                'recursive' => 0,
            )
        );
        $this->set('categories', $this->Paginator->paginate());

        $this->helpers[] = 'Tree';
        $categoriestree = $this->Category->find('all', array(
            'recursive' => -1,
            'order' => array(
                'Category.lft' => 'ASC'
            ),
            'conditions' => array(
            ),
        ));
        $this->set(compact('categoriestree'));
    }

////////////////////////////////////////////////////////////

    public function admin_view($id = null) {
        if (!$this->Category->exists($id)) {
            throw new NotFoundException('Invalid category');
        }
        $category = $this->Category->find('first', array(
            'contain' => array(
                'ParentCategory'
            ),
            'conditions' => array(
                'Category.id' => $id
            )
        ));
        $this->set(compact('category'));
    }

////////////////////////////////////////////////////////////

    public function admin_add() {
        if ($this->request->is('post')) {
            $this->Category->create();
            if ($this->Category->save($this->request->data)) {
                $this->Flash->flash('The category has been saved');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->flash('The category could not be saved. Please, try again.');
            }
        }

        $parents = $this->Category->generateTreeList(null, null, null, ' -- ');
        $this->set(compact('parents'));
    }

////////////////////////////////////////////////////////////

    public function admin_edit($id = null) {
        if (!$this->Category->exists($id)) {
            throw new NotFoundException('Invalid category');
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Category->save($this->request->data)) {
                $this->Flash->flash('The category has been saved');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->flash('The category could not be saved. Please, try again.');
            }
        } else {
            $this->request->data = $this->Category->find('first', array('conditions' => array('Category.id' => $id)));
        }

        $parents = $this->Category->generateTreeList(null, null, null, ' -- ');
        $this->set(compact('parents'));
    }

////////////////////////////////////////////////////////////

    public function admin_delete($id = null) {
        $this->Category->id = $id;
        if (!$this->Category->exists()) {
            throw new NotFoundException('Invalid category');
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Category->delete()) {
            $this->Flash->flash('Category deleted');
            return $this->redirect(array('action' => 'index'));
        }
        $this->Flash->flash('Category was not deleted');
        return $this->redirect(array('action' => 'index'));
    }

////////////////////////////////////////////////////////////

}
