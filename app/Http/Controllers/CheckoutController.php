<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Checkout;
use App\Models\Student;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(){
        $checkouts = Checkout::orderBy("updated_at", "desc")
        ->orderBy("created_at", "desc")
        ->get();
        $books = Book::orderBy("updated_at", "desc")
        ->orderBy("created_at", "desc")
        ->get();
        $students = Student::orderBy("updated_at", "desc")
        ->orderBy("created_at", "desc")
        ->get();

        return view('Checkout', compact('checkouts', 'books', 'students'));
    }

    public function openUpdate($checkout, $book, $student)
    {
        $checkouts = Checkout::find($checkout);
        $books = Book::find($book);
        $students = Student::find($student);

        return response()->json(['checkouts' => $checkouts, 'books' => $books, 'students' => $students]);
    }

    public function destroy(Checkout $checkout) {
        $checkout->delete();
    }

    public function store(Request $request ) {
        $fields = $request->validate([
            'student_id'=> 'required | numeric',
            'book_id'=> 'required | numeric',
            'checkout_date'=> 'required',
            'return_date'=> 'required',
            'status'=> 'required',
        ]);

        Checkout::create($fields);
        return redirect('/checkouts');
    }

    public function update(Request $request, Checkout $checkout) {
        $fields = $request->validate([
            'student_id'=> 'required | numeric',
            'book_id'=> 'required | numeric',
            'checkout_date'=> 'required',
            'return_date'=> 'required',
            'status'=> 'required',
        ]);
        $checkout->update($fields);
    }

}
