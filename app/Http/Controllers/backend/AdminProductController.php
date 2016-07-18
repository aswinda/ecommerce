<?php namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use App\Model\Product as Product;
use App\Model\Brand as Brand;
use App\Model\ProductCategory as ProductCategory;
use App\Model\ProductImage as ProductImage;
use Input;
use Redirect;
use File;

class AdminProductController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$products = Product::listProduct();

		return view('backend.product.index')
			->with('tab1', 'Product')
			->with('title', 'Products')
			->with('titleDescription', 'Manage Products')
			->with('products', $products);
	}

	public function create()
	{
		$categories = ProductCategory::all();
		$brands = Brand::all();

		return view('backend.product.create')
			->with('tab1', 'Products')
			->with('tab2', 'Create')
			->with('title', 'Products')
			->with('titleDescription', 'Create')
			->with('categories', $categories)
			->with('brands', $brands);
	}

	public function store()
	{
		$product = new Product;
		$product->name = Input::get('name');
		$product->brand_id = Input::get('brand');
		$product->product_category_id = Input::get('category');
		$product->price = Input::get('price');
		if(empty(Input::get('is_featured')))
			$product->is_featured = 0;
		else
			$product->is_featured = 1;

		$product->save();

		$image = new ProductImage;
		$image->product_id = $product->id;
		
		// Store Image
		if (Input::file('file') != NULL)
		{
			if(Input::file('file')->getClientMimeType() != 'image/jpeg' &&
			Input::file('file')->getClientMimeType() != 'image/jpg' &&
			Input::file('file')->getClientMimeType() != 'image/png'  &&
			Input::file('file')->getClientMimeType() != 'image/bmp')
			{
				return Redirect::back()
					->with('errors', 'File Harus gambar dan bertipe jpeg, jpg, png');
			}

			
			$file = Input::file('file');
			$name = strtotime("now");
			$extension = str_replace("image/", "", $file->getClientMimeType());
			$image->image = $name.'.'.$extension;
			
			Input::file('file')->move(public_path().'/images/products',$image->image);

			$image->save();
		}


		return Redirect::to('admin/product')
			->with('message', 'product has been added');
	}

	public function edit($id)
	{
		$categories = ProductCategory::all();
		$brands = Brand::all();
		$product = Product::detailProductWithImage($id);

		return view('backend.product.edit')
			->with('tab1', 'products')
			->with('title', 'products')
			->with('titleDescription', 'Edit')
			->with('product', $product)
			->with('categories', $categories)
			->with('brands', $brands);
	}

	public function update($id)
	{
		$product = Product::find($id);
		$product->name = Input::get('name');
		$product->brand_id = Input::get('brand');
		$product->product_category_id = Input::get('category');
		$product->price = Input::get('price');
		if(empty(Input::get('is_featured')))
			$product->is_featured = 0;
		else
			$product->is_featured = 1;

		$product->save();

		/*$image = new ProductImage;
		$image->product_id = $product->id;

		// Store Image
		if (Input::file('file') != NULL)
		{
			// delete old image

			//File::delete(public_path().'/images/products/'.$profile->photo);

			if(Input::file('file')->getClientMimeType() != 'image/jpeg' &&
			Input::file('file')->getClientMimeType() != 'image/jpg' &&
			Input::file('file')->getClientMimeType() != 'image/png'  &&
			Input::file('file')->getClientMimeType() != 'image/bmp')
			{
				return Redirect::back()
					->with('errors', 'File Harus gambar dan bertipe jpeg, jpg, png');
			}

			
			$file = Input::file('file');
			$name = strtotime("now");
			$extension = str_replace("image/", "", $file->getClientMimeType());
			$profile->photo = $name.'.'.$extension;
			Input::file('file')->move(public_path().'/images/profiles',$profile->photo);

			$image->save();
		}

		*/
		return Redirect::to('admin/product')
			->with('message', 'Product has been updated!');
	}

	public function delete($id)
	{
		Product::destroy($id);
		return Redirect::to('admin/product')
			->with('message', 'Product has been deleted!');
	}

	public function show($id)
	{
		$product = Product::detailProductWithImage($id);

		return view('backend.product.show')
			->with('tab1', 'products')
			->with('title', 'products')
			->with('titleDescription', 'show')
			->with('product', $product);
	}

}
