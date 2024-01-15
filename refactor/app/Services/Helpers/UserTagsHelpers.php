<?php

namespace App\Services\Helpers;

class UserTagsHelpers
{
    public static function getUserTagsStringFromArray(array $users): string
    {
        $userTags = [];

        foreach ($users as $index => $user) {
            if ($index === 0) {
                $userTags[] = [
                    'operator' => 'OR'
                ];
            }

            $userTags[] = [
                'key' => 'email',
                'relation' => '=',
                'value' => strtolower($user->email),
            ];
        }

        return json_encode($userTags);
    }
}
