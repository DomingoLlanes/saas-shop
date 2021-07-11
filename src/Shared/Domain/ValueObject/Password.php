<?php

declare(strict_types=1);

namespace ShopSaas\Shared\Domain\ValueObject;

use ShopSaas\Shared\Domain\PhpPasswordEncoder;
use Stringable;

class Password implements Stringable
{
    public function __construct(protected string $value)
    {
        $this->value = $this->encode();
    }

    public function value(): string
    {
        return $this->value;
    }

    public function validatePassword(string $plainPassword): bool
    {
        return PhpPasswordEncoder::verify($plainPassword, $this->value);
    }

    public function encode(): string
    {
        return PhpPasswordEncoder::encode($this->value);
    }

    public function __toString(): string
    {
        return $this->value();
    }
}
