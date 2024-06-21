<?php

namespace App\Repositories\Central;

use App\Http\Resources\Central\Api\Section\SectionCollection;
use App\Interfaces\Central\SectionRepositoryInterface;
use App\Models\Product;
use App\Models\Section;

class SectionRepository implements SectionRepositoryInterface
{
    public function list_section(array $params)
    {
        if (!isset($params['tenant_id'])) {
            $paginatedSections = Section::with('products')->paginate($params['page_size']);
            $sectionCollection = new SectionCollection($paginatedSections);
        } else {
            $paginatedSections = Section::with('products')->where('tenant_id', $params['tenant_id'])->paginate(15);
            $sectionCollection = new SectionCollection($paginatedSections);
        }

        $sectionCollection->setPaginator($paginatedSections);
        return $sectionCollection;
    }
    public function get_section_by_id($id)
    {
        return Section::with('products')->findOrFail($id);
    }
    public function store_section(array $data)
    {
        $section = Section::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'tenant_id' => $data['tenant_id'],
        ]);
        if (isset($data['products'])) {
            $products = preg_split('/[\s,]+/', trim($data['products']));
            $productsIDs = Product::whereIn('productId', $products)->pluck('id')->toArray();
            $order = 1;
            foreach ($productsIDs as $productId) {
                $section->products()->attach($productId, ['order' => $order]);
                $order++;
            }
        }
        return Section::with('products')->findOrFail($section->id);
    }
    public function update_section(array $data, $id)
    {
        $section = Section::findOrFail($id);
        $section->update($data);
        return Section::with('products')->findOrFail($section->id);
    }
    public function delete_section($id)
    {
        $section = Section::findOrFail($id);
        if ($section) {
            Section::destroy($section->id);
        }
    }
}
