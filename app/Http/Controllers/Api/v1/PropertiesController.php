<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePropertyRequest;
use App\Http\Resources\PropertyResource;
use App\Models\Property;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PropertiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Property::query()
            ->with(['networks'])
            // ->where('status', 'published')
            ->whereHas('networks', fn ($query) => $query->where('external_feeds', 'like', '%slv%'));

        if ($request->filled('include')) {
            $query->with($this->parseIncludes($request->input('include')));
        }

        if ($request->filled('reference')) {
            $query->where('properties.reference', trim($request->input('reference')));
        } else {

            if ($request->filled('order_by')) {
                $this->applyOrderBy($query, $request->input('order_by'));
            }

            if ($request->filled('region')
                && $request->input('region') != 'all'
            ) {
                $query->whereHas('address', fn ($query) => $query->where('region', trim($request->input('region'))));
            }

            if ($request->filled('towns')
                && $request->input('towns') != 'all'
            ) {
                $towns = array_map('trim', explode(',', urldecode($request->input('towns'))));
                $query->whereHas('address', fn ($query) => $query->whereIn('town_city', $towns));
            }

            if ($request->filled('propertyType')
                && $request->input('propertyType') != 'all'
            ) {
                $types = array_map('trim', explode(',', urldecode($request->input('propertyType'))));
                $query->whereHas('propertyType', fn ($query) => $query->whereIn('name', $types));
            }

            if ($request->filled('bedrooms')
                && $request->input('bedrooms') != 'any'
            ) {
                $query->where('properties.bedrooms', $request->input('bedrooms'));
            }

            if ($request->filled('bathrooms')
                && $request->input('bathrooms') != 'any'
            ) {
                $query->where('properties.bathrooms', $request->input('bathrooms'));
            }

            if ($request->filled('min_price') || $request->filled('max_price')) {
                $query->whereHas('price', function ($query) use ($request) {
                    if ($request->filled('min_price')
                        && $request->input('min_price') != 'any'
                    ) {
                        $query->where('basic_price', '>=', $request->input('min_price'));
                    }
                    if ($request->filled('max_price')
                        && $request->input('max_price') != 'any'
                    ) {
                        $query->where('basic_price', '<=', $request->input('max_price'));
                    }
                });
            }

            if ($request->filled('plot_size')
                && $request->input('plot_size') != 'any'
            ) {
                $query->where('properties.plot', '>=', $request->input('plot_size'));
            }

            // if ($request->filled('area_size')
            //     && $request->input('area_size') != 'any'
            // ) {
            //     $query->whereHas('amenities', fn ($query) => $query->where('covered', '>=', $request->input('area_size')));
            // }
        }

        $propertyList = $query->paginate(1);

        $propertyList->getCollection()->each->makeHidden(['description', 'plot_description', 'pool_description']);

        return PropertyResource::collection($propertyList);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePropertyRequest $request)
    {
        $data = array_merge($request->validated(), Arr::only($request->all(), ['address', 'price', 'media', 'networks']));

        $property = Property::create(Arr::except($data, ['address', 'price', 'media', 'networks']));

        if (isset($data['address'])) {
            $property->address()->create($data['address']);
        }

        if (isset($data['price'])) {
            $property->price()->create($data['price']);
        }

        if (isset($data['media'])) {
            $property->media()->createMany($data['media']);
        }

        if (isset($data['networks'])) {
            $property->networks()->createMany($data['networks']);
        }

        return PropertyResource::make($property->load(['address', 'price', 'media', 'networks']));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Property $property)
    {

        if ($property->status !== 'published'
            || ! $property->networks()->where('external_feeds', 'slv')->exists()
        ) {
            $property = null;
        } else {
            if ($request->filled('include')) {
                $property->load($this->parseIncludes($request->input('include')));
            }
        }

        return PropertyResource::make($property);
    }

    /**
     * Display the specified resource using reference
     *
     * @return PropertyResource
     */
    public function showByReference(Request $request, string $reference)
    {
        $property = Property::where('reference', trim($reference))
            ->with(['networks'])
            ->where('status', 'published')
            ->whereHas('networks', fn ($query) => $query->where('external_feeds', 'slv'))
            ->firstOrFail();

        if ($request->filled('include')) {
            if ($request->input('include') == 'all') {
                $property->load([
                    'propertyType',
                    'address',
                    'price',
                    'contact',
                    'photos',
                    'amenities',
                    'key_features',
                    'media',
                ]);
            } else {
                $property->load($this->parseIncludes($request->input('include')));
            }
        }

        return PropertyResource::make($property);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePropertyRequest $request, Property $property)
    {
        $data = array_merge($request->validated(), Arr::only($request->all(), ['address', 'price', 'media', 'networks']));

        $property->update(Arr::except($data, ['address', 'price', 'media', 'networks']));

        if (isset($data['address'])) {
            $property->address()->updateOrCreate(['property_id' => $property->id], $data['address']);
        }

        if (isset($data['price'])) {
            $property->price()->updateOrCreate(['property_id' => $property->id], $data['price']);
        }

        if (isset($data['media'])) {
            $property->media()->upsert($data['media'], ['property_id', 'type', 'url'], ['caption', 'sort_order', 'photo_update_date']);
        }

        if (isset($data['networks'])) {
            $property->networks()->upsert($data['networks'], ['property_id', 'external_feeds'], ['website_banner']);
        }

        return PropertyResource::make($property->load(['address', 'price', 'media', 'networks']));
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

    private function parseIncludes(string $include): array
    {
        return array_filter(array_map('trim', explode(',', $include)));
    }

    private function applyOrderBy(Builder $query, string $orderBy): void
    {
        [$column, $direction] = array_pad(explode(',', $orderBy), 2, 'asc');
        $direction = strtolower($direction) === 'desc' ? 'desc' : 'asc';

        if ($column === 'price') {
            $query->join('property_prices', 'properties.id', '=', 'property_prices.property_id')
                ->orderBy('property_prices.basic_price', $direction)
                ->select('properties.*');

            return;
        }

        if (in_array($column, ['published_at', 'updated_at', 'created_at'], true)) {
            $query->orderBy("properties.{$column}", $direction);

            return;
        }

        $query->orderBy($column, $direction);
    }
}
