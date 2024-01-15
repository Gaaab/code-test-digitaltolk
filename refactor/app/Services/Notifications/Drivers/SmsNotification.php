<?php

namespace App\Services\Notification;

use Exception;

class SmsNotification implements NotificationAdapter
{
    public function send(NotifableEntity $notifableEntity)
    {
        $data = $notifableEntity->data();

        if (! $data) throw new Exception("Data not found");

        // @TODO: Send to sms notification party api

        return true; // or return response from data using dto
    }
}
