<?php 

require_once '../src/lib/assertion.php';

require_once 'testEdito.php';

file_put_contents('test.txt', "test");

echo "<h2>Les tests ont passés avec succès</h2>";