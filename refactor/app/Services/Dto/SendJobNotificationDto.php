<?php

namespace Services\Dto;

use DTApi\Models\Job;

class SendJobNotificationDto
{
    public function __construct(protected Job $job)
    {
    }

    public function toArray()
    {
        $user_meta = $this->job->user->userMeta()->first();
        $data = array();
        $data['job_id'] = $this->job->id;
        $data['from_language_id'] = $this->job->from_language_id;
        $data['immediate'] = $this->job->immediate;
        $data['duration'] = $this->job->duration;
        $data['status'] = $this->job->status;
        $data['gender'] = $this->job->gender;
        $data['certified'] = $this->job->certified;
        $data['due'] = $this->job->due;
        $data['job_type'] = $this->job->job_type;
        $data['customer_phone_type'] = $this->job->customer_phone_type;
        $data['customer_physical_type'] = $this->job->customer_physical_type;
        $data['customer_town'] = $user_meta->city;
        $data['customer_type'] = $user_meta->customer_type;

        $due_Date = explode(" ", $this->job->due);
        $due_date = $due_Date[0];
        $due_time = $due_Date[1];
        $data['due_date'] = $due_date;
        $data['due_time'] = $due_time;
        $data['job_for'] = array();
        if ($this->job->gender != null) {
            if ($this->job->gender == 'male') {
                $data['job_for'][] = 'Man';
            } else if ($this->job->gender == 'female') {
                $data['job_for'][] = 'Kvinna';
            }
        }
        if ($this->job->certified != null) {
            if ($this->job->certified == 'both') {
                $data['job_for'][] = 'normal';
                $data['job_for'][] = 'certified';
            } else if ($this->job->certified == 'yes') {
                $data['job_for'][] = 'certified';
            } else {
                $data['job_for'][] = $this->job->certified;
            }
        }

        return $data;
    }
}
