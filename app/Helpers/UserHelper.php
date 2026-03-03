<?php

namespace App\Helpers;

use App\Models\User;

class UserHelper
{
    public static function getAccessibleUserIds(User $user)
    {
        if ($user->isAssistant() && $user->parent) {
            // For assistants, return their parent's ID plus their own ID
            return [$user->parent->id, $user->id];
        }
        
        // For primary users, return their own ID
        return [$user->id];
    }
    
    public static function getPrimaryAgentId(User $user)
    {
        return $user->isAssistant() ? $user->parent_id : $user->id;
    }
}