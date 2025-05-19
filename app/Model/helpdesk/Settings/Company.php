<?php

namespace App\Model\helpdesk\Settings;

use App\BaseModel;

class Company extends BaseModel
{
    protected $table = 'settings_company';

    protected $fillable = [
        'company_name', 'website', 'phone', 'address', 'landing_page', 'offline_page',
        'thank_page', 'logo', 'use_logo', 'favicon',
        'header_bg_color', 'menu_bg_color', 'button_bg_color', 'footer_bg_color',
    ];
}
