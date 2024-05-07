<?php

namespace Maize\Searchable\Searchables;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;

readonly class SearchableFactory
{
    public function __construct(
        public Model $model,
        public string $column,
        // public ?float $weight = null,
    ) {
    }

    public static function make(mixed ...$args): self
    {
        return new self(...$args);
    }

    public function create() // :Searchable
    {if (static::isAttribute()) {
        return SearchableAttribute::make(
            column: $this->column,
            model: $this->model
        );
    }

        if (static::isRelationship()) {
            return SearchableRelation::make(
                relation: static::getSegments()->first(),
                column: static::getSegments()->last(),
                model: $this->model
            );
        }
    }

    public function isExpression(): bool
    {
        return $this->column instanceof Expression;
    }

    public function isAttribute(): bool
    {
        if ($this->isExpression()) {
            return false;
        }

        return Schema::hasColumn(
            $this->model?->getTable() ?? '',
            $this->getFirstSegment()
        );
    }

    public function isRelationship(): bool
    {
        if ($this->isExpression()) {
            return false;
        }

        return method_exists(
            $this->model ?? '',
            $this->getFirstSegment()
        );
    }

    // TODO: check
    public function isJson(): bool
    {
        if ($this->isExpression()) {
            return false;
        }

        $count = $this->isRelationship() ? 2 : 1;

        return str($this->column)
            ->explode('.')
            ->count() > $count;
    }

    public function getSegments(): Collection
    {
        return str($this->column)->explode('.');
    }

    public function getFirstSegment(): string
    {
        return str($this->column)
            ->explode('.')
            ->first();
    }
}
