<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Models\Address;
use App\Repositories\AddressRepository;
use Auth;
use Illuminate\Http\Request;

class AddressController extends Controller
{
  private $repo;

  public function __construct(AddressRepository $repo) {
    $this->repo = $repo;
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $address = $this->repo->index(Auth::id());
    return view('address.index', compact('address'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(AddressRequest $request)
  {
    $success = $this->repo->store(Auth::id());
    if($success) {
      //go to next page: delivery method
      return redirect()->route('delivery.index');
    } else {
      return redirect()->back();
    }
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $address = $this->repo->find(Auth::id(), $id);
    if($address) {
      return view('address.edit', compact('address'));
    } else {
      abort(404);
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $address = $this->repo->find(Auth::id(), $id);
    if ($address) {
      $success = $this->repo->update($address);
      if($success) {

      } else {

      }
    } else {
      abort(403);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}
