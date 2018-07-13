<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Validator;

class ProductsController extends BaseController {

    public function index() {
        $products = Product::all();

        return $this->sendResponse($products->toArray(), 'Products retrieved successfully.');
    }

    public function show(Product $product) {

        return $this->sendResponse($product->toArray(), 'Product retrieved successfully.');
    }

    public function store(Request $request) {

        $input = $request->all();

        $validator = Validator::make($request->all(), [
                    'title' => 'required|unique:products|max:255',
                    'description' => 'required',
                    'price' => 'integer',
                    'availability' => 'boolean',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error', $validator->errors());
        }

        $product = Product::create($input);

        return $this->sendResponse($product->toArray(), 'Product created successfully.');
    }

    public function update(Request $request, Product $product) {

        $validator = Validator::make($request->all(), [
                    'title' => 'required|unique:products|max:255',
                    'description' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error', $validator->errors());
        }
        $product->update($request->all());

        return $this->sendResponse($product->toArray(), 'Product updated successfully.');
    }

    public function delete($id) {

        $product = Product::find($id);

        if ($product != null) {
            $product->delete();
            return $this->sendResponse($product->toArray(), 'Product deleted successfully.', 204);
        }
        return $this->sendError('Not found', 'Product not found.');
    }

}
