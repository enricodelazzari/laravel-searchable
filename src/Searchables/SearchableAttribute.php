<?php

namespace Maize\Searchable\Searchables;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Expression;

readonly class SearchableAttribute
{
    public function __construct(
        public Expression|string $column,
        // public ?float $weight = null,
        public Model $model,
    ) {
        // $this->weight ??= config('searchable.default_match_weight', 1);
    }

    public static function make(mixed ...$args): self
    {
        return new self(...$args);
    }
}
