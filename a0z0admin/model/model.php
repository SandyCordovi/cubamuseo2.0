<?php
class model {
    var $stmt;
    var $con;

    function  __construct() {
        $this->con = new mysqli(Configuracion::$host, Configuracion::$database_user, Configuracion::$database_pass, Configuracion::$database_name);
    }

    function get_stmt($query)
    {
        try{
            $this->stmt = $this->con->prepare($query);
            if ($this->stmt) {
                $this->stmt->execute();
                return $this->stmt;
            }
            else
            {
                return NULL;
            }
        }
        catch (Exception $e)
        {
            return NULL;
        }
    }

    function dispouse_db()
    {

    }
}
?>