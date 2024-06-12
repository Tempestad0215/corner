<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Inertia\Inertia;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Sacar los datos
        $data = Category::where('status', false)
            ->simplePaginate(15);

        // Devolve los datos
        return Inertia::render('Categories/Index',[
            'categories' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        try {

            // Numero
            $count = Category::count();

            // Si tiene mas de 200 categoria
            if($count > 199 )
            {
                return back()->with('name','Por favor ya no es posible crear mas categoria, contacte el soporte');
            }

            // Guardar los datos validado
            Category::create($request->validated());

            // Devolver hacia atras
            return back();

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, String $code)
    {
        try {
            // Conseguir el primer categoria con las descripcio hecha
            $category = Category::where('status', true)
                ->where('code', $code)
                ->first();

            // Actualizar los datos
            $category->name = $request->name;
            $category->description = $request->description;

            // Guardar los datos
            $category->save();

            // Retornar hacia atras
            return back();


        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
