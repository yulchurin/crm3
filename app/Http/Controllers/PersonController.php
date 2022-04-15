<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParentPersonRequest;
use App\Http\Requests\PersonRequest;
use App\Http\Resources\PaperResource;
use App\Http\Resources\PersonResource;
use App\Traits\GetStudent;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Response;
use Inertia\ResponseFactory;

class PersonController extends Controller
{
    use GetStudent;

    public function __construct()
    {
        $this->middleware('phoneFix')->except('index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PersonRequest $request
     * @return RedirectResponse|JsonResponse
     */
    public function store(PersonRequest $request)
    {
        $student = $this->getStudent();

        if ($student?->person()->exists()) {
            $student->person()->update($request->validated());
        } else {
            $student->person()->create($request->validated());
        }

        Log::channel('user_actions')->info(Auth::id() . ': ' .json_encode($request->validated()));

        return $request->wantsJson()
            ? new JsonResponse('', 200)
            : back()->with('status', 'profile-information-updated');
    }

    /**
     * Display the specified resource.
     *
     * @return Response|ResponseFactory
     */
    public function index()
    {
        $student = $this->getStudent();

        $personResource = $student->person()->exists() ? new PersonResource($student->person) : null;
        $paperResource = $student->paper()->exists() ? new PaperResource($student->paper) : null;

        $parentPerson = $student->legalRepresentativePerson()->exists()
            ? new PersonResource($student->legalRepresentativePerson)
            : null;

        $parentPaper = $student->legalRepresentativePerson?->paper()->exists()
            ? new PaperResource($student->legalRepresentativePerson?->paper)
            : null;

        return inertia('Person/Show', [
            'person' => $personResource,
            'paper' => $paperResource,
            'parent' => $parentPerson,
            'parent_paper' => $parentPaper,
        ]);
    }

    public function storeParent(ParentPersonRequest $request)
    {
        $student = $this->getStudent();

        if ($student?->legalRepresentativePerson()->exists()) {
            $student->legalRepresentativePerson()->update($request->validated());
        } else {
            $legalRepresentative = $student->legalRepresentative()->create();
            $legalRepresentativePerson = $student->legalRepresentativePerson()->create($request->validated());
            $legalRepresentativePerson->legal_representative_id = $legalRepresentative->id;
            $legalRepresentativePerson->save();
        }

        Log::channel('user_actions')->info(Auth::id() . ': ' .json_encode($request->validated()));

        return $request->wantsJson()
            ? new JsonResponse('', 200)
            : back()->with('status', 'profile-information-updated');
    }
}
