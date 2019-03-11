<?php

namespace Modules\Callback\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CallbackRequest extends FormRequest
{
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'fio' => 'required|max:255',
      'company_name' => 'max:50',
      'telephone' => 'required|max:50',
      'email' => 'email'
    ];
  }

  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }
}
