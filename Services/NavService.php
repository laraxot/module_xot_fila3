<<<<<<< HEAD
<?php

namespace Modules\Xot\Services;

use Carbon\Carbon;
use Exception;

/**
 * Class NavService.
 */
class NavService {
    /**
     * @return array
     */
    public static function yearNav() {
        $request = \Request::capture();
        $routename = \Route::currentRouteName();
        //$request->route('parameter_name')
        //$request->route()->paremeters()
        // 20     Cannot call method parameters() on mixed
        //$paz = request()->route()->parameters();
        $route_current = \Route::current();
        $params = [];
        if (null != $route_current) {
            $params = $route_current->parameters();
        }
        $year = $request->input('year', date('Y'));
        $year = $year - 1;
        $nav = [];
        for ($i = 0; $i < 3; ++$i) {
            $tmp = [];
            $params['year'] = $year;
            $tmp['title'] = $year;
            if (date('Y') == $params['year']) {
                $tmp['title'] = '['.$tmp['title'].']';
            }
            if ($year == $params['year']) {
                $tmp['active'] = 1;
            } else {
                $tmp['active'] = 0;
            }

            if (null == $routename) {
                throw new Exception('routename is null');
            }
            $tmp['url'] = route($routename, $params);
            $nav[] = (object) $tmp;
            ++$year;
        }

        return $nav;
    }

    /**
     * @return array
     */
    public static function monthYearNav() { //possiamo trasformarlo in una macro
        $request = \Request::capture();
        $routename = \Route::currentRouteName();

        $route_current = \Route::current();
        $params = [];
        if (null != $route_current) {
            $params = $route_current->parameters();
        }

        $year = $request->input('year', date('Y'));
        $month = $request->input('month', date('m'));
        $q = 2;
        $date = Carbon::create($year, $month, 1);
        if (false === $date) {
            throw new Exception('carbon error');
        }
        $d = $date->subMonths($q);
        $nav = [];
        for ($i = 0; $i < ($q * 2) + 1; ++$i) {
            $tmp = [];
            $params['month'] = (int) $d->format('m');
            $params['year'] = (int) $d->format('Y');
            $tmp['title'] = $d->isoFormat('MMMM YYYY');
            if (date('Y') == $params['year'] && date('m') == $params['month']) {
                $tmp['title'] = '['.$tmp['title'].']';
            }
            if ($year == $params['year'] && $month == $params['month']) {
                $tmp['active'] = 1;
            } else {
                $tmp['active'] = 0;
            }
            if (null == $routename) {
                throw new Exception('routename is null');
            }
            $tmp['url'] = route($routename, $params);
            $nav[] = (object) $tmp;
            $d->addMonth();
        }

        return $nav;
        //$d->locale() //it !!
        /*
        return '';
        */
    }

    /* deprecated
    public static function yearNavRedirect() {
        $request = \Request::capture();
        $routename = \Route::currentRouteName();
        $params = \Route::current()->parameters();
        $year = $request->input('year', date('Y'));
        $redirect = 1;
        if ('' == $request->year) {
            if ($redirect) {
                $t = $this->addQuerystringsUrl(['request' => $request, 'qs' => ['year' => date('Y')]]);
                $this->force_exit = true;
                $this->out = redirect($t);
                die($this->out); //forzatura

                return;
            }
            $request->year = date('Y');
        }

        $year = $request->year - 1;
        $nav = [];
        for ($i = 0; $i < 3; ++$i) {
            $tmp = [];
            $params['year'] = $year;
            $tmp['title'] = $year;
            if (date('Y') == $params['year']) {
                $tmp['title'] = '['.$tmp['title'].']';
            }
            if ($request->year == $params['year']) {
                $tmp['active'] = 1;
            } else {
                $tmp['active'] = 0;
            }
            $tmp['url'] = route($routename, $params);
            $nav[] = (object) $tmp;
            ++$year;
        }

        return $nav;
    }
    */
=======
<?php

namespace Modules\Xot\Services;

use Carbon\Carbon;
use Exception;

/**
 * Class NavService.
 */
class NavService {
    /**
     * @return array
     */
    public static function yearNav() {
        $request = \Request::capture();
        $routename = \Route::currentRouteName();
        //$request->route('parameter_name')
        //$request->route()->paremeters()
        // 20     Cannot call method parameters() on mixed
        //$paz = request()->route()->parameters();
        $route_current = \Route::current();
        $params = [];
        if (null != $route_current) {
            $params = $route_current->parameters();
        }
        $year = $request->input('year', date('Y'));
        $year = $year - 1;
        $nav = [];
        for ($i = 0; $i < 3; ++$i) {
            $tmp = [];
            $params['year'] = $year;
            $tmp['title'] = $year;
            if (date('Y') == $params['year']) {
                $tmp['title'] = '['.$tmp['title'].']';
            }
            if ($year == $params['year']) {
                $tmp['active'] = 1;
            } else {
                $tmp['active'] = 0;
            }

            if (null == $routename) {
                throw new Exception('routename is null');
            }
            $tmp['url'] = route($routename, $params);
            $nav[] = (object) $tmp;
            ++$year;
        }

        return $nav;
    }

    /**
     * @return array
     */
    public static function monthYearNav() { //possiamo trasformarlo in una macro
        $request = \Request::capture();
        $routename = \Route::currentRouteName();

        $route_current = \Route::current();
        $params = [];
        if (null != $route_current) {
            $params = $route_current->parameters();
        }

        $year = $request->input('year', date('Y'));
        $month = $request->input('month', date('m'));
        $q = 2;
        $date = Carbon::create($year, $month, 1);
        if (false === $date) {
            throw new Exception('carbon error');
        }
        $d = $date->subMonths($q);
        $nav = [];
        for ($i = 0; $i < ($q * 2) + 1; ++$i) {
            $tmp = [];
            $params['month'] = (int) $d->format('m');
            $params['year'] = (int) $d->format('Y');
            $tmp['title'] = $d->isoFormat('MMMM YYYY');
            if (date('Y') == $params['year'] && date('m') == $params['month']) {
                $tmp['title'] = '['.$tmp['title'].']';
            }
            if ($year == $params['year'] && $month == $params['month']) {
                $tmp['active'] = 1;
            } else {
                $tmp['active'] = 0;
            }
            if (null == $routename) {
                throw new Exception('routename is null');
            }
            $tmp['url'] = route($routename, $params);
            $nav[] = (object) $tmp;
            $d->addMonth();
        }

        return $nav;
        //$d->locale() //it !!
        /*
        return '';
        */
    }

    /* deprecated
    public static function yearNavRedirect() {
        $request = \Request::capture();
        $routename = \Route::currentRouteName();
        $params = \Route::current()->parameters();
        $year = $request->input('year', date('Y'));
        $redirect = 1;
        if ('' == $request->year) {
            if ($redirect) {
                $t = $this->addQuerystringsUrl(['request' => $request, 'qs' => ['year' => date('Y')]]);
                $this->force_exit = true;
                $this->out = redirect($t);
                die($this->out); //forzatura

                return;
            }
            $request->year = date('Y');
        }

        $year = $request->year - 1;
        $nav = [];
        for ($i = 0; $i < 3; ++$i) {
            $tmp = [];
            $params['year'] = $year;
            $tmp['title'] = $year;
            if (date('Y') == $params['year']) {
                $tmp['title'] = '['.$tmp['title'].']';
            }
            if ($request->year == $params['year']) {
                $tmp['active'] = 1;
            } else {
                $tmp['active'] = 0;
            }
            $tmp['url'] = route($routename, $params);
            $nav[] = (object) $tmp;
            ++$year;
        }

        return $nav;
    }
    */
>>>>>>> 3c97c308c85924a62f31c89c71edfe23450749f0
}