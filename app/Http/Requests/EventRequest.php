<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages() {
        return [
            'title.required' => 'The titles field required.',
            'has_many_event_details.min' => 'Selecting day/s field is required.',
            'date_from.date' => 'Date from is invalid.',
            'date_to.date' => 'Date to is invalid.',
            // 'date_to.after' => 'Two dates are invalid.',
            'a_custom_error.required' => 'Selected days or dates are invalid.',
        ];

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            "title" => "required",
            "date_from" => "date",
            // "date_to" => "date|after:date_from",
            "has_many_event_details" => "array|min:1",
            "a_custom_error" => "required",
        ];
        if(!$this->validateDates()) $rules['a_custom_error'] = "required"; 
            else unset($rules['a_custom_error']);
        return $rules;
    }

    public function validateDates()
    {
        if($this->request->get('date_from') && $this->request->get('date_to')){
            $period = CarbonPeriod::create($this->request->get('date_from'), $this->request->get('date_to'));
            $days = collect($this->request->get('has_many_event_details'))->map(function ($d) {
                return $d['name'];
            })->toArray();
            $checkIfExistDays = collect($period)->map(function ($s) use ($days) {
                return in_array($s->format('D'), $days) ? true : false;
            })->toArray();
            return in_array('true', $checkIfExistDays);
        }
        
    }
}
