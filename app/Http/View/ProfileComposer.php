<?php


    namespace App\Http\View;


    use App\Profile;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\View\View;

    class ProfileComposer
    {
        public function compose(View $view)
        {
            $profile = Profile::find(Auth::user()->id);
            return $view->with('profile',$profile);
        }
    }