<?php

namespace App\Http\Controllers\admin\game;

use App\Http\Controllers\Controller;
use App\Models\Game;
use DOMDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::latest()->paginate(10);

        return view('admin.game.index', compact('games'));
    }

    public function store(Request $request)
    {
        $question = $request->question;
        $answer = $request->answer;

        if (!empty($question)) {
            $question = $this->processBase64Images($question);
        }

        if (!empty($answer)) {
            $answer = $this->processBase64Images($answer);
        }

        $request->merge(['question' => $question, 'answer' => $answer]);

        $request->validate([
            'category' => 'required',
            'question' => 'required',
            'answer' => 'nullable', 
        ]);

        $input = $request->all();

        Game::create($input);

        return redirect()->route('admin.games.index')->with('success', 'Kartu Berhasil Ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $question = $request->question;
        $answer = $request->answer;

        if (!empty($question)) {
            $question = $this->processBase64Images($question);
        }

        if (!empty($answer)) {
            $answer = $this->processBase64Images($answer);
        }

        $request->merge(['question' => $question, 'answer' => $answer]);

        $request->validate([
            'category' => 'required',
            'question' => 'required',
            'answer' => 'nullable',
        ]);

        $game = Game::findOrFail($id);
        $game->category = $request->input('category');
        $game->question = $request->input('question');
        $game->answer = $request->input('answer');

        $game->save();

        return redirect()->route('admin.games.index')->with('success', 'Kartu Berhasil Diperbarui!');
    }

    private function processBase64Images($content)
    {
        $dom = new DOMDocument();

        libxml_use_internal_errors(true); 
        $dom->loadHTML($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $images = $dom->getElementsByTagName('img');

        foreach ($images as $key => $img) {
            $src = $img->getAttribute('src');

            if (preg_match('/^data:image\/(png|jpeg|jpg|gif);base64,/', $src)) {
                $data = base64_decode(explode(',', explode(';', $src)[1])[1]);
                $image_name = "/main/summernote/" . time() . $key . '.png';
                file_put_contents(public_path() . $image_name, $data);

                $img->removeAttribute('src');
                $img->setAttribute('src', $image_name);
            }
        }

        return $dom->saveHTML();
    }

    public function destroy($id)
    {
        $game = Game::findOrFail($id);

        $question = $game->question;
        $answer = $game->answer;

        $this->deleteImagesFromContent($question);
        $this->deleteImagesFromContent($answer);

        $game->delete();

        return redirect()->route('admin.games.index')->with('success', 'Kartu Berhasil Dihapus!');
    }

    private function deleteImagesFromContent($content)
    {
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'));
        libxml_clear_errors();

        $images = $dom->getElementsByTagName('img');
        foreach ($images as $img) {
            $path = $img->getAttribute('src');

            if (!preg_match('/^http[s]?:\/\//', $path) && \File::exists(public_path($path))) {
                \File::delete(public_path($path));
            }
        }
    }

}
