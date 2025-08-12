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

namespace App\Http\Requests\Booking;

use App\Models\Booking;
use Carbon\Carbon;
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

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->any()) {
                return;
            }

            $start = Carbon::createFromFormat('Y-m-d H:i', $this->input('start_time'));
            $end = Carbon::createFromFormat('Y-m-d H:i', $this->input('end_time'));

            if ($start?->diffInMinutes($end) > 240) {
                $validator->errors()->add('end_time', 'Длительность бронирования не может превышать 4 часа.');
            }

            $activeCount = Booking::query()
                ->where('user_id', $this->input('user_id'))
                ->where('end_time', '>', Carbon::now())
                ->count();

            if ($activeCount >= 2) {
                $validator->errors()->add('user_id', 'У пользователя уже есть 2 активных бронирования.');
            }
        });
    }
}
