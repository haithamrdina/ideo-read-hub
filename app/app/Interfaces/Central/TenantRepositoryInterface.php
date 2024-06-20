<?php

namespace App\Interfaces\Central;

interface TenantRepositoryInterface
{
    public function list_tenant();
    public function get_tenant_by_id($id);
    public function store_tenant(array $data);
    public function update_tenant(array $data, $id);
    public function delete_tenant($id);
}
