<?php
/**
 * RoomController.php
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

namespace App\Http\Controllers;

use App\Http\Requests\Room\SlotsRequest;
use App\Models\Booking;
use App\Models\Room;
use Carbon\CarbonPeriod;
use Illuminate\Support\Carbon;

class RoomController extends Controller
{
    public function slots(Room $room, SlotsRequest $request): array
    {
        $bookings = Booking::whereRoomId($room->id)->get();
        $start_period = Carbon::parse('9:00');
        $end_period = Carbon::parse('18:00');

        foreach (CarbonPeriod::create($start_period, '30 minutes', $end_period) as $date) {
            if (!($bookings->contains('start_time', $date) || $bookings->contains('end_time', $date))) {
                $hours[] = $date->format('H:i');
            }
        }

        return $hours ?? [];
    }
}
