<?php

namespace REJack\LivewireCrud\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use REJack\LivewireCrud\Services\LivewireCrudService;

abstract class CrudController extends Controller
{
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
     * @return string
     */
    abstract protected function getDataTableComponent(): string;

    /**
     * @var string
     */
    public string $headerTitle = '';

    /**
     * @return string
     */
    public function getDataTableComponentName(): string
    {
        $livewireComponents = include app()->bootstrapPath('cache' . DIRECTORY_SEPARATOR . 'livewire-components.php');

        return array_search($this->getDataTableComponent(), $livewireComponents, true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return response()->view(
            'livewire-crud::index',
            [
                'datatable' => $this->getDataTableComponentName(),
                'header' => $this->headerTitle,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        // ToDo: replace with correct response
        return response()->view('livewire-crud::create');
    }

    /**
     * Display the specified resource.
     *
     * @param int|string $id
     * @return Response
     */
    public function show(int|string $id): Response
    {
        return response()->view('livewire-crud::show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int|string $id
     * @return Response
     */
    public function edit(int|string $id): Response
    {
        return response()->view('livewire-crud::edit');
    }
}
