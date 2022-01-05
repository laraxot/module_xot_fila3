<?php

declare(strict_types=1);

namespace Modules\Xot\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Modules\Xot\Contracts\RowsContract;

//----------- Requests ----------

// per dizionario morph
//------------ services ----------

/**
 * Class ModelService.
 */
class RowsService {
    /**
     * Undocumented function.
     *
     * @param RowsContract $query
     *
     * @return RowsContract
     */
    public static function search($query, ?string $q, array $search_fields = []) {
        //backtrace(true);
        //dddx([$query, $q, $search_fields]);

        if (! isset($q)) {
            return $query;
        }

        $model = $query->getModel();
        /*
        $test = QueryBuilder::for($query)
            //->allowedFilters(Filter::FiltersExact('q', 'matr'))
            ->allowedFilters([AllowedFilter::exact('q', 'matr'), AllowedFilter::exact('q', 'ente')])
            // ->allowedIncludes('posts')
            //->allowedFilters('matr')
            ->get();
        */
        /*
            ->allowedFilters([
                Filter::search('q', ['first_name', 'last_name', 'address.city', 'address.country']),
            ]);
        */
        //dddx($test);

        $tipo = 0; //0 a mano , 1 repository, 2 = scout
        switch ($tipo) {
            case 0:
                //$search_fields = $this->search(); //campi di ricerca
                if (0 == count($search_fields)) { //se non gli passo nulla, cerco in tutti i fillable
                    $search_fields = $model->getFillable();
                }
                //$table = $model->getTable();
                if (strlen($q) > 1) {
                    $query = $query->where(function ($subquery) use ($search_fields, $q): void {
                        foreach ($search_fields as $k => $v) {
                            if (Str::contains($v, '.')) {
                                [$rel, $rel_field] = explode('.', $v);

                                //dddx([$rel, $rel_field]);
                                $subquery = $subquery->orWhereHas(
                                    $rel,
                                    function (Builder $subquery1) use ($rel_field, $q): void {
                                        //dddx($subquery1->getConnection()->getDatabaseName());

                                        $subquery1->where($rel_field, 'like', '%'.$q.'%');
                                        //dddx($subquery1);
                                    }
                                );

                            //dddx($subquery);
                            } else {
                                $subquery = $subquery->orWhere($v, 'like', '%'.$q.'%');
                            }
                        }
                    });
                }
                //dddx(['q' => $q, 'sql' => $query->toSql()]);

                return $query;
                // break;
            case 1:
                //$repo = with(new \Modules\Food\Repositories\RestaurantRepository())->search('grom');
                //dddx($repo->paginate());
                //return $repo;
                break;
            case 2:
                break;
        } //end switch

        return $query;
    }

    //end applySearch

    /**
     * Undocumented function.
     *
     * @param RowsContract $query
     *
     * @return RowsContract
     */
    public static function filter($query, array $filters, $filters_fields) {
        //https://github.com/spatie/laravel-query-builder

        //$filters_fields = $this->filters();
        if (null == $query) {
            return null;
        }

        $filters_rules = collect($filters_fields)
            ->filter(
                function ($item) {
                    return isset($item->rules);
                }
            )->map(
                function ($item) {
                    return [$item->param_name => $item->rules];
                }
            )->collapse()
            ->all();

        $validator = Validator::make($filters, $filters_rules);
        if ($validator->fails()) {
            \Session::flash('error', 'error');
            $id = $query->getModel()->getKeyName();

            return $query->whereNull($id); //restituisco query vuota
        }

        $filters_fields = collect($filters_fields)->filter(function ($item) use ($filters) {
            return in_array($item->param_name, array_keys($filters));
        })
            ->all();

        foreach ($filters_fields as $k => $v) {
            $filter_val = $filters[$v->param_name];
            if ('' != $filter_val) {
                if (! isset($v->op)) {
                    $v->op = '=';
                }
                if (isset($v->where_method)) {
                    if (! isset($v->field_name)) {
                        dddx(['err' => 'field_name is missing']);

                        return $query;
                    }
                    $query = $query->{$v->where_method}($v->field_name, $filter_val);
                } else {
                    $query = $query->where($v->field_name, $v->op, $filter_val);
                }
            }
        }

        return $query;
    }
}