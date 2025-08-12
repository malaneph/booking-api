<?php
/**
 * BookingResource.php
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

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'user_id' => $this->user_id,
            'room_id' => $this->room_id,
            'start_time' => Carbon::parse($this->start_time)->inUserTimezone()->format('Y-m-d H:i'),
            'end_time' => Carbon::parse($this->end_time)->inUserTimezone()->format('Y-m-d H:i'),
        ];
    }
}
