<?php

namespace App\Models;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Wildside\Userstamps\Userstamps;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;
    use Userstamps;


    public static function getCustomColumns(): array
    {
        return [
            'id',
            'company',
            'provider',
            'subfolder',
            'status',
            'favicon',
            'logo',
            'banner',
            'theme'
        ];
    }
}
