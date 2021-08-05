<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        
       
        //parent::initialize();
        /*
        *Se quita por lo del login y logout
        parent::initialize();
        -----habilitará el cambio automático de clase de vista en los tipos de contenido----
        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        */


        $this->loadComponent('Flash');
        /**
         * Se agrega para el logout y login
         */
        $this->loadComponent('Auth',[

            /**
             * Lineas para generar las diferencias entre usuarios
             */
            'authorize' => ['Controller'], // linea agregada
            /**
             * Simplemente asignamos las URLs que serán cargadas despues del login y del logout,
             * en nuestro caso /articles/ y / respectivamente.
             */
            'loginRedirect'=>[    //Para redirigir despues del login
                'controller'=>'Articles',
                'action'=>'index'
            ],
            'logoutRedirect'=>[   //Para redirigir despues del logout
                'controller'=>'Pages',
                'action'=>'display',
                'home'
            ]
        ]);
    }
    /**
     * Lo que hicimos en beforeFilter() fue decirle al AuthComponent que no requiera login para las acciones 
     * index y view en cada controlador.Queremos que nuestros visitantes puedan leer y listar las entradas sin registrarse.
     */
    public function  beforeFilter(Event $event)
    {
        $this->Auth->allow(['index','view','display']);
    }

    /**
     * Se llama después de que se ejecuta la acción del controlador, pero antes de que se renderice la vista. 
     * Puede utilizar este método para realizar la lógica o establecer las variables de vista que se requieren en cada solicitud.
     */
    public function beforeRender(Event $event)
    {

    }
    /**
     * En esta funcion damos permisos deacurso al rol
     */
    public function isAuthorized($user)
    {
        //El administrador tiene acceso a todas las acciones.
        if( isset($user['role']) && $user['role'] === 'admin') //checa si la variable está definida y no es null y ademas es un administrador.
        {
            return true;
        }
        /**
         * Caso de negacion por default.
         */
        return false;
    }

        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
    
}
