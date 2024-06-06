<?php

namespace App\Http\Services;

use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Models\BookType;
use Illuminate\Http\Request;

class BookService
{
    public function index()
    {
        $allBook = BookResource::collection(Book::all());
        return $allBook;
    }

    public function sortedBook(BookType $type)
    {
        $books = BookResource::collection($type->books);
        return $books;
    }
    public function store(Request $request)
    {
        $requestData = $request->all();

        if ($request->hasFile('image')) {
            $requestData['image'] = $this->fileUpload();
        }

        $storedBook = Book::create($requestData);
        return $storedBook;
    }

    public function update(Request $request,Book $book)
    {
        $requestData = $request->all();
        if($request->hasFile('image'))
        {
            if (isset($book->image) && file_exists(public_path('/files/photosBook/' . $book->image))) {
                unlink(public_path('/files/photosBook/' . $book->image));
            }
            $requestData['image'] = $this->fileUpload();
        }
        $updatedBook = $book->update($requestData);
        return $updatedBook;
    }

    public function destroy(Book $book)
    {
        $book->delete();
    }



    public function fileUpload(){
        if (request()->hasFile('image') && request()->file('image')->isValid()) {
            $file = request()->file('image');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $fileName = preg_replace('/[^A-Za-z0-9\-_.]/', '', $fileName);
            $file->move(public_path('files/photosBook'), $fileName);
            return $fileName;
        }

        return null;
    }
}
