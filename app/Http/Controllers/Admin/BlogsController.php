<?php

namespace App\Http\Controllers\Admin;


use App\Models\PrintfulOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Products;
use App\Models\Blogs;
use App\Models\BlogReview;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Form;
use Validator;
use Auth;
use Illuminate\Support\Str;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (auth()->check() && auth()->user()->role == 1) {
                return $next($request);
            }

            abort(403, 'Unauthorized');
        });
    }

    public function index()
    {
        $blogs = Blogs::paginate(5);
        return view('admin.pages.blogs.index')->with('blogs', $blogs)->with('activeLink', 'blogs');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.blogs.create')->with('activeLink', 'blogs');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required|string|max:255',
            'description' => 'required',
            'feature_image' => '',
            'blog_image' => '',
            'meta_title' => 'string|max:255',
            'meta_description' => '',
            'meta_keyword' => 'string|max:255'
        ]);

        // Handle image uploads
        $feature_image = $request->file('feature_image')->store('public/images');
        $blog_image = $request->file('blog_image')->store('public/images');

        // Save data to the database
        $blog = new Blogs();
        $blog->title = $request->input('title');
        $blog->description = $request->input('description');
        $blog->feature_image = $feature_image;
        $blog->blog_image = $blog_image;
        $blog->meta_title = $request->input('meta_title');
        $blog->meta_description = $request->input('meta_description');
        $blog->meta_keywords = $request->input('meta_keywords');

        $slug = Str::slug($request->input('title'));
        $existingSlug = Blogs::where('slug', $slug)->exists();

        if ($existingSlug) {
            $counter = 1;
            do {
                $newSlug = $slug . '-' . $counter;
                $existingSlug = Blogs::where('slug', $newSlug)->exists();
                $counter++;
            } while ($existingSlug);
            $slug = $newSlug;
        }

        // Save the blog
        $blog->slug = $slug;
        $blog->save();
        return redirect('/admin/blogs')->with('success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Products $product)
    {

        return view('products.show')->with('products', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //echo "<pre>"; print_r($id); die;
        $blog = Blogs::find($id);
        return view('admin.pages.blogs.edit')->with('blog', $blog)->with('activeLink', 'blogs');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //echo "<pre>"; print_r($request->all()); die;
        $blog = Blogs::find($id);
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'description' => 'required',
            'feature_image' => '',
            'blog_image' => '',
            'meta_title' => 'string|max:255',
            'meta_description' => '',
            'meta_keyword' => 'string|max:255'
        ]);

        // Handle image uploads

        $feature_image = $blog->feature_image;
        if ($request->file('feature_image')) {
            $feature_image = $request->file('feature_image')->store('public/images');
        }

        $blog_image = $blog->blog_image;
        if ($request->file('blog_image')) {
            $blog_image = $request->file('blog_image')->store('public/images');
        }

        // Save data to the database          
        //$blog = new Blogs();
        $blog->title = $request->input('title');
        $blog->description = $request->input('description');
        $blog->blog_image = $blog_image;
        $blog->feature_image = $feature_image;
        $blog->meta_title = $request->input('meta_title');
        $blog->meta_description = $request->input('meta_description');
        $blog->meta_keywords = $request->input('meta_keywords');

        $slug = Str::slug($request->input('title'));
        $existingSlug = Blogs::where('slug', $slug)->where('id','!=',$id)->exists();

        if ($existingSlug) {
            $counter = 1;
            do {
                $newSlug = $slug . '-' . $counter;
                $existingSlug = Blogs::where('slug', $newSlug)->exists();
                $counter++;
            } while ($existingSlug);
            $slug = $newSlug;
        }

        // Save the product
        $blog->slug = $slug;
        $blog->update();
        return redirect('/admin/blogs')->with('success');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  Products $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {


        //delete image from local folder "/photo/"
        //Storage::delete($product->product_image);

        //delete product title, description, amount and image from MySQL
        $product = Blogs::find($id);
        $product->delete();
        return redirect('/admin/blogs')->with('delete', ' ');
    }

    //FRONTEND CONTROL -  ANY PRODUCT SHOW LIST, AND  INDIVIDUAL PRODUCT VIEW
    public function product_show()
    {

        $products = Products::paginate(4);

        return view('products.product_show')->with('products', $products);
    }
    public function product_view(Products $product)
    {


        return view('products.product_view')->with('products', $product);
    }
    public function create_template(Request $request, $id)
    {
        $product = Products::find($id);

        $product->front_image = fileToUrl($product->front_image);
        $product->back_image = fileToUrl($product->back_image);
        $product->left_image = fileToUrl($product->left_image);
        $product->right_image = fileToUrl($product->right_image);
        return view('admin.pages.product.createTemplate')->with('product', $product);
    }

    public function store_template(Request $request)
    {

        // simulate store template

        // return
        //     response($request)
        //         ->header('Content-Type', 'text/json');

        // $this->validate($request, [
        //     'product_name' => 'required|min:3|max:50',
        //     'commission' => 'required',
        //     'supporting_country' => 'required',
        //     'product_for' => 'required',
        //     'product_type' => 'required',
        //     'product_sub_type' => 'required',
        //     'front_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'back_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'right_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'left_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        // ]);



        // Save data to the database
        $product = new Products();
        $product->product_name = $request->product_name;
        $product->commission = $request->commission;
        $product->supporting_country = $request->supporting_country;
        $product->product_for = $request->product_for;
        $product->product_type = $request->product_type;
        $product->product_sub_type = $request->product_sub_type;
        $product->front_image = $request->frontImage;
        $product->back_image = $request->backImage;
        $product->right_image = $request->rightImage;
        $product->left_image = $request->leftImage;

        // Save the product
        $product->save();

        // return $product;
        return
            response($product)
            ->header('Content-Type', 'text/json');
    }

    public function get_template(Request $request)
    {
        $product = Products::latest()->first();
        $product->front_image = fileToUrl($product->front_image);
        $product->back_image = fileToUrl($product->back_image);
        $product->left_image = fileToUrl($product->left_image);
        $product->right_image = fileToUrl($product->right_image);
        return
            response($product)
            ->header('Content-Type', 'text/json');
    }

    public function updateApi(Request $request, $id)
    {

        $product = Products::find($id);
        $this->validate($request, [
            'front_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'back_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'right_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'left_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle image uploads

        if ($request->file('front_image')) {
            $frontImage = $request->file('front_image')->store('public/images');
            $product->front_image = $frontImage;
        }

        if ($request->file('back_image')) {
            $backImage = $request->file('back_image')->store('public/images');
            $product->back_image = $backImage;
        }

        if ($request->file('right_image')) {
            $rightImage = $request->file('right_image')->store('public/images');
            $product->right_image = $rightImage;
        }

        if ($request->file('left_image')) {
            $leftImage = $request->file('left_image')->store('public/images');
            $product->left_image = $leftImage;
        }
        $product->imageData = $request->input('imageData');
        // Save the product
        $product->update();
        return
            response($product)
            ->header('Content-Type', 'text/json');
    }

    public function storeViaApi(Request $request)
    {

        try {
            $_request = json_decode($request->getContent());

            // $this->validate($request, [
            //     'product_name' => 'required',
            //     'product_price' => 'required',
            //     'product_description' => '',
            //     'commission' => 'required',
            //     'supporting_country' => '',
            //     'product_for' => 'required',
            //     'product_type' => 'required',
            //     'product_sub_type' => '',
            //     'front_image' => '',
            //     'front_image_price' => 'required',
            //     'front_image_donation' => '',
            //     'back_image' => '',
            //     'back_image_price' => 'required',
            //     'back_image_donation' => '',
            //     'right_image' => '',
            //     'left_image' => '',
            //     'seo_title' => '',
            //     'meta_description' => '',
            //     'meta_keyword' => '',
            //     'product_x_axis' => '',
            //     'product_y_axis' => '',
            //     'product_width' => '',
            //     'product_height' => ''
            // ]);

            // Handle image uploads
            // $frontImage = $request->file('front_image')->store('public/images');
            // $backImage = $request->file('back_image')->store('public/images');
            // $rightImage = $request->file('right_image')->store('public/images');
            // $leftImage = $request->file('left_image')->store('public/images');

            // Save data to the database
            $product = new Products();
            $product->product_name = $_request->product_name;
            $product->product_price = $_request->product_price;
            $product->product_description = $_request->product_description;
            $product->commission = $_request->commission;
            $product->supporting_country = $_request->supporting_country;
            $product->product_for = $_request->product_for;
            $product->product_type = $_request->product_type;
            $product->product_sub_type = $_request->product_sub_type;
            $product->front_image = $_request->front_image;
            $product->front_image_price = $_request->front_image_price;
            $product->front_image_donation = $_request->front_image_donation;
            $product->back_image = $_request->back_image;
            $product->back_image_price = $_request->back_image_price;
            $product->back_image_donation = $_request->back_image_donation;
            $product->right_image = $_request->right_image;
            $product->left_image = $_request->left_image;
            $product->seo_title = $_request->seo_title;
            $product->meta_description = $_request->meta_description;
            $product->meta_keyword = $_request->meta_keyword;
            $product->product_x_axis = $_request->product_x_axis;
            $product->product_y_axis = $_request->product_y_axis;
            $product->product_width = $_request->product_width;
            $product->product_height = $_request->product_height;
            $slug = Str::slug($_request->product_name);
            $existingSlug = Products::where('product_slug', $slug)->exists();

            if ($existingSlug) {
                $counter = 1;
                do {
                    $newSlug = $slug . '-' . $counter;
                    $existingSlug = Products::where('product_slug', $newSlug)->exists();
                    $counter++;
                } while ($existingSlug);
                $slug = $newSlug;
            }

            // Save the product
            $product->product_slug = $slug;
            $product->save();
            return response($product)
                ->header('Content-Type', 'text/json');
        } catch (\Exception $e) {
            // Handling the exception
            return response()->json([
                'error' => [
                    'message' => $e->getMessage(), // Retrieve the error message
                    'code' => $e->getCode(), // Retrieve the error code
                ]
            ], 500); // Internal Server Error status code
        }
    }

    public function moderate(Request $request){
        $blogs = BlogReview::where('blog_id',$request->id)->paginate();
        return view('admin.pages.blogs.moderate')->with('blogs', $blogs)->with('activeLink', 'blogs');;
    }

    public function changestatus(Request $request){
        $blogs = BlogReview::where('id',$request->id)->update(['status'=>$request->status]);
        return redirect()->back()->with('status', 'Status Changed Successfully');
    }
}
