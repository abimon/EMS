<?php

namespace Illuminate\Foundation\Auth;

use App\Models\University;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        $uns = University::all();
        return view('auth.register',compact('uns'));
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 201)
                    : redirect($this->redirectPath());
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }
}













// ("Adventist University of Africa"),
// ("Africa International University"),
// ("Africa Nazarene University"),
// ("Amref International University"),
// ("Chuka University"),
// ("Daystar University"),
// ("Dedan Kimathi University of Technology"),
// ("Egerton University"),
// ("Garissa University"),
// ("Great Lakes University of Kisumu"),
// ("Gretsa University"),
// ("International Leadership University, Kenya"),
// ("Islamic University of Kenya"),
// ("Jaramogi Oginga Odinga University of Science and Technology"),
// ("Jomo Kenyatta University of Agriculture and Technology"),
// ("Kabarak University"),
// ("KAG East University"),
// ("Karatina University"),
// ("KCA University"),
// ("Kenya Highlands University"),
// ("Kenya Methodist University"),
// ("Kenyatta University"),
// ("Kibabii University"),
// ("Kirinyaga University"),
// ("Kiriri Women's University of Science and Technology"),
// ("Kisii University"),
// ("Laikipia University"),
// ("Lukenya University"),
// ("Maasai Mara University"),
// ("Machakos University	Machakos"),
// ("Management University of Africa"),
// ("Maseno University"),
// ("Masinde Muliro University of Science and Technology"),
// ("Meru University of Science and Technology"),
// ("Moi University"),
// ("Mount Kenya University"),
// ("Multimedia University of Kenya	Nairobi"),
// ("Murang'a University of Technology"),
// ("Pan Africa Christian University"),
// ("Pioneer International University"),
// ("Pwani University"),
// ("Riara University"),
// ("Rongo University"),
// ("Scott Christian University"),
// ("South Eastern Kenya University"),
// ("St. Paul's University"),
// ("Strathmore University"),
// ("Taita Taveta University"),
// ("Technical University of Kenya"),
// ("Technical University of Mombasa	Mombasa"),
// ("The Catholic University of Eastern Africa"),
// ("The Co-operative University of Kenya"),
// ("The East African University"),
// ("The Presbyterian University of East Africa"),
// ("Umma University"),
// ("United States International University Africa"),
// ("University of Eastern Africa, Baraton"),
// ("University of Eldoret"),
// ("University of Embu"),
// ("University of Kabianga"),
// ("University of Nairobi"),
// ("Uzima University"),
// ("Zetech University")