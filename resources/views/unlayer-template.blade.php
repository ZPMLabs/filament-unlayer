<div class="flex flex-col items-center justify-center">
    <div>
        <img src="https://api.unlayer.com/v2/stock-templates/{{ $template['slug'] }}/thumbnail?width=500" alt="{{ $template['name'] }}">
        <div class="text-center p-2">
            <h3 class="text-sm font-semibold">{{ $template['name'] }} ({{ $template['rating'] }})</h3>
        </div>
    </div>
</div>