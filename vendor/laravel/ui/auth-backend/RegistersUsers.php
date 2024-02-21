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
// (now(),now(),"Adventist University of Africa"),
// (now(),now(),"Africa International University"),
// (now(),now(),"Africa Nazarene University"),
// (now(),now(),"Amref International University"),
// (now(),now(),"Chuka University"),
// (now(),now(),"Daystar University"),
// (now(),now(),"Dedan Kimathi University of Technology"),
// (now(),now(),"Egerton University"),
// (now(),now(),"Garissa University"),
// (now(),now(),"Great Lakes University of Kisumu"),
// (now(),now(),"Gretsa University"),
// (now(),now(),"International Leadership University, Kenya"),
// (now(),now(),"Islamic University of Kenya"),
// (now(),now(),"Jaramogi Oginga Odinga University of Science and Technology"),
// (now(),now(),"Jomo Kenyatta University of Agriculture and Technology"),
// (now(),now(),"Kabarak University"),
// (now(),now(),"KAG East University"),
// (now(),now(),"Karatina University"),
// (now(),now(),"KCA University"),
// (now(),now(),"Kenya Highlands University"),
// (now(),now(),"Kenya Methodist University"),
// (now(),now(),"Kenyatta University"),
// (now(),now(),"Kibabii University"),
// (now(),now(),"Kirinyaga University"),
// (now(),now(),"Kiriri Women's University of Science and Technology"),
// (now(),now(),"Kisii University"),
// (now(),now(),"Laikipia University"),
// (now(),now(),"Lukenya University"),
// (now(),now(),"Maasai Mara University"),
// (now(),now(),"Machakos University	Machakos"),
// (now(),now(),"Management University of Africa"),
// (now(),now(),"Maseno University"),
// (now(),now(),"Masinde Muliro University of Science and Technology"),
// (now(),now(),"Meru University of Science and Technology"),
// (now(),now(),"Moi University"),
// (now(),now(),"Mount Kenya University"),
// (now(),now(),"Multimedia University of Kenya	Nairobi"),
// (now(),now(),"Murang'a University of Technology"),
// (now(),now(),"Pan Africa Christian University"),
// (now(),now(),"Pioneer International University"),
// (now(),now(),"Pwani University"),
// (now(),now(),"Riara University"),
// (now(),now(),"Rongo University"),
// (now(),now(),"Scott Christian University"),
// (now(),now(),"South Eastern Kenya University"),
// (now(),now(),"St. Paul's University"),
// (now(),now(),"Strathmore University"),
// (now(),now(),"Taita Taveta University"),
// (now(),now(),"Technical University of Kenya"),
// (now(),now(),"Technical University of Mombasa	Mombasa"),
// (now(),now(),"The Catholic University of Eastern Africa"),
// (now(),now(),"The Co-operative University of Kenya"),
// (now(),now(),"The East African University"),
// (now(),now(),"The Presbyterian University of East Africa"),
// (now(),now(),"Umma University"),
// (now(),now(),"United States International University Africa"),
// (now(),now(),"University of Eastern Africa, Baraton"),
// (now(),now(),"University of Eldoret"),
// (now(),now(),"University of Embu"),
// (now(),now(),"University of Kabianga"),
// (now(),now(),"University of Nairobi"),
// (now(),now(),"Uzima University"),
// (now(),now(),"Zetech University")