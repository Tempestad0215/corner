<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;
use JsonException;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        // Para buscar
        $search = $request->get('search');

        // Sacar los datos
        $data = Category::where('status', false)
            ->where(function(Builder $query) use ($search){
                $query->where('code','LIKE','%'.$search.'%')
                    ->orWhere('name','LIKE','%'.$search.'%')
                    ->orWhere('description','LIKE','%'.$search.'%');
            })
            ->latest()
            ->simplePaginate();

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
            $category = Category::where('status', false)
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
    public function destroy(String $code)
    {
        try {

            // Buscar los datos para deshabilitar
            $category = Category::where('status', false)
                ->where('code', $code)
                ->first();

            // Actualizar los datos
            $category->status = true;
            $category->save();

            // Devolver hacia atras
            return back();

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    // Para conseguir las categorias
    public function get(Request $request)
    {
        try {

            // Para buscar los datos
            $search = $request->get('search');

            // Buscar los datos
            $data = Category::where('status', false)
                ->where('name','LIKE','%'. $search .'%')
                ->limit(10)
                ->get();

            return response()->json($data);

        } catch (\Throwable $th) {
            // Enviar un mensaje de error
            throw new JsonException($th->getMessage(), 400);
        }
    }
}
