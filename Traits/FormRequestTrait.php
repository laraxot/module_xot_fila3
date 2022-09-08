<?php

declare(strict_types=1);

namespace Modules\Xot\Traits;

/**
 * Trait FormRequestTrait.
 */
<<<<<<< HEAD
trait FormRequestTrait {
=======
trait FormRequestTrait
{
>>>>>>> 9472ad4 (first)
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
<<<<<<< HEAD
    public function messages() {
        $pieces = explode('\\', __CLASS__);
        $pack = mb_strtolower($pieces[1]);
        // dddx($pieces);
=======
    public function messages()
    {
        $pieces = \explode('\\', __CLASS__);
        $pack = \mb_strtolower($pieces[1]);
        //dddx($pieces);
>>>>>>> 9472ad4 (first)
        $pieces = \array_slice($pieces, 3);
        $pieces = collect($pieces)->map(
            function ($item) {
                return snake_case($item);
            }
        )->all();
<<<<<<< HEAD
        $trad_name = $pack.'::'.implode('.', $pieces);
=======
        $trad_name = $pack.'::'.\implode('.', $pieces);
>>>>>>> 9472ad4 (first)
        $trad = trans($trad_name);
        if (! \is_array($trad)) {
            //    dddx($trad_name.' is not an array');
            $trad = [];
        }
<<<<<<< HEAD
        $tradGeneric = trans('theme::generic'); // deve funzionare anche senza il pacchetto "food", invece "extend" e' un pacchetto primario
        if (! \is_array($tradGeneric)) {
            $tradGeneric = [];
        }
        $trad = array_merge($tradGeneric, $trad);
=======
        $tradGeneric = trans('theme::generic'); //deve funzionare anche senza il pacchetto "food", invece "extend" e' un pacchetto primario
        if (! \is_array($tradGeneric)) {
            $tradGeneric = [];
        }
        $trad = \array_merge($tradGeneric, $trad);
>>>>>>> 9472ad4 (first)

        return $trad;
    }
}
