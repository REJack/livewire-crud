@php($config = config('livewire-crud.modal'))
<x-jet-dialog-modal wire:model="modalVisible">
    <x-slot name="title">
        <span class="text-gray-900 dark:text-gray-300">
            @lang('Delete :entity ":name"', ['entity' => $this->getService()->getEntityName(), 'name' => $this->getService()->getDeleteName($currentModel)])
        </span>
    </x-slot>

    <x-slot name="content">
        @include($this->getService()->getModalContentView(), ['currentModel' => $currentModel, 'service' => $this->getService()])
    </x-slot>

    <x-slot name="footer">
        <div class="flex justify-end">
            <x-button md :color="$config['abort']['color'] ?? 'dark'"
                      :label="__($config['abort']['label'] ?? 'Abort')"
                      wire:click.prevent="resetModal"
                      class="py-2 px-3"/>

            <x-button md :color="$config['submit']['color'] ?? 'dark'"
                      :label="__($config['submit']['label'] ?? 'Delete permanently')"
                      wire:click.prevent="submitModal"
                      class="py-2 px-3 ml-2"/>
        </div>
    </x-slot>
</x-jet-dialog-modal>
