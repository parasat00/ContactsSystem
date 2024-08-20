<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditUserRequest;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\Contact;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;

class ContactController extends Controller
{
    public function index(): JsonResponse
    {
        $user = Auth::user();
        $contacts = $user->contacts;

        return response()->json([
            'success' => true,
            'user' => $user,
        ], 200);
    }

    public function store(StoreContactRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();

            $user = Auth::user();

            $contact = new Contact();
            $contact->user_id = $user->id;
            $contact->name = $validated['name'];
            $contact->phone = $validated['phone'];
            $contact->email = $validated['email'] ?? null;
            $contact->address = $validated['address'] ?? null;

            $contact->save();

            return response()->json([
                'success' => true,
                'message' => 'Contact successfully created',
                'contact' => $contact
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create contact: ' . $exception->getMessage(),
                'error' => $exception->getCode()
            ], 500);
        }
    }

    public function show(Contact $contact): JsonResponse
    {
        return response()->json([
            'success' => true,
            'contact' => $contact,
        ], 200);
    }

    public function update(UpdateContactRequest $request, Contact $contact): JsonResponse
    {
        try {
            $validated = $request->validated();

            $contact->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Contact was updated successfully',
                'contact' => $contact
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update contact: ' . $exception->getMessage(),
                'error' => $exception->getCode()
            ], 500);
        }
    }

    public function destroy(Contact $contact): JsonResponse
    {
        try {
            $contact->delete();

            return response()->json([
                'success' => true,
                'message' => 'Contact is deleted successfully'
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete contact: ' . $exception->getMessage(),
                'error' => $exception->getCode()
            ], 500);
        }
    }
}
