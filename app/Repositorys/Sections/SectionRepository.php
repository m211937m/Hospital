<?Php

namespace App\Repositorys\Sections;

use App\Interfaces\Sections\SectionInterface;
use App\Models\Section;
use App\Models\SectionTranslation;
use Exception;
use Illuminate\Http\Request;

class SectionRepository implements SectionInterface
{
    public function index()
    {
        try{

            $sections = Section::all();
            return view("Dashboard.Sections.index",compact("sections"));
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function store($request)
    {
        try{
            Section::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);
            session()->flash("add");
            return redirect()->route('Sections.index');
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
    public function update($request){
        try{

            $section=Section::findOrFail($request->id);
            $section->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);
                session()->flash("edit");
                return redirect()->route('Sections.index');
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function show($id)
    {
        try{

            $doctors = Section::findorfail($id)->doctors;
            $section = Section::findorfail($id);
            return view('Dashboard.Sections.show',compact('doctors','section'));
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function destroy($request){
        try{

            $section=Section::findOrFail($request->id)->delete();
                session()->flash("delete");
                return redirect()->route('Sections.index');
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
