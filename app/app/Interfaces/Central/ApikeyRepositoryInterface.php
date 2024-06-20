<?php

namespace App\Interfaces\Central;

interface ApikeyRepositoryInterface
{
    public function list_apikey(array $params);
    public function get_apikey_by_id($id);
    public function store_apikey(array $data);
    public function delete_apikey($id);
}
