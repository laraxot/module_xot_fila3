<?php

declare(strict_types=1);

namespace Modules\Xot\Http\Requests;

<<<<<<< HEAD
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Modules\Xot\Contracts\PanelContract;
use Illuminate\Foundation\Http\FormRequest;

// use Modules\Food\Models\Profile;
// --- Rules ---
=======
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Modules\Xot\Contracts\PanelContract;

//use Modules\Food\Models\Profile;
//--- Rules ---
>>>>>>> 9472ad4 (first)

/**
 * Class XotBaseRequest.
 */
<<<<<<< HEAD
abstract class XotBaseRequest extends FormRequest {
    // use FormRequestTrait;

    // public function __construct(){
    // $this->setContainer(factory(Profile::class));
    // $this->setContainer(app());
    // }
=======
abstract class XotBaseRequest extends FormRequest
{
    //use FormRequestTrait;

    //public function __construct(){
    //$this->setContainer(factory(Profile::class));
    //$this->setContainer(app());
    //}
>>>>>>> 9472ad4 (first)

    public PanelContract $panel;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
<<<<<<< HEAD
    public function authorize() {
=======
    public function authorize()
    {
>>>>>>> 9472ad4 (first)
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
<<<<<<< HEAD
    public function rules() {
        return [];
    }

    public function setPanel(PanelContract $panel): self {
=======
    public function rules()
    {
        return [];
    }

    public function setPanel(PanelContract $panel): self
    {
>>>>>>> 9472ad4 (first)
        $this->panel = $panel;

        return $this;
    }

    /**
     * @param PanelContract $panel
     * @param string        $act
     */
<<<<<<< HEAD
    public function validatePanel($panel, $act = ''): void {
=======
    public function validatePanel($panel, $act = ''): void
    {
>>>>>>> 9472ad4 (first)
        $this->setPanel($panel);
        $this->prepareForValidation();
        $rules = $panel->rules(['act' => $act]);
        $this->validate($rules, $panel->rulesMessages());
    }

<<<<<<< HEAD
    /**
=======
    /*
>>>>>>> 9472ad4 (first)
     * Get the validated data from the request.
     *
     * @return array
     */
    /*
    public function validated()
    {
        $rules = $this->container->call([$this, 'rules']);
        return $this->only(collect($rules)->keys()->map(function ($rule) {
            return explode('.', $rule)[0];
        })->unique()->toArray());
    }
    */
    /**
     * https://stackoverflow.com/questions/28854585/laravel-5-form-request-data-pre-manipulation?rq=1.
     **/

    /**
     * Cerco di rilevare quando viene chiamato.
     */
<<<<<<< HEAD
    public function modifyInput(array $data): void {
        dddx($data);
    }

    public function prepareForValidation() {
=======
    public function modifyInput(array $data): void
    {
        dddx($data);
    }

    public function prepareForValidation()
    {
>>>>>>> 9472ad4 (first)
        $data = $this->request->all();
        $date_fields = collect($this->panel->fields())->filter(
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
=======
            if (! is_object($value)) {
>>>>>>> 9472ad4 (first)
                $func = 'Conv'.$field->type;
                $value_new = $this->$func($field, $value);
                $this->request->add([$field->name => $value_new]);
            }
        }
    }

    /**
     * Cerco di rilevare quando viene chiamato.
     *
     * @return array
     */
<<<<<<< HEAD
    public function validationData() {
=======
    public function validationData()
    {
>>>>>>> 9472ad4 (first)
        dddx('aaa');

        return [];
    }

    /**
     * @param string $field
<<<<<<< HEAD
     * @param string  $value
     *
     * @return Carbon
     */
    public function ConvDate($field, $value) {
        if (null === $value) {
            return $value;
        }
        $value_new = Carbon::createFromFormat('d/m/Y', $value);
        if($value_new==false){
            throw new Exception('['.__LINE__.']['.__FILE__.']');
        }
=======
     * @param mixed  $value
     *
     * @return mixed
     */
    public function ConvDate($field, $value)
    {
        if (null == $value) {
            return $value;
        }
        $value_new = Carbon::createFromFormat('d/m/Y', $value);

>>>>>>> 9472ad4 (first)
        return $value_new;
    }

    /**
     * @param string $field
<<<<<<< HEAD
     * @param string  $value
     *
     * @return Carbon
     */
    public function ConvDateTime($field, $value) {
        if (null === $value) {
            return $value;
        }
        $value_new = Carbon::createFromFormat('d/m/Y H:i', $value);
        if($value_new==false){
            throw new Exception('['.__LINE__.']['.__FILE__.']');
        }
=======
     * @param mixed  $value
     *
     * @return mixed
     */
    public function ConvDateTime($field, $value)
    {
        if (null == $value) {
            return $value;
        }
        $value_new = Carbon::createFromFormat('d/m/Y H:i', $value);

>>>>>>> 9472ad4 (first)
        return $value_new;
    }

    /**
     * @param string $field
<<<<<<< HEAD
     * @param string  $value
     *
     * @return Carbon
     */
    public function ConvDateTime2Fields($field, $value) {
        if (null === $value) {
            return $value;
        }
        $value_new = Carbon::createFromFormat('d/m/Y H:i', $value);
        if($value_new==false){
            throw new Exception('['.__LINE__.']['.__FILE__.']');
        }
        return $value_new;
    }
}
=======
     * @param mixed  $value
     *
     * @return mixed
     */
    public function ConvDateTime2Fields($field, $value)
    {
        if (null == $value) {
            return $value;
        }
        $value_new = Carbon::createFromFormat('d/m/Y H:i', $value);

        return $value_new;
    }
}
>>>>>>> 9472ad4 (first)
