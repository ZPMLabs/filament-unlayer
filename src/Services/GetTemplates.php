<?php

namespace ZPMLabs\FilamentUnlayer\Services;

use Illuminate\Support\Facades\Http;

class GetTemplates
{
    public static function all(string $name = '', string $type = 'email', bool $isPremium = false, $limit = 20, $offset = 0, string $collection = '', string $sortBy = 'recent')
    {
        $page = (int) floor($offset / $limit) + 1;
        $filter = [
            'premium' => $isPremium ? 'true' : '',
            'collection' => $collection,
            'name' => $name,
            'sortBy' => $sortBy,
            'type' => $type,
        ];

        $data = [
            'page' => $page,
            'perPage' => $limit,
            'filter' => $filter,
        ];

        $response = Http::withHeaders([
            'Accept' => '*/*',
            'Content-Type' => 'application/json',
        ])->post('https://unlayer.com/templates/search', $data);

        $result = $response->json();

        $templates = $result['data'] ?? [];

        return collect($templates)->mapWithKeys(fn (array $template) => [
            $template['slug'] => view('filament-unlayer::unlayer-template')->with('template', $template)->render()
        ])->toArray();
    }

    public static function find(string $name)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('https://studio.unlayer.com/api/v1/graphql', [
            'query' => '
                query StockTemplateLoad($slug: String!) {
                  StockTemplate(slug: $slug) {
                    StockTemplatePages {
                      design
                    }
                  }
                }
            ',
            'variables' => [
                'slug' => $name,
            ],
        ]);

        $result = $response->json();

        return $result['data']['StockTemplate']['StockTemplatePages'][0]['design'] ?? null;
    }
}
