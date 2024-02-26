<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Enums\Cost;
use App\Http\Requests\StoreSeekerToPractitioner;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;
use App\Mail\ApprovedProfile;
use App\Models\Certificate;
use App\Models\Country;
use App\Models\User;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Language;
use App\Models\Review;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Service;
use App\Models\Content;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', User::class);
        return view('admin.users.index', [
            'users' => User::filter($request->toArray())->where('role', Role::ServiceProvider)->paginate()
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('practitionerViewAny', User::class);
        return view('admin.users.create', [
            'countries' => Country::orderBy('name')->get(),
            'languages' => Language::all(),
            'categories' => Category::all(),
            'subcategories' => Subcategory::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        $data = $request->validated();

        if ($request->photo) {
            $path = $request->file('photo')->store('images', 'public');
            $data['photo'] = $path;
        }

        $user = User::create($data);

        collect($data['specialisations'] ?? [])->each(fn ($specialisation) => !empty($specialisation['name']) ? $user->specialisations()->create($specialisation) : true);
        collect($data['testimonials'] ?? [])->each(fn ($testimonial) => !empty($testimonial['name']) ? $user->testimonials()->create($testimonial) : true);

        $user->categoriesuser()->sync(collect($data['categories'] ?? [])->pluck('id'));
        $user->subcategoriesuser()->sync(collect($data['subcategories'] ?? [])->pluck('id'));
        $user->languages()->sync(collect($data['languages'] ?? [])->pluck('id'));

        if ($request->certificates) {
            foreach ($request->file('certificates') as $certificate) {
                $path = $certificate->store('certificates', 'public');
                $original_name = $certificate->getClientOriginalName();
                Certificate::create([
                    'user_id' => $user->id,
                    'file' => $path,
                    'original_name' => $original_name
                ]);
            }
        }

        Mail::to($user)->when($user->status == 1)->send(new ApprovedProfile($user));
        return redirect()->route('users.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('admin.users.edit', [
            'user' => $user,
            'countries' => Country::orderBy('name')->get(),
            'roles' => Role::cases(),
            'languages' => Language::all(),
            'categories' => Category::all(),
            'subcategories' => Subcategory::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, User $user)
    {
        $this->authorize('update', $user);
        $data = $request->validated();

        if ($request->photo) {
            $path = $request->file('photo')->store('images', 'public');
            $data['photo'] = $path;
        }

        if ($request->certificates) {
            foreach ($request->file('certificates') as $certificate) {
                $path = $certificate->store('certificates', 'public');
                $original_name = $certificate->getClientOriginalName();
                Certificate::create([
                    'user_id' => $user->id,
                    'file' => $path,
                    'original_name' => $original_name
                ]);
            }
        }

        if ($request->user()->isMaintainer() || $request->user()->isAdmin()) {
            $data['status'] = isset($data['status']) && $data['status'] == '1';
        } else {
            unset($data['status']);
        }

        $user->update($data);

        $user->specialisations()->delete();
        $user->testimonials()->delete();

        collect($data['specialisations'] ?? [])->each(fn ($specialisation) => !empty($specialisation['name']) ? $user->specialisations()->create($specialisation) : true);
        collect($data['testimonials'] ?? [])->each(fn ($testimonial) => !empty($testimonial['name']) ? $user->testimonials()->create($testimonial) : true);

        $user->categoriesuser()->sync(collect($data['categories'] ?? [])->pluck('id'));
        $user->subcategoriesuser()->sync(collect($data['subcategories'] ?? [])->pluck('id'));

        $user->languages()->sync(collect($data['languages'] ?? [])->pluck('id'));

        if ($request->user()->isServiceProvider()) {
            return redirect()->route('dashboard');
        }
        Mail::to($user)->when($user->status == 1)->send(new ApprovedProfile($user));
        return redirect()->route('users.index');
    }


    public function changeStatus(User $user)
    {
        $user->status = !$user->status;
        $user->save();

        Mail::to($user)->when($user->status == 1)->send(new ApprovedProfile($user));

        return redirect()->route('users.index');
    }

    public function show(User $facilitator)
    {
        $services = Service::whereHas('packages')
            ->join('timezones', 'services.timezone_id', '=', 'timezones.id')
            ->select('services.*', 'timezones.timezone')
            ->where(function ($query) {
                $query->where(function ($query) {
                    $query->where('services.type', 2)
                        ->orWhere('services.recurring', 6);
                })->whereRaw('custom_end_date >= (NOW() + INTERVAL timezones.timezone HOUR)');
            })
            ->orWhere(function ($query) {
                $query->where('services.type', '<>', 2)->where('services.recurring', '<>', 6)
                    ->whereRaw('end >= (NOW() + INTERVAL timezones.timezone HOUR)');
            })
            ->filterByUserStatus()
            ->filterByServiceStatus()
            ->where('user_id', $facilitator->id)
            ->select('services.*')
            ->paginate(8);

        $paidContents = Content::where('user_id', $facilitator->id)->where('cost', Cost::Paid->value)->take(12)->get();
        $freeContents = Content::where('user_id', $facilitator->id)->where('cost', Cost::Free->value)->take(12)->get();

        $reviews = Review::where('status', 1)->where('user_id', $facilitator->id)->take(3)->get();
        $reviewsCount = Review::where('status', 1)->where('user_id', $facilitator->id)->count();

        return view('front.users.show', [
            'user' => $facilitator,
        ])
            ->with('services', $services)
            ->with('paidcontents', $paidContents)
            ->with('freecontents', $freeContents)
            ->with('reviews', $reviews)
            ->with('reviewsCount', $reviewsCount);
    }

    public function deleteCertificate(Certificate $certificate)
    {
        $this->authorize('delete', $certificate);

        $certificate->delete();
        Storage::disk('public')->delete($certificate->file);

        return to_route('dashboard');
    }

    /**
     * Remove the specified resource from storage.

     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', User::class);
        $user->delete();

        return redirect()->route('users.index');
    }

    public function seekerForPractitioner(User $user){

        return view('front.forms.seeker-create-facilitator', [
            'countries' => Country::orderBy('name')->get(),
            'user'=> $user
        ]);
    }

    public function dashboardForPractitioner(StoreSeekerToPractitioner $request, User $user){

        $this->authorize('update', $user);

        $data = $request->validated();

        if ($request->photo) {
            $path = $request->file('photo')->store('images', 'public');
            $data['photo'] = $path;
        }
        $stripe = new \Stripe\StripeClient($_ENV['STRIPE_SECRET_KEY']);
        $facilitatorStripe = $stripe->accounts->create([
            'type' => 'standard',
        ]);

        $data['stripe_id'] = $facilitatorStripe->id;

        $data['role'] = Role::ServiceProvider;

        $user->update($data);

        if ($request->certificates) {
            foreach ($request->file('certificates') as $certificate) {
                $path = $certificate->store('certificates', 'public');
                Certificate::create([
                    'user_id' => $user->id,
                    'file' => $path
                ]);
            }
        }

        Auth::login($user, true);
        return redirect()->route('success.register');


    }

    public function startChat(User $user)
    {
        return view('admin.chat', [
            'user' => $user
        ]);
    }

    public function search(Request $request)
    {
        $practitioners = User::filter($request->toArray())
            ->where('status', 1)
            ->where('role', Role::ServiceProvider->value)
            //->paying()
            ->positionDesc()
            ->search($request->toArray())
            ->paginate(9);

        return view('front.practitioners.search')
            ->withPractitioners($practitioners)
            ->withCategories(Category::all())
            ->withSubcategories(Subcategory::all())
            ->withLanguages(Language::all());
    }

}
