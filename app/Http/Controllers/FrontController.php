<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Announcement;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function home () {

        $announcements = Announcement::where('is_accepted',true)->orderBy('created_at','desc')->take(6)->get();

        return view('home.index', compact('announcements'));
    }

    public function categoryShow(Category $category){
        return view('category.show',compact('category'));
    }

    public function searchAnnouncements(Request $request){
        $announcements = Announcement::search($request->searched)->where('is_accepted',true)->paginate(6);

        return view('announcements.index',compact('announcements'));
    }
}
