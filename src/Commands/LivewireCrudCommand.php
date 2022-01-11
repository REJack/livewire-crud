<?php

namespace REJack\LivewireCrud\Commands;

use Illuminate\Console\Command;

class LivewireCrudCommand extends Command
{
    public $signature = 'livewire-crud';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
