<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Product;

class SearchController extends Controller
{
    public function getData (Request $request) {
        $all_locations = Location::all();
        $locations = collect();
        $intersections_location = 0;

        $all_products = Product::all();
        $products = collect();
        $intersections_product = 0;

        $input_search = str_split(str_replace(' ','',strtolower($request->search)));

        foreach($all_locations as $location) {
            $location_city = str_split(str_replace(' ','',strtolower($location->city)));
            $intersections_location = array_intersect(array_unique($location_city), array_unique($input_search));

            if(count($intersections_location) > 0){
                $locations->push($location);
            }
        }

        foreach($all_products as $product) {
            $product_name = str_split(str_replace(' ','',strtolower($product->name)));
            $intersections_product = array_intersect(array_unique($product_name), array_unique($input_search));

            if(count($intersections_product) > 0){
                $products->push($product);
            }
        }

        if (count($locations) == 0){
            $locations = 'No Location Result(s) for ';
        }
        if (count($products) == 0){
            $products = 'No Product Result(s) for ';
        }

        $real_input = $request->search;

        return view('search', compact(['locations','products', 'real_input']));
    }
}
