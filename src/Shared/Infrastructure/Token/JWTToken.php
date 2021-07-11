<?php

declare(strict_types=1);

namespace ShopSaas\Shared\Infrastructure\Token;

use DateTime;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\SignatureInvalidException;
use ShopSaas\Shared\Domain\Token\Token;

final class JWTToken implements Token
{
    private const ALGORITHM = 'RS512';
    private const JWT_PRIVATE_KEY_PATH = __DIR__ . '/../../../../etc/jwt/keys/private.key';
    private const JWT_PUBLIC_KEY_PATH = __DIR__ . '/../../../../etc/jwt/keys/public.key.pub';

    public function __construct(
        private string $expiresIn
    )
    {
    }

    public function encode(array $payload): string
    {
        $payload = $this->addSecurityData($payload);

        return JWT::encode($payload, $this->getPrivateKeyFromFile(), self::ALGORITHM);
    }

    public function decode(string $tokenAsString): object
    {
        return JWT::decode($tokenAsString, $this->getPublicKeyFromFile(), [self::ALGORITHM]);
    }

    public function verify(string $tokenAsString): bool
    {
        try {
            $this->decode($tokenAsString);
        } catch (SignatureInvalidException | BeforeValidException | ExpiredException $ex) {
            return false;
        }
        return true;
    }

    private function addSecurityData(array $payload): array
    {
        $currentTimestamp = (new DateTime())->getTimestamp();

        return array_merge(
            $payload,
            [
                'iss'       => 'saas-shop',
                'aud'       => 'saas-shop',
                'iat'       => $currentTimestamp,
                'nbf'       => $currentTimestamp,
                'expiresIn' => $currentTimestamp + (int)$this->expiresIn,
            ]
        );
    }

    private function getPublicKeyFromFile(): string
    {
        return file_get_contents(self::JWT_PUBLIC_KEY_PATH);
    }

    private function getPrivateKeyFromFile(): string
    {
        return file_get_contents(self::JWT_PRIVATE_KEY_PATH);
    }
}
