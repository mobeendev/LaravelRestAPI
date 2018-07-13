<?php

namespace App\Repositories;

use App\Product;
use App\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface {

    public function all() {
        return Product::all();
    }

    public function find($id) {
        return Product::find($id);
    }

    public function create(array $data) {
        
    }

    public function delete($id) {
        
    }

    public function show($id) {
        
    }

    public function update(array $data, $id) {
        
    }

}
