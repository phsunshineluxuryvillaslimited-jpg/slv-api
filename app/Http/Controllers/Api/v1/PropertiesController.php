<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePropertyRequest;
use App\Http\Resources\PropertyResource;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = Property::query();
        
        if ($request->has('include')) {
            $query->with(explode(',', $request->include));
        }
        
        $query->where('published', 'yes');

        return PropertyResource::collection($query->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePropertyRequest $request, Property $property)
    {
        $data = $request->validated();

        $property = Property::create($data);

        if (isset($data['address'])) {
            $property->address()->create($data['address']);
        }

        if (isset($data['price'])) {
            $property->price()->create($data['price']);
        }

        if (isset($data['details'])) {
            $property->details()->create($data['details']);
            if (isset($data['details']['size'])) {
                $property->propertyDetailSize()->create($data['details']['size']);
            }
            if (isset($data['details']['rooms'])) {
                $property->propertyDetailRooms()->create($data['details']['rooms']);
            }
        }
        if (isset($data['media'])) {
            $property->media()->createMany($data['media']);
        }

        if (isset($data['networks'])) {
            $property->networks()->createMany($data['networks']);
        }

        return PropertyResource::make(
            $property->with([
                'address',
                'price',
                'details',
                'details.sizing',
                'details.rooms',
                'media',
                'networks'
            ])
            ->find($property->id)
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Property $property)
    {
        $id = $property->id;
        
        if ($request->has('include')) {
           $property = $property->with(explode(',', $request->include));
        }
        
        return PropertyResource::make($property->find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePropertyRequest $request, Property $property)
    {   
        // $data = $request->validated();
        // dd($request->all());
        $data = $request->all();
        $property->update($data);

        if (isset($data['address'])) {
            $property->address()->updateOrCreate($data['address']);
        }

        if (isset($data['price'])) {
            $property->price()->updateOrCreate($data['price']);
        }

        if (isset($data['details'])) {
            $property->details()->updateOrCreate($data['details']);
            if (isset($data['details']['size'])) {
                $property->propertyDetailSize()->updateOrCreate($data['details']['size']);
            }
            if (isset($data['details']['rooms'])) {
                $property->propertyDetailRooms()->updateOrCreate($data['details']['rooms']);
            }
        }
        if (isset($data['media'])) {
            $property->media()->upsert([['media' => $data['media']]], [
                'property_id',
                'type',
                'url',
                'caption',
                'sort_order',
                'media_update_date'
            ]);
        }
        
        if (isset($data['networks'])) {
            $property->networks()->upsert($data['networks'], ['property_id', 'network', 'published']);
        }


        return PropertyResource::make(
            $property->with([
                'address',
                'price',
                'details',
                'details.sizing',
                'details.rooms',
                'media',
                'networks'
            ])
            ->find($property->id)
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $property = Property::findOrFail($id);
        $property->delete();

        return response()->noContent();
    }

}
