<?php
/*
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Ramsey\Uuid\Uuid;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::query();

        if ($request->has('employee_name')) {
            $query->where('employee_name', 'like', '%' . $request->input('employee_name') . '%');
        }
        if ($request->has('event_name')) {
            $query->where('event_name', 'like', '%' . $request->input('event_name') . '%');
        }
        if ($request->has('event_date')) {
            $query->whereDate('event_date', $request->input('event_date'));
        }
        if ($request->has('price')) {
            $price = $request->input('price');
            if (is_numeric($price)) {
                $query->where('price', $price);
            }
        }

        $bookings = $query->get();
        $total_price = $bookings->sum('price');

        return view('index', compact('bookings', 'total_price'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_name' => 'required|string',
            'event_name' => 'required|string',
            'event_date' => 'required|date',
            'price' => 'required|numeric',
        ]);

        Booking::create([
            'id' => Uuid::uuid4()->toString(),
            'employee_name' => $request->input('employee_name'),
            'event_name' => $request->input('event_name'),
            'event_date' => $request->input('event_date'),
            'price' => $request->input('price'),
        ]);

        return redirect()->route('bookings.index')->with('success', 'New booking added successfully!');
    }
}
    */
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Booking;
    use Ramsey\Uuid\Uuid; // Осигурајте се дека сте го имплементирале ова
    
    class BookingController extends Controller
    {
        public function index(Request $request)
        {
            $query = Booking::query();
    
            // Филтрирање според име на вработен
            if ($request->filled('employee_name')) {
                $query->where('employee_name', 'like', '%' . $request->input('employee_name') . '%');
            }
    
            // Филтрирање според име на настан
            if ($request->filled('event_name')) {
                $query->where('event_name', 'like', '%' . $request->input('event_name') . '%');
            }
    
            // Филтрирање според дата на настан
            if ($request->filled('event_date')) {
                $query->whereDate('event_date', $request->input('event_date'));
            }
    
            // Филтрирање според цена
            if ($request->filled('price')) {
                $query->where('price', $request->input('price'));
            }
    
            $bookings = $query->get();
            $total_price = $bookings->sum('price');
    
            return view('index', compact('bookings', 'total_price'));
        }
    
        public function store(Request $request)
        {
            $request->validate([
                'employee_name' => 'required|string',
                'event_name' => 'required|string',
                'event_date' => 'required|date',
                'price' => 'required|numeric',
            ]);
    
            Booking::create([
                'id' => Uuid::uuid4()->toString(), // Користете Ramsey UUID за генерација
                'employee_name' => $request->input('employee_name'),
                'event_name' => $request->input('event_name'),
                'event_date' => $request->input('event_date'),
                'price' => $request->input('price'),
            ]);
    
            return redirect()->route('bookings.index')->with('success', 'New booking added successfully!');
        }
    }