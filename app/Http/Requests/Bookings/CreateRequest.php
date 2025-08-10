<?php
/**
 * CreateRequest.php
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

namespace App\Http\Requests\Bookings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Date;

class CreateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'user_id' => ['required', 'integer', Rule::exists('users', 'id')],
            'room_id' => ['required', 'integer', Rule::exists('rooms', 'id')],
            'start_time' => ['required', (new Date())
                ->format('Y-m-d H:i')
                ->after('now')],
            'end_time' => ['required', (new Date())
                ->format('Y-m-d H:i')
                ->after('start_time')],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
