<?php

/**
 * Los modelos son una parte fundamental en CakePHP. 
 * Cuando creamos un modelo, podemos interactuar con la base de datos para crear, editar, ver y borrar con facilidad cada ítem de ese modelo.
 */

/**Archivo del modelo */
/**
 * Los comportamientos proporcionan una forma conveniente de empaquetar 
 * el comportamiento que es común a varios modelos.
 */
namespace App\Model\Table;

use Cake\ORM\Table;

/*
 * Se crea la clase ArticlesTable que se extiende
 * de la clase Table
 */
/**
 * Los comportamientos proporcionan una manera fácil de crear piezas de lógica 
 * reutilizables vinculadas horizontalmente a clases de tabla.
 */
class ArticlesTable extends Table //metodo mixin
/**
 * Cualquier método público definido en un comportamiento 
 * se agregará como un método "mixin" en el objeto de tabla en el que se adjunta.
 */
/**
 * Si adjunta dos comportamientos que proporcionan los mismos métodos,
 * se lanzará una excepción. 
 */
{
    /**
     *Se crea el metodo(comportamiento) initialize
     */
    public function initialize(array $config)
    {
        /**
         * Para agregar un comportamiento a su tabla, puede llamar al método addBehavior().
         * Por lo general, el mejor lugar para hacer esto es en el método initialize():
         */
        $this->addBehavior('Timestamp');
        // Para relacionar las dos tablas de la base de datos.
        // Simplemente agregue la relación Pertenece a con CategoriesTable
        $this->belongsTo('Categories',[
            'foreignKey'=>'category_id',
        ]);
    }

    public function isOwnedBy($articleId, $userId)
    {
        return $this->exists(['id' => $articleId,'user_id' => $userId]);
    }
}
?>