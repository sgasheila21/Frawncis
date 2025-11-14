<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class LocationController extends Controller
{
    public function locationShow (){
        $locations = Location::all();
        return view('location/list', compact('locations'));
    }

    public function newLocationShow (){
        $hasImage = false;
        return view('location/add', compact('hasImage'));
    }

    public function newLocation (Request $request){
        $hasImage = false;
        $namaFileTemp = '';

        if($request->has('oldImage')){
            if($request->has('locImage')){
                $hasImage = true;
                $extFileTemp = $request->locImage->getClientOriginalExtension();
                $namaFileTemp = 'temp_location_user_'.auth()->user()->id.'.'.$extFileTemp;
            }
            else{
                $hasImage = true;
                $namaFileTemp = $request->oldImage;    
            }

            $validator = FacadesValidator::make($request->all(), [
                'city' => 'required|max:30',
                'address' => 'required|max:50',
                'openHours' => 'required',
                'closeHours' => 'required|after:openHours',
                'locImage' => 'max:10240|mimes:jpg,jpeg,png'
            ],
            [
                'city.required' => 'The city field is required.',
                'city.max' => 'The maximum length of city field is 30 characters.',
                'address.required' => 'The address field is required.',
                'address.max' => 'The maximum length of address field is 50 characters.',
                'openHours.required' => 'The opening hours field is required.',
                'closeHours.required' => 'The closing hours field is required.',
                'closeHours.gt' => 'The closing hours must be after opening hours',
                'locImage.max' => 'Maximum file size for image is 10MB.',
                'locImage.mimes' => 'Image must be in the format of either .jpg, .jpeg. or .png.'
            ]);

            if($validator->fails()){
                $errors = $validator->errors();

                if($request->has('locImage')){
                    if(file_exists(public_path('temp/'.$request->oldImage)))  unlink(public_path('temp/'.$request->oldImage));

                    $request->locImage->move('temp',$namaFileTemp);
                }

                return view('location/add')->with(compact(['hasImage','namaFileTemp','errors']));
            }
            else{
                if($request->has('locImage')){
                    if(file_exists(public_path('temp/'.$request->oldImage)))  unlink(public_path('temp/'.$request->oldImage));
                    $request->locImage->move('temp',$namaFileTemp);
                }
            }
        }
        else{
            if($request->has('locImage')){
                $hasImage = true;
                $extFileTemp = $request->locImage->getClientOriginalExtension();
                $namaFileTemp = 'temp_location_user_'.auth()->user()->id.'.'.$extFileTemp;
            }

            $validator = FacadesValidator::make($request->all(), [
                'city' => 'required|max:30',
                'address' => 'required|max:50',
                'openHours' => 'required',
                'closeHours' => 'required|after:openHours',
                'locImage' => 'required|max:10240|mimes:jpg,jpeg,png'
            ],
            [
                'city.required' => 'The city field is required.',
                'city.max' => 'The maximum length of city field is 30 characters.',
                'address.required' => 'The address field is required.',
                'address.max' => 'The maximum length of address field is 50 characters.',
                'openHours.required' => 'The opening hours field is required.',
                'closeHours.required' => 'The closing hours field is required.',
                'closeHours.gt' => 'The closing hours must be after opening hours',
                'locImage.required' => 'The image field is required.',
                'locImage.max' => 'Maximum file size for image is 10MB.',
                'locImage.mimes' => 'Image must be in the format of either .jpg, .jpeg. or .png.'
            ]);

            if($validator->fails()){
                $errors = $validator->errors();

                if($request->has('locImage')){
                    $request->locImage->move('temp',$namaFileTemp);
                }

                return view('location/add')->with(compact(['hasImage','namaFileTemp','errors']));
            }
            else{
                if($request->has('locImage')){
                    $request->locImage->move('temp',$namaFileTemp);
                }
            }
        }

        $inputToData = Location::create([
            'city' => $request->city,
            'address' => $request->address,
            'opening_hours' => $request->openHours,
            'closing_hours' => $request->closeHours,
            'image' => $namaFileTemp
        ]);

        $recentInputData = Location::find($inputToData->id);
        $currentFilePath = public_path('temp/'.$namaFileTemp);
        $ext = pathinfo($currentFilePath, PATHINFO_EXTENSION);
        $newFileName = 'user_'.auth()->user()->id.'_location_'.$inputToData->id.'.'.$ext;
        $newFilePath = public_path('locations_image/' . $newFileName);

        if (file_exists($currentFilePath)) {
            if (!is_dir(public_path('locations_image'))) {
                mkdir(public_path('locations_image'));
            }
            File::move($currentFilePath, $newFilePath);
        }

        $recentInputData->image = $newFileName;
        $recentInputData->save();

        if($recentInputData && $recentInputData->wasChanged()){
            return redirect('/locations')->with('success', 'Location Successfully Added!');
        }
        else{
            return redirect('/locations')->with('failure', 'Failed To Add Location!');
        }   
    }

    public function updateLocationShow ($id){
        $location = Location::find($id);
        $imageSource = '/locations_image/'.$location->image;
        $hasChanged = false;

        return view('/location/update', compact(['location','imageSource','hasChanged']));
    }

    public function updateLocation ($id, Request $request){
        $location = Location::find($id);

        $hasChanged = false;
        $imageSource = '/locations_image/'.$location->image;

        if($request->has('isChanged')){
                $hasChanged = true;
                $imageSource = '#'; 
        }
        else{
            if($request->has('locImage')){
                $hasChanged = true;
                $imageSource = '#';
            }
        }

        if($imageSource == '#'){
            $validator = FacadesValidator::make($request->all(), [
                'city' => 'required|max:30',
                'address' => 'required|max:50',
                'openHours' => 'required',
                'closeHours' => 'required|after:openHours',
                'locImage' => 'required|max:10240|mimes:jpg,jpeg,png'
            ],
            [
                'city.required' => 'The city field is required.',
                'city.max' => 'The maximum length of city field is 30 characters.',
                'address.required' => 'The address field is required.',
                'address.max' => 'The maximum length of address field is 50 characters.',
                'openHours.required' => 'The opening hours field is required.',
                'closeHours.required' => 'The closing hours field is required.',
                'closeHours.gt' => 'The closing hours must be after opening hours',
                'locImage.required' => 'The image field is required.',
                'locImage.max' => 'Maximum file size for image is 10MB.',
                'locImage.mimes' => 'Image must be in the format of either .jpg, .jpeg. or .png.'
            ]);
        }
        else{
            $validator = FacadesValidator::make($request->all(), [
                'city' => 'required|max:30',
                'address' => 'required|max:50',
                'openHours' => 'required',
                'closeHours' => 'required|after:openHours',
                'locImage' => 'max:10240|mimes:jpg,jpeg,png'
            ],
            [
                'city.required' => 'The city field is required.',
                'city.max' => 'The maximum length of city field is 30 characters.',
                'address.required' => 'The address field is required.',
                'address.max' => 'The maximum length of address field is 50 characters.',
                'openHours.required' => 'The opening hours field is required.',
                'closeHours.required' => 'The closing hours field is required.',
                'closeHours.gt' => 'The closing hours must be after opening hours',
                'locImage.max' => 'Maximum file size for image is 10MB.',
                'locImage.mimes' => 'Image must be in the format of either .jpg, .jpeg. or .png.'
            ]);
        }

        if($validator->fails()){
            $errors = $validator->errors();
    
            if($request->has('locImage')){
                if(file_exists(public_path('temp/'.$location->image)))  unlink(public_path('temp/'.$location->image));

                $request->locImage->move('temp',$location->image);
                $imageSource = '#';
            }

            return view('location/update')->with(compact(['imageSource','errors','location','hasChanged']));
        }
        else{
            if($request->has('locImage')){
                if(file_exists(public_path('temp/'.$location->image)))  unlink(public_path('temp/'.$location->image));

                $request->locImage->move('temp',$location->image);
                $imageSource = '#';
            }
        }

        $location->city = $request->city;
        $location->address = $request->address;
        $location->opening_hours = $request->openHours;
        $location->closing_hours = $request->closeHours;

        if($hasChanged){
            unlink(public_path('locations_image/'.$location->image));
            $currentFilePath = public_path('temp/'.$location->image);
            $newFilePath = public_path('locations_image/'.$location->image);
    
            File::move($currentFilePath, $newFilePath);
        }

        $location->save();

        if($location->wasChanged() || File::exists($newFilePath)){
            return redirect('/locations')->with('success', 'Location Has Been Updated!');
        }
        else{
            return redirect('/locations')->with('failure', 'Nothing changed!');
        }
    }

    public function deleteLocation ($id, Request $request){
        if ($request->has('btnYes')){
            $location = Location::find($id);
            $deleted = $location->delete();

            if($deleted){
                unlink(public_path('locations_image/'.$location->image));
                return redirect('/locations')->with('success', 'Location Has Been Deleted!');
            }
            else{
                return redirect('/locations')->with('failure', 'Failed to Delete Location!');
            }
        }
        else if ($request->has('btnCancel')){
            return redirect('/locations')->with('failure', 'Deletion canceled!');
        }
    }
}
