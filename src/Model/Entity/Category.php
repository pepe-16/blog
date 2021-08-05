<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Category Entity
 *
 * @property int $id
 * @property int|null $parent_id
 * @property int|null $lft
 * @property int|null $rght
 * @property string $name
 * @property string|null $description
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\ParentCategory $parent_category
 * @property \App\Model\Entity\Article[] $articles
 * @property \App\Model\Entity\ChildCategory[] $child_categories
 */
class Category extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    /***
     * Las clases entity permiten definir metodos de acceso y mutación
     * logica para registros inviduales y mucho más.
     */
    protected $_accessible = [
        /**
         * Por el momento, TreeBehavior no soporta las llaves primarias composites.
         */
        /**
         * Columna que contiene el ID del registro padre
         */
        'parent_id' => true,
        /**
         * Se emplea para mantener la estructura en forma de arbol.
         */
        'lft' => true,
         /**
         * Se emplea para mantener la estructura en forma de arbol.
         */
        'rght' => true,
        'name' => true,
        'description' => true,
        'created' => true,
        'modified' => true,
        'parent_category' => true,
        'articles' => true,
        'child_categories' => true,
    ];
}
