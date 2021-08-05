<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Http\Exception\NotFoundException;

class UsersController extends AppController
{
    /*
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        //se comunica con la base de datos.
        //$this->Auth->allow('add');
    }
    * Cambia
    */
    /**
     * Funcion para ver 
     */
    public function index()
    {
        $this->set('users',$this->Users->find('all'));
    }

    public function view($id)
    {
        if(!$id)
        {
            throw new NotFoundException(__('Invalid user'));
        }
        $use = $this->Users->get($id);
        $this->set(compact('user'));
    }

    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post'))
        {
            $user = $this->Users->patchEntity($user,$this->request->getData());
            if ($this->Users->save($user))
            {
                /**
                 * Mensaje para informar que se pudo guardar el nuevo usuario
                 */
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'add']);
            }
            /**
             * Mensaje para informar que no se pudo guardar el nuevo usuario.
             */
            $this->Flash->error(__('Unable to add the user.'));
        }
        $this->set('user',$user);
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        /**
         * Solo se admiten las fuinciones de agragar y cesar cesion.
         */
        $this->Auth->allow(['add','logout']);
    }

    public function login()
    {
         /**
        * En este caso,utilizamos el método Cake\Network\ServerRequest::is()
        * para verificar que la petición es una petición HTTP POST.
         */
        if($this->request->is('post'))
        {
            /**
             * Almacena en la variable user el intento de logeo.
             */
            $user = $this->Auth->identify();
            /**
             * Si son datos correctos, se procede a redirigirse a otra pagina
             */
            if($user)
            {
                /**
                 * E
                 */
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            /**
             * Mensaje para informar que no se pudo realizar el logeo.
             */
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }
    
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
}
?>