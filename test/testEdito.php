<?php

require_once 'src/model/editoManager.php';

testEdito();

function testEdito(){
    $manager = new EditoManager;
    $manager->setEdito(" ");
    $manager->setEdito("Bonjour, ceci est l'édito");
    assertEquals("Bonjour, ceci est l'édito", $manager->getEdito());
}