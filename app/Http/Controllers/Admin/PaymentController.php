<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\User;
use App\Models\ClassBooking;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display all payments (admin/staff view).
     */
    public function index(Request $request)
    {
        $gymId = auth()->user()->gym_id;

        $query = Payment::with(['user', 'recordedBy', 'booking']);

        if ($gymId) {
            $query->where('gym_id', $gymId);
        }

        if ($request->has('user_id') && $request->user_id) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        if ($request->has('payment_method') && $request->payment_method) {
            $query->where('payment_method', $request->payment_method);
        }

        if ($request->has('date_from') && $request->date_from) {
            $query->where('payment_date', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to) {
            $query->where('payment_date', '<=', $request->date_to);
        }

        $payments = $query->orderBy('payment_date', 'desc')->paginate(20);

        $totalAmount = (clone $query)->where('status', 'completed')->sum('amount');

        $clients = User::where('role', 'client')
            ->when($gymId, fn ($q) => $q->where('gym_id', $gymId))
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->get();

        return view('admin.payments.index', compact('payments', 'clients', 'totalAmount'));
    }

    /**
     * Show form to record a new payment.
     */
    public function create(Request $request)
    {
        $gymId = auth()->user()->gym_id;

        $clients = User::where('role', 'client')
            ->when($gymId, fn ($q) => $q->where('gym_id', $gymId))
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->get();

        $selectedUserId = $request->query('user_id');

        return view('admin.payments.create', compact('clients', 'selectedUserId'));
    }

    /**
     * Store a new payment.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'booking_id' => 'nullable|exists:class_bookings,id',
            'amount' => 'required|numeric|min:0.01',
            'currency' => 'nullable|string|max:3',
            'payment_method' => 'required|in:cash,card,bank_transfer,mobile_money,other',
            'status' => 'required|in:completed,pending,failed,refunded',
            'reference_number' => 'nullable|string|max:255',
            'payment_date' => 'required|date',
            'payment_for' => 'required|in:membership,class,personal_training,other',
            'description' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $gymId = auth()->user()->gym_id;

        $payment = Payment::create([
            'user_id' => $request->user_id,
            'booking_id' => $request->booking_id,
            'gym_id' => $gymId,
            'recorded_by' => auth()->id(),
            'amount' => $request->amount,
            'currency' => $request->currency ?? 'USD',
            'payment_method' => $request->payment_method,
            'status' => $request->status,
            'reference_number' => $request->reference_number,
            'payment_date' => $request->payment_date,
            'payment_for' => $request->payment_for,
            'description' => $request->description,
            'notes' => $request->notes,
        ]);

        return redirect()->route('admin.payments.show', $payment)
            ->with('success', 'Payment recorded successfully!');
    }

    /**
     * Display a specific payment.
     */
    public function show(Payment $payment)
    {
        $payment->load(['user', 'recordedBy', 'booking', 'gym']);

        return view('admin.payments.show', compact('payment'));
    }

    /**
     * Show form to edit a payment.
     */
    public function edit(Payment $payment)
    {
        $payment->load(['user']);

        return view('admin.payments.edit', compact('payment'));
    }

    /**
     * Update a payment.
     */
    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'booking_id' => 'nullable|exists:class_bookings,id',
            'amount' => 'required|numeric|min:0.01',
            'currency' => 'nullable|string|max:3',
            'payment_method' => 'required|in:cash,card,bank_transfer,mobile_money,other',
            'status' => 'required|in:completed,pending,failed,refunded',
            'reference_number' => 'nullable|string|max:255',
            'payment_date' => 'required|date',
            'payment_for' => 'required|in:membership,class,personal_training,other',
            'description' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $payment->update($request->only([
            'booking_id', 'amount', 'currency', 'payment_method', 'status',
            'reference_number', 'payment_date', 'payment_for', 'description', 'notes',
        ]));

        return redirect()->route('admin.payments.show', $payment)
            ->with('success', 'Payment updated successfully!');
    }

    /**
     * Delete a payment.
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()->route('admin.payments.index')
            ->with('success', 'Payment deleted successfully.');
    }

    /**
     * Show payments for a specific client (admin view).
     */
    public function clientPayments(Request $request, User $user)
    {
        if (!$user->isClient()) {
            abort(404);
        }

        $query = Payment::where('user_id', $user->id);

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $payments = $query->orderBy('payment_date', 'desc')->paginate(10);
        $totalPaid = Payment::where('user_id', $user->id)->where('status', 'completed')->sum('amount');

        return view('admin.payments.client-payments', compact('user', 'payments', 'totalPaid'));
    }

    /**
     * Display the client's own payment history.
     */
    public function myPayments(Request $request)
    {
        $user = auth()->user();

        $query = Payment::where('user_id', $user->id);

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        if ($request->has('date_from') && $request->date_from) {
            $query->where('payment_date', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to) {
            $query->where('payment_date', '<=', $request->date_to);
        }

        $payments = $query->orderBy('payment_date', 'desc')->paginate(10);

        $totalPaid = Payment::where('user_id', $user->id)->where('status', 'completed')->sum('amount');
        $totalPending = Payment::where('user_id', $user->id)->where('status', 'pending')->sum('amount');

        return view('client.payments', compact('user', 'payments', 'totalPaid', 'totalPending'));
    }

    /**
     * Display a single payment for the client.
     */
    public function showMyPayment(Payment $payment)
    {
        if ($payment->user_id !== auth()->id()) {
            abort(403);
        }

        $payment->load(['recordedBy', 'booking', 'gym']);

        return view('client.payment-details', compact('payment'));
    }
}
