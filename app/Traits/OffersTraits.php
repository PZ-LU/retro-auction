<?php

namespace App\Traits;

use App\Http\Controllers\OfferPartController;

/**
 * 
 */
trait OffersTraits
{
    // Offer Parts
    public function showOfferParts($offerId) {
        return OfferPartController::show($offerId);
    }

    public function storeOfferParts($arrayData, $offerId) {
        return OfferPartController::store($arrayData, $offerId);
    }
}
