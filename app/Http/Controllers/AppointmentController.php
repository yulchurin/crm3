<?php

namespace App\Http\Controllers;

use App\Actions\Appointments\AppointmentData;
use App\Actions\Appointments\BookDrivingLesson;
use App\Actions\Appointments\CancelBookedDrivingLesson;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Resources\AppointmentCollection;
use App\Http\Resources\PlaceCollection;
use App\Models\Appointment;
use App\Models\Place;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class AppointmentController extends Controller
{
    public function index()
    {
        $availableSlots = Appointment::with(['schedule', 'group', 'instructor', 'vehicle', 'place'])
            ->available()
            ->paginate(20);

        return new AppointmentCollection($availableSlots);
    }


    /**
     * @throws UnknownProperties
     */
    public function book(
        StoreAppointmentRequest $request,
        BookDrivingLesson $bookDrivingLesson,
        Appointment $appointment
    ): RedirectResponse {

        $this->authorize('update', $appointment);

        $validated = $request->validated();

        $data = new AppointmentData(
            place: Place::find($validated['place']),
            comment: $validated['comment'],
        );

        $bookDrivingLesson($data, $appointment);

        return back()->with('status', 'appointment-created');
    }


    public function unbook(
        Request $request,
        CancelBookedDrivingLesson $cancelBookedDrivingLesson,
        Appointment $appointment
    ): RedirectResponse {
        if ($request->user()->cannot('update', $appointment)) {
            abort(403);
        }

        $cancelBookedDrivingLesson($appointment);

        return back()->with('status', 'appointment-deleted');
    }

    /**
     * @return AppointmentCollection
     */
    public function instructorView(): AppointmentCollection
    {
        $appointments = Appointment::query()
            ->ofThisInstructor()
            ->ofThisWeekAndHigher()
            ->onlyBooked()
            ->with(['schedule', 'group', 'student', 'vehicle', 'place'])
            ->paginate(20);

        return new AppointmentCollection($appointments);
    }
}
