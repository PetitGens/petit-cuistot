<?php

require_once 'src/model/tagManager.php';
require_once 'src/model/tag.php';

testTags();
function testTags(){
    $manager = new TagManager();
    $nombreTagsDebut = count($manager->getTags());

    $tagsCrees = [];
    $tagsCrees[] = new Tag('miam miam');
    $tagsCrees[] = new Tag('bof bof');
    $tagsCrees[] = new Tag('cronch cronch');
    $tagsCrees[] = new Tag('slurp');

    foreach($tagsCrees as $tag){
        $manager->creerTag($tag);
    }

    assertEquals(4, count($manager->getTags()) - $nombreTagsDebut);

    foreach($tagsCrees as $i => $tag){
        $tagsCrees[$i] = getTagNouvellementCree($tag);
        assertTrue($tagsCrees[$i] !== null);
        assertEquals($tag->getIntitule(), $manager->getTag($tagsCrees[$i]->getId())->getIntitule());
        $manager->supprimerTag($tagsCrees[$i]);
    }

    assertEquals($nombreTagsDebut, count($manager->getTags()));
}

function getTagNouvellementCree($tag){
    $manager = new TagManager();
    
    $tags = $manager->getTags();

    foreach($tags as $tagBase){
        if($tagBase->getIntitule() === $tag->getIntitule()){
            return $tagBase;
        }
    }
    return null;
}