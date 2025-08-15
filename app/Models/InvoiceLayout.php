<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceLayout extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get the location associated with the invoice layout.
     */
    public function locations()
    {
        return $this->hasMany(\App\Models\BusinessLocation::class);
    }

    /**
     * Return list of invoice layouts for a business
     *
     * @param int $business_id
     *
     * @return array
     */
    public static function forDropdown($business_id)
    {
        $layouts = InvoiceLayout::where('business_id', $business_id)
                    ->pluck('name', 'id');

        return $layouts;
    }
    /**
     * The attributes that should be cast to native types.
     *
     * @return array
     */
    protected function casts(): array
    {
        return [
            'product_custom_fields' => 'array',
            'contact_custom_fields' => 'array',
            'location_custom_fields' => 'array',
            'common_settings' => 'array',
            'qr_code_fields' => 'array',
            //'module_info' => 'array',
        ];
    }
}
