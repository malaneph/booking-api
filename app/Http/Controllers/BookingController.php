<?php
/**
 * BookingController.php
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

use App\Http\Requests\Bookings\CreateRequest;
use App\Models\Booking;
use App\Services\BookingService;
use Illuminate\Http\Request;

/**
 *
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
class BookingController extends Controller
{
    /**
     * Инициализация сервиса
     *
     * @param BookingService $bookingService
     */
    public function __construct(protected readonly BookingService $bookingService)
    {
    }

    /**
     * Создание бронирования
     *
     * @param  CreateRequest  $request
     *
     * @return Booking|string[]
     */
    public function create(CreateRequest $request)
    {
        $data = $request->validated();

        if ($this->bookingService->checkBookingTime($data['room_id'], $data['start_time'], $data['end_time'])) {
            return Booking::create($data);
        }

        return [
            'message' => 'Ошибка при создании'
        ];
    }

    /**
     * Удаление бронирования
     *
     * @param  Booking  $booking
     * @param  Request  $request
     *
     * @return array
     */
    public function delete(Booking $booking, Request $request): array
    {
         if ($booking->user_id === $request->user()->id) {
             return [
                 'message' => $booking->delete() ? 'Удалено' : 'Ошибка при удалении',
             ];
         }

         return [
             'message' => 'Ошибка при удалении'
         ];
    }

}
