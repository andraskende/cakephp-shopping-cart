<?php
class MysqldumpsController extends AppController {

////////////////////////////////////////////////////////////

    public function admin_index()
    {
        App::uses('Folder', 'Utility');
        App::uses('File', 'Utility');
        $folder = new Folder(TMP . 'backups/');
        $files = $folder->find();
        $this->set(compact('files'));
    }

////////////////////////////////////////////////////////////

    public function admin_backup()
    {
        require_once('../Config/database.php');
        $db = get_class_vars('DATABASE_CONFIG');

        system('mysqldump --user ' . $db['default']['login'] . ' --password=' . $db['default']['password'] . ' --host=' . $db['default']['host'] . ' ' . $db['default']['database'] . ' > ' . TMP . 'backups/' . $db['default']['database'] . '-' . date('Y-m-d-H-i') . '.sql', $retval);
        return $this->redirect(['action' => 'index', 'admin' => true]);
    }

////////////////////////////////////////////////////////////

    public function admin_delete()
    {
        $file = $this->request->query['file'];

        if(is_file((TMP . 'backups/' . $file))) {
            unlink(TMP . 'backups/' . $file);
        }
        return $this->redirect(['action' => 'index', 'admin' => true]);
    }

////////////////////////////////////////////////////////////

}