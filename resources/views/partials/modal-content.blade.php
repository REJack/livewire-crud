<div class="text-gray-800 dark:text-gray-400">
    <div class="text-md font-semibold mb-3">
        @lang('Do you really want to delete the following :entity? <br /> If you remove the :entity, then all related data\'s will permanently removed!', ['entity' => $service->getEntityName()])
    </div>
    @if($currentModel)
        @foreach($service->getModalColumns() as $columnName => $columnData)
            @if(isset($columnData['column']))
                <div class="flex {{ !$loop->first ? 'border-t border-gray-400 dark:border-gray-300' : '' }}">
                    <div class="w-4/12 py-2 font-bold">
                        @lang($columnName ?? $columnData['label'])
                    </div>
                    <div class="w-8/12 py-2 flex items-center">
                        @if(isset($columnData['format']))
                            @if(isset($columnData['asHtml']))
                                {!! $columnData['format']($currentModel->{$columnData['column']}) !!}
                            @else
                                {{ $columnData['format']($currentModel->{$columnData['column']}) }}
                            @endif
                        @else
                            {{ $currentModel->{$columnData['column']} }}
                        @endif
                    </div>
                </div>
            @endif
        @endforeach
    @endif
</div>
