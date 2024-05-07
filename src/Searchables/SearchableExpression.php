<?php

namespace Maize\Searchable\Searchables;

use Illuminate\Database\Query\Expression;

readonly class SearchableExpression
{
    public function __construct(
        public Expression $expression,
    ) {
    }

    public static function make(mixed ...$args): self
    {
        return new self(...$args);
    }
}
