<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Company;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ProjectsController extends Controller
{

    public function __invoke($value='')
    {
        dd("ProjectsController No action.");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($company_id = null)
    {
        if(Auth::check())
        {
            if($company_id != null)
            {
                $projects = Project::where('company_id',$company_id)->get();  
            }
            else
            {
                $projects = DB::table('projects')->get(array('name','id' ));
            }              

            dump($projects);
            return view('pages.projects.index',compact('projects'));
        }
        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($company_id = null)
    {
        if(Auth::check())
        {
            $companies = null;
            if($company_id == null)
            {
                $companies = Company::where('user_id',Auth::user()->id)->get();
            }
            // dump($company_id);
            // dump($companies);
            return view('pages.projects.create',compact('company_id','companies'));
        }
        return view('auth.login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::check())
        {
            $project = Project::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'user_id' => Auth::user()->id,
                'company_id' => $request->input('company_id')
            ]); 

            if($project){
                return redirect()->route('projects.show', ['project'=> $project->id])
                ->with('success' , 'Project created successfully');
            }
        }
        return back()->withInput()->with('errors', 'Error creating new project');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {

        $project = Project::find($project->id);
        // dump($project);
        // dd($project->comments);
        // $project->comments
        return view('pages.projects.show',compact('project')); //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(project $project)
    {
        $project = Project::find($project->id);
        return view('pages.projects.edit',compact('project')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, project $project)
    {
        $projectUpdate = Project::where('id',$project->id)
                            ->update([
                                'name' => $request->name,
                                'description' => $request->description
                            ]);
        if($projectUpdate)
        {
            return redirect()->action('ProjectsController@show',['project' => $project->id])->with('success','Updated Successfully!');
        }
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(project $project)
    {
        $findproject = Project::find($project->id);
        if($findproject->delete())
        {
            return redirect()->action('ProjectsController@index')->with('success','Project deleted Successfully!');
        }

        return back()->withInput()->with('error','Project could not be deleted.');
    }

}
