<!--File: /src/Template/Articles/view.ctp -->
<h1><?= h($article->title) ?></h1>   <!-- Regresa el titulo del articulo -->
<p><?= h($article->body) ?></p> <!-- Regresa el cuerpo del articulo -->
<p><small>Created: <?= $article->created->format(DATE_RFC850) ?></small></p> <!-- Regresa la fecha de reacion del articulo -->
