<?php

namespace App\Http\Controllers;

use App\Interested;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class InterestedController extends Controller
{
    public function store(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'email' => 'required|email:rfc,dns|unique:interesteds,email',
        ]);

        if ($validator->fails()) {
            return redirect(URL::previous().'#interet')
                ->withErrors($validator)
                ->withInput();
        }

        Interested::create([
            'region' => ($request->get('region')[0]),
            'email'  => $request->get('email'),
        ]);

        return Redirect::to(URL::previous().'#interet')
            ->withInput()
            ->with('status', 'Merci de votre intérêt, nous ne manquerons pas de vous tenir informés');
    }
}
