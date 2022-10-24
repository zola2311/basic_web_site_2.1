<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    //
    public function AllCat(){
        // by using eloquent orm read data
//         $categories = Category::all();

         //making latest data appear first
//                $categories = Category::latest()->paginate(5);

                //using query builder method with pagination
//         $categories = DB::table('categories')->latest()->paginate(5);
//         return view('admin.category.index', compact('categories'));

//query builder method
//         $categories = DB::table('categories')
//                 ->join('users','categories.user_id','users.id')
//                 ->select('categories.*','users.name')
//                 ->latest()->paginate(5);


        $categories = Category::latest()->paginate(5);
//        return view('admin.category.index', compact('categories'));
       $trachCat = Category::onlyTrashed()->latest()->paginate(3);

        // $categories = DB::table('categories')->latest()->paginate(5);
//        return view('admin.category.index');

       return view('admin.category.index', compact('categories','trachCat'));
    }
    public function AddCat(Request $request){
        $validatedData = $request->validate([
            'category_name' => 'required|unique:categories|max:255',

        ],
            [//custom message
                'category_name.required' => 'Please Input Category Name',
                'category_name.max' => 'Category Less Then 255Chars',
            ]);
//eloquent orm way
        Category::insert([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,// take id of authenticated user
            'created_at' => Carbon::now()
        ]);
//another way of inserting(preferable)
//         $category = new Category;
//         $category->category_name = $request->category_name;
//         $category->user_id = Auth::user()->id;
//         $category->save();
//using query builder method
//         $data = array();
//         $data['category_name'] = $request->category_name;
//         $data['user_id'] = Auth::user()->id;
//         DB::table('categories')->insert($data);

        return Redirect()->back()->with('success','Category Inserted Successfully');

    }

    public function Edit($id){
        // eloquent orm way
        // $categories = Category::find($id);
       //query builder way
        $categories = DB::table('categories')->where('id',$id)->first();
        return view('admin.category.edit',compact('categories'));

    }
//
//
    public function Update(Request $request ,$id){
//        // eloquent orm way
//         $update = Category::find($id)->update([
//             'category_name' => $request->category_name,
//             'user_id' => Auth::user()->id
//
//         ]);
// //query builder way
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        DB::table('categories')->where('id',$id)->update($data);

        return Redirect()->route('all.category')->with('success','Category Updated Successfull');
//
    }
//
//
    public function SoftDelete($id){
        $delete = Category::find($id)->delete();
        return Redirect()->back()->with('success','Category Soft Delete Successfully');
    }
//
//
    public function Restore($id){
        $delete = Category::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success','Category Restore Successfully');

    }

    public function Pdelete($id){
        $delete = Category::onlyTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('success','Category Permanently Deleted');
    }

}
