<?php

namespace App\Http\Controllers;

use App\Models\RoleChangeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleChangeRequestController extends Controller
{
    public function requestRoleChange()
    {
        $request = RoleChangeRequest::create([
            'user_id' => Auth::id(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Permohonan perubahan role telah diajukan.',
            'data' => $request
        ], 201);
    }

    public function acceptRoleChange(Request $request, $id)
    {
        $roleChangeRequest = RoleChangeRequest::findOrFail($id);
        $user = $roleChangeRequest->user;

        // Ubah role pengguna menjadi 'pakar'
        $user->role = 'pakar';
        $user->save();

        // Ubah status permohonan
        $roleChangeRequest->status = 'accepted';
        $roleChangeRequest->save();

        return response()->json([
            'success' => true,
            'message' => 'Permohonan perubahan role diterima.',
            'data' => $user
        ]);
    }

    public function rejectRoleChange(Request $request, $id)
    {
        $roleChangeRequest = RoleChangeRequest::findOrFail($id);
        $roleChangeRequest->status = 'rejected';
        $roleChangeRequest->save();

        return response()->json([
            'success' => true,
            'message' => 'Permohonan perubahan role ditolak.'
        ]);
    }
}
