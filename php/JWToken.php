<?php
require_once(__DIR__ . '/../vendor/autoload.php');

use Firebase\JWT\JWT;

class JWToken {
    private $secretKey;
    private $issuerClaim;
    private $audienceClaim;

    public function __construct($secretKey, $issuerClaim, $audienceClaim) {
        $this->secretKey = $secretKey;
        $this->issuerClaim = $issuerClaim;
        $this->audienceClaim = $audienceClaim;
    }

    // Genera un token JWT
    public function generarToken($usuario) {
        $issuedAtClaim = time();
        $notBeforeClaim = $issuedAtClaim + 10;
        $expireClaim = $issuedAtClaim + 3600;

        $token = [
            "iss" => $this->issuerClaim,
            "aud" => $this->audienceClaim,
            "iat" => $issuedAtClaim,
            "nbf" => $notBeforeClaim,
            "exp" => $expireClaim,
            "data" => [
                "usuario" => $usuario,
            ],
        ];

        return JWT::encode($token, $this->secretKey, 'HS256');
    }
}
?>