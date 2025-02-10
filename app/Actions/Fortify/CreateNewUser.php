<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
   public function create(array $input): User
{
    $validatedData = Validator::make($input, [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'address' => ['required', 'string', 'max:255'],
        'phone' => ['required', 'string', 'regex:/^[0-9]+$/', 'min:11'],
        'password' => $this->passwordRules(),
        'profile_photo_path' => 'nullable|image|max:5000', // image validation
    ])->validate();

    if (isset($input['profile_photo_path'])) {
        $image = $input['profile_photo_path'];
        $imageName = uniqid() . '_' . $image->getClientOriginalName();
        $image->storeAs('public/profile_pictures', $imageName); // Store the image
        $validatedData['profile_photo_path'] = 'profile_pictures/' . $imageName; // Save the path
    }

    return User::create([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'address' => $validatedData['address'],
        'phone' => $validatedData['phone'],
        'profile_photo_path' => $validatedData['profile_photo_path'] ?? null,
        'password' => Hash::make($validatedData['password']),
    ]);
}


}
