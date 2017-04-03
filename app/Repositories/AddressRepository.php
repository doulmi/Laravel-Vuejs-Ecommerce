<?php

namespace App\Repositories;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressRepository
{
  private $request;

  public function __construct(Request $request)
  {
    $this->request = $request;
  }

  public function store($userId)
  {
    //set other address not be default
    $address = Address::where('user_id', $userId);
    foreach ($address as $adr) {
      $adr->update(['is_default' => false]);
    }

    return Address::create(array_merge($this->request->all(), [
      'user_id' => $userId,
      'is_default' => true
    ]));
  }

  public function update($address)
  {
    return $address->update($this->request->all());
  }

  public function find($userId, $addressId)
  {
    return Address::where('user_id', $userId)->where('id', $addressId)->first();
  }

  public function index($userId)
  {
    return Address::where('user_id', $userId)->orderBy('is_default', 'DESC')->get();
  }

  public function setDefault($userId, $addressId)
  {

  }
}
