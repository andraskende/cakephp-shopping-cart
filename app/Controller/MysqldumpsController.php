<?php
class MysqldumpsController extends AppController {

////////////////////////////////////////////////////////////

    public function admin_index() {
        App::uses('Folder', 'Utility');
        App::uses('File', 'Utility');
        $folder = new Folder(WWW_ROOT . 'backups/');
        $files = $folder->find();
        $this->set(compact('files'));
    }

////////////////////////////////////////////////////////////

    public function admin_backup() {

        require_once('../Config/database.php');
        $db = get_class_vars('DATABASE_CONFIG');

        system('mysqldump --user ' . $db['default']['login'] . ' --password=' . $db['default']['password'] . ' --host=' . $db['default']['host'] . ' ' . $db['default']['database'] . ' > ' . WWW_ROOT . 'backups/' . $db['default']['database'] . '-' . date('Y-m-d-H-i') . '.sql', $retval);
        return $this->redirect(array('action' => 'index', 'admin' => true));
    }

////////////////////////////////////////////////////////////

    public function admin_delete() {
        $file = $this->params['data']['mysqldump']['file'];
        if(is_file((WWW_ROOT . 'backups/' . $file))) {
            unlink(WWW_ROOT . 'backups/' . $file);
        }
        return $this->redirect(array('action' => 'index', 'admin' => true));
    }

////////////////////////////////////////////////////////////

}