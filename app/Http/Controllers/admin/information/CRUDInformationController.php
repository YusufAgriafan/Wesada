<?php

namespace App\Http\Controllers\admin\information;

use App\Http\Controllers\Controller;
use App\Models\Information;
use DOMDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CRUDInformationController extends Controller
{
    public function index()
    {
        $information = Information::latest()->paginate(5);

        return view('admin.information.index', compact('information'));
    }
    

    public function store(Request $request)
    {
        $content = $request->content;

        if (!empty($content)) {
            $dom = new DOMDocument();

            libxml_use_internal_errors(true); 
            $dom->loadHTML($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

            $images = $dom->getElementsByTagName('img');

            foreach ($images as $key => $img) {
                $src = $img->getAttribute('src');

                if (preg_match('/^data:image\/(png|jpeg|jpg|gif);base64,/', $src)) {
                    $data = base64_decode(explode(',', explode(';', $src)[1])[1]);
                    $image_name = "/main/information/" . time() . $key . '.png';
                    file_put_contents(public_path() . $image_name, $data);

                    $img->removeAttribute('src');
                    $img->setAttribute('src', $image_name);
                }
            }
            $content = $dom->saveHTML();
        }

        $request->merge(['content' => $content]);

        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'content' => 'required',
        ]);

        $input = $request->all();

        Information::create($input);

        return redirect()->route('admin.information.index')->with('success', 'Informasi Berhasil Ditambahkan!');
    }

    public function edit($title)
    {
        $information = Information::where('title', $title)->get();
        if ($information->isEmpty()) {
            abort(404);
        }
        $item = $information->first();

        return view('admin.information.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $content = $request->content;

        if (!empty($content)) {
            $dom = new DOMDocument();

            libxml_use_internal_errors(true); 
            $dom->loadHTML($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

            $images = $dom->getElementsByTagName('img');

            foreach ($images as $key => $img) {
                $src = $img->getAttribute('src');

                // Hanya proses gambar dengan src yang merupakan base64
                if (preg_match('/^data:image\/(png|jpeg|jpg|gif);base64,/', $src)) {
                    $data = base64_decode(explode(',', explode(';', $src)[1])[1]);
                    $image_name = "/main/information/" . time() . $key . '.png';
                    file_put_contents(public_path() . $image_name, $data);

                    $img->removeAttribute('src');
                    $img->setAttribute('src', $image_name);
                }
            }
            $content = $dom->saveHTML();
        }

        $request->merge(['content' => $content]);

        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'content' => 'required',
        ]);

        $informasi = Information::where('id', $id)->firstOrFail();

        $informasi->title = $request->input('title');
        $informasi->category = $request->input('category');
        $informasi->content = $request->input('content');

        $informasi->save();

        return redirect()->route('admin.information.index')->with('success', 'Informasi Berhasil Diperbarui!');
    }

    public function destroy($id)
    {
        $information = Information::findOrFail($id);

        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML(mb_convert_encoding($information->content, 'HTML-ENTITIES', 'UTF-8'));
        libxml_clear_errors();

        $images = $dom->getElementsByTagName('img');
        foreach($images as $img){
            $path = $img->getAttribute('src');

            if (!preg_match('/^http[s]?:\/\//', $path) && File::exists(public_path($path))) {
                File::delete(public_path($path));
            }
        }

        $information->delete();

        return redirect()->route('admin.information.index')->with('success', 'Informasi Berhasil Dihapus!');
    }


}
