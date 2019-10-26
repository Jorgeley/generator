<?php

/**
 * simple example class just to have something to instantiate
 */
class obj {

    private $i = 1;
    private $a = [];

    function __construct($i = 1) {
        $this->i = $i;
        $this->a = range(0, $i);
    }

    public function getI() {
        return $this->i;
    }

    public function getA() {
        return $this->a;
    }

    public function setI($i) {
        $this->i = $i;
    }

    public function setA($a) {
        $this->a = $a;
    }

}

/**
 * this is the common way of returning objects in a bulk
 * @param int $n
 * @return \obj
 */
function returnObjects($n = 1000) {
    $objs = [];
    for ($i = 1; $i <= $n; $i++) {
        $objs[] = new obj($i);
    }
    return $objs;
}

/**
 * this is a generator, rather than returning all objects, it returns one by 
 * one (it saves the state of the function in every call)
 * @param int $n
 */
function generateObjects($n = 1000) {
    for ($i = 1; $i <= $n; $i++) {
        /**
         * 'yield' returns the object and save the status of the function, so 
         * next call starts from next loop iteration and so on...
         */
        yield (new obj($i));
    }
}

//main script: get current memory, run one of the functions and calculate memory usage after
$m = memory_get_peak_usage();
/**
 * comment 'returnObjects()' call bellow and uncomment 'generateObjects()' call 
 * if you want to see the generator memory usage
 */
//$objs = returnObjects();

/**
 * comment 'generateObjects()' and uncomment 'returnObjects()' call if you 
 * want to see the common function return memory usage
 */
$objs = generateObjects();
foreach ($objs as $obj) {
    echo get_class($obj) . ": {$obj->getI()}\n";
}
echo "total memory consuption: " . (memory_get_peak_usage() - $m) . " bytes\n";
