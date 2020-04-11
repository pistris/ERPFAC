<?php
//VerificarModulo(1,1);
    function VerificarModulo($intUsuario, $intModulo){
        require("conexion.php");
        $pdo = retornarConexion();
        $sqlModulo = "SELECT 
                    tbl4.*
                FROM
                tCatUsuario tbl1
                    INNER JOIN
                tCatPlanPago tbl2 ON tbl2.intPlanPago = tbl1.intPlanPago
                    INNER JOIN
                tPlanPagoModulo tbl3 ON tbl3.intPlanPago = tbl1.intPlanPago
                    INNER JOIN
                tCatModulo tbl4 ON tbl4.intModulo = tbl3.intModulo
                WHERE
                    tbl1.intUsuario = $intUsuario and tbl3.intModulo = $intModulo;";
        $sql = $pdo->prepare($sqlModulo);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_OBJ);

        $Permiso = false;
        
        if(sizeof($resultado)>0){
            $Permiso = true;
        }
        
        return $Permiso;
    }
?>
