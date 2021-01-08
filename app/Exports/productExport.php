<?php

namespace App\Exports;

use App\Product;
use App\Category;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class productExport implements WithHeadings,FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $productData = Product::select('category_id','product_name','product_code','product_color','price')->where('status',1)->orderBy('id','Desc')->get();
        foreach($productData as $key => $product){
        	$catname = Category::select('category_name')->where('id',$product->category_id)->first();
        	$productData[$key]->category_id = $catname->category_name;
        }
        return $productData;
    }
    public function headings(): array{
    	return ['Category Name','Product Name','Product Code','Product Color','Price'];
    }
}
