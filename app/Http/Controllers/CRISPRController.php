<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class CRISPRController extends Controller
{
    public function design(Request $request)
    {
        $sequence = strtoupper($request->input('sequence'));
        $request->validate([
            'sequence' => 'required|regex:/^[ACGT]+$/i',
            'pam' => 'required|in:GG,AG'
        ]);
        // Генерация гидов
        $pam = $request->input('pam', 'GG');
        preg_match_all("/(?=(.{20}{$pam}))/", $sequence, $matches);

        $guides = $matches[1] ?? ['No guides found'];

        // Сохраняем данные в сессии
        session()->put('guides', $guides);
        DB::table('guides_history')->insert([
            'sequence' => $sequence,
            'pam' => $pam,
            'guides' => json_encode($guides),
            'created_at' => now()
        ]);
        // Перенаправляем на главную
        return redirect('/');
    }
    public function download()
{
    
    $guides = session('guides', []);
    
    if (empty($guides)) {
        return redirect('/')->with('error', 'No guides to download!');
    }

    $content = implode("\n", $guides);
    return response($content)
        ->header('Content-Type', 'text/plain')
        ->header('Content-Disposition', 'attachment; filename="crispr_guides.txt"');
}
}
