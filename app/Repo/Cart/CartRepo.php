<?php

namespace App\Repo\Cart ;

use App\Models\Product;
use Illuminate\Support\Collection;

interface CartRepo
{

public function get() :Collection;
public function add(Product $product,$quantity = 1 ) ;
public function delete($id) ;
public function update(Product $product,$quantity) ;
public function empty() ;
public function total() ;




}
