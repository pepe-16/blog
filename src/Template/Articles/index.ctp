<!--File: /src/Template/Articles/index.ctp -->
<h1>Artículos</h1>
<!--Añade un enlace de «Añadir Artículo».-->
<div class = "actions columns large-2 medium-3">
<h3><?= __('Actions') ?></h3>
    <ul class = "side-nav">
            <!-- Para iniicar cesion -->
            <li>
            <!--Ahora, gracias a las capacidades de enrutamiento inverso, puede pasar la matriz de URL como se muestra a continuación 
            y CakePHP sabrá cómo formar la URL como se define en las rutas -->
                <?= $this->Html->link('Iniciar cesion',['controller' => 'Users', 'action' => 'login']) ?>
            </li>
            <!-- Para cerrar cesion -->
            <li>
                <?= $this->Html->link('Cerrar cesion',['controller' => 'Users', 'action' => 'logout']) ?>
            </li>
            <!-- Para registrarse -->
            <li>
                <?= $this->Html->link('Registrarse',['controller' => 'Users', 'action' => 'add']) ?>
            </li>
            <!-- Para añadir articulo -->
            <li>
                <?= $this->Html->link('Añadir articulo',['controller' => 'Articles', 'action' => 'add']) ?>
            </li>
            <!-- Para añadir categoria -->
            <li>
                <?= $this->Html->link('Añadir categoria',['controller' => 'Categories', 'action' => 'index']) ?>
            </li>
          
    </ul>
</div>

</thead>
<table>
    <tr> 
        <th>Id</th> 
        <th>Title</th> 
        <th>Created</th>
        <!-- Se añade con el boton de edit -->
        <th>Action</th>
    </tr> 
    <!--Aquí es donde iteramos nuestro objeto de consulta $articles, mostrando en pantalla la información del artículo --> 
    <?php foreach ($articles as $article): ?>
    <tr> 
        <td><?= $article->id ?></td>
        <td> 
            <!--$this->Html es una llamada a un objeto, es una instancia de la clase Cake\ View\Helper\HtmlHelper --> 
            <!-- El método link() generará un enlace HTML con el título como primer parámetro y la URL como segundo parámetro.--> 
            <!-- Cuando crees URLs en CakePHP te recomendamos emplear el formato de array.-->
            <?= $this->Html->link($article->title, ['controller' => 'Articles', 'action' => 'view', $article->id]) ?> 
        </td> 
        <td>
            <?= $article->created->format(DATE_RFC850) ?>
        </td> 
        <td>
            <!-- El método link() generará un enlace HTML, para la parte de editar -->
            <?= $this->Html->link('Editar',['action'=>'edit',$article->id])?>
        </td>
        <td>
            <!-- Parqa borrar registros -->
            <!-- Utilizando View\Helper\FormHelper::postLink() crearemos un enlace que utilizará JavaScript para hacer una petición POST que eliminará nuestro artículo -->                        .
            <?= $this->Form->postLink('Eliminar',['action'=>'delete',$article->id],['confirm'=>'¿Estás seguro?'])?>
        </td>
    </tr> 
    <?php endforeach; ?> 
</table>
