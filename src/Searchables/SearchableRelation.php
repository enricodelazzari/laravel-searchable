<?php

namespace Maize\Searchable\Searchables;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Expression;

readonly class SearchableRelation
{
    public function __construct(
        public string $relation,
        public Expression|string $column,
        public ?Model $model = null,
    ) {
    }

    public static function make(mixed ...$args): self
    {
        return new self(...$args);
    }
}
