<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Enums\Aimed;
use App\Enums\ContentType;
use App\Enums\Cost;
use App\Enums\Target;
use App\Models\User;
use App\Enums\Role;
use App\Http\Requests\StoreContentRequest;
use App\Http\Requests\UpdateContentRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Result;
use App\Models\Language;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.contents.index')
            ->with('contents', Content::filterUser($request->user())->filter($request->toArray())->paginate());
    }

    public function show(Content $content)
    {
        if (!$content->status) return to_route('content.search');
        if (!$content->user->isPaying() && auth()->user()->role->value !== Role::Admin->value) return to_route('content.search');

        $isPaid = false;

        $havePurchase = false;

        if (Auth::check()) {
            $isPaid = $content->purchases()->where('user_id', auth()->user()->id)->where('status', true)->count() > 0;
            $havePurchase = $content->purchases()->where('user_id', auth()->user()->id)->first();
        }

        $admin = User::where('role', Role::Admin->value)->first();

        return view('front.contents.show', ['content' => $content])
            ->with('contents', Content::filterByUserStatus()->filterByContentStatus()->take(32)->get())
            ->withIsPaid($isPaid)
            ->withAdmin($admin)
            ->withHavePurchase($havePurchase);
    }

    public function create()
    {
        $practitinoers = User::where('role', Role::ServiceProvider->value)->where('status', true)->get();

        $this->authorize('create', Content::class);
            return view('admin.contents.create')
            ->withCosts(Cost::cases())
            ->withContentTypes(ContentType::cases())
            ->withAimed(Aimed::cases())
            ->withTargets(Target::cases())
            ->withLanguages(Language::all())
            ->withCategories(Category::all())
            ->withGoals(Result::all())
            ->withSubcategories(Subcategory::all())
            ->withPractitioners($practitinoers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreContentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContentRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = auth()->id();
        if(isset($data['practitioner'])) $data['user_id'] = $data['practitioner'];
        $data['thumbnail'] = $request->file('thumbnail')->store('images', 'public');
        $data['status'] = false;

        return DB::transaction(function () use ($data) {
            $content = Content::create($data);

            $content->user()->associate(Auth::user());

            collect($data['learns'] ?? [])->each(fn ($learn) => !empty($learn['name']) ? $content->learns()->create($learn) : true);

            $content->categories()->sync(collect($data['categories'] ?? [])->pluck('id'));
            $content->subcategories()->sync(collect($data['subcategories'] ?? [])->pluck('id'));
            $content->goals()->sync(collect($data['goals'] ?? [])->pluck('id'));
            $content->languages()->sync(collect($data['languages'] ?? [])->pluck('id'));
            if (isset($data['lessons'])) $content->syncLessons($data['lessons']);

            return redirect()->route('contents.index');
        });

    }

    public function edit(Content $content)
    {
        return view('admin.contents.edit')
            ->withCosts(Cost::cases())
            ->withContentTypes(ContentType::cases())
            ->withAimed(Aimed::cases())
            ->withTargets(Target::cases())
            ->withLanguages(Language::all())
            ->withCategories(Category::all())
            ->withGoals(Result::all())
            ->withSubcategories(Subcategory::all())
            ->withContent($content->loadMissing('goals', 'categories', 'subcategories', 'user', 'languages', 'lessons'));
    }

    public function update(UpdateContentRequest $request, Content $content)
    {
        $data = $request->validated();

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('images', 'public');
        }

        DB::transaction(function () use ($content, $data) {
            if (!isset($data->status)) {
                $content['status'] = false;
            }
            $content->update($data);

            $content->learns()->delete();

            collect($data['learns'] ?? [])->each(fn ($learn) => !empty($learn['name']) ? $content->learns()->create($learn) : true);

            $content->categories()->sync(collect($data['categories'] ?? [])->pluck('id'));
            $content->subcategories()->sync(collect($data['subcategories'] ?? [])->pluck('id'));
            $content->goals()->sync(collect($data['goals'] ?? [])->pluck('id'));
            $content->languages()->sync(collect($data['languages'] ?? [])->pluck('id'));
            $content->lessons()->delete();
            if (isset($data['lessons'])) $content->syncLessons($data['lessons']);
        });

        return redirect()->route('contents.index');
    }

    public function search(Request $request)
    {
        $contents = Content::filter($request->toArray())
        ->filterByUserPlan()
        ->filterByUserStatus()
        ->filterByContentStatus()
        ->search($request->toArray())
        ->paginate(9);

        return view('front.contents.search')
            ->withContents($contents)
            ->withResults(Result::all())
            ->withCategories(Category::all())
            ->withSubcategories(Subcategory::all())
            ->withLanguages(Language::all())
            ->withAimeds(Aimed::class)
            ->withTargets(Target::class)
            ->withTypes(ContentType::class);
    }

    public function destroy(Content $content)
    {
        if($content->purchases()->count() > 0) return to_route('contents.index')->with('message', 'Unable to delete a content belonging to an order!');
        $content->delete();

        return to_route('contents.index');
    }

    public function replicate(Content $content)
    {
            $message = 'You need to insert the photos again!';
            $practitioners = User::where('role', Role::ServiceProvider->value)->where('status', true)->get();

            return view('admin.contents.create')
            ->withContent($content)
            ->withCosts(Cost::cases())
            ->withContentTypes(ContentType::cases())
            ->withMessage($message)
            ->withGoals(Result::all())
            ->withCategories(Category::all())
            ->withSubcategories(Subcategory::all())
            ->withLanguages(Language::all())
            ->withAimeds(Aimed::class)
            ->withTargets(Target::class)
            ->withTypes(ContentType::class)
            ->withPractitioners($practitioners);
    }

    public function changeStatus(Content $content)
    {
        $content->status = !$content->status;
        $content->save();

        return to_route('contents.index');
    }
}
