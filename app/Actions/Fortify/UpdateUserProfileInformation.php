<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Illuminate\Support\Facades\Storage;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        Validator::make($input, [
            'nama_lengkap' => 'required',
            'tanggal_lahir' => 'required|date_format:Y-m-d',
            'nomor_hp' => 'required|numeric',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('\App\Models\Karyawan', 'email')->ignore($user->id)
            ],
            'nik' => 'required|numeric',
            'ektp' => [
                'nullable',
                'file',
                'image',
                'mimes:jpg,jpeg,png',
                'max:1024',
            ],
            'alamat_lengkap' => 'required',
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'nama_lengkap' => $input['nama_lengkap'],
                'tanggal_lahir' => $input['tanggal_lahir'],
                'nomor_hp' => $input['nomor_hp'],
                'email' => $input['email'],
                'nik' => $input['nik'],
                'alamat_lengkap' => $input['alamat_lengkap'],
            ])->save();

            if ($input['ektp']) {
                $file_name = $user->slug . '-' . uniqid() . '.' . $input['ektp']->getClientOriginalExtension();
                $path = Storage::disk('public')->putFileAs('karyawan/ektp', $input['ektp'], $file_name);
                $user->ektp_path = $path;
                $user->save();
            }
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
