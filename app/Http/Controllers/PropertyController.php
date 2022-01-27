<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessImage;
use App\Models\Category;
use App\Models\Image;
use App\Models\Property;
use App\Models\Realtor;
use App\Models\Thumbnail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as ImageLibrary;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sortBy = $request->query('sortBy', 'properties.name');
        $order = $request->query('order', 'asc');

        $properties = Property::join('realtors', 'realtors.id', '=', 'properties.realtor_id')
        ->join('users', 'users.id', '=', 'realtors.user_id')
        ->leftjoin('categories', 'categories.id', '=', 'properties.category_id')
        ->select('properties.id', 'properties.name', 'properties.description', 'properties.price', 'properties.realtor_id', 'realtors.phone as realtor_contact', 'users.name as realtor_name', 'users.email as realtor_email', 'categories.name as category_name')
        ->orderBy($sortBy, $order)->paginate(5);

        return view('properties.index', compact('properties', 'sortBy', 'order'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! auth()->check()) {
            return redirect()->route('login');
        }

        $categories = Category::all();

        return view('properties.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! auth()->check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'description' => 'required',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'name' => 'required',
            'category_id' => 'required',
        ]);

        $user_id = Auth::id();

        $realtor = Realtor::where('user_id', $user_id)->get();
        if ($realtor->isEmpty()) {
            $messages = ['You should create a Realtor profile to create a Property'];

            return redirect()->route('properties.create')
            ->withErrors($messages);
        }

        $property = Property::create($request->except(['count']));
        $property->realtor_id = $user_id;
        $property->save();

        $count = $request->input('count');
        var_dump($count);
        for ($i = 0; $i < $count; $i++) {
            $image = $request->file('images'.strval($i));
            $image->store('images', 'public');

            $newImage = new Image([
                'property_id' => $property->id,
                'file_path' => $image->hashName(),
            ]);

            $newImage->save();
            var_dump($i);
            ProcessImage::dispatch($newImage, url('/').'/storage/images/'.$image->hashName());
        }

        return redirect()->route('properties.index')
                        ->with('success', 'Property created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        $images = Image::join('thumbnails', 'images.id', '=', 'thumbnails.image_id')
        ->where('images.property_id', '=', $property->id)
        ->select('images.id', 'images.property_id', 'images.file_path as image_file_path', 'thumbnails.file_path as thumbnail_file_path')
        ->get();

        return view('properties.show', compact('property', 'images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        if (! auth()->check()) {
            return redirect()->route('login');
        }

        if (! Gate::allows('update-property', $property)) {
            abort(403);
        }

        $categories = Category::all();

        return view('properties.edit', compact('property', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property)
    {
        if (! auth()->check()) {
            return redirect()->route('login');
        }

        if (! Gate::allows('update-property', $property)) {
            abort(403);
        }

        $request->validate([
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required',
        ]);

        $property->update($request->except(['count']));

        $count = $request->input('count');

        for ($i = 0; $i < $count; $i++) {
            $image = $request->file('images'.strval($i));
            $image->store('images', 'public');

            $newImage = new Image([
                'property_id' => $property->id,
                'file_path' => $image->hashName(),
            ]);

            $newImage->save();

            ProcessImage::dispatch($newImage, url('/').'/storage/images/'.$image->hashName());
        }

        return redirect()->route('properties.index')
                        ->with('success', 'Property updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        if (! auth()->check()) {
            return redirect()->route('login');
        }

        if (! Gate::allows('delete-property', $property)) {
            abort(403);
        }

        $property->delete();

        return redirect()->route('properties.index')
                        ->with('success', 'Property deleted successfully');
    }
}
