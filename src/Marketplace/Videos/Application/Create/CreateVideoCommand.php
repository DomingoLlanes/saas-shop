<?php

declare(strict_types=1);

namespace ShopSaas\Marketplace\Videos\Application\Create;

use ShopSaas\Shared\Domain\Bus\Command\Command;

final class CreateVideoCommand implements Command
{
    public function __construct(
        private string $id,
        private string $type,
        private string $title,
        private string $url,
        private string $courseId
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function url(): string
    {
        return $this->url;
    }

    public function courseId(): string
    {
        return $this->courseId;
    }
}
