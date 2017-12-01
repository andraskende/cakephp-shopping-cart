<?php
App::uses('AppController', 'Controller');
class ProductsController extends AppController {

////////////////////////////////////////////////////////////

    public $components = array(
        'RequestHandler',
    );

////////////////////////////////////////////////////////////

    public function beforeFilter() {
        parent::beforeFilter();
    }

////////////////////////////////////////////////////////////

    public function index() {
        $products = $this->Product->find('all', array(
            'recursive' => -1,
            'contain' => array(
                'Brand'
            ),
            'limit' => 20,
            'conditions' => array(
                'Product.active' => 1,
                'Brand.active' => 1
            ),
            'order' => array(
                'Product.views' => 'ASC'
            )
        ));
        $this->set(compact('products'));

        $this->Product->updateViews($products);

        $this->set('title_for_layout', Configure::read('Settings.SHOP_TITLE'));
    }

////////////////////////////////////////////////////////////

    public function products() {

        $this->Paginator = $this->Components->load('Paginator');

        $this->Paginator->settings = array(
            'Product' => array(
                'recursive' => -1,
                'contain' => array(
                    'Brand'
                ),
                'limit' => 20,
                'conditions' => array(
                    'Product.active' => 1,
                    'Brand.active' => 1
                ),
                'order' => array(
                    'Product.name' => 'ASC'
                ),
                'paramType' => 'querystring',
            )
        );
        $products = $this->Paginator->paginate();
        $this->set(compact('products'));

        $this->set('title_for_layout', 'All Products - ' . Configure::read('Settings.SHOP_TITLE'));

    }

////////////////////////////////////////////////////////////

    public function view($id = null) {

        $product = $this->Product->find('first', array(
            'recursive' => -1,
            'contain' => array(
                'Category',
                'Brand'
            ),
            'conditions' => array(
                'Brand.active' => 1,
                'Product.active' => 1,
                'Product.slug' => $id
            )
        ));
        if (empty($product)) {
            return $this->redirect(array('action' => 'index'), 301);
        }

        $this->Product->updateViews($product);

        $this->set(compact('product'));

        $productmods = $this->Product->Productmod->getAllProductMods($product['Product']['id'], $product['Product']['price']);
        $this->set('productmodshtml', $productmods['productmodshtml']);

        $this->set('title_for_layout', $product['Product']['name'] . ' ' . Configure::read('Settings.SHOP_TITLE'));

    }

////////////////////////////////////////////////////////////

    public function search() {

        $search = null;
        if(!empty($this->request->query['search']) || !empty($this->request->data['name'])) {
            $search = empty($this->request->query['search']) ? $this->request->data['name'] : $this->request->query['search'];
            $search = preg_replace('/[^a-zA-Z0-9 ]/', '', $search);
            $terms = explode(' ', trim($search));
            $terms = array_diff($terms, array(''));
            $conditions = array(
                'Brand.active' => 1,
                'Product.active' => 1,
            );
            foreach($terms as $term) {
                $terms1[] = preg_replace('/[^a-zA-Z0-9]/', '', $term);
                $conditions[] = array('Product.name LIKE' => '%' . $term . '%');
            }
            $products = $this->Product->find('all', array(
                'recursive' => -1,
                'contain' => array(
                    'Brand'
                ),
                'conditions' => $conditions,
                'limit' => 200,
            ));
            if(count($products) == 1) {
                return $this->redirect(array('controller' => 'products', 'action' => 'view', 'slug' => $products[0]['Product']['slug']));
            }
            $terms1 = array_diff($terms1, array(''));
            $this->set(compact('products', 'terms1'));
        }
        $this->set(compact('search'));

        if ($this->request->is('ajax')) {
            $this->layout = false;
            $this->set('ajax', 1);
        } else {
            $this->set('ajax', 0);
        }

        $this->set('title_for_layout', 'Search');

        $description = 'Search';
        $this->set(compact('description'));

        $keywords = 'search';
        $this->set(compact('keywords'));
    }

////////////////////////////////////////////////////////////

    public function searchjson() {

        $term = null;
        if(!empty($this->request->query['term'])) {
            $term = $this->request->query['term'];
            $terms = explode(' ', trim($term));
            $terms = array_diff($terms, array(''));
            $conditions = array(
                // 'Brand.active' => 1,
                'Product.active' => 1
            );
            foreach($terms as $term) {
                $conditions[] = array('Product.name LIKE' => '%' . $term . '%');
            }
            $products = $this->Product->find('all', array(
                'recursive' => -1,
                'contain' => array(
                    // 'Brand'
                ),
                'fields' => array(
                    'Product.id',
                    'Product.name',
                    'Product.image'
                ),
                'conditions' => $conditions,
                'limit' => 20,
            ));
        }
        // $products = Hash::extract($products, '{n}.Product.name');
        echo json_encode($products);
        $this->autoRender = false;

    }

////////////////////////////////////////////////////////////

    public function sitemap() {
        $products = $this->Product->find('all', array(
            'recursive' => -1,
            'contain' => array(
                'Brand'
            ),
            'fields' => array(
                'Product.slug'
            ),
            'conditions' => array(
                'Brand.active' => 1,
                'Product.active' => 1
            ),
            'order' => array(
                'Product.created' => 'DESC'
            ),
        ));
        $this->set(compact('products'));

        $website = Configure::read('Settings.WEBSITE');
        $this->set(compact('website'));

        $this->layout = 'xml';
        $this->response->type('xml');
    }

////////////////////////////////////////////////////////////

    public function admin_reset() {
        $this->Session->delete('Product');
        return $this->redirect(array('action' => 'index'));
    }

////////////////////////////////////////////////////////////

    public function admin_index() {

        if ($this->request->is('post')) {

            if($this->request->data['Product']['active'] == '1' || $this->request->data['Product']['active'] == '0') {
                $conditions[] = array(
                    'Product.active' => $this->request->data['Product']['active']
                );
                $this->Session->write('Product.active', $this->request->data['Product']['active']);
            } else {
                $this->Session->write('Product.active', '');
            }

            if(!empty($this->request->data['Product']['brand_id'])) {
                $conditions[] = array(
                    'Product.brand_id' => $this->request->data['Product']['brand_id']
                );
                $this->Session->write('Product.brand_id', $this->request->data['Product']['brand_id']);
            } else {
                $this->Session->write('Product.brand_id', '');
            }

            if(!empty($this->request->data['Product']['name'])) {
                $filter = $this->request->data['Product']['filter'];
                $this->Session->write('Product.filter', $filter);
                $name = $this->request->data['Product']['name'];
                $this->Session->write('Product.name', $name);
                $conditions[] = array(
                    'Product.' . $filter . ' LIKE' => '%' . $name . '%'
                );
            } else {
                $this->Session->write('Product.filter', '');
                $this->Session->write('Product.name', '');
            }

            $this->Session->write('Product.conditions', $conditions);
            return $this->redirect(array('action' => 'index'));

        }

        if($this->Session->check('Product')) {
            $all = $this->Session->read('Product');
        } else {
            $all = array(
                'active' => '',
                'brand_id' => '',
                'name' => '',
                'filter' => '',
                'conditions' => ''
            );
        }
        $this->set(compact('all'));

        $this->Paginator = $this->Components->load('Paginator');

        $this->Paginator->settings = array(
            'Product' => array(
                'contain' => array(
                    'Category',
                    'Brand',
                ),
                'recursive' => -1,
                'limit' => 50,
                'conditions' => $all['conditions'],
                'order' => array(
                    'Product.name' => 'ASC'
                ),
                'paramType' => 'querystring',
            )
        );
        $products = $this->Paginator->paginate();

        $brands = $this->Product->Brand->findList();

        $brandseditable = array();
        foreach ($brands as $key => $value) {
            $brandseditable[] = array(
                'value' => $key,
                'text' => $value,
            );
        }

        $categories = $this->Product->Category->generateTreeList(null, null, null, '--');

        $categorieseditable = array();
        foreach ($categories as $key => $value) {
            $categorieseditable[] = array(
                'value' => $key,
                'text' => $value,
            );
        }

        $tags = ClassRegistry::init('Tag')->find('all', array(
            'order' => array(
                'Tag.name' => 'ASC'
            ),
        ));

        $this->set(compact('products', 'brands', 'brandseditable', 'categorieseditable', 'tags'));

    }

////////////////////////////////////////////////////////////

    public function admin_view($id = null) {

        if (($this->request->is('post') || $this->request->is('put')) && !empty($this->request->data['Product']['image']['name'])) {

            $this->Img = $this->Components->load('Img');

            $newName = $this->request->data['Product']['slug'];

            $ext = $this->Img->ext($this->request->data['Product']['image']['name']);

            $origFile = $newName . '.' . $ext;
            $dst = $newName . '.jpg';

            $targetdir = WWW_ROOT . 'images/original';

            $upload = $this->Img->upload($this->request->data['Product']['image']['tmp_name'], $targetdir, $origFile);

            if($upload == 'Success') {
                $this->Img->resampleGD($targetdir . DS . $origFile, WWW_ROOT . 'images/large/', $dst, 800, 800, 1, 0);
                $this->Img->resampleGD($targetdir . DS . $origFile, WWW_ROOT . 'images/small/', $dst, 180, 180, 1, 0);
                $this->request->data['Product']['image'] = $dst;
            } else {
                $this->request->data['Product']['image'] = '';
            }

            if ($this->Product->save($this->request->data)) {
                $this->Flash->flash($upload);
                return $this->redirect($this->referer());
            } else {
                $this->Flash->flash('The Product could not be saved. Please, try again.');
            }
        }

        if (!$this->Product->exists($id)) {
            throw new NotFoundException('Invalid product');
        }
        $product = $this->Product->find('first', array(
            'recursive' => -1,
            'contain' => array(
                'Category',
                'Brand',
            ),
            'conditions' => array(
                'Product.id' => $id
            )
        ));
        $this->set(compact('product'));
    }

////////////////////////////////////////////////////////////

    public function admin_add() {
        if ($this->request->is('post')) {
            $this->Product->create();
            if ($this->Product->save($this->request->data)) {
                $this->Flash->flash('The product has been saved');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->flash('The product could not be saved. Please, try again.');
            }
        }
        $brands = $this->Product->Brand->find('list');
        $this->set(compact('brands'));

        $categories = $this->Product->Category->generateTreeList(null, null, null, '--');
        $this->set(compact('categories'));
    }

////////////////////////////////////////////////////////////

    public function admin_edit($id = null) {

        $_SESSION['KCFINDER'] = array(
            'disabled' => false,
            'uploadURL' => '../images/products',
            'uploadDir' => '',
            'dirPerms' => 0777,
            'filePerms' => 0777
        );

        if (!$this->Product->exists($id)) {
            throw new NotFoundException('Invalid product');
        }
        if ($this->request->is('post') || $this->request->is('put')) {

            if ($this->Product->save($this->request->data)) {
                $this->Flash->flash('The product has been saved');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->flash('The product could not be saved. Please, try again.');
            }
        } else {
            $product = $this->Product->find('first', array(
                'conditions' => array(
                    'Product.id' => $id
                )
            ));
            $this->request->data = $product;
        }

        $this->set(compact('id'));

        $this->set(compact('product'));

        $brands = $this->Product->Brand->find('list');
        $this->set(compact('brands'));

        $categories = $this->Product->Category->generateTreeList(null, null, null, '--');
        $this->set(compact('categories'));

        $productmods = $this->Product->Productmod->find('all', array(
            'conditions' => array(
                'Productmod.product_id' => $id
            )
        ));
        $this->set(compact('productmods'));

    }

////////////////////////////////////////////////////////////

    public function admin_tags($id = null) {

        $tags = ClassRegistry::init('Tag')->find('all', array(
            'recursive' => -1,
            'fields' => array(
                'Tag.name'
            ),
            'order' => array(
                'Tag.name' => 'ASC'
            ),
        ));
        $tags = Hash::combine($tags, '{n}.Tag.name', '{n}.Tag.name');
        $this->set(compact('tags'));

        if ($this->request->is('post') || $this->request->is('put')) {

            $tagstring = '';

            foreach($this->request->data['Product']['tags'] as $tag) {
                $tagstring .= $tag . ', ';
            }

            $tagstring = trim($tagstring);
            $tagstring = rtrim($tagstring, ',');

            $this->request->data['Product']['tags'] = $tagstring;

            $this->Product->save($this->request->data, false);

            return $this->redirect(array('action' => 'tags', $this->request->data['Product']['id']));

        }

        $product = $this->Product->find('first', array(
            'conditions' => array(
                'Product.id' => $id
            )
        ));
        if (empty($product)) {
            throw new NotFoundException('Invalid product');
        }
        $this->set(compact('product'));

        $selectedTags = explode(',', $product['Product']['tags']);
        $selectedTags = array_map('trim', $selectedTags);
        $this->set(compact('selectedTags'));

        $neighbors = $this->Product->find('neighbors', array('field' => 'id', 'value' => $id));
        $this->set(compact('neighbors'));

    }

////////////////////////////////////////////////////////////

    public function admin_csv() {
        $products = $this->Product->find('all', array(
            'recursive' => -1,
        ));
        $this->set(compact('products'));
        $this->layout = false;
    }

////////////////////////////////////////////////////////////

    public function admin_delete($id = null) {
        $this->Product->id = $id;
        if (!$this->Product->exists()) {
            throw new NotFoundException('Invalid product');
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Product->delete()) {
            $this->Flash->flash('Product deleted');
            return $this->redirect(array('action' => 'index'));
        }
        $this->Flash->flash('Product was not deleted');
        return $this->redirect(array('action' => 'index'));
    }

////////////////////////////////////////////////////////////

}
