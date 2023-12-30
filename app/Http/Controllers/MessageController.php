<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function new_message(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'message' => 'required|string',
            'access_code' => $request->input('visibility') == 'only user' ? 'required|string' : 'nullable|string',
            'visibility' => 'required|string|in:all,only user',
        ]);
        // Si la validation échoue, renvoyez les erreurs au format JSON
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        // Générer le lien sans espaces et en minuscules
        $link = strtolower(str_replace(' ', '', $request->input('name')));

        // Vérifier si le lien existe déjà
        $linkCount = Message::where('link', 'like', $link . '%')->count();

        // Si le lien existe déjà, ajouter un suffixe numérique
        if ($linkCount > 0) {
            $link .= '-' . $linkCount;
        }
        // Créer un nouveau message en utilisant le modèle Message
        $message = Message::create([
            'name' => $request->input('name'),
            'message' => $request->input('message'),
            'access_code' => $request->input('access_code'),
            'visibility' => $request->input('visibility'),
            'link' => $link,
            'status' => true, // Par défaut
        ]);
        //return view('pages.copy_link', ['message' => $message]);
        return response()->json(['message' => 'Message créé avec succès', 'data' => $message], 201);
    }

    public function messageLink($id)
    {
        $message = Message::find($id);
        if ($message){
            return view('pages.copy_link', ['message' => $message]);
        }else{
            return redirect()->route('not_found');
        }
    }

    public function getMessageByLink($link)
    {
        $message = Message::where('link', $link)->first();
        if ($message) {
            return view('pages.message', ['message' => $message]);
        } else {
            return redirect()->route('not_found');
        }
    }
}
