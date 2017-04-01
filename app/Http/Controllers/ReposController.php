<?php

namespace App\Http\Controllers;

use Kris\LaravelFormBuilder\FormBuilderTrait;
use App\Http\Requests\RepoRequest;
use App\Models\Repo;

class ReposController extends Controller
{
  use FormBuilderTrait;

  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $repos = Repo::all();
    return view('repos.index', compact('repos'));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    $form = $this->form('App\Forms\RepoForm', [
      'method' => 'POST',
      'url' => route('repos.store')
    ]);
    return view('repos.create', compact('form'));

  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(RepoRequest $request)
  {
    $repo = Repo::create($request->all());
    return redirect()->route('repos.show', $repo->id);
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show(Repo $repo)
  {
    return view('repos.show', compact('repo'));
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit(Repo $repo)
  {
    $form = $this->form('App\Forms\RepoForm', [
      'method' => 'PATCH',
      'model' => $repo,
      'url' => route('repos.update',$repo)
    ]);
    return view('repos.edit', compact('form'));
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(RepoRequest $request, Repo $repo)
  {
    $repo->fill($request->all());
    if(!$request->auto_deploy){
      $repo->auto_deploy = 0;
    }
    $repo->save();
    return redirect()->back();
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy(Repo $repo)
  {
    $repo->delete();
    return redirect()->route('repos.index');
  }
}
