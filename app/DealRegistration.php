<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DealRegistration extends Model
{
    protected $fillable = [
        'auth_user',
        'first_name',
        'last_name',
        'email',
        'job_title',
        'company',
        'phone',
        'website',
        'address',
        'country',
        'headquarters',
        'indeustry',
        'good_relation',
        'meeting_scheduled_completed',
        'purchase_time_frame',
        'your_full_name',
        'your_full_email',
        'your_full_phone',
        'fwb_affiliate',
        'is_the_sales_rep_name',
    ];
}
