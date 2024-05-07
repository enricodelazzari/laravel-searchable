<?php

namespace Maize\Searchable\Searchables;

use Illuminate\Database\Query\Expression;

readonly class SearchableJson
{
    public function __construct(
        // public string $path,
        // public Expression|string $column,
        // public array $types,
    ) {
    }

    public static function make(mixed ...$args): self
    {
        return new self(...$args);
    }
}
