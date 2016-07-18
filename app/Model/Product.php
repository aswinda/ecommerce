<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Product extends Model {
	
	protected $table = 'products';

	public static function listProduct()
	{
		// group id 5, user customer tidak ditampilkan
		$list = DB::select( DB::raw("SELECT 
							products.id AS product_id,
							products.name AS name,
							brands.name AS brand_name,
							products.price,
							products_categories.name AS category,
							is_featured 
						FROM 
							products, 
							products_categories,
							brands
						WHERE 
							products.product_category_id = products_categories.id AND
							products.brand_id = brands.id")
		);
		

		return $list;
	}

	public static function detailProductWithImage($id)
	{
		$list = DB::select( DB::raw(
				"SELECT 
					products.id AS product_id,
					products.name AS name,
					products.brand_id,
					brands.name AS brand_name,
					products.product_category_id,
					products.price,
					products_categories.name AS category,
					is_featured,
					image
				FROM 
					products, 
					products_categories,
					products_images,
					brands
				WHERE 
					products.id = :id AND
					products.brand_id = brands.id AND
					products.product_category_id = products_categories.id AND 
					products_images.product_id = products.id
					"), 

			array(
				"id"	=> $id
			));

		return $list[0];
	}

}
