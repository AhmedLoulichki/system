<?php

class ssha {

    public function hashSSHA($password) {

        $salt = sha1("$@_&/-#()=\]^{½*'~^");
        $salt = substr($salt, 0, 4);
        $hash = base64_encode(sha1($password . $salt, true) . $salt);

        //$hash = sha1($password);
        return $hash;
    }

}

?>