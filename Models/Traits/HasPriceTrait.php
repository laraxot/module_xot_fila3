<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Traits;

<<<<<<< HEAD
// use Laravel\Scout\Searchable;

// ----- models------

// ---- services -----
// use Modules\Xot\Services\PanelService;

// ------ traits ---
=======
//use Laravel\Scout\Searchable;

//----- models------

//---- services -----
//use Modules\Xot\Services\PanelService;

//------ traits ---
>>>>>>> 9472ad4 (first)

/**
 * Modules\Food\Models\Traits\HasPriceTrait.
 *
 * @property string $currency
 * @property float  $price
 * @property string $price_complete
 * @property int    $qty
 */
<<<<<<< HEAD
trait HasPriceTrait {
=======
trait HasPriceTrait
{
>>>>>>> 9472ad4 (first)
    /**
     * @param mixed $value
     *
     * @return \Cknow\Money\Money
     */
<<<<<<< HEAD
    public function getPriceCurrencyAttribute($value) {
=======
    public function getPriceCurrencyAttribute($value)
    {
>>>>>>> 9472ad4 (first)
        return @money((int) $this->price * 100, $this->currency);
    }

    /**
     * @param mixed $value
     *
     * @return \Cknow\Money\Money
     */
<<<<<<< HEAD
    public function getPriceCompleteCurrencyAttribute($value) {
=======
    public function getPriceCompleteCurrencyAttribute($value)
    {
>>>>>>> 9472ad4 (first)
        return @money((int) $this->price_complete * 100, $this->currency);
    }

    /**
     * @param mixed $value
     *
     * @return \Cknow\Money\Money
     */
<<<<<<< HEAD
    public function getSubtotalCurrencyAttribute($value) {
=======
    public function getSubtotalCurrencyAttribute($value)
    {
>>>>>>> 9472ad4 (first)
        if ($this->qty > 0) {
            $value = $this->qty * $this->price;
        } else {
            $value = $this->price;
        }

        return @money((int) $value * 100, $this->currency);
    }

    /**
     * @param float $number
     *
     * @return \Cknow\Money\Money
     */
<<<<<<< HEAD
    public function getCurrency($number) {
=======
    public function getCurrency($number)
    {
>>>>>>> 9472ad4 (first)
        return @money((int) $number * 100, $this->currency);
    }
}
