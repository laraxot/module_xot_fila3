<?php

declare(strict_types=1);

namespace Modules\Xot\Jobs\PanelCrud;

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

// ----------- Requests ----------
// ------------ services ----------

/**
 * Class XotBaseJob.
 * NON DEVE ESSERE ShouldQueue, se no non lo esegue subito con dispatchSync, dispatchNow sara' deprecato.
 */
abstract class XotBaseJob { /* implements ShouldQueue */
    // use Traits\CommonTrait;
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
        $relationships = ModelService::make()->setModel($model)->getRelationshipsAndData($data);
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
            $func = $act.'RelationshipsPivot';
            static::$func($model, 'pivot', $data['pivot']);
        }
    }

    public function prepareForValidation(array $data, PanelContract $panel): array {
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
            if (! \is_object($value)) {
                $func = 'Conv'.$field->type;
                /*
                dddx($field);
                 +"type": "Date"
                +"name": "dalf"
                +"comment": "dal retribuzione"
                */
                $value_new = $this->$func($field, $value);
                // $this->request->add([$field->name => $value_new]);
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
                $rules[$fill] = '';
            }
        }

        // dddx(['data' => $data, 'rules' => $rules, 'panel_class' => get_class($panel), 'act' => $act]);

        $validator = Validator::make($data, $rules);

        return $validator->validate(); // fa tutto da solo
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
     * @param object $field
     */
    public function ConvDate($field, string $value): ?Carbon {
        // Strict comparison using === between null and string will always evaluate to false.
        // if (null === $value) {
        //    return null;
        // }
        $value_new = Carbon::createFromFormat('d/m/Y', $value);
        if (false === $value_new) {
            throw new \Exception('['.__LINE__.']['.class_basename(__CLASS__).']');
        }

        return $value_new;
    }

    /**
     * Method Modules\Xot\Jobs\PanelCrud\XotBaseJob::ConvDateTime() should return Carbon\Carbon|false|null but returns 0|0.0|''|'0'|array()|false|null.
     */
    public function ConvDateTime(\stdClass $field, string $value): ?Carbon {
        // Strict comparison using === between null and string will always evaluate to false.
        // if (null === $value) {
        //    return null;
        // }

        $value_new = Carbon::createFromFormat('d/m/Y H:i', $value);
        if (false === $value_new) {
            // throw new Exception('['.__LINE__.']['.class_basename(__CLASS__).']');
            return null;
        }

        return $value_new;
    }

    /**
     *  Method Modules\Xot\Jobs\PanelCrud\XotBaseJob::ConvDateTime2Fields() should return Carbon\Carbon|false|null but returns 0|0.0|''|'0'|array()|false|null.
     */
    public function ConvDateTime2Fields(\stdClass $field, string $value): ?Carbon {
        // Strict comparison using === between null and string will always evaluate to false.
        // if (null === $value) {
        //    return $value;
        // }
        $value_new = Carbon::createFromFormat('d/m/Y H:i', $value);
        if (false === $value_new) {
            return null;
        }

        return $value_new;
    }
}
