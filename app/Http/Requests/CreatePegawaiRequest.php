<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreatePegawaiRequest extends Request {

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
			'nama'       => 'required',
            'email'      => 'required|email',
            'level' 	 => 'required|numeric'
		];
	}

	 public function messages()
    {
        return [
            'nama.required'  => 'Kolom nama harus diisi',
            'email.required' => 'Kolom email belum diisi',
            'email.email' 	 => 'Email tidak sesuai',
            'level.required' => 'Level pegawai belum dipilih',
            'level.numeric'  => 'Level pegawai tidak sesuai'
        ];
    }

}