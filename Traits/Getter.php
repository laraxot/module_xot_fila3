<?php

declare(strict_types=1);

namespace Modules\Xot\Traits;

/**
 * Trait Getter.
 */
<<<<<<< HEAD
trait Getter {
    /**
     * __merge function.
     */
    public static function __merge(string $index, array $value): array {
        $tmp = self::__getStatic($index);
        if (! \is_array($tmp)) {
            $tmp = [];
        }
        $tmp = array_merge($tmp, $value);
=======
trait Getter
{
    /**
     * __merge function.
     */
    public static function __merge(string $index, array $value): array
    {
        $tmp = self::__getStatic($index);
        if (! is_array($tmp)) {
            $tmp = [];
        }
        $tmp = \array_merge($tmp, $value);
>>>>>>> 9472ad4 (first)
        self::__setStatic($index, $tmp);

        return $tmp;
    }

    /**
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
<<<<<<< HEAD
    public static function __getStatic(string $index) {
=======
    public static function __getStatic(string $index)
    {
>>>>>>> 9472ad4 (first)
        if (isset(self::$vars[$index])) {
            return self::$vars[$index];
        }

        $params = [];
        $func = 'get_'.$index;
        $ris = self::$func($params);
<<<<<<< HEAD
        // dd(get_called_class());//XRA\Extend\Services\ThemeService
        // dd(class_basename(get_called_class()));//ThemeService
        $class = static::class;
        // *
        if ('' === $ris && isset($class::$config_name)) {
            $config_name = $class::$config_name;
            $ris = config($config_name.'.'.$index);
        }
        // */
=======
        //dd(get_called_class());//XRA\Extend\Services\ThemeService
        //dd(class_basename(get_called_class()));//ThemeService
        if ('' == $ris && isset(\get_called_class()::$config_name)) {
            $config_name = \get_called_class()::$config_name;
            $ris = config($config_name.'.'.$index);
        }
>>>>>>> 9472ad4 (first)
        self::__setStatic($index, $ris);

        return $ris;
    }

<<<<<<< HEAD
    // end __set
=======
    //end __set
>>>>>>> 9472ad4 (first)

    /**
     * @param mixed $value
     */
<<<<<<< HEAD
    public static function __setStatic(string $index, $value): void {
        // echo '<br/>SET ['.get_class($this).']['.$index.']['.round(memory_get_usage()/(1024*1024),2).' MB]';
        self::$vars[$index] = $value;
    }

    // end __set

    public static function __concatBeforeStatic(string $index, string $value): void {
=======
    public static function __setStatic(string $index, $value): void
    {
        //echo '<br/>SET ['.get_class($this).']['.$index.']['.round(memory_get_usage()/(1024*1024),2).' MB]';
        self::$vars[$index] = $value;
    }

    //end __set

    public static function __concatBeforeStatic(string $index, string $value): void
    {
>>>>>>> 9472ad4 (first)
        $tmp = self::__getStatic($index);
        $tmp = $value.$tmp;
        self::__setStatic($index, $tmp);
    }

<<<<<<< HEAD
    // * //se lo togli non funziona piu' le funzioni del themeservice
=======
    //* //se lo togli non funziona piu' le funzioni del themeservice
>>>>>>> 9472ad4 (first)

    /**
     * @param string $method
     * @param array  $args
     *
     * @return mixed|void
     */
<<<<<<< HEAD
    public static function __callStatic($method, $args) {
        if (preg_match('/^([gs]et)([A-Z])(.*)$/', $method, $match)) {
            $reflector = new \ReflectionClass(__CLASS__);
            $property = mb_strtolower($match[2]).$match[3];
=======
    public static function __callStatic($method, $args)
    {
        if (\preg_match('/^([gs]et)([A-Z])(.*)$/', $method, $match)) {
            $reflector = new \ReflectionClass(__CLASS__);
            $property = \mb_strtolower($match[2]).$match[3];
>>>>>>> 9472ad4 (first)
            if ($reflector->hasProperty($property)) {
                $property = $reflector->getProperty($property);
                switch ($match[1]) {
                case 'get':
                    return $property->getValue();
                case 'set':
                    $property->setValue($args[0]);

                    return;
                }
            } else {
                throw new \InvalidArgumentException("Property {$property} doesn't exist");
            }
        }
    }

<<<<<<< HEAD
    // */
=======
    //*/
>>>>>>> 9472ad4 (first)

    /**
     * @param string $index
     *
     * @return bool
     */
<<<<<<< HEAD
    public function __isset($index) {
=======
    public function __isset($index)
    {
>>>>>>> 9472ad4 (first)
        return isset($this->vars[$index]);
    }

    /**
     * @param mixed $value
     */
<<<<<<< HEAD
    public function __concat(string $index, $value): void {
        // default After
=======
    public function __concat(string $index, $value): void
    {
        //default After
>>>>>>> 9472ad4 (first)
        $tmp = $this->__get($index);
        $tmp = $tmp.$value;
        $this->__set($index, $tmp);
    }

    /**
     * @set undefined vars
     *
     * @param mixed $value
     */
<<<<<<< HEAD
    public function __set(string $index, $value): void {
        // echo '<br/>SET ['.get_class($this).']['.$index.']['.round(memory_get_usage()/(1024*1024),2).' MB]';
=======
    public function __set(string $index, $value): void
    {
        //echo '<br/>SET ['.get_class($this).']['.$index.']['.round(memory_get_usage()/(1024*1024),2).' MB]';
>>>>>>> 9472ad4 (first)
        $this->vars[$index] = $value;
    }

    /**
     * @param string $index
     *
     * @return mixed|null
     */
<<<<<<< HEAD
    public function __get($index) {
=======
    public function __get($index)
    {
>>>>>>> 9472ad4 (first)
        if (isset($this->vars[$index])) {
            return $this->vars[$index];
        }

        return null;
    }

    /**
     * @param string $index
     * @param mixed  $value
     */
<<<<<<< HEAD
    public function __concatBefore($index, $value): void {
=======
    public function __concatBefore($index, $value): void
    {
>>>>>>> 9472ad4 (first)
        $tmp = $this->__get($index);
        $tmp = $value.$tmp;
        $this->__set($index, $tmp);
    }

    /**
     * @return mixed|null
     */
<<<<<<< HEAD
    public function __getVars(array $params = []) {
=======
    public function __getVars(array $params = [])
    {
>>>>>>> 9472ad4 (first)
        $vars = $this->vars;
        $vars['smarty'] = '';
        unset($vars['smarty']);

        return $vars;
    }
}
