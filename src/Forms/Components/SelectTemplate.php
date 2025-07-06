<?php

namespace ZPMLabs\FilamentUnlayer\Forms\Components;

use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Utilities\Set;

class SelectTemplate extends Select
{
    protected string $view = 'filament-unlayer::select-template';

    protected string $type = 'email';

    protected string $collection = '';

    protected string $sortBy = 'recent';

    protected bool $isPremium = false;

    protected int $limit = 20;

    protected int $offset = 0;

    public static function make(?string $name = null): static
    {
        $static = app(static::class, ['name' => $name]);
        $static->configure();
        $static->columnSpanFull()
            ->getSearchResultsUsing(fn (string $search): array => config('filament-unlayer.templateResolver')::all($search, $static->type, $static->isPremium, $static->limit, $static->offset, $static->collection, $static->sortBy))
            ->allowHtml()
            ->searchable()
            ->searchValues()
            ->searchLabels(false)
            ->searchDebounce(200)
            ->options(fn (): array => config('filament-unlayer.templateResolver')::all(type: $static->type, isPremium: $static->isPremium, limit: $static->limit, offset: $static->offset, collection: $static->collection, sortBy: $static->sortBy))
            ->placeholder(__('Pick Template'))
            ->optionsLimit(500)
            ->extraAttributes(['class' => 'template-select'])
            ->live(onBlur: true)
            ->afterStateUpdated(fn (string $operation, $state, Set $set) => $set('content', config('filament-unlayer.templateResolver')::find($state)));

        return $static;
    }

    public function type(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function collection(string $collection): static
    {
        $this->collection = $collection;

        return $this;
    }

    public function sortBy(string $sortBy): static
    {
        $this->sortBy = $sortBy;

        return $this;
    }

    public function isPremium(bool $isPremium): static
    {
        $this->isPremium = $isPremium;

        return $this;
    }

    public function limit(int $limit): static
    {
        $this->limit = $limit;

        return $this;
    }

    public function offset(int $offset): static
    {
        $this->offset = $offset;

        return $this;
    }
}
