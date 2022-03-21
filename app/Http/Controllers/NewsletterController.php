<?php

namespace App\Http\Controllers;

class NewsletterController extends Controller
{
    /*public function store(NewsletterInterface $newsletter)
    {
        $email = auth()->user()->email;
        try {
            $newsletter->subscribe($email);
            Cache::forever('subscribed_' . md5($email), true);
        } catch (\Exception $e) {
            throw ValidationException::withMessages([
                'email' => $email . ' could not be added to our newsletter list! ' . $e->getMessage()
            ]);
        }

        return redirect('/')->with('success', 'You are now signed up for our newsletter');
    }

    public function destroy(NewsletterInterface $newsletter)
    {
        $email = auth()->user()->email;
        try {
            $newsletter->deleteListMember(md5($email));
            Cache::forget('subscribed_' . md5($email));
        } catch (\Exception $e) {
            throw ValidationException::withMessages([
                'email' => $email . ' could not be removed to our newsletter list! ' . $e->getMessage()
            ]);
        }

        return redirect('/')->with('success', 'You are now signed out from our newsletter');
    }*/
}
