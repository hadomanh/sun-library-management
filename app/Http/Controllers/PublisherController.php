<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    private $publisher;

    public function __construct(Publisher $publisher)
    {
        $this->publisher = $publisher;
    }

    public function index()
    {
        $publishers = $this->publisher->paginate(5);

        return view('publisher.index')->with(compact('publishers'));
    }

    public function create(Request $request)
    {
        $publisher = new Publisher;
        $publisher->name = $request->name;
        $publisher->save();

        return redirect()->back();
    }

    public function delete($id)
    {
        return $this->publisher->findOrFail($id)->delete();
    }
}
