<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function updateAdmin(Request $request, $id)
    {
        $user = Auth::user();
        $adminToUpdate = User::findOrFail($id);


        if ($user->id != $id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
        ]);

        $adminToUpdate->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);

        if (isset($validatedData['password'])) {
            $adminToUpdate->update([
                'password' => Hash::make($validatedData['password']),
            ]);
        }

        return  $adminToUpdate;
    }

    public function updateClient(Request $request, $id)
    {
        $user = Auth::user();


        $clientToUpdate = User::findOrFail($id);


        if ($user->id != $id || !$user->hasRole('client')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }


        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
        ]);


        $clientToUpdate->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);


        if (isset($validatedData['password'])) {
            $clientToUpdate->update([
                'password' => Hash::make($validatedData['password']),
            ]);
        }

        return $clientToUpdate;
    }
}

?>
