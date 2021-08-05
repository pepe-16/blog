<?php
use Migrations\AbstractMigration;

class Initial extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */

     /**
      * Por el momento, TreeBehavior no soporta las llaves primarias composites.
      * TreeBehavior ayuda a manejar estructuras de árbol jerarquica en una tabla. 
      * Utiliza MPTT logic37 para manejar los datos. Las estructuras en árbol MPTT están optimizadas para lecturas, 
      * lo cual las hace ideal para aplicaciones con gran carga de lectura como los blogs.
      */
    public function change()
    {
        //creacion de la tabla articulos
        $articles = $this->table('articles');
        $articles->addColumn('title','string',['limit'=>50])
        ->addColumn('body','text',['null'=>true,'default'=>null])
        ->addColumn('category_id','integer',['null'=>true,'default'=>null])
        ->addColumn('created','datetime')
        ->addColumn('modified','datetime',['null'=>true,'default'=>null])
        ->save();
        //creacion de la nueva tabla categorias
        $categories = $this->table('categories');
        $categories->addColumn('parent_id','integer',['null'=>true,'default'=>null])   // parent_id (nullable) La columna que contiene el ID del registro padre
        ->addColumn('lft','integer',['null'=>true,'default'=>null])   // lft (integer, signed) Utilizado para mantener la estructura en forma de árbol
        ->addColumn('rght','integer',['null'=>true,'default'=>null])  // rght (integer, signed) Utilizado para mantener la estructura en forma de árbol
        ->addColumn('name','string',['limit'=>255])
        ->addColumn('description','string',['limit'=>255,'null'=>true,'default'=>null])
        ->addColumn('created','datetime')
        ->addColumn('modified','datetime',['null'=>true,'default'=>null])
        ->save();
    }
}
