<?php

namespace App\Http\Model\Responses;

/**
 * Description of Error
 *
 * @author Giuseppe Dezute Fechio
 */
class Error {

    public $error = true;
    public $code = 500;
    public $message;

    public function __construct($message , $code=0) {
        $this->message = $message;
        if ($code!==0){
            $this->code = $code;
        }
    }

}
