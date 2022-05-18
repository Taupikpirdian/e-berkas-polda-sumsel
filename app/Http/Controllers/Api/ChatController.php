<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Participant;
use App\User;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function getListChatToMe()
    {
        try {
            $user = Auth::user();

            if ($user) {
                $user_auth_id = $user->id;
                $listThread = Participant::with('thread', 'thread.listConversation')
                    ->where('user_id', $user_auth_id)
                    ->orderBy('updated_at', 'desc')
                    ->select('user_id as id_user_penerima', 'thread_id')
                    ->get();
                return response()->json([
                    'data' => $listThread,
                    'code' => 200,
                    'message' => 'Sukses',
                ], 200);
            } else {
                return response()->json([
                    'data' => null,
                    'code' => 400,
                    'message' => 'Terdapat masalah teknis',
                ], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'data' => null,
                'code' => 401,
                'message' => 'Error : ' . $e,
            ], 401);
        }
    }

    public function getContact()
    {
        try {
            $user = Auth::user();

            $listContact = null;
            if ($user->hasRole(3)) { // kepolisian
                $listContact = User::with('roles:name')->orderBy('name', 'asc')->role('kejaksaan')->select('id','name')->get();
            } else if ($user->hasRole(5)) { // kejaksaan
                $listContact = User::with('roles:name')->orderBy('name', 'asc')->role('kepolisian')->select('id','name')->get();
            }

            if ($user) {
                return response()->json([
                    'data' => $listContact,
                    'code' => 200,
                    'message' => 'Sukses',
                ], 200);
            } else {
                return response()->json([
                    'data' => null,
                    'code' => 400,
                    'message' => 'Terdapat masalah teknis',
                ], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'data' => null,
                'code' => 401,
                'message' => 'Error : ' . $e,
            ], 401);
        }
    }
}
