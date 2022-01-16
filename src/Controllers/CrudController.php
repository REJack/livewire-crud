<?php

namespace REJack\LivewireCrud\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

abstract class CrudController extends Controller
{
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
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // ToDo: replace with correct response
        return response()->redirectTo('');
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

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int|string $id
     * @return RedirectResponse
     */
    public function update(Request $request, int|string $id): RedirectResponse
    {
        // ToDo: replace with correct response
        return response()->redirectTo('');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int|string $id
     * @return RedirectResponse
     */
    public function destroy(int|string $id): RedirectResponse
    {
        // ToDo: replace with correct response
        return response()->redirectTo('');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int|string $id
     * @return void
     */
    public function destroyModal(int|string $id): void
    {
    }
}
