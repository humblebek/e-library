<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function dashboard()
    {
        $lastMonth = Carbon::now()->subMonth();

        $dashboard['user'] = User::role('client')->count();
        $dashboard['books'] = Book::count();
        $dashboard['ordered_books'] = Book::where('status',1)->count();
        $dashboard['foreign_books'] = Book::where('book_type_id',1)->count();
        $dashboard['russian_books'] = Book::where('book_type_id',2)->count();
        $dashboard['pdf_books'] = Book::where('book_type_id',3)->count();
        $dashboard['new_books'] = Book::where('publishDate','>=',$lastMonth)->count();

        return $this->checkData($dashboard);
    }


    public function checkData($data)
    {
        if (empty($data)) {
            return ['error' => 'No data available'];
        }
        if (!is_array($data)) {
            return ['error' => 'Invalid data format'];
        }
        return $data;
    }
}
