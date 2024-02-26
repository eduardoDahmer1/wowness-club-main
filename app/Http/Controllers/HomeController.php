<?php

namespace App\Http\Controllers;

use App\Enums\Cost;
use App\Enums\Role;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Service;
use App\Models\Result;
use App\Models\Category;
use App\Enums\Type;
use App\Models\Content;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::filterByPostStatus()->filterByPostDate()->whereNull('video')->take(3)->get();

        $services = Service::whereHas('results', function (Builder $query) {
            $query->where('result_id', 2);
        })->whereHas('packages', function (Builder $query) {
            $query->where('price', '>', 0);
        })->filterByUserStatus()->filterByServiceStatus()->orderByRaw('updated_at - created_at ASC')->take(15)->get();

        $paidContents = Content::whereHas('results', function (Builder $query) {
            $query->where('result_id', 1);
        })->FilterByUserStatus()->FilterByContentStatus()->where('cost', Cost::Paid->value)->take(12)->get();

        $freeContents = Content::whereHas('results', function (Builder $query) {
            $query->where('result_id', 5);
        })->FilterByUserStatus()->FilterByContentStatus()->where('cost', Cost::Free->value)->take(12)->get();

        $facilitators = User::where('status', 1)->where('role', Role::ServiceProvider->value)

            ->positionDesc()->take(16)->get();
        return view('front.home', compact('facilitators', 'posts'))
            ->with('results', Result::all())
            ->with('types', Type::cases())
            ->with('categories', Category::all())
            ->with('services', $services)
            ->with('paidcontents',$paidContents)
            ->with('freecontents',$freeContents);
    }
}
