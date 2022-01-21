<?php

namespace REJack\LivewireCrud\DataTableComponent;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use REJack\LivewireCrud\Services\LivewireCrudService;

abstract class LivewireCrudDataTable extends DataTableComponent
{
    /**
     * @var bool
     */
    public bool $modalVisible = false;

    /**
     * @var Model|null
     */
    public ?Model $currentModel;

    /**
     * @return string
     */
    abstract public function getServiceClass(): string;

    /**
     * @return LivewireCrudService
     */
    public function getService(): LivewireCrudService
    {
        return app($this->getServiceClass());
    }

    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return $this->getService()->getModel();
    }

    /**
     * @return array
     */
    private function getColumns(): array
    {
        return $this->getService()->getTableColumns();
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        $columns = [];

        foreach ($this->getColumns() as $columnName => $columnData) {
            $isBlank = false;

            if (isset($columnData['table']) && ! $columnData['table']) {
                continue;
            }
            if ($columnData instanceof Column) {
                $columns[] = $columnData;

                continue;
            }

            if (isset($columnData['blank']) || isset($columnData['action'])) {
                $newColumn = Column::blank();
                $newColumn->text = $columnName;
                $isBlank = true;
            } else {
                $newColumn = Column::make($columnName, $columnData['column'] ?? null);
            }

            if (isset($columnData['action'])) {
                $newColumn->addClass(config('livewire-crud.dataTable.actionClasses'));
                $newColumn->asHtml();

                $baseRoute = $this->getService()->getBaseRoute();
                if (isset($columnData['actions'])) {
                    $newColumn->format(function ($row) use ($columnData, $baseRoute) {
                        return view(
                            'livewire-crud::partials.actions',
                            [
                                'rowData' => $row,
                                'actions' => $columnData['actions'],
                                'routeBase' => $baseRoute,
                            ]
                        );
                    });
                }
            }

            // Sort / Search
            if ($isBlank === false && (! isset($columnData['sortable']) || $columnData['sortable'])) {
                $newColumn->sortable(
                    isset($columnData['sortable']) && ! is_bool($columnData['sortable'])
                        ? $columnData['sortable']
                        : null
                );
            }
            if ($isBlank === false && (! isset($columnData['searchable']) || $columnData['searchable'])) {
                $newColumn->searchable(
                    isset($columnData['searchable']) && ! is_bool($columnData['searchable'])
                        ? $columnData['searchable']
                        : null
                );
            }

            // Cell Formatting
            if (isset($columnData['format'])) {
                $newColumn->format($columnData['format']);
            }
            if (isset($columnData['asHtml'])) {
                $newColumn->asHtml();
            }

            // Conditional Columns
            if (isset($columnData['hideIf'])) {
                $newColumn->hideIf($columnData['hideIf']);
            }

            // Column Selection
            if (isset($columnData['excludeFromSelectable'])) {
                $newColumn->excludeFromSelectable();
            }
            if (isset($columnData['excludeFromSelectable'])) {
                $newColumn->selected();
            }

            // Header / Footer
            if (isset($columnData['secondaryHeader'])) {
                $newColumn->secondaryHeader($columnData['secondaryHeader']);
            }
            if (isset($columnData['footer'])) {
                $newColumn->footer($columnData['footer']);
            }

            // Misc
            if (isset($columnData['headClasses'])) {
                if (is_array($columnData['headClasses'])) {
                    $newColumn->addClass(implode(' ', $columnData['headClasses']));
                } else {
                    $newColumn->addClass($columnData['headClasses']);
                }
            }
            if (isset($columnData['attributes'])) {
                $newColumn->addAttributes($columnData['classes']);
            }

            $columns[] = $newColumn;
        }

        return $columns;
    }

    /**
     * @param Column $column
     * @param $row
     * @return string|null
     */
    public function setTableDataClass(Column $column, $row): ?string
    {
        $columnData = collect($this->getColumns())->first(function ($data, $key) use ($column) {
            return $column->text === $key;
        });

        if (in_array($column->text, ['actions', 'buttons'])) {
            return config('livewire-crud.dataTable.actionClasses');
        }

        return $columnData['cellClasses'] ?? null;
    }

    /**
     * @return array
     */
    protected function getSelectArray(): array
    {
        return collect($this->getColumns())
            ->whereNotNull('column')
            ->map(function ($row) {
                return $row['column'];
            })
            ->merge($this->getService()->additionalTableSelectArray)
            ->toArray();
    }

    /**
     * @return Builder
     */
    public function getBuilderQuery(): Builder
    {
        return $this->getModel()::query();
    }

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return $this->getBuilderQuery()
            ->select($this->getSelectArray());
    }

    /**
     * @param int|string $modelId
     * @return void
     */
    public function openModal(int|string $modelId): void
    {
        $this->modalVisible = true;
        $this->currentModel = $this->getModel()::findOrFail($modelId);
    }

    /**
     * @return void
     */
    public function resetModal(): void
    {
        $this->modalVisible = false;
        $this->currentModel = null;
    }

    /**
     * @return void
     */
    public function submitModal(): void
    {
        $this->getService()->deleteModel($this->currentModel->id);
        $this->resetModal();
    }

    /**
     * {@inheritdoc}
     */
    public function modalsView(): string
    {
        return 'livewire-crud::delete-modal';
    }
}
