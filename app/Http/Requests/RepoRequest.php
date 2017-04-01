<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RepoRequest extends FormRequest
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
  /**
  * Get the validation rules that apply to the request.
  *
  * @return array
  */
  public function rules()
  {
    return [
      'url'           => 'string|url|between:18,255|required',
      'bitbucket'     => 'string|unique:repos|required',
      'directory'     => 'string|required',
      'remote'        => 'string|required',
      'branch'        => 'string|required',
      'auto_deploy'   => 'integer',
      'comments'      => 'nullable|string'
    ];
  }
}
