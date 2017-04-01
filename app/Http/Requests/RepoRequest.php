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
    if ($this->method() == 'PATCH')
    {
      // Update operation, exclude the record with id from the validation:
      $bitbucket_rule = 'required|string|unique:repos,bitbucket,' . $this->repo->id;
    }
    else
    {
      // Create operation. There is no id yet.
      $bitbucket_rule = 'string|unique:repos|required';
    }
    return [
      'url'           => 'string|url|between:18,255|required',
      'bitbucket'     => $bitbucket_rule,
      'directory'     => 'string|required',
      'remote'        => 'string|required',
      'branch'        => 'string|required',
      'auto_deploy'   => 'integer',
      'comments'      => 'nullable|string'
    ];
  }
}
