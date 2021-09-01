<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;

class BookController extends Controller
{
    private $book;
    private $publisher;
    private $category;
    private $author;

    public function __construct(Book $book, Publisher $publisher, Category $category, Author $author)
    {
        $this->book = $book;
        $this->publisher = $publisher;
        $this->category = $category;
        $this->author = $author;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = $this->book->all();

        return view('book.index')->with(compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $publishers = $this->publisher->all();
        $categories = $this->category->all();
        $authors = $this->author->all();

        return view('book.create')->with(compact('publishers', 'categories', 'authors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book = new Book;
        $book->title = $request->title;
        $book->number_of_pages = $request->number_of_pages;
        $book->quantity = $request->quantity;
        $book->publisher_id = $request->publisher_id;
        $book->save();
        $book->refresh();
        $book->categories()->attach($request->categories);
        $book->authors()->attach($request->authors);

        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $publishers = $this->publisher->all();
        $categories = $this->category->all();
        $authors = $this->author->all();

        return view('book.edit')->with(compact('book', 'publishers', 'categories', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $book->title = $request->title;
        $book->number_of_pages = $request->number_of_pages;
        $book->quantity = $request->quantity;
        $book->publisher_id = $request->publisher_id;
        $book->categories()->sync($request->categories);
        $book->save();

        return redirect(route('books.index'));
    }

    public function destroy($id)
    {
        return $this->book->findOrFail($id)->delete();

    }
}
