<?php

declare(strict_types=1);

namespace App\Filters\Concerns;

trait InteractsWithJson
{
    protected bool $asJson;

    protected ?string $property = null;

    public function __construct(bool $asJson = false, ?string $property = null)
    {
        $this->asJson   = $asJson;
        $this->property = $property;
    }
}
