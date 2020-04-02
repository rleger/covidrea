<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminNotificationController extends Controller
{
    /**
     * List of etablissements
     * @TODO Pagination
     */
    public function index(Request $request, $type = 'prospect')
    {
        $searchEmail = $request->input('email');
        // @Todo Pagination
        if ($type != "prospect" && $type != "invite") {
            abort(404);
        }
        if ($type == "prospect") {
            if ($searchEmail) {
                $notifications = \DB::select(\DB::raw('
                    SELECT * FROM prospect_notifications 
                    WHERE prospect_notifications.id IN (
                        SELECT MAX(prospect_notifications.id) 
                        FROM prospect_notifications 
                        JOIN prospects on prospects.id = prospect_notifications.prospect_id 
                        WHERE prospects.user_email = \'' . $searchEmail . '\'
                        GROUP BY prospect_notifications.prospect_id
                    );'));
            } else {
                $notifications = \DB::select(\DB::raw('
                    SELECT * FROM prospect_notifications
                    WHERE id IN (
                        SELECT MAX(id)
                        FROM prospect_notifications
                        GROUP BY prospect_id
                );'));
            }
        }
        if ($type == "invite") {
            if ($searchEmail) {
                $notifications = \DB::select(\DB::raw('
                    SELECT * FROM invite_notifications 
                    WHERE invite_notifications.id IN (
                        SELECT MAX(invite_notifications.id) 
                        FROM invite_notifications 
                        JOIN invites on invites.id = invite_notifications.invite_id 
                        WHERE invites.email = \'' . $searchEmail . '\'
                        GROUP BY invite_notifications.invite_id
                    );'));
            } else {
                $notifications = \DB::select(\DB::raw('
                    SELECT * FROM invite_notifications
                    WHERE id IN (
                    SELECT MAX(id)
                    FROM invite_notifications
                    GROUP BY invite_id
                );'));
            }
        }
        
        return view('admin.notification.index', compact('notifications', 'type', 'searchEmail'));
    }

    /**
     * Invite new users
     *
     */
    public function invite()
    {
        // 
    }

    /**
     * Edit an etablissement
     * 
     */
    public function edit()
    {
        //
    }
}
