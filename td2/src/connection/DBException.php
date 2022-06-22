<?php
 /**
   * DBException.php : Exceptions pour les accès à la base
   *
   * @author Gérôme Canals
   * 
   * @package hellokant
   */
namespace hellokant\connection;

class DBException extends \Exception {

    public function __construct($message, $code = 0) {
        parent::__construct($message, $code);
    }

    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

}
