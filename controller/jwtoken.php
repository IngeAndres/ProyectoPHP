<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWToken
{
    private $secretKey;
    private $issuerClaim;
    private $audienceClaim;

    public function __construct()
    {
        $this->secretKey = 'defaultSecretKey';
        $this->issuerClaim = 'defaultIssuer';
        $this->audienceClaim = 'defaultAudience';
    }

    public function generarToken($logiUsua)
    {
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
                "logiUsua" => $logiUsua,
            ],
        ];

        return JWT::encode($token, $this->secretKey, 'HS256');
    }

    public function verificarToken($token)
    {
        try {
            $decoded = JWT::decode($token, $this->secretKey, array('HS256'));

            if (
                $decoded->iss !== $this->issuerClaim ||
                $decoded->aud !== $this->audienceClaim ||
                !isset($decoded->data->logiUsua)
            ) {
                return false;
            }

            return $decoded;
        } catch (Exception $e) {
            return false;
        }
    }
}
