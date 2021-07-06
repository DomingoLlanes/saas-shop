<?php

declare(strict_types=1);

namespace ShopSaas\Marketplace\Videos\Domain;

use ShopSaas\Shared\Domain\ValueObject\Enum;
use InvalidArgumentException;

/**
 * @method static VideoType screencast()
 * @method static VideoType interview()
 */
final class VideoType extends Enum
{
    public const SCREENCAST = 'screencast';
    public const INTERVIEW  = 'interview';

    protected function throwExceptionForInvalidValue($value): void
    {
        throw new InvalidArgumentException(sprintf('The <%s> value is not a valid video type', $value));
    }
}
