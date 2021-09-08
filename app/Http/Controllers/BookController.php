<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;
use App\Http\Requests\BookFilterRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;

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
        $books = $this->book->paginate(5);

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
        return view('book.show', compact('book'));
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
        $book->authors()->sync($request->authors);
        $book->categories()->sync($request->categories);
        $book->save();

        return redirect(route('books.index'));
    }

    public function destroy($id)
    {
        return $this->book->findOrFail($id)->delete();
    }

    public function filter(BookFilterRequest $request)
    {
        Log::info($request);
        $builder = $this->book;

        if (isset($request->title)) {
            $builder = $builder->where('title', 'LIKE', '%' . $request->title . '%');
        }

        if (isset($request->publisher)) {
            Log::info($request->publisher);
            $builder = $builder->whereHas('publisher', function (Builder $builderPrime) use ($request) {
                $builderPrime->where('name', 'LIKE', '%' . $request->publisher . '%');
            });
        }

        if (isset($request->author)) {
            $builder = $builder->whereHas('authors', function (Builder $builderPrime) use ($request) {
                $builderPrime->where('name', 'LIKE', '%' . $request->author . '%');
            });
        }

        if (isset($request->category)) {
            $categories = explode(' ', strtolower($request->category));
            foreach ($categories as $category) {
                $builder = $builder->whereHas('categories', function (Builder $builderPrime) use ($category) {
                    $builderPrime->where('name', $category);
                });
            }
        }

        if (isset($request->rating[0]) || isset($request->rating[1])) {
            $rating = [$request->rating[0] ?: 1, $request->rating[1] ?: 5];
            $builder = $builder->join('user_book', 'books.id', '=', 'user_book.book_id')
                ->select('user_book.book_id', 'books.*')
                ->selectRaw('avg(`rating`) as avg_rating')
                ->groupBy('user_book.book_id')
                ->havingRaw('avg_rating >= ? and avg_rating <= ?', $rating)
                ->orderBy('books.id');
        }

        Log::info($builder->toSql(), $builder->getBindings());
        $books = $builder->paginate(20)->appends(request()->except('page'));
        Log::info($books);

        return view('home', ['books' => $books]);
    }
}
