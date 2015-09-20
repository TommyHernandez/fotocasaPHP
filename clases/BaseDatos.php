<?php

/**
 * Description of BaseDatos
 *
 * @author pedroTHDC
 * @version 0.6
 */
class BaseDatos {

    private $conexion;
    private $resultado;

    function __construct() {
        try {
            $this->conexion = new PDO('mysql:host=' . Configuracion::SERVIDOR . ';dbname=' . Configuracion::BASEDATOS, Configuracion::USUARIO, Configuracion::CLAVE, array(PDO::ATTR_PERSISTENT => true,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8'));
        } catch (PDOException $e) {
            $this->conexion = null;
        }
    }

    function isConectado() {
        if ($this->conexion != NULL) {
            return true;
        } else {
            return false;
        }
    }

//

    function closeConexion() {
        $this->conexion = null;
    }

//

    function getAutonumerico() {
        if ($id = $this->conexion->lastInsertId()) {
            return $id;
        } else {
            return false;
        }
    }

    function getFila() {
        if ($this->resultado != null) {
            return $this->resultado->fetch();
        }else{
        return false;
        }
    }

    function getNumeroFilas() {
        if ($this->resultado != null) {
            return $this->resultado->rowCount();
        }
        return -1;
        //según la documentación no devuelve siempre el número de filas después de un select (depende del SGBD)
    }

    function setBaseDatos($bd) {
        return $this->conexion->query("use $baseDatos") !== false;
    }

    function closeConsulta() {
        $this->resultado->closeCursor();
    }

    /**
     * Realiza un query de la consulta utilizando  consultas preparadas y haciendo un bind de los valores por nombre
     * @param type $sql
     * @param type $param
     */
    function setConsulta($sql, $param = array()) {
        $this->resultado = $this->conexion->prepare($sql);
        foreach ($param as $indice => $valor) {
            $this->resultado->bindValue($indice, $valor);
        }
        return $this->resultado->execute();
    }

    /**
     * Realiza el query con consulta preparada con id.
     * @param type $sql
     * @param type $param
     */
    function setConsultaPreparada($sql, $param = array()) {
        $this->resultado = $this->conexion->prepare($consulta);
        $pos = 1;
        foreach ($parametros as $valor) {
            $this->resultado->bindValue($pos, $valor);
            $pos++;
        }

        return $this->resultado->execute();
    }
/**
 * 
 * @param type $sql
 * @return boolean
 */
    function setConsultaSQL($sql) {
        $this->resultado = $this->conexion->query($sql);
        if ($this->resultado === false) {
            $this->resultado = null;
            return false;
        } else {
            return true;
        }
    }

    function setTransaccion() {
        $this->conexion->beginTransacion();
    }

    function setValidarTransaccion() {
        $this->conexion->commit();
    }

    function setAnularTrasaccion() {
        $this->conexion->rollBack();
    }
    function getError (){
        return $this->resultado->errorInfo();
    }
    function getErorres (){
        mysql_errno($this->conexion) . ": " . mysql_error($this->conexion) . "\n";
    }

}
