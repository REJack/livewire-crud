<?php

namespace REJack\LivewireCrud\Services;

use Illuminate\Database\Eloquent\Model;

abstract class LivewireCrudService
{
    /**
     * @var string[]
     */
    public array $additionalTableSelectArray = [];

    /**
     * @return string
     */
    abstract public function getModelClass(): string;

    /**
     * @return string
     */
    abstract public function getTableClass(): string;

    /**
     * @return string
     */
    abstract public function getBaseRoute(): string;

    /**
     * @return string
     */
    abstract public function getEntityName(): string;

    /**
     * @param Model $model
     * @return string
     */
    abstract public function getDeleteName(Model $model): string;

    /**
     * @return array
     */
    public function getDefaultColumns(): array
    {
        return [];
    }

    /**
     * @return array
     */
    public function getFormColumns(): array
    {
        return $this->getDefaultColumns();
    }

    /**
     * @return array
     */
    public function getTableColumns(): array
    {
        return $this->getDefaultColumns();
    }

    /**
     * @return array
     */
    public function getModalColumns(): array
    {
        return $this->getDefaultColumns();
    }

    /**
     * @return array
     */
    public function getCreateColumns(): array
    {
        return $this->getFormColumns();
    }

    /**
     * @return array
     */
    public function getEditColumns(): array
    {
        return $this->getFormColumns();
    }

    /**
     * @return array
     */
    public function getShowColumns(): array
    {
        return $this->getFormColumns();
    }

    /**
     * @return boolean
     */
    public function getTableAuthorization(): bool
    {
        return true;
    }

    /**
     * @return boolean
     */
    public function getCreateAuthorization(): bool
    {
        return true;
    }

    /**
     * @return boolean
     */
    public function getEditAuthorization(): bool
    {
        return true;
    }

    /**
     * @return boolean
     */
    public function getShowAuthorization(): bool
    {
        return true;
    }

    /**
     * @return string
     */
    public function getModalContentView(): string
    {
        return 'livewire-crud::partials.modal-content';
    }

    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return app($this->getModelClass());
    }

    /**
     * @param array $attributes
     * @return bool
     */
    public function createModel(array $attributes): bool
    {
        return $this->getModel()::create($attributes);
    }

    /**
     * @param int|string $id
     * @param array $attributes
     * @return bool
     */
    public function updateModel(int|string $id, array $attributes): bool
    {
        return $this->getModel()::where($this->getModel()->getKeyName(), $id)->update($attributes);
    }

    /**
     * @param int|string $id
     * @return bool
     */
    public function deleteModel(int|string $id): bool
    {
        return $this->getModel()::destroy($id);
    }
}
