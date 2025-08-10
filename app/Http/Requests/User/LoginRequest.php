<?php
/**
 * LoginRequest.php
 *
 * PHP Version 8.3
 *
 * @category  File
 * @package   booking-api
 * @author    Sandal <sandalkaigorodov@gmail.com>
 * @copyright 2025 booking-api
 * @license   MIT License
 * @link      https://github.com/malaneph/booking-api
 */

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required',
            'password' => 'required',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
