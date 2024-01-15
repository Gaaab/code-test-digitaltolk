<?php

namespace App\Services\Notification;

use Interfaces\NotifableEntity;
use Interfaces\Drivers\NotificationAdapter;

class NotificationService
{
    public function __construct(protected NotificationAdapter $notificationAdapter)
    {
    }

    public function handle(NotifableEntity $notificationEntity)
    {
        return $this->notificationAdapter->send($notificationEntity);
    }
}

/**
 * Usage:
 * (new NotificationService($entity, $driver))
 */
