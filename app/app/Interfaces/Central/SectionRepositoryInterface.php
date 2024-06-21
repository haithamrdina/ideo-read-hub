<?php

namespace App\Interfaces\Central;

interface SectionRepositoryInterface
{
    public function list_section(array $params);
    public function get_section_by_id($id);
    public function store_section(array $data);
    public function update_section(array $data, $id);
    public function delete_section($id);
}
