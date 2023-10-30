<?php
class AssertionFailedException extends Exception{}

function assertEquals($var1, $var2){
    if($var1 !== $var2){
        throw new AssertionFailedException("expected value : ".$var1." actual : ".$var2."");
    }
}

function assertTrue($bool){
    if(! $bool){
        throw new AssertionFailedException("expected true value");
    }
}