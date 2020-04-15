<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Invite;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Validator;

class InviteController extends Controller
{
    /**
     * Constructor.
     */
    public function __construct()
    {
    }

    public function createNewInvite(Request $request)
    {
        $inviteToCreate = $request->json();

        $errorList = $this->validateRequest($inviteToCreate->all());
        if (!empty($errorList)) {
            return response()->json($errorList, 400);
        }

        foreach ($inviteToCreate as $invite) {
            //create a new invite record
            Invite::create([
                'nom' => $invite['nom'],
                'rpps' => $invite['rpps'],
                'email' => $invite['email'],
                'active' => 1,
                'etab_finess' => $invite['etab_finess'],
                'token' => $invite['token']
            ]);
        }

        return response()->json(null, 201);
    }

    private function validateRequest(array $inviteToCreate): array
    {
        if (count($inviteToCreate) === 0) {
            return [['error' => 'no invite to create']];
        }

        $errorList = [];
        foreach ($inviteToCreate as $invite) {
            try {
                // Validate the request
                Validator::make($invite, [
                    'nom' => 'required|alpha_spaces|max:50',
                    'rpps' => 'required|integer',
                    'email' => 'required|email:rfc,dns|unique:users',
                    'etab_finess' => 'required:alpha',
                    'token' => 'required:alpha|max:16'
                ])->validate();
            } catch (ValidationException $e) {
                $errorList[] = ['data' => $invite, 'errors' => $e->errors()];
            }
        }

        return $errorList;
    }
}
