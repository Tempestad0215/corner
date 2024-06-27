<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProCatResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Devolver la vista con los datos
        try {
            // Buscar los datos
            $search = $request->get('search');

            // Consguir los datos
            $products = Product::where('status',false)
                ->where(function(Builder $query) use ($search) {
                    $query->where('name','like','%'. $search .'%')
                        ->orWhere('code','like','%'. $search.'%' )
                        ->orWhereHas('category', function(Builder $query) use ($search) {
                            $query->where('name','like','%'. $search .'%');
                        });
                })
                ->latest()
                ->simplePaginate();

            // Formaterar los datos
            $productFormat = ProCatResource::collection($products)->response()->getData(true);



            // DEvolver los datos
            return Inertia::render('Products/Index',[
                'products' => $productFormat
            ]);

        } catch (\Throwable $th) {
            throw $th;

        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        try {

            // Guardar los datos validados
            Product::create($request->validated());

            // Devolver hacia atras
            return back();

        } catch (\Throwable $th) {
            throw $th;
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        try {

            // Actualizar los datos
           $product->update($request->validated());


            // Deolver hacia atrs
            return back();

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {

            // Eliminar los datos
            $product->status = true;

            // Guardar los datos
            $product->save();

            // Devolver hacia atras
            return back();

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
