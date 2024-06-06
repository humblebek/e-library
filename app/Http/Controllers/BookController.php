<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Http\Services\BookService;
use App\Models\Book;
use App\Models\BookType;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }
    public function index()
    {
        $dataIndex = $this->bookService->index();
        return $dataIndex;
    }

    public function sortedBooksByType(BookType $type)
    {
        $dataSortBook = $this->bookService->sortedBook($type);
        // Return the collection of books as a resource
        return $dataSortBook;
    }

    public function store(Request $request)
    {
        $dataStore = $this->bookService->store($request);

        return response()->json(['message' => 'Book created successfully', 'Book' => $dataStore], 201);
    }

    public function show(Book $book)
    {
        return new BookResource($book);
    }

    public function update(Request $request, Book $book)
    {
        $dataUpdate = $this->bookService->update($request, $book);
        return response()->json(['message' => 'Book updated successfully', 'Book' => $dataUpdate], 201);
    }

    public function destroy(Book $book)
    {
        $this->bookService->destroy($book);
        return response()->json(['message' => 'Book deleted successfully'], 201);
    }
}
