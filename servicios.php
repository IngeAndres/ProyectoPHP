<?php
require_once 'conexion.php';

class servicios
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::getInstance()->getConnection();
    }

    public function listarServiciosPorCliente($razonSocial)
    {
        $sql = "SELECT s.codiServ, u.nombUbig, p.nombPlan, m.nombMes, s.diaFact, cu.montDeud
                FROM servicio s
                INNER JOIN cliente cl ON s.codiClie = cl.codiClie
                INNER JOIN cuota cu ON s.codiServ  = cu.codiServ
                INNER JOIN plan p ON s.codiPlan = p.codiPlan
                INNER JOIN concepto co ON cu.codiConc = co.codiConc
                INNER JOIN mes m ON co.codiMes = m.codiMes
                INNER JOIN ubigeo u ON s.codiUbig = u.codiUbig
                WHERE cl.raznSociClie = '$razonSocial'";

        $result = $this->conexion->query($sql);

        if (!$result) {
            die("Error en la consulta: " . $conn->error);
        }

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }
}
?>