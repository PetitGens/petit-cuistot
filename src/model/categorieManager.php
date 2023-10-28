<?php

declare(strict_types=1);

require_once 'src/model/manager.php';

/**
 * Classe utilitaire permettant de gérer les catégories de recettes.
 * Les catégories sont manipulés directement en un string 
 * qui contient le nom de la catégorie.
 * 
 * @author Julien Ait azzouzene <julien.aitazzouzene@etu.unicaen.fr>
 */
class CategorieManager extends Manager{    
    /**
     * Renvoie toutes les catégories en base.
     *
     * @return array un tableau contenant les noms de catégorie (string)
     */
    public function getCategories(): array{
        throw new Exception('not implemented yet');
    }
}