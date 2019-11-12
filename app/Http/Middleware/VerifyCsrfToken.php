<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/submit_aircraft/upload',
        '/MasterRequest/upload',
        '/user/upload',
        '/submit_engine/attachment',
        '/submit_special/attachment',
        '/submit_vendor/upload',
        '/submit_component_personel/attachment',
        'vendor_attach/attachment',
        '/submit_component_document/attachment',
        '/submit_component_test_equipment/attachment',
        '/submit_component_special_tool/attachment',
        '/submit_attachment/attachment',
        '/submit_app_config/attachment',
        '/attachmentResubmit/attachment',
        '/MedicalClaim/upload',
        '/Nda/upload'
    ];
}
