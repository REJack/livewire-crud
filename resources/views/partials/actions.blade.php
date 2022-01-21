@php
    $builtInActions = array_keys(config('livewire-crud.actions', []));
    $basicClasses = config('livewire-crud.classes.actions.basicClasses', 'h-7');
@endphp
@foreach($actions as $actionName => $action)
    @php
        $spacerClass = !$loop->first ? config('livewire-crud.classes.actions.spacerClass', 'ml-1') : '';
    @endphp
    @if(is_array($action))
        @php
            $builtInData = config('livewire-crud.actions.' . $actionName);
            $routeEnd = $action['routeEnd'] ?? $builtInData['routeEnd'];
            $routeBase = $action['routeBase'] ?? $routeBase;
            $route = $action['routeComplete'] ?? (($routeBase) . '.' . $routeEnd );
            $label = null;
            if(!isset($action['iconOnly'], $builtInData['iconOnly']) || !$action['iconOnly'] || !$builtInData['iconOnly']) {
                $label = $action['label'] ?? $actionName ?? null;
            }
        @endphp
        <x-button :color="$action['color'] ?? $builtInData['color'] ?? 'dark'"
                  :href="route($route, [$rowData->id])"
                  :icon="$action['icon'] ?? $builtInData['icon'] ?? null"
                  class="!inline-flex {{ $action['classes'] ?? '' }} {{ $basicClasses }} {{ $spacerClass }}"
                  :label="$label"/>
    @else
        @if (in_array($action, $builtInActions, true))
            @php
                $builtInData = config('livewire-crud.actions.' . $action);
                $label = null;

                if(!isset($builtInData['iconOnly']) || !$builtInData['iconOnly']) {
                    $label = $builtInData['label'] ?? null;
                }
            @endphp
            @if($routeBase === 'livewire')
                @continue
            @endif
            @if($action === 'delete')
                <x-button :label="$label"
                          :color="$builtInData['color'] ?? 'dark'"
                          :icon="$builtInData['icon'] ?? null"
                          wire:click.prevent="openModal({{ $rowData->id }})"
                          class="!inline-flex {{ $basicClasses }} {{ $spacerClass }}"/>
            @else
                <x-button :label="$label"
                          :color="$builtInData['color'] ?? 'dark'"
                          :icon="$builtInData['icon'] ?? null"
                          :href="route($routeBase . '.' . $builtInData['routeEnd'], [$rowData->id])"
                          class="!inline-flex {{ $basicClasses }} {{ $spacerClass }}"/>
            @endif
        @endif
    @endif
@endforeach
