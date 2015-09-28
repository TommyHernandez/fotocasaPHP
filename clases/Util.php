<?php

/**
 * Description of Util
 *
 * @author PedroTHDC
 */
class Util {

    static function getEnlaces($pagina, $totales, $enlace) {
        if ($pagina - 1 <= 0) {
            $anterior = 0;
        } else {
            $anterior = $pagina - 1;
        }
        $next = $pagina + 1;
        $ultima = ($totales / Configuracion::RPP) - 1;
        if ($pagina == 0) {
            $enlaces[0] = "<a href='$enlace?p=0'> &lt; &lt;  </a>";
            $enlaces[] = "<a href='$enlace?p=$anterior'> &lt;  </a>";
            $enlaces[] = "<a href='#'> $pagina  </a>";
            $enlaces[] = "<a href='$enlace?p=$next'> &gt;  </a>";
            $enlaces[] = "<a href='$enlace?p=$ultima'> &gt; &gt;  </a>";
        } else {
            if ($pagina == $ultima) {
                $enlaces[0] = "<a href='$enlace?p=0'> &lt; &lt;  </a>";
                $enlaces[] = "<a href='$enlace?p=$anterior'> &lt;  </a>";
                $enlaces[] = "<a href='#'> $pagina  </a>";
            } else {
                $enlaces[0] = "<a href='$enlace?p=0'> &lt; &lt;  </a>";
                $enlaces[] = "<a href='$enlace?p=$anterior'> &lt;  </a>";
                $enlaces[] = "<a href='#'> $pagina  </a>";
                $enlaces[] = "<a href='$enlace?p=$next'> &gt;  </a>";
                $enlaces[] = "<a href='$enlace?p=$ultima'> &gt; &gt;  </a>";
            }
        }
        return $enlaces;
    }
    
    static function getDocumentRoot (){
        return $_SERVER['DOCUMENT_ROOT'];
    }
    static function getURI(){
        return $_SERVER['REQUEST_URI'];
    }
}
