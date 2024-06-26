<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProCatResource;
use App\Models\ProductTrans;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
                        ->orWhere('code','like','%'. $search.'%' );
                })
                ->orWhereHas('category', function(Builder $query) use ($search) {
                    $query->where('name','like','%'. $search .'%');
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        try {

            // Para asegurar de que todo
            DB::transaction(function() use ($request){

                // Guardar los datos validados
                $product = Product::create($request->validated());

                // Devolver hacia atras con los productos
                ProductTrans::create([
                    'product_id' => $product->id,
                    'quantity' => $product->stock,
                    'price' => $product->price,
                    'cost' => $product->cost
                ]);
            });

            // Devolver hacia atras
            return back();



        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
