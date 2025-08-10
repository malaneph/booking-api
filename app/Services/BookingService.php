<?php
/**
 * BookingService.php
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

namespace App\Services;

use App\Models\Booking;
use Carbon\CarbonPeriod;

/**
 * Сервис для работы с бронированиями
 *
 * PHP Version 8.3
 *
 * @category  Class
 * @package   booking-api
 * @author    Sandal <sandalkaigorodov@gmail.com>
 * @copyright 2025 booking-api
 * @license   MIT License
 * @link      https://github.com/malaneph/booking-api
 */
class BookingService
{
    /**
     * Проверка, доступно ли время для бронирования
     *
     * @param  int  $room_id
     * @param  string  $start_time
     * @param  string  $end_time
     *
     * @return bool
     */
    public function checkBookingTime(int $room_id, string $start_time, string $end_time): bool
    {
        $booking_period = CarbonPeriod::create($start_time, $end_time);
        foreach (Booking::whereRoomId($room_id)->get() as $booking) {
            if ($booking_period->overlaps(CarbonPeriod::create($booking->start_time, $booking->end_time))) {
                return false;
            }
        }

        return true;
    }
}
