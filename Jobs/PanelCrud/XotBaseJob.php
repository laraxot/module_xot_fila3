<?php

declare(strict_types=1);

namespace Modules\Xot\Jobs\PanelCrud;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Modules\Xot\Contracts\PanelContract;
use Modules\Xot\Services\ModelService;

//----------- Requests ----------
//------------ services ----------

/**
 * Class XotBaseJob.
 */
abstract class XotBaseJob implements ShouldQueue {
    //use Traits\CommonTrait;
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected PanelContract $panel;

    protected array $data;

    /**
     * __construct.
     */
    public function __construct(array $data, PanelContract &$panel) {
        $this->panel = $panel;
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): PanelContract {
        return $this->panel;
    }

    /**
     * manage the relationships.
     */
    public function manageRelationships(Model $model, array $data, string $act): void {
        $relationships = ModelService::getRelationshipsAndData($model, $data);
        /*
        dddx([
            '$model' => $model,
            '$data' => $data,
            '$relationships' => $relationships,
        ]);
        */
        foreach ($relationships as $k => $v) {
            $func = $act.'Relationships'.$v->relationship_type;
            if (method_exists($this, $func)) {
                static::$func($model, $v->name, $v->data);
            } else {
                dddx(
                    [
                        'error' => $func.' is missing',
                        'act' => $act,
                        'relationship_type' => $v->relationship_type,
                        'model' => $model,
                        'data' => $v->data,
                    ]
                );
            }
        }
        if (isset($data['pivot'])) {
            $func = $act.'Relationships'.'Pivot';
            static::$func($model, 'pivot', $data['pivot']);
        }
    }

    /**
     * @param array         $data
     * @param PanelContract $panel
     *
     * @return mixed
     */
    public function prepareForValidation($data, $panel) {
        $date_fields = collect($panel->fields())->filter(
            function ($item) use ($data) {
                return Str::startsWith($item->type, 'Date') && isset($data[$item->name]);
            }
        )->all();
        foreach ($date_fields as $field) {
            $value = $data[$field->name]; // metterlo nel filtro sopra ?
            /*
            *  Se e' un oggetto e' già convertito
            **/
            if (! is_object($value)) {
                $func = 'Conv'.$field->type;
                $value_new = $this->$func($field, $value);
                //$this->request->add([$field->name => $value_new]);
                $data[$field->name] = $value_new;
            }
        }

        return $data;
    }

    /**
     * @param array         $data
     * @param PanelContract $panel
     *
     * @throws \Illuminate\Validation\ValidationException
     *
     * @return array
     */
    public function prepareAndValidate($data, $panel) {
        $data0 = $data;
        $data = $this->prepareForValidation($data, $panel);
        $act = '';
        $rules = $panel->rules(['act' => $act]);
        $fillable = $panel->row->getFillable();
        $fillable_from_data = collect($fillable)->intersect(array_keys($data));
        foreach ($fillable_from_data as $fill) {
            if (! in_array($fill, array_keys($rules))) {
                $rules[$fill] = '';
            }
        }

        //dddx(['data' => $data, 'rules' => $rules, 'panel_class' => get_class($panel), 'act' => $act]);

        $validator = Validator::make($data, $rules);

        return $validator->validate(); //fa tutto da solo
    }

    /**
     * Undocumented function.
     *
     * @param mixed $field
     * @param mixed $value
     *
     * @return mixed
     */
    public function ConvDateList($field, $value) {
        return $value;
    }

    /**
     *  Method Modules\Xot\Jobs\PanelCrud\XotBaseJob::ConvDate() should return Carbon\Carbon|false|null but returns 0|0.0|''|'0'|array()|false|null.
     *
     * @param mixed $field
     * @param mixed $value
     *
     * @return mixed
     */
    public function ConvDate($field, $value) {
        if (null == $value) {
            return $value;
        }
        $value_new = Carbon::createFromFormat('d/m/Y', $value);

        return $value_new;
    }

    /**
     * Method Modules\Xot\Jobs\PanelCrud\XotBaseJob::ConvDateTime() should return Carbon\Carbon|false|null but returns 0|0.0|''|'0'|array()|false|null.
     *
     * @param mixed $field
     * @param mixed $value
     *
     * @return mixed
     */
    public function ConvDateTime($field, $value) {
        if (null == $value) {
            return $value;
        }
        try {
            $value_new = Carbon::createFromFormat('d/m/Y H:i', $value);
        } catch (\Exception $e) {
            return $value;
        }

        return $value_new;
    }

    /**
     *  Method Modules\Xot\Jobs\PanelCrud\XotBaseJob::ConvDateTime2Fields() should return Carbon\Carbon|false|null but returns 0|0.0|''|'0'|array()|false|null.
     *
     * @param mixed $field
     * @param mixed $value
     *
     * @return mixed
     */
    public function ConvDateTime2Fields($field, $value) {
        if (null == $value) {
            return $value;
        }
        $value_new = Carbon::createFromFormat('d/m/Y H:i', $value);

        return $value_new;
    }
}