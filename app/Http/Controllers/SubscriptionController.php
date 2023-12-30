<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscriptionController extends Controller
{
    public function new_subscription(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'max:255',],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first('email'),
            ], 400);
        }

        // L'email est valide, procéder avec la vérification et la création de la souscription
        $email = $request->input('email');
        $subscription = Subscription::where('email', $email)->first();

        if ($subscription) {
            // L'email existe dans la base de données
            if ($subscription->status) {
                // Le statut est déjà vrai
                return response()->json([
                    'success' => true,
                    'message' => 'Subscription already exists with a true status.',
                ]);
            }

            // Mettre à jour le statut à true
            $subscription->update(['status' => true]);
            $actionMessage = 'Subscription status updated to true.';
        } else {
            // L'email n'existe pas, créer une nouvelle souscription
            Subscription::create(['email' => $email, 'status' => true, 'key' => $this->generateAndCheckUniqueKey()]);
            $actionMessage = 'Subscription created successfully.';
        }

        return response()->json([
            'success' => true,
            'message' => $actionMessage,
        ]);
    }

    public function generateAndCheckUniqueKey() {
        do {
            // Generate a random key
            $key = $this->generateKey(10);
            // Check if the key already exists in the 'messages' table
            $alreadyExists = Subscription::where('key', $key)->exists();
        } while ($alreadyExists);
        return $key;
    }

}
