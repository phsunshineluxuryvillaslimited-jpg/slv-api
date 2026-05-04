<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePropertyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route('property.id');

        return [
            'title' => 'required|string|max:255|unique:properties,title,' . $id . ',id',
            // 'agent_ref' => 'required|string|max:80',
            // 'author_id' => 'required|exists:users,id',
            // 'property_type_id' => 'required|exists:property_types,id',
            // 'status' => 'required|string',
            // 'new_home' => 'integer|min:0',
            // 'student_property' => 'integer|min:0',
            // 'house_flat_share' => 'integer|min:0',
            // 'date_available' => 'nullable|date_format:Y-m-d',
            // 'contract_months' => 'integer|min:0',
            // 'minimum_term' => 'integer|min:0',
            // 'let_type' => 'nullable|string|max:255',

            // //address
            // 'address.house_name_number' => 'required_with:address|string|max:255',
            // 'address.address_2' => 'nullable|string|max:255',
            // 'address.address_3' => 'nullable|string|max:255',
            // 'address.address_4' => 'nullable|string|max:255',
            // 'address.town'=> 'required_with:address|string|max:255',
            // 'address.postcode_1' => 'required_with:address|string|max:255',
            // 'address.postcode_2' => 'nullable|string|max:255',
            // 'address.display_address' => 'nullable|string|max:255',
            // 'address.country_code' => 'required_with:address|string|max:3',
            // 'address.region' => 'nullable|string|max:255',
            // 'address.sub_region' => 'nullable|string|max:255',
            // 'address.town_city' => 'nullable|string|max:255',
            // 'address.latitude' => 'nullable|numeric',
            // 'address.longitude' => 'nullable|numeric',
            // 'address.pov_latitude' => 'nullable|numeric',
            // 'address.pov_longitude' => 'nullable|numeric',
            // 'address.pov_heading' => 'nullable|numeric',
            // 'address.pov_pitch' => 'nullable|numeric',
            // 'address.pov_zoom' => 'nullable|numeric',

            // //price
            // 'price.price' => 'required_with:price|numeric',
            // 'price.price_qualifier' => 'nullable|string|max:255',
            // 'price.os_price_qualifier' => 'nullable|string|max:255',
            // 'price.deposit' => 'nullable|numeric',
            // 'price.administration_fee' => 'nullable|numeric',
            // 'price.rent_frequency' => 'nullable|string|max:255',
            // 'price.tenure_Type' => 'nullable|string|max:255',
            // 'price.auction' => 'nullable|boolean',
            // 'price.tenure_Unexpired_Years' => 'nullable|numeric',
            // 'price.price_per_unit_area' => 'nullable|numeric',
            // 'price.price_per_unit_per_annum' => 'nullable|numeric',

            // //details
            // 'details.summary' => 'nullable|string',
            // 'details.description' => 'nullable|string',
            // 'details.features' => 'nullable|array',
            // 'details.bedrooms' => 'nullable|integer|min:0',
            // 'details.bathrooms' => 'nullable|integer|min:0',
            // 'details.reception_rooms' => 'nullable|integer|min:0',
            // 'details.parking' => 'nullable|string|max:255',
            // 'details.outside_space' => 'nullable|string|max:255',
            // 'details.year_built' => 'nullable|integer|min:0',
            // 'details.internal_area' => 'nullable|numeric',
            // 'details.internal_area_unit' => 'nullable|string|max:255',
            // 'details.land_area' => 'nullable|numeric',
            // 'details.land_area_unit' => 'nullable|string|max:255',
            // 'details.floors' => 'nullable|integer|min:0',
            // 'details.entrance_floor' => 'nullable|integer|min:0',
            // 'details.condition' => 'nullable|string|max:255',
            // 'details.accessibility' => 'nullable|string|max:255',
            // 'details.heating' => 'nullable|string|max:255',
            // 'details.golf_course_on_site_or_within_10_minutes_walk' => 'nullable|boolean',
            // 'details.golf_course_within_a_20_minute_drive' => 'nullable|boolean',
            // 'details.private_pool' => 'nullable|boolean',
            // 'details.communal_pool' => 'nullable|boolean',
            // 'details.at_beach_or_within_10_minute_walk' => 'nullable|boolean',
            // 'details.beach_within_a_20_minute_drive' => 'nullable|boolean',
            // 'details.private_beach' => 'nullable|boolean',
            // 'details.sea_view' => 'nullable|boolean',
            // 'details.at_ski_field_or_within_10_minutes_walk' => 'nullable|boolean',
            // 'details.ski_field_within_a_45_minute_drive' => 'nullable|boolean',
            // 'details.air_conditioning' => 'nullable|boolean',
            // 'details.security_system' => 'nullable|boolean',
            // 'details.gated_entry' => 'nullable|boolean',
            // 'details.balcony' => 'nullable|boolean',
            // 'details.ground_floor_terrace' => 'nullable|boolean',
            // 'details.roof_terrace' => 'nullable|boolean',
            // 'details.hot_tub' => 'nullable|boolean',
            // 'details.business_for_sale' => 'nullable|boolean',
            // 'details.comm_use_class' => 'nullable|string|max:255',

            // //media
            // 'media.*.type' => 'required_with:media|string|max:255',
            // 'media.*.url' => 'required_with:media|url|max:255',
            // 'media.*.caption' => 'nullable|string|max:255',
            // 'media.*.sort_order' => 'nullable|integer|min:0',
            // 'media.*.media_update_date' => 'nullable|date_format:Y-m-d H:i:s',


            // //networks
            // 'networks.*.network' => 'required_with:networks|string|max:255',
            // 'networks.*.published' => 'required_with:networks|boolean'
        ];
    }
}
