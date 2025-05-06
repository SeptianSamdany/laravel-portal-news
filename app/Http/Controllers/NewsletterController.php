<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsletterController extends Controller
{

    // public function subscribe(Request $request)
    // {
    //     // Validate the request
    //     $request->validate([
    //         'email' => 'required|email|max:255'
    //     ]);
        
    //     // Create or update subscription (using DB directly since we don't have a model)
    //     DB::table('newsletter_subscriptions')->updateOrInsert(
    //         ['email' => $request->email],
    //         [
    //             'email' => $request->email,
    //             'is_active' => true,
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ]
    //     );
        
    //     // Redirect back with success message
    //     return redirect()->back()->with('success', 'You have been successfully subscribed to our newsletter!');
    // }
}