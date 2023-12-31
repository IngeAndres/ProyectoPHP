<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Token
{
    private $secretKey;

    public function __construct()
    {
        $this->secretKey = bin2hex(random_bytes(32));
    }

    public function generarToken($codiClie, $numeDocu)
    {
        try {
            $issuedAtClaim = time();
            $notBeforeClaim = $issuedAtClaim;
            $expireClaim = $issuedAtClaim + 3600;

            $token = [
                "iat" => $issuedAtClaim,
                "nbf" => $notBeforeClaim,
                "exp" => $expireClaim,
                "data" => [
                    "codiClie" => $codiClie,
                    "numeDocu" => $numeDocu,
                ],
            ];

            return JWT::encode($token, $this->secretKey, 'HS256');
        } catch (Exception $e) {
            echo "Error al generar el token: " . $e->getMessage() . "\n";
            return false;
        }
    }

    public function verificarToken($token, $userData)
    {
        try {
            $decoded = JWT::decode($token, new Key($this->secretKey, 'HS256'));

            if (
                $decoded->data->codiClie !== $userData['codiClie'] ||
                $decoded->data->numeDocu !== $userData['numeDocu']
            ) {
                return false;
            }

            return $decoded;
        } catch (Exception $e) {
            echo "Error al verificar el token: " . $e->getMessage() . "\n";
            return false;
        }
    }
}

$jwToken = new Token();

$codiClie = 1;
$numeDocu = '72755161';
$token = $jwToken->generarToken($codiClie, $numeDocu);

echo "Token generado: " . $token;

// Datos para verificar el token
$userData = [
    'codiClie' => 1,
    'numeDocu' => '72755161',
];

$decodedToken = $jwToken->verificarToken($token, $userData);

if ($decodedToken) {
    echo " Token verificado: ";
    print_r($decodedToken);
} else {
    echo "Error al verificar el token.\n";
}
