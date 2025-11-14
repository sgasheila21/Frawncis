<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator as FacadesValidator;

use function PHPSTORM_META\map;

class ProductController extends Controller
{
    public function productShow (){
        $products = Product::orderBy('created_at', 'desc')->paginate(8);
        return view('product/list', compact('products'));
    }

    public function newProductShow(){
        $hasImage = false;
        $types = ProductType::all();
        return view('product/add', compact(['hasImage','types']));
    }

    public function newProduct (Request $request){
        $hasImage = false;
        $namaFileTemp = '';

        $types = ProductType::all();

        if($request->has('oldImage')){
            if($request->has('prodImage')){
                $hasImage = true;
                $extFileTemp = $request->prodImage->getClientOriginalExtension();
                $namaFileTemp = 'temp_product_user_'.auth()->user()->id.'.'.$extFileTemp;
            }
            else{
                $hasImage = true;
                $namaFileTemp = $request->oldImage;    
            }

            $validator = FacadesValidator::make($request->all(), [
                'name' => 'required|max:50',
                'price' => 'required|integer|min:1000',
                'description' => 'required',
                'productType' => 'required|exists:product_types,id',
                'prodImage' => 'max:10240|mimes:jpg,jpeg,png'
            ],
            [
                'name.required' => 'The name field is required.',
                'name.max' => 'The maximum length of name field is 50 characters.',
                'price.required' => 'The price field is required.',
                'price.integer' => 'The price field must be integer.',
                'price.min' => 'The minimum value of price is 1000',
                'description.required' => 'The description field is required.',
                'productType.required' => 'The product type field is required.',
                'productType.exists' => 'The product type is not in the product types table',
                'prodImage.max' => 'Maximum file size for image is 10MB.',
                'prodImage.mimes' => 'Image must be in the format of either .jpg, .jpeg. or .png.'
            ]);

            if($validator->fails()){
                $errors = $validator->errors();

                if($request->has('prodImage')){
                    if(file_exists(public_path('temp/'.$request->oldImage)))  unlink(public_path('temp/'.$request->oldImage));

                    $request->prodImage->move('temp',$namaFileTemp);
                }

                return view('product/add')->with(compact(['hasImage','namaFileTemp','errors','types']));
            }
            else{
                if($request->has('prodImage')){
                    if(file_exists(public_path('temp/'.$request->oldImage)))  unlink(public_path('temp/'.$request->oldImage));
                    $request->prodImage->move('temp',$namaFileTemp);
                }
            }
        }
        else{
            if($request->has('prodImage')){
                $hasImage = true;
                $extFileTemp = $request->prodImage->getClientOriginalExtension();
                $namaFileTemp = 'temp_product_user_'.auth()->user()->id.'.'.$extFileTemp;
            }

            $validator = FacadesValidator::make($request->all(), [
                'name' => 'required|max:50',
                'price' => 'required|integer|min:1000',
                'description' => 'required',
                'productType' => 'required|exists:product_types,id',
                'prodImage' => 'required|max:10240|mimes:jpg,jpeg,png'
            ],
            [
                'name.required' => 'The name field is required.',
                'name.max' => 'The maximum length of name field is 50 characters.',
                'price.required' => 'The price field is required.',
                'price.integer' => 'The price field must be integer.',
                'price.min' => 'The minimum value of price is 1000',
                'description.required' => 'The description field is required.',
                'productType.required' => 'The product type field is required.',
                'productType.exists' => 'The product type is not in the product types table',
                'prodImage.required' => 'The image field is required',
                'prodImage.max' => 'Maximum file size for image is 10MB.',
                'prodImage.mimes' => 'Image must be in the format of either .jpg, .jpeg. or .png.'
            ]);

            if($validator->fails()){
                $errors = $validator->errors();

                if($request->has('prodImage')){
                    $request->prodImage->move('temp',$namaFileTemp);
                }

                return view('product/add')->with(compact(['hasImage','namaFileTemp','errors','types']));
            }
            else{
                if($request->has('prodImage')){
                    $request->prodImage->move('temp',$namaFileTemp);
                }
            }
        }

        $inputToData = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'product_type_id' => $request->productType,
            'image' => $namaFileTemp
        ]);

        $recentInputData = Product::find($inputToData->id);
        $currentFilePath = public_path('temp/'.$namaFileTemp);
        $ext = pathinfo($currentFilePath, PATHINFO_EXTENSION);
        $newFileName = 'user_'.auth()->user()->id.'_product_'.$inputToData->id.'.'.$ext;
        $newFilePath = public_path('products_image/' . $newFileName);

        if (file_exists($currentFilePath)) {
            if (!is_dir(public_path('products_image'))) {
                mkdir(public_path('products_image'));
            }
            File::move($currentFilePath, $newFilePath);
        }

        $recentInputData->image = $newFileName;
        $recentInputData->save();

        if($recentInputData && $recentInputData->wasChanged()){
            return redirect('/products')->with('success', 'Product Successfully Added!');
        }
        else{
            return redirect('/products')->with('failure', 'Failed To Add Product!');
        }   
    }

    public function updateProductShow($id){
        $product = Product::find($id);
        $imageSource = '/products_image/'.$product->image;
        $hasChanged = false;
        $types = ProductType::all();

        return view('/product/update', compact(['product','imageSource','hasChanged','types']));
    }

    public function updateProduct ($id, Request $request){
        $product = Product::find($id);
        $types = ProductType::all();

        $hasChanged = false;
        $imageSource = '/products_image/'.$product->image;

        if($request->has('isChanged')){
                $hasChanged = true;
                $imageSource = '#'; 
        }
        else{
            if($request->has('prodImage')){
                $hasChanged = true;
                $imageSource = '#';
            }
        }

        if($imageSource == '#'){
            $validator = FacadesValidator::make($request->all(), [
                'name' => 'required|max:50',
                'price' => 'required|integer|min:1000',
                'description' => 'required',
                'productType' => 'required|exists:product_types,id',
                'prodImage' => 'required|max:10240|mimes:jpg,jpeg,png'
            ],
            [
                'name.required' => 'The name field is required.',
                'name.max' => 'The maximum length of name field is 50 characters.',
                'price.required' => 'The price field is required.',
                'price.integer' => 'The price field must be integer.',
                'price.min' => 'The minimum value of price is 1000',
                'description.required' => 'The description field is required.',
                'productType.required' => 'The product type field is required.',
                'productType.exists' => 'The product type is not in the product types table',
                'prodImage.required' => 'The image field is required',
                'prodImage.max' => 'Maximum file size for image is 10MB.',
                'prodImage.mimes' => 'Image must be in the format of either .jpg, .jpeg. or .png.'
            ]);
        }
        else{
            $validator = FacadesValidator::make($request->all(), [
                'name' => 'required|max:50',
                'price' => 'required|integer|min:1000',
                'description' => 'required',
                'productType' => 'required|exists:product_types,id',
                'prodImage' => 'max:10240|mimes:jpg,jpeg,png'
            ],
            [
                'name.required' => 'The name field is required.',
                'name.max' => 'The maximum length of name field is 50 characters.',
                'price.required' => 'The price field is required.',
                'price.integer' => 'The price field must be integer.',
                'price.min' => 'The minimum value of price is 1000',
                'description.required' => 'The description field is required.',
                'productType.required' => 'The product type field is required.',
                'productType.exists' => 'The product type is not in the product types table',
                'prodImage.max' => 'Maximum file size for image is 10MB.',
                'prodImage.mimes' => 'Image must be in the format of either .jpg, .jpeg. or .png.'
            ]);
        }

        if($validator->fails()){
            $errors = $validator->errors();
    
            if($request->has('prodImage')){
                if(file_exists(public_path('temp/'.$product->image)))  unlink(public_path('temp/'.$product->image));

                $request->prodImage->move('temp',$product->image);
                $imageSource = '#';
            }

            return view('product/update')->with(compact(['imageSource','errors','product','hasChanged','types']));
        }
        else{
            if($request->has('prodImage')){
                if(file_exists(public_path('temp/'.$product->image)))  unlink(public_path('temp/'.$product->image));

                $request->prodImage->move('temp',$product->image);
                $imageSource = '#';
            }
        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->product_type_id = $request->productType;

        if($hasChanged){
            unlink(public_path('products_image/'.$product->image));
            $currentFilePath = public_path('temp/'.$product->image);
            $newFilePath = public_path('products_image/'.$product->image);
    
            File::move($currentFilePath, $newFilePath);
        }

        $product->save();

        if($product->wasChanged() || File::exists($newFilePath)){
            return redirect('/products')->with('success', 'Product Has Been Updated!');
        }
        else{
            return redirect('/products')->with('failure', 'Nothing changed!');
        }
    }

    public function deleteProduct ($id, Request $request){
        if ($request->has('btnYes')){
            $product = Product::find($id);
            $deleted = $product->delete();

            if($deleted){
                unlink(public_path('products_image/'.$product->image));
                return redirect('/products')->with('success', 'Product Has Been Deleted!');
            }
            else{
                return redirect('/products')->with('failure', 'Failed to Delete Product!');
            }
        }
        else if ($request->has('btnCancel')){
            return redirect('/products')->with('failure', 'Deletion canceled!');
        }
    }

    public function updateProductCart ($id, Request $request){
        $cart = Cart::where([['member_id',auth()->user()->id], ['product_id',$id]])->first();
        $updated = false;

        if($request->has('btnRemove')){
            $updated = $cart->delete();
        }
        else if($request->has('btnAdd')){
            $updated = Cart::create([
                'member_id' => auth()->user()->id,
                'product_id' => $id,
                'quantity' => 1
            ]);
        }

        if($updated){
            return redirect('/products')->with('success', 'Cart Has Been Updated!');
        }
        else{
            return redirect('/products')->with('failure', 'Nothing changed!');
        }
    }
}
