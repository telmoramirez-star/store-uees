<?php

namespace App\Modules\Logs\Services;

use App\Modules\Logs\Models\Log;

class LogService
{
    public function logAction($userId, $action, $description = null)
    {
        return Log::create([
            'user_id' => $userId,
            'action' => $action,
            'description' => $description,
        ]);
    }
}
