<?php

namespace REJack\LivewireCrud\DataTableComponent;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

abstract class LivewireCrudDataTable extends DataTableComponent
{
    /**
     * @return string
     */
    abstract protected function getModel(): string;

    /**
     * @return array
     */
    abstract protected function getColumns(): array;

    /**
     * @return array
     */
    public function columns(): array
    {
        $columns = [];

        foreach ($this->getColumns() as $column) {
            if (isset($column['blank'])) {
                $columns[] = Column::blank();

                continue;
            }

            $newColumn = Column::make($column['text'] ?? null, $column['column'] ?? null);

            // Sort / Search
            if (isset($column['sortable'])) {
                $newColumn->sortable(is_bool($column['sortable']) ? null : $column['sortable']);
            }
            if (isset($column['searchable'])) {
                $newColumn->searchable(is_bool($column['searchable']) ? null : $column['searchable']);
            }

            // Cell Formatting
            if (isset($column['format'])) {
                $newColumn->format($column['format']);
            }
            if (isset($column['asHtml'])) {
                $newColumn->asHtml();
            }

            // Conditional Columns
            if (isset($column['hideIf'])) {
                $newColumn->hideIf($column['hideIf']);
            }

            // Column Selection
            if (isset($column['excludeFromSelectable'])) {
                $newColumn->excludeFromSelectable();
            }
            if (isset($column['excludeFromSelectable'])) {
                $newColumn->selected();
            }

            // Header / Footer
            if (isset($column['secondaryHeader'])) {
                $newColumn->secondaryHeader($column['secondaryHeader']);
            }
            if (isset($column['footer'])) {
                $newColumn->footer($column['footer']);
            }

            // Misc
            if (isset($column['classes'])) {
                if (is_array($column['classes'])) {
                    $newColumn->addClass(implode(' ', $column['classes']));
                } else {
                    $newColumn->addClass($column['classes']);
                }
            }
            if (isset($column['attributes'])) {
                $newColumn->addAttributes($column['classes']);
            }

            $columns[] = $newColumn;
        }

        return $columns;
    }

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return app($this->getModel())::query();
    }

    /**
     * @return string
     */
    public function rowView(): string
    {
        return 'livewire-crud::table.row';
    }
}
