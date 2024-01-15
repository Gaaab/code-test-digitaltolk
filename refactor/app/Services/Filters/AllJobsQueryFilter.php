<?php

namespace App\Services\Filters;

use Illuminate\Support\Facades\DB;

class AllJobsQueryFilter
{
    public function __construct(
        protected $currentUser =  null,
        protected $customerType = null
    )
    {
    }

    public function id($query, $values)
    {
        if (is_array($values)) {
            $query->whereIn('id', $values);
        }
        else {
            $query->where('id', $values);
        }

        return $query;
    }

    public function feedback($query)
    {
        $query->where('ignore_feedback', '0');

        $query->whereHas('feedback', function ($q) {
            $q->where('rating', '<=', '3');
        });

        return $query;
    }

    public function lang($query, $values)
    {
        $query->whereIn('from_language_id', $values);

        return $query;
    }

    public function status($query, $values)
    {
        $query->whereIn('status', $values);

        return $query;
    }

    public function customer_email($query, $values)
    {
        $users = DB::table('users')->whereIn('email', $values)->get();

        if ($users->count()) {
            $query->whereIn('user_id', collect($users)->pluck('id')->all());
        }

        return $query;
    }

    public function filter_timetype($query, $value, array $inputs)
    {
        $determineColumn = $value === 'created' ? 'created_at' : 'due';

        if (!$value) return $query;

        if ($inputs['from'] ?: false) {
            $query->where($determineColumn, '>=', $inputs['from']);
        }

        if ($inputs['to'] ?: false) {
            $to = $inputs['to'] . " 23:59:00";
            $query->where($determineColumn, '<=', $to);
        }

        $query->orderBy($determineColumn, 'desc');

        return $query;
    }

    public function physical($query, $value, array $inputs)
    {
        $query->where('customer_physical_type', $value);
        $query->where('ignore_physical', 0);

        return $query;
    }

    public function phone($query, $value, array $inputs)
    {
        $query->where('customer_phone_type', $value);

        if (isset($inputs['physical']))
            $query->where('ignore_physical_phone', 0);

        return $query;
    }
    // @TODO: Complete all filter logic here ...
}
