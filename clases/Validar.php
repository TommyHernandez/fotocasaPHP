<?php
/**
 * Description of Validar
 *
 * @author Tomas
 */
class Validar {

    static function isCorreo($v) {
        return filter_var($v, FILTER_VALIDATE_EMAIL);
    }

    static function isEntero($v) {
        return filter_var($v, FILTER_VALIDATE_INT);
    }

    static function isNumero($v) {
        return filter_var($v, FILTER_VALIDATE_FLOAT);
    }

    static function isTelefono($v) {
        return self::isCondicion($v, '/^[6-9][0-9]{8}$/');
        // con una expresion regular 9 numeros que empiezan por 6, 7, 8 ó 9
    }

    static function isURL($v) {
        return filter_var($v, FILTER_VALIDATE_URL);
    }

    static function isIP($v) {
        return filter_var($v, FILTER_VALIDATE_IP);
    }

    static function isFecha($v) {
        return self::isCondicion($v, '/^(0[1-9]|1[0-9]|2[0-9]|3[01])(.|-)(0[1-9]|1[012])(.|-)(19[5-9]|20[012])[0-9]$/');
        // con una expresion regular DD.MM.YYYY año desde 1950 hasta 2029
    }

    static function isDNI($v) {
        return self::isCondicion($v, '/^(([X-Z]{1})([-]?)(\d{7})([-]?)([A-Z]{1}))|((\d{8})([-]?)([A-Z]{1}))$/');
    }

    static function isCP($v) {
        return self::isCondicion($v, '/^(((0[1-9]|5[0-2])|[1-4][0-9])|AD)[0-9]{3}$/');
        // con una expresion regular 
        //PP->01 - 52 , AD Andorra
        // 0 capital de provincia
        // 1-9 si no es de capital de provincia
        //01-99 distrito , localidad, municipio
    }

    static function isLongitudMinima($v, $l = 1) {
        if (strlen($v) >= $l) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    static function isLongitudMaxima($v, $l = 1) {
        if (strlen($v) <= $l) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    static function isLongitud($v, $lmin = 1, $lmax = -1) {
        if (strlen($v) >= $lmin && strlen($v) <= $lmax) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    /**
     * Comprueba si lo que recibe es sea una cadena que empieza por la etiqueta <script> y termina por </script>
     * @param type $v
     * @return boolean
     */
    static function isScript($v) {
        return self::isCondicion($v, '/^(<)(script)(>).*?(<)(\/)(script)(>)$/');
    }

    static function isLogin($v) {
        return self::isCondicion($v, '/^[A-Za-z][A-Za-z0-9]{4,8}[A-Za-z]$/');
        //1º principio /
        //2º final /
        //^x empieza con x
        //x$ acaba con x
    }

    static function isClave($v) {
        return self::isCondicion($v, '/[A-Za-z0-9]{6,10}$/');
    }

    static function isCondicion($v, $condicion) {
        return preg_match($condicion, $v);
    }

}
