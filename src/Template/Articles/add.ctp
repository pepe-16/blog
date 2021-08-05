<!--File: src/Template/Articles/add.ctp -->
<h1>Añadir Artículo</h1>
<?php
    /**
     * Para aprovechar estas funciones es conveniente que utilices el FormHelper en tus vistas. 
     * La clase Cake\View\ Helper\FormHelper está disponible en tus vistas por defecto a través de $this->Form.
     */
    echo $this->Form->create($article);
    //Se agrrga con las categorias, para poder seleccionar una
    //Los argumentos que toma la funcion input, son directamente los campos de las 
    echo $this->Form->input('category_id'); 
    echo $this->Form->input('title');                     //Cuadro para ingresar el titulo
    echo $this->Form->input('body', ['rows' => '3']);     //El '4' determina el numero de filas del cuadro de escritura.
    echo $this->Form->button(__('Guardar artículo'));     //Boton de guardado.
    echo $this->Form->end();
    
?>