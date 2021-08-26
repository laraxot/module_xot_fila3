<?php

declare(strict_types=1);

namespace Modules\Xot\Jobs\PanelCrud;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Modules\Xot\Contracts\ModelContract;
use Modules\Xot\Contracts\PanelContract;
use Modules\Xot\Services\ModelService;

//----------- Requests ----------
//------------ services ----------

/**
 * Class XotBaseJob.
 */
abstract class XotBaseJob implements ShouldQueue {
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
    //use Traits\CommonTrait;

    protected PanelContract $panel;

    protected array $data;

    /**
     * __construct.
     */
    public function __construct(array $data, PanelContract &$panel) {
        $this->panel = $panel;
        $this->data = $data;
        //$this->data = $this->prepareAndValidate($request->all(), $panel);
    }

    /**
     * Execute the job.
     */
    public function handle(): PanelContract {
        return $this->panel;
    }

    /**
     * manage the relationships.
     *
     * @param ModelContract|Model $model
     */
    public function manageRelationships($model, array $data, string $act): void {
        $relationships = ModelService::getRelationshipsAndData($model, $data);
        foreach ($relationships as $k => $v) {
            $func = $act.'Relationships'.$v->relationship_type;
            if (method_exists($this, $func)) {
                static::$func($model, $v->name, $v->data);
            } else {
                //dddx(['error'=>$func.' is missing']);
            }
        }
        if (isset($data['pivot'])) {
            $func = $act.'Relationships'.'Pivot';
            self::$func($model, 'pivot', $data['pivot']);
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
        //dddx(['data0' => $data0, 'data' => $data]);
        $act = '';
        $rules = $panel->rules(['act' => $act]);
        //dddx(['data' => $data, 'rules' => $rules, 'panel_class' => get_class($panel)]);

        $validator = Validator::make($data, $rules);

        return $validator->validate(); //fa tutto da solo
    }

    public function ConvDateList($field, $value) {
        return $value;
    }

    /**
     * @param $field
     * @param mixed $value
     *
     * @return Carbon|false|null
     */
    public function ConvDate($field, $value) {
        if (null == $value) {
            return $value;
        }
        $value_new = Carbon::createFromFormat('d/m/Y', $value);

        return $value_new;
    }

    /**
     * @param $field
     * @param mixed $value
     *
     * @return Carbon|false|null
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
     * @param $field
     * @param mixed $value
     *
     * @return Carbon|false|null
     */
    public function ConvDateTime2Fields($field, $value) {
        if (null == $value) {
            return $value;
        }
        $value_new = Carbon::createFromFormat('d/m/Y H:i', $value);

        return $value_new;
    }
}
