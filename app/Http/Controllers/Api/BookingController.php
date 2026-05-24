<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\DoctorAvailability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with([
            'parent',
            'doctor',
            'child',
            'availability'
        ])->get();

        return response()->json([
            'msg'      => 'Return all bookings',
            'status'   => 200,
            'bookings' => $bookings
        ], 200);
    }

    public function show($id)
    {
        $booking = Booking::with([
            'parent',
            'doctor',
            'child',
            'availability'
        ])->find($id);

        if (!$booking) {
            return response()->json([
                'msg'    => 'Booking not found',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'msg'     => 'Booking found',
            'status'  => 200,
            'booking' => $booking
        ], 200);
    }

    // ========================
    // CREATE BOOKING
    // ========================
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'parent_id'       => 'required|exists:parents,id',
            'doctor_id'       => 'required|exists:doctors,id',
            'child_id'        => 'required|exists:children,id',
            'availability_id' => 'required|exists:doctor_availabilities,id',
            'type'            => 'required|in:online,in_person',
            'parent_note'     => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg'    => 'Validation errors',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422);
        }

        // ========================
        // GET AVAILABILITY
        // ========================
        $availability = DoctorAvailability::find($request->availability_id);

        // تأكد إن الـ slot تابعة للدكتور ده
        if ($availability->doctor_id != $request->doctor_id) {
            return response()->json([
                'msg'    => 'This slot does not belong to this doctor',
                'status' => 422
            ], 422);
        }

        // تأكد إن الـ slot active
        if (!$availability->is_active) {
            return response()->json([
                'msg'    => 'This slot is not available for booking',
                'status' => 422
            ], 422);
        }

        // ========================
        // CHECK DOUBLE BOOKING
        // الـ unique() في الجدول بيعمل ده تلقائياً
        // لكن بنتحقق هنا علشان نرجع رسالة واضحة
        // ========================
        $alreadyBooked = Booking::where('availability_id', $request->availability_id)
            ->whereIn('status', ['pending', 'confirmed'])
            ->exists();

        if ($alreadyBooked) {
            return response()->json([
                'msg'    => 'This slot is already booked',
                'status' => 409
            ], 409);
        }

        // ========================
        // CREATE BOOKING
        // status دايماً pending عند الإنشاء
        // ========================
        $booking = Booking::create([
            'parent_id'       => $request->parent_id,
            'doctor_id'       => $request->doctor_id,
            'child_id'        => $request->child_id,
            'availability_id' => $request->availability_id,
            'type'            => $request->type,
            'parent_note'     => $request->parent_note,
            'status'          => 'pending',
        ]);

        return response()->json([
            'msg'     => 'Booking created successfully',
            'status'  => 201,
            'booking' => $booking->load('availability')
        ], 201);
    }

    // ========================
    // UPDATE BOOKING
    // بس يسمح بتعديل note و type
    // ========================
    public function update(Request $request, $id)
    {
        $booking = Booking::find($id);

        if (!$booking) {
            return response()->json([
                'msg'    => 'Booking not found',
                'status' => 404
            ], 404);
        }

        // منع التعديل بعد التأكيد أو الرفض
        if (in_array($booking->status, ['confirmed', 'rejected', 'completed'])) {
            return response()->json([
                'msg'    => 'Cannot update a booking with status: ' . $booking->status,
                'status' => 422
            ], 422);
        }

        $validator = Validator::make($request->all(), [
            'type'        => 'nullable|in:online,in_person',
            'parent_note' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg'    => 'Validation errors',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422);
        }

        // نسمح بس بتعديل type و parent_note
        // availability_id و doctor_id و parent_id ثابتين
        $booking->update($request->only(['type', 'parent_note']));

        return response()->json([
            'msg'     => 'Booking updated successfully',
            'status'  => 200,
            'booking' => $booking
        ], 200);
    }




    // ========================
    // GET AVAILABLE SLOTS
    // بيرجع كل slots للدكتور في يوم معين
    // مع حالة كل slot (available / booked)
    // ========================
    public function availableSlots($doctorId, Request $request)
    {
        $date = $request->date;

        if (!$date) {
            return response()->json([
                'msg'    => 'Date is required',
                'status' => 422
            ], 422);
        }

        // جيب كل الـ slots للدكتور في اليوم ده
        $slots = DoctorAvailability::where('doctor_id', $doctorId)
            ->where('date', $date)
            ->where('is_active', true)
            ->get();

        if ($slots->isEmpty()) {
            return response()->json([
                'msg'    => 'No slots found for this doctor on this date',
                'status' => 404,
                'slots'  => []
            ], 404);
        }

        // جيب الـ availability_ids المحجوزة
        $bookedIds = Booking::whereIn('availability_id', $slots->pluck('id'))
            ->whereIn('status', ['pending', 'confirmed'])
            ->pluck('availability_id')
            ->toArray();

        // ابني response فيه حالة كل slot
        $result = $slots->map(function ($slot) use ($bookedIds) {
            return [
                'availability_id'  => $slot->id,
                'time'             => $slot->time,
                'appointment_type' => $slot->appointment_type,
                'status'           => in_array($slot->id, $bookedIds)
                                        ? 'booked'
                                        : 'available',
            ];
        });

        return response()->json([
            'msg'       => 'Slots returned successfully',
            'status'    => 200,
            'doctor_id' => $doctorId,
            'date'      => $date,
            'slots'     => $result
        ], 200);
    }

    // ========================
    // CONFIRM BOOKING
    // ========================
    public function confirmBooking($id)
    {
        $booking = Booking::find($id);

        if (!$booking) {
            return response()->json([
                'msg'    => 'Booking not found',
                'status' => 404
            ], 404);
        }

        if ($booking->status !== 'pending') {
            return response()->json([
                'msg'    => 'Only pending bookings can be confirmed',
                'status' => 422
            ], 422);
        }

        $booking->status       = 'confirmed';
        $booking->confirmed_at = now();
        $booking->save();

        return response()->json([
            'msg'     => 'Booking confirmed successfully',
            'status'  => 200,
            'booking' => $booking
        ], 200);
    }

    // ========================
    // REJECT BOOKING
    // ========================
    public function rejectBooking(Request $request, $id)
    {
        $booking = Booking::find($id);

        if (!$booking) {
            return response()->json([
                'msg'    => 'Booking not found',
                'status' => 404
            ], 404);
        }

        if ($booking->status !== 'pending') {
            return response()->json([
                'msg'    => 'Only pending bookings can be rejected',
                'status' => 422
            ], 422);
        }

        $booking->status      = 'rejected';
        $booking->rejected_at = now();
        $booking->doctor_note = $request->doctor_note;
        $booking->save();

        return response()->json([
            'msg'     => 'Booking rejected successfully',
            'status'  => 200,
            'booking' => $booking
        ], 200);
    }

    // ========================
    // COMPLETE BOOKING
    // ========================
    public function completeBooking($id)
    {
        $booking = Booking::find($id);

        if (!$booking) {
            return response()->json([
                'msg'    => 'Booking not found',
                'status' => 404
            ], 404);
        }

        if ($booking->status !== 'confirmed') {
            return response()->json([
                'msg'    => 'Only confirmed bookings can be completed',
                'status' => 422
            ], 422);
        }

        $booking->status       = 'completed';
        $booking->completed_at = now();
        $booking->save();

        return response()->json([
            'msg'     => 'Booking completed successfully',
            'status'  => 200,
            'booking' => $booking
        ], 200);
    }

    // ========================
    // cancle BOOKING for parent
    // ========================
    
    public function canacle($id)
    {
        $booking = Booking::find($id);

        if (!$booking) {
            return response()->json([
                'msg'    => 'Booking not found',
                'status' => 404
            ], 404);
        }

        // منع الحذف لو confirmed
        if ($booking->status === 'confirmed') {
            return response()->json([
                'msg'    => 'Cannot delete a confirmed booking. Cancel it instead.',
                'status' => 422
            ], 422);
        }

        $booking->delete();

        return response()->json([
            'msg'    => 'Booking deleted successfully',
            'status' => 200
        ], 200);
    }

    // ========================
    // Delete BOOKING
    // ========================
    public function delete($id)
    {
        $booking = Booking::find($id);

        if (!$booking) {
            return response()->json([
                'msg'    => 'Booking not found',
                'status' => 404
            ], 404);
        }

        $booking->delete();

        return response()->json([
            'msg'    => 'Booking deleted successfully',
            'status' => 200
        ], 200);
    }
}