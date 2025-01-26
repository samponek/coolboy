<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    /**
     * Zobrazí seznam fotek, možnost filtrovat podle názvu.
     */
    public function index(Request $request)
    {
        // Pokud je zadán filtr pro název, použije se k filtrování fotek
        $titleFilter = $request->get('title', '');

        // Načítání fotek z databáze s filtrací
        $photos = Photo::where('title', 'like', '%' . $titleFilter . '%')->paginate(9);  // 9 je počet fotek na stránku, můžete upravit

        return view('photos.index', compact('photos'));
    }

    /**
     * Zobrazuje formulář pro přidání nové fotky.
     */
    public function create()
    {
        return view('photos.create');
    }

    /**
     * Ukládá novou fotku do databáze.
     */
    public function store(Request $request)
    {
        // Validace formuláře
        $request->validate([
            'title' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $photo = new Photo();
        $photo->title = $request->title;

        // Uložení obrázku a uložení cesty do databáze
        if ($request->hasFile('image')) {
            // Uložení obrázku do složky 'public/photos'
            $imagePath = $request->file('image')->store('photos', 'public');
            
            // Uložení cesty k obrázku do databáze
            $photo->image = $imagePath;  // uloží cestu jako 'photos/obrazek.jpg'
        }

        // Uložení do databáze
        $photo->save();

        // Přesměrování zpět na hlavní stránku s úspěšnou zprávou
        return redirect()->route('photos.index')->with('success', 'Fotka byla úspěšně přidána!');
    }

    /**
     * Zobrazuje formulář pro úpravu existující fotky.
     */
    public function edit($id)
    {
        $photo = Photo::findOrFail($id);
        return view('photos.edit', compact('photo'));
    }

    /**
     * Aktualizuje existující fotku v databázi.
     */
    public function update(Request $request, $id)
    {
        // Validace požadavků
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $photo = Photo::findOrFail($id);

        // Pokud je obrázek nový, uložíme ho
        if ($request->hasFile('image')) {
            // Smazání starého obrázku
            Storage::delete('public/photos/' . $photo->image);

            // Uložení nového obrázku
            $imagePath = $request->file('image')->store('public/photos');
            $photo->image = basename($imagePath);
        }

        // Aktualizace názvu fotky
        $photo->title = $request->input('title');
        $photo->save();

        // Redirect s úspěšnou zprávou
        return redirect()->route('photos.index')->with('success', 'Fotka byla úspěšně upravena!');
    }

    /**
     * Smaže fotku z databáze a úložiště.
     */
    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);

        // Smazání obrázku ze storage
        Storage::delete('public/photos/' . $photo->image);

        // Smazání záznamu z databáze
        $photo->delete();

        // Redirect s úspěšnou zprávou
        return redirect()->route('photos.index')->with('success', 'Fotka byla úspěšně smazána!');
    }
}
