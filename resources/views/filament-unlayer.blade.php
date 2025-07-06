<x-dynamic-component 
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div
        x-load
        x-load-src="{{ \Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('filament-unlayer', 'ZPMLabs/filament-unlayer') }}"
        x-data="initUnlayer({
            state: $wire.entangle('{{ $getStatePath() }}'),
            displayMode: '{{ $getDisplayMode() }}',
            id: '{{ $getId() }}',
            uploadUrl: '{{ $getUploadUrl() }}',
            additionalOptions: {{ json_encode($getAdditionalOptions()) }}
        })"
    >
        <div wire:ignore x-ref="unlayer" id="{{$getId()}}" style="height: {{ $getHeight() }};"></div>
    </div>
</x-dynamic-component>
