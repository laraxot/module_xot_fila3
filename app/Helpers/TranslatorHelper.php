<?php

declare(strict_types=1);

namespace Modules\Xot\Helpers;

use Illuminate\Translation\Translator;

/**
<<<<<<< HEAD
<<<<<<< HEAD
 * Helper per la gestione sicura degli oggetti Translator.
=======
 * Helper per la gestione sicura degli oggetti Translator
>>>>>>> origin/dev
=======
 * Helper per la gestione sicura degli oggetti Translator.
>>>>>>> laraxot/master
 */
class TranslatorHelper
{
    /**
     * Converte in modo sicuro un oggetto Translator o qualsiasi altro valore in una stringa.
     *
<<<<<<< HEAD
<<<<<<< HEAD
     * @param mixed  $value   Il valore da convertire in stringa
     * @param string $default Valore predefinito se non è possibile convertire
     *
=======
     * @param mixed $value Il valore da convertire in stringa
     * @param string $default Valore predefinito se non è possibile convertire
     * 
>>>>>>> origin/dev
=======
     * @param mixed  $value   Il valore da convertire in stringa
     * @param string $default Valore predefinito se non è possibile convertire
     *
>>>>>>> laraxot/master
     * @return string La stringa risultante
     */
    public static function toString($value, string $default = ''): string
    {
        // Se è già una stringa, restituiscila direttamente
        if (is_string($value)) {
            return $value;
        }
<<<<<<< HEAD
<<<<<<< HEAD

=======
        
>>>>>>> origin/dev
=======

>>>>>>> laraxot/master
        // Se è null, restituisci stringa vuota o default
        if (is_null($value)) {
            return $default;
        }
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> laraxot/master

        // Se è numerico, convertilo a stringa
        if (is_numeric($value)) {
            return (string) $value;
        }

<<<<<<< HEAD
=======
        
        // Se è numerico, convertilo a stringa
        if (is_numeric($value)) {
            return (string)$value;
        }
        
>>>>>>> origin/dev
=======
>>>>>>> laraxot/master
        // Se è un oggetto Translator, gestiscilo in modo specifico
        if ($value instanceof Translator) {
            // Assumiamo che sia chiamato via __toString in un contesto
            // di stampa, quindi cerchiamo di ottenere il valore tradotto
            try {
<<<<<<< HEAD
<<<<<<< HEAD
                return (string) $value;
=======
                return (string)$value;
>>>>>>> origin/dev
=======
                return (string) $value;
>>>>>>> laraxot/master
            } catch (\Throwable $e) {
                return 'Translator Object';
            }
        }
<<<<<<< HEAD
<<<<<<< HEAD

=======
        
>>>>>>> origin/dev
=======

>>>>>>> laraxot/master
        // Se è un oggetto con metodo __toString, usalo
        if (is_object($value) && method_exists($value, '__toString')) {
            try {
                return $value->__toString();
            } catch (\Throwable $e) {
                return get_class($value);
            }
        }
<<<<<<< HEAD
<<<<<<< HEAD

=======
        
>>>>>>> origin/dev
=======

>>>>>>> laraxot/master
        // Per oggetti senza metodo __toString, restituisci la classe
        if (is_object($value)) {
            return get_class($value);
        }
<<<<<<< HEAD
<<<<<<< HEAD

=======
        
>>>>>>> origin/dev
=======

>>>>>>> laraxot/master
        // Per array, converti in JSON
        if (is_array($value)) {
            try {
                return json_encode($value) ?: $default;
            } catch (\Throwable $e) {
                return 'Array';
            }
        }
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> laraxot/master

        // Per tutti gli altri tipi, tenta un cast a stringa
        try {
            return (string) $value;
<<<<<<< HEAD
=======
        
        // Per tutti gli altri tipi, tenta un cast a stringa
        try {
            return (string)$value;
>>>>>>> origin/dev
=======
>>>>>>> laraxot/master
        } catch (\Throwable $e) {
            return $default;
        }
    }
<<<<<<< HEAD
<<<<<<< HEAD
}
=======
} 
>>>>>>> origin/dev
=======
}
>>>>>>> laraxot/master
