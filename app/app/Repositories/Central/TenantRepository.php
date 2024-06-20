<?php

namespace App\Repositories\Central;

use App\Http\Resources\Central\Api\Tenant\TenantCollection;
use App\Interfaces\Central\TenantRepositoryInterface;
use App\Models\Tenant;
use Illuminate\Support\Facades\Storage;

class TenantRepository implements TenantRepositoryInterface
{
    public function list_tenant()
    {
        $paginatedTenants = Tenant::paginate(15);
        $tenantCollection = new TenantCollection($paginatedTenants);
        $tenantCollection->setPaginator($paginatedTenants);
        return $tenantCollection;
    }
    public function get_tenant_by_id($id)
    {
        return Tenant::findOrFail($id);
    }
    public function store_tenant(array $data)
    {
        $tenantData = [
            'id' => $data['subfolder'],
            'company' => $data['company'],
            'provider' => $data['provider'],
            'subfolder' => config('app.url') . '/' . $data['subfolder']
        ];
        $tenantDirectory = 'tenants/' . $data['subfolder'];

        if (isset($data['favicon'])) {
            $extension = $data['favicon']->getClientOriginalExtension();
            $newFaviconName = 'favicon.' . $extension;
            $faviconPath = $data['favicon']->storeAs($tenantDirectory, $newFaviconName, 'public');
            $tenantData['favicon'] = $faviconPath;
        }

        if (isset($data['logo'])) {
            $extension = $data['logo']->getClientOriginalExtension();
            $newLogoName = 'logo.' . $extension;
            $logoPath = $data['logo']->storeAs($tenantDirectory, $newLogoName, 'public');
            $tenantData['logo'] = $logoPath;
        }

        if (isset($data['banner'])) {
            $extension = $data['banner']->getClientOriginalExtension();
            $newBannerName = 'banner.' . $extension;
            $bannerPath = $data['banner']->storeAs($tenantDirectory, $newBannerName, 'public');
            $tenantData['banner'] = $bannerPath;
        }

        if (isset($data['theme'])) {
            $themePath = $tenantDirectory . '/style.css';
            Storage::disk('public')->put($themePath, $data['theme']);
        } else {
            $themePath = $tenantDirectory . '/style.css';
            Storage::disk('public')->put($themePath, "/** Make your style css here */ ");
        }
        $tenantData['theme'] = $themePath;
        return Tenant::create($tenantData);
    }
    public function update_tenant(array $data, $id)
    {
        $tenant = Tenant::findOrFail($id);
        $tenantDirectory = 'tenants/' . $tenant->id;

        if (isset($data['favicon'])) {
            $extension = $data['favicon']->getClientOriginalExtension();
            $newFaviconName = 'favicon.' . $extension;
            $faviconPath = $data['favicon']->storeAs($tenantDirectory, $newFaviconName, 'public');
            $tenantData['favicon'] = $faviconPath;
        } else {
            $tenantData['favicon'] = $tenant->favicon;
        }

        if (isset($data['logo'])) {
            $extension = $data['logo']->getClientOriginalExtension();
            $newLogoName = 'logo.' . $extension;
            $logoPath = $data['logo']->storeAs($tenantDirectory, $newLogoName, 'public');
            $tenantData['logo'] = $logoPath;
        } else {
            $tenantData['logo'] = $tenant->logo;
        }

        if (isset($data['banner'])) {
            $extension = $data['banner']->getClientOriginalExtension();
            $newBannerName = 'banner.' . $extension;
            $bannerPath = $data['banner']->storeAs($tenantDirectory, $newBannerName, 'public');
            $tenantData['banner'] = $bannerPath;
        } else {
            $tenantData['banner'] = $tenant->banner;
        }

        if (isset($data['theme'])) {
            $themePath = $tenantDirectory . '/style.css';
            Storage::disk('public')->put($themePath, $data['theme']);
        } else {
            $themePath = $tenant->theme;
        }
        $tenantData['theme'] = $themePath;
        $tenant->update($tenantData);
        return Tenant::findOrFail($tenant->id);
    }
    public function delete_tenant($id)
    {

    }
}
