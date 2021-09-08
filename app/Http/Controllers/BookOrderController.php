<?php

namespace App\Http\Controllers;

use App\Models\{BookOrder, User, Book};
use Illuminate\Http\Request;
use \App\Http\Requests\BookOrderRequest;
use \Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use \Carbon\CarbonPeriod;

class BookOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = BookOrder::where('user_id', '=', Auth::user()->id)->withCount('books')->get();
        return view('book_order.index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookOrderRequest $request)
    {
        $order = new BookOrder();
        $order->from = $request->from ?: \Carbon\Carbon::now();
        $order->to = $request->to ?: \Carbon\Carbon::now();
        $order->status = 0;
        $user = User::find(Auth::user()->id);
        $order->user()->associate($user);
        $order->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BookOrder  $bookOrder
     * @return \Illuminate\Http\Response
     */
    public function show(BookOrder $bookOrder)
    {
        return view('book_order.show', ['order' => $bookOrder]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BookOrder  $bookOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(BookOrder $bookOrder)
    {
        $availableBooks = $this->getAvailableBooks($bookOrder);
        return view('book_order.edit', ['order' => $bookOrder, 'availables' => $availableBooks]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BookOrder  $bookOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookOrder $bookOrder)
    {
        Log::info($request);
        $bookOrder->from = $request->from ?: $bookOrder->from;
        $bookOrder->to = $request->to ?: $bookOrder->to;
        $bookOrder->status = $request->status ?: $bookOrder->status;
        $bookOrder->books()->sync($request->books);
        $bookOrder->save();

        return redirect(route('book_orders.show', ['book_order' => $bookOrder]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookOrder  $bookOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookOrder $bookOrder)
    {
        //
    }

    private function getAvailableBooks(BookOrder $bookOrder)
    {
        $period = CarbonPeriod::create($bookOrder->from, $bookOrder->to);
        $query = DB::table('books')
            ->join('book_order_list','id', '=', 'book_order_list.book_id', 'left')
            ->join('book_orders', 'book_orders.id', '=', 'book_order_list.order_id', 'left')
            ->select(['books.*', 'book_order_list.order_id'])
            ->groupBy('books.id');

        foreach($period as $day) {
            $query->havingRaw('sum(if(book_orders.from <= ? and book_orders.to >= ?, 1, 0)) < quantity or book_order_list.order_id = ?', [$day, $day, $bookOrder->id]);
        }
        Log::info($query->toSql(), $query->getBindings());

        return $query->get();
    }
}
