<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function addAnswer(Request $request) {
        // Valider les données du formulaire
        $request->validate([
            'message_id' => 'required|integer',
            'name' => 'required|string',
            'content' => 'required|string'
        ]);

        // Créer une nouvelle instance de réponse
        $newAnswer = new Answer([
            'message_id' => $request->input('message_id'),
            'name' => $request->input('name'),
            'content' => $request->input('content'),
            'status' => true,
        ]);

        // Enregistrer la nouvelle réponse dans la base de données
        $newAnswer->save();

        // Vous pouvez renvoyer une réponse JSON ou toute autre logique nécessaire
        return response()->json(['success' => true, 'message' => 'Réponse ajoutée avec succès']);
    }
}
