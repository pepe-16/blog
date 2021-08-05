<?php
    namespace App\Controller;

    /**
     * En el controlador es donde escribiremos el código para interactuar con nuestros artículos.
     */
    class ArticlesController extends AppController
    {

        /**
         * atributo publico para agregar registros
         */
        public $components = ['Flash'];
        /**
         * Vamos a añadir una acción a nuestro nuevo controlador.
         * Las acciones representan una función concreta o interfaz en nuestra aplicación.
         */
         /**
          * Es una funcion de salida de informacion
          */
        public function index()
        {
            /**
             * Esta funcion muestra todos los registros de los articulos.
             * por eso se le pasa como argumento all a la funcion find 
             */
            $articles = $this->Articles->find('all');
            /**
             * La única instrucción en la acción utiliza set() para pasar datos desde el controlador hacia la vista
             * */
            /**
             * asigna una variable en la vista llamada “articles” igual al valor retornado por el método find('all') 
             * del objeto de tabla Artículos (ArticlesTable).
             */
            $this->set(compact('articles'));     //Esto asignaría el objeto de consulta (query object) a la vista para ser invocado por una iteración foreach.
        }
         /**
          * Es una funcion de salida de informacion
          */
        public function view($id = null)
        {
            /**
             * Estamos usando get() en vez de find('all') ya que sólo queremos un artículo concreto.
             */
            $article = $this->Articles->get($id);
            /**
             * compact — Crear un array que contiene variables y sus valores
             * Devuelve un array de salida con todas las variables añadidas a él.
             */
            $this->set(compact('article'));
        }
        public function add()
        {
            $article = $this->Articles->newEntity();     //Llama al formulario enviado.
            /**
             * Cada petición de CakePHP incluye un objeto ServerRequest que es accesible utilizando $this->request.
             * El objeto de petición contiene información útil acerca de la petición que se recibe y puede ser utilizado para controlar el flujo de nuestra aplicación.
             */
            /**
             * En este caso,utilizamos el método Cake\Network\ServerRequest::is()
             * para verificar que la petición es una petición HTTP POST.
             */
            if($this->request->is('post'))  //Si se encuentra algo en la entrada a traves del metodo post
            {
                /**
                 * Cuando un usuariou tiliza un formulario y efectúa un POST a la aplicación,esta información está disponible en $this->request->getData().
                 */
                $article = $this->Articles->patchEntity($article, $this->request->getData());
                /**
                 * Se agrega esta linea para tener referente del usuario
                 */
                $article->user_id = $this->Auth->user('id');
                /**
                 * También puedes hacer lo siguiente
                 * $newData=['user_id'=>$this->Auth->user('id')];
                 * $article=$this->Articles->patchEntity($article,$newData);
                 */
                if($this->Articles->save($article)) // Intenta salvar un nuevo artículo utilizando el modelo Articles
                {
                    /**
                     * Utilizamos el método mágico __call del Flash Component para guardar un mensaje en una variable de sesión que será mostrado en la página después de la redirección.
                     */
                    $this->Flash->success(_('Su artículo se ha guardado.')); //Mensahe de processo exitoso.
                    /**
                     * El método Cake\Controller\Controller::redirect del controlador redirige hacia otra URL.
                     */
                    return $this->redirect(['action' => 'index']); //Te redirige al index.
                }
                $this->Flash->error(_('Su articulo no se ha guardado')); //Mensahe de processo no exitosos.
            }
            $this->set('article',$article);
            /**
            * Para la parte de las categorias
            * Obtenemos el listado de categorias
             * Esto nos permitirá elegir una categoría para un Article al momento de crearlo o editarlo
             */
            $categories = $this->Articles->Categories->find('treeList');
            $this->set(compact('categories'));
        }
        public function edit($id = null)
        {
            
            $article = $this->Articles->get($id);
            if($this->request->is(['post','put']))
            {
                $this->Articles->patchEntity($article,$this->request->getData());
                if($this->Articles->save($article))
                {
                    $this->Flash->success(__('Tu artículo ha sido actualizado.'));
                    return $this->redirect(['action'=>'index']);
                }
                $this->Flash->error(__('Tu artículo no se ha podido actualizar.'));
            }
            $this->set('article',$article);
        }
        public function delete($id)
        {
            $this->request->allowMethod(['post','delete']);
            $article = $this->Articles->get($id);
            if($this->Articles->delete($article))
            {
                $this->Flash->success(__('El artículo con id:{0} ha sido eliminado.',h($id)));

            }
            return $this->redirect(['action'=>'index']);
        }
        /**
         * Estamos sobre escribiendo el método
         * isAuthorized() de AppController y
         * comprobando si la clase padre autoriza 
         * al usuario.
         *  Si no lo hace entonces solamente 
         */
        public function isAuthorized($user)
        {
            /**
             * Les damos autorizacion a todos los usuarios
             * registrados y logeados de añadir articulos (add)
             */
            if($this->request->getParam('action') === 'add')
            {
                return true;
            }
            /**
             * El propietario de un artículo puede editarlo y eliminarlo.
             */
            /**
             * Busca la "accion"(aguja), dentro del pajar (['edit','delete']).
             * Devuelve true si "accion" se encuentra en el array, false de lo contrario.
             */
            if(in_array($this->request->getParam('action'),['edit','delete']))
            {
                /**
                 * La solicitud expone los parámetros de enrutamiento a través del getParam() método.
                 * Para obtener todos los parámetros de enrutamiento como una matriz, use getAttribute().
                 * Se accede a todos los elementos de ruta a través de esta interfaz.
                 * 
                 */
                /**
                 * Una vez que el argumento se pasa a la acción del controlador, puede obtener el argumento con la siguiente declaración.
                 */
                $articleId = (int)$this->request->getParam('pass.0');
                if($this->Articles->isOwnedBy($articleId,$user['id']))
                {
                    return true;
                }
            }
            return parent::isAuthorized($user);

        }
    }

?>