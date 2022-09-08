<?php

declare(strict_types=1);

namespace Modules\Xot\Jobs\PanelCrud;

<<<<<<< HEAD
use Carbon\Carbon;
use Exception;
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
use stdClass;

// ----------- Requests ----------
// ------------ services ----------
=======
use stdClass;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Modules\Xot\Services\ModelService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\InteractsWithQueue;
use Modules\Xot\Contracts\PanelContract;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

//----------- Requests ----------
//------------ services ----------
>>>>>>> 9472ad4 (first)

/**
 * Class XotBaseJob.
 * NON DEVE ESSERE ShouldQueue, se no non lo esegue subito con dispatchSync, dispatchNow sara' deprecato.
 */
<<<<<<< HEAD
abstract class XotBaseJob /* implements ShouldQueue */
{
    // use Traits\CommonTrait;
=======
abstract class XotBaseJob /*implements ShouldQueue*/
{
    //use Traits\CommonTrait;
>>>>>>> 9472ad4 (first)
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected PanelContract $panel;

    protected array $data;

    /**
     * __construct.
     */
    public function __construct(array $data, PanelContract $panel) {
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
<<<<<<< HEAD
        $relationships = ModelService::make()->setModel($model)->getRelationshipsAndData($data);
=======
        $relationships = ModelService::make()->setModel($model)->getRelationshipsAndData( $data);
>>>>>>> 9472ad4 (first)
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

<<<<<<< HEAD
    public function prepareForValidation(array $data, PanelContract $panel): array {
=======
    /**
     * @param array         $data
     * @param PanelContract $panel
     *
     * @return mixed
     */
    public function prepareForValidation($data, $panel) {
>>>>>>> 9472ad4 (first)
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
<<<<<<< HEAD
            if (! \is_object($value)) {
                $func = 'Conv'.$field->type;
                $value_new = $this->$func($field, $value);
                // $this->request->add([$field->name => $value_new]);
=======
            if (! is_object($value)) {
                $func = 'Conv'.$field->type;
                $value_new = $this->$func($field, $value);
                //$this->request->add([$field->name => $value_new]);
>>>>>>> 9472ad4 (first)
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
<<<<<<< HEAD
        /**
         * @var array
         */
        $data = $this->prepareForValidation($data, $panel);
        /**
         * @var \Illuminate\Contracts\Support\Arrayable
         */
        $data_keys = array_keys($data);
        $act = '';
        $rules = $panel->rules(['act' => $act]);
        $fillable = $panel->row->getFillable();
        $fillable_from_data = collect($fillable)
            ->intersect($data_keys);
        foreach ($fillable_from_data as $fill) {
            if (! \in_array($fill, array_keys($rules), true)) {
=======
        $data = $this->prepareForValidation($data, $panel);
        $act = '';
        $rules = $panel->rules(['act' => $act]);
        $fillable = $panel->row->getFillable();
        $fillable_from_data = collect($fillable)->intersect(array_keys($data));
        foreach ($fillable_from_data as $fill) {
            if (! in_array($fill, array_keys($rules))) {
>>>>>>> 9472ad4 (first)
                $rules[$fill] = '';
            }
        }

<<<<<<< HEAD
        // dddx(['data' => $data, 'rules' => $rules, 'panel_class' => get_class($panel), 'act' => $act]);

        $validator = Validator::make($data, $rules);

        return $validator->validate(); // fa tutto da solo
=======
        //dddx(['data' => $data, 'rules' => $rules, 'panel_class' => get_class($panel), 'act' => $act]);

        $validator = Validator::make($data, $rules);

        return $validator->validate(); //fa tutto da solo
>>>>>>> 9472ad4 (first)
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
     */
    public function ConvDate(string $field, string $value): ?Carbon {
<<<<<<< HEAD
        // Strict comparison using === between null and string will always evaluate to false.
        // if (null === $value) {
        //    return null;
        // }
=======
        if (null == $value) {
            return null;
        }
>>>>>>> 9472ad4 (first)
        $value_new = Carbon::createFromFormat('d/m/Y', $value);
        if (false === $value_new) {
            throw new Exception('['.__LINE__.']['.class_basename(__CLASS__).']');
        }

        return $value_new;
    }

    /**
     * Method Modules\Xot\Jobs\PanelCrud\XotBaseJob::ConvDateTime() should return Carbon\Carbon|false|null but returns 0|0.0|''|'0'|array()|false|null.
     */
    public function ConvDateTime(stdClass $field, string $value): ?Carbon {
<<<<<<< HEAD
        // Strict comparison using === between null and string will always evaluate to false.
        // if (null === $value) {
        //    return null;
        // }

        $value_new = Carbon::createFromFormat('d/m/Y H:i', $value);
        if (false == $value_new) {
            // throw new Exception('['.__LINE__.']['.class_basename(__CLASS__).']');
            return null;
=======

        if (null == $value) {
            return null;
        }

        $value_new = Carbon::createFromFormat('d/m/Y H:i', $value);
        if (false === $value_new) {
            throw new Exception('['.__LINE__.']['.class_basename(__CLASS__).']');
>>>>>>> 9472ad4 (first)
        }

        return $value_new;
    }

    /**
     *  Method Modules\Xot\Jobs\PanelCrud\XotBaseJob::ConvDateTime2Fields() should return Carbon\Carbon|false|null but returns 0|0.0|''|'0'|array()|false|null.
<<<<<<< HEAD
     */
    public function ConvDateTime2Fields(stdClass $field, string $value): ?Carbon {
        // Strict comparison using === between null and string will always evaluate to false.
        // if (null === $value) {
        //    return $value;
        // }
        $value_new = Carbon::createFromFormat('d/m/Y H:i', $value);
        if (false == $value_new) {
            return null;
        }

        return $value_new;
    }
}
=======
     *

     */
    public function ConvDateTime2Fields(stdClass $field, string $value):?Carbon {
        if (null == $value) {
            return $value;
        }
        $value_new = Carbon::createFromFormat('d/m/Y H:i', $value);

        return $value_new;
    }
}
>>>>>>> 9472ad4 (first)
