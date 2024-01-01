<?Php

namespace App\Repositorys\Sections;

use App\Interfaces\Sections\SectionInterface;
use App\Models\Section;
use App\Models\SectionTranslation;
use Illuminate\Http\Request;

class SectionRepository implements SectionInterface
{
    public function index()
    {
        $sections = Section::all();
        return view("Dashboard.Sections.index",compact("sections"));
    }
    public function store($request)
    {
        Section::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        session()->flash("add");
        return redirect()->route('Sections.index');

    }
    public function update($request){
        $section=Section::findOrFail($request->id);
        $section->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
            session()->flash("edit");
            return redirect()->route('Sections.index');

    }
    public function show($id)
    {
        $doctors = Section::findorfail($id)->doctors;
        $section = Section::findorfail($id);
        return view('Dashboard.Sections.show',compact('doctors','section'));
    }
    public function destroy($request){
        $section=Section::findOrFail($request->id)->delete();
            session()->flash("delete");
            return redirect()->route('Sections.index');

    }
}
