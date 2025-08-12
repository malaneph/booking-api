<?php
/**
 * IndexRequest.php
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

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Date;

class IndexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'date' => ['required', (new Date())
                ->format('Y-m-d')]
        ];
    }
}
