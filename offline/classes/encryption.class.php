<?php
class encryption {
    public function encrypt( $msg, $k, $base64 = false ) {
 
        if ( ! $td = mcrypt_module_open('rijndael-256', '', 'ctr', '') )
            return false;
 
        $msg = serialize($msg);                         # serialize
        $iv = mcrypt_create_iv(32, MCRYPT_RAND);        # create iv
 
        if ( mcrypt_generic_init($td, $k, $iv) !== 0 )  # initialize buffers
            return false;
 
        $msg = mcrypt_generic($td, $msg);               # encrypt
        $msg = $iv . $msg;                              # prepend iv
        $mac = $this->pbkdf2($msg, $k, 1000, 32);       # create mac
        $msg .= $mac;                                   # append mac
 
        mcrypt_generic_deinit($td);                     # clear buffers
        mcrypt_module_close($td);                       # close cipher module
 
        if ( $base64 ) $msg = base64_encode($msg);      # base64 encode?
 
        return $msg;                                    # return iv+ciphertext+mac
    }
 
    public function decrypt( $msg, $k, $base64 = false ) {
 
        if ( $base64 ) $msg = base64_decode($msg);          # base64 decode?
 
        # open cipher module (do not change cipher/mode)
        if ( ! $td = mcrypt_module_open('rijndael-256', '', 'ctr', '') )
            return false;
 
        $iv = substr($msg, 0, 32);                          # extract iv
        $mo = strlen($msg) - 32;                            # mac offset
        $em = substr($msg, $mo);                            # extract mac
        $msg = substr($msg, 32, strlen($msg)-64);           # extract ciphertext
        $mac = $this->pbkdf2($iv . $msg, $k, 1000, 32);     # create mac
 
        if ( $em !== $mac )                                 # authenticate mac
            return false;
 
        if ( mcrypt_generic_init($td, $k, $iv) !== 0 )      # initialize buffers
            return false;
 
        $msg = mdecrypt_generic($td, $msg);                 # decrypt
        $msg = unserialize($msg);                           # unserialize
 
        mcrypt_generic_deinit($td);                         # clear buffers
        mcrypt_module_close($td);                           # close cipher module
 
        return $msg;                                        # return original msg
    }
 
    public function pbkdf2( $p, $s, $c, $kl, $a = 'sha256' ) {
 
        $hl = strlen(hash($a, null, true)); # Hash length
        $kb = ceil($kl / $hl);              # Key blocks to compute
        $dk = '';                           # Derived key
 

        for ( $block = 1; $block <= $kb; $block ++ ) {
 

            $ib = $b = hash_hmac($a, $s . pack('N', $block), $p, true);
 
            for ( $i = 1; $i < $c; $i ++ )
 
                $ib ^= ($b = hash_hmac($a, $b, $p, true));
 
            $dk .= $ib;
        }
 
        return substr($dk, 0, $kl);
    }
}
?>