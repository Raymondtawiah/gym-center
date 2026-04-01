<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClientPerformance;
use App\Models\User;
use Illuminate\Http\Request;

class PerformanceController extends Controller
{
    /**
     * Display a list of all client performances (admin/staff view).
     */
    public function index(Request $request)
    {
        $gymId = auth()->user()->gym_id;

        $query = ClientPerformance::with(['user']);

        if ($gymId) {
            $query->where('gym_id', $gymId);
        }

        // Filter by user
        if ($request->has('user_id') && $request->user_id) {
            $query->where('user_id', $request->user_id);
        }

        // Filter by date range
        if ($request->has('date_from') && $request->date_from) {
            $query->where('recorded_date', '>=', $request->date_from);
        }
        if ($request->has('date_to') && $request->date_to) {
            $query->where('recorded_date', '<=', $request->date_to);
        }

        $performances = $query->orderBy('recorded_date', 'desc')
            ->paginate(20);

        $clients = User::where('role', 'client')
            ->when($gymId, fn ($q) => $q->where('gym_id', $gymId))
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->get();

        return view('admin.performances.index', compact('performances', 'clients'));
    }

    /**
     * Show form to create a new performance record.
     */
    public function create(Request $request)
    {
        $gymId = auth()->user()->gym_id;

        $clients = User::where('role', 'client')
            ->when($gymId, fn ($q) => $q->where('gym_id', $gymId))
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->get();

        // Pre-select client if passed via query string
        $selectedUserId = $request->query('user_id');

        return view('admin.performances.create', compact('clients', 'selectedUserId'));
    }

    /**
     * Store a new performance record.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'recorded_date' => 'required|date',
            'weight' => 'nullable|numeric|min:0',
            'height' => 'nullable|numeric|min:0',
            'body_fat_percentage' => 'nullable|numeric|min:0|max:100',
            'muscle_mass' => 'nullable|numeric|min:0',
            'resting_heart_rate' => 'nullable|integer|min:20|max:250',
            'blood_pressure' => 'nullable|string|max:20',
            'bench_press_max' => 'nullable|numeric|min:0',
            'squat_max' => 'nullable|numeric|min:0',
            'deadlift_max' => 'nullable|numeric|min:0',
            'cardio_duration' => 'nullable|integer|min:0',
            'cardio_distance' => 'nullable|numeric|min:0',
            'sit_and_reach' => 'nullable|numeric',
            'fitness_score' => 'nullable|integer|min:1|max:10',
            'notes' => 'nullable|string',
            'recommendations' => 'nullable|string',
        ]);

        $gymId = auth()->user()->gym_id;

        $performance = ClientPerformance::create([
            'user_id' => $request->user_id,
            'gym_id' => $gymId,
            'recorded_date' => $request->recorded_date,
            'weight' => $request->weight,
            'height' => $request->height,
            'body_fat_percentage' => $request->body_fat_percentage,
            'muscle_mass' => $request->muscle_mass,
            'resting_heart_rate' => $request->resting_heart_rate,
            'blood_pressure' => $request->blood_pressure,
            'bench_press_max' => $request->bench_press_max,
            'squat_max' => $request->squat_max,
            'deadlift_max' => $request->deadlift_max,
            'cardio_duration' => $request->cardio_duration,
            'cardio_distance' => $request->cardio_distance,
            'sit_and_reach' => $request->sit_and_reach,
            'fitness_score' => $request->fitness_score,
            'notes' => $request->notes,
            'recommendations' => $request->recommendations,
        ]);

        return redirect()->route('admin.performances.show', $performance)
            ->with('success', 'Performance record created successfully!');
    }

    /**
     * Display a specific performance record.
     */
    public function show(ClientPerformance $performance)
    {
        $performance->load(['user', 'gym']);

        // Get previous records for this user for comparison
        $previousRecords = ClientPerformance::where('user_id', $performance->user_id)
            ->where('id', '!=', $performance->id)
            ->where('recorded_date', '<=', $performance->recorded_date)
            ->orderBy('recorded_date', 'desc')
            ->take(5)
            ->get();

        return view('admin.performances.show', compact('performance', 'previousRecords'));
    }

    /**
     * Show form to edit a performance record.
     */
    public function edit(ClientPerformance $performance)
    {
        $performance->load(['user']);

        return view('admin.performances.edit', compact('performance'));
    }

    /**
     * Update a performance record.
     */
    public function update(Request $request, ClientPerformance $performance)
    {
        $request->validate([
            'recorded_date' => 'required|date',
            'weight' => 'nullable|numeric|min:0',
            'height' => 'nullable|numeric|min:0',
            'body_fat_percentage' => 'nullable|numeric|min:0|max:100',
            'muscle_mass' => 'nullable|numeric|min:0',
            'resting_heart_rate' => 'nullable|integer|min:20|max:250',
            'blood_pressure' => 'nullable|string|max:20',
            'bench_press_max' => 'nullable|numeric|min:0',
            'squat_max' => 'nullable|numeric|min:0',
            'deadlift_max' => 'nullable|numeric|min:0',
            'cardio_duration' => 'nullable|integer|min:0',
            'cardio_distance' => 'nullable|numeric|min:0',
            'sit_and_reach' => 'nullable|numeric',
            'fitness_score' => 'nullable|integer|min:1|max:10',
            'notes' => 'nullable|string',
            'recommendations' => 'nullable|string',
        ]);

        $performance->update($request->only([
            'recorded_date', 'weight', 'height', 'body_fat_percentage', 'muscle_mass',
            'resting_heart_rate', 'blood_pressure', 'bench_press_max', 'squat_max',
            'deadlift_max', 'cardio_duration', 'cardio_distance', 'sit_and_reach',
            'fitness_score', 'notes', 'recommendations',
        ]));

        return redirect()->route('admin.performances.show', $performance)
            ->with('success', 'Performance record updated successfully!');
    }

    /**
     * Delete a performance record.
     */
    public function destroy(ClientPerformance $performance)
    {
        $performance->delete();

        return redirect()->route('admin.performances.index')
            ->with('success', 'Performance record deleted successfully.');
    }

    /**
     * Show performance history for a specific client (admin/staff view).
     */
    public function clientHistory(Request $request, User $user)
    {
        // Ensure the target user is a client
        if (!$user->isClient()) {
            abort(404);
        }

        $query = ClientPerformance::where('user_id', $user->id);

        // Filter by date range
        if ($request->has('date_from') && $request->date_from) {
            $query->where('recorded_date', '>=', $request->date_from);
        }
        if ($request->has('date_to') && $request->date_to) {
            $query->where('recorded_date', '<=', $request->date_to);
        }

        $performances = $query->orderBy('recorded_date', 'desc')
            ->paginate(10);

        return view('admin.performances.client-history', compact('user', 'performances'));
    }

    /**
     * Display the client's own performance history.
     */
    public function myPerformances(Request $request)
    {
        $user = auth()->user();

        $query = ClientPerformance::where('user_id', $user->id);

        // Filter by date range
        if ($request->has('date_from') && $request->date_from) {
            $query->where('recorded_date', '>=', $request->date_from);
        }
        if ($request->has('date_to') && $request->date_to) {
            $query->where('recorded_date', '<=', $request->date_to);
        }

        $performances = $query->orderBy('recorded_date', 'desc')
            ->paginate(10);

        // Chart data - get all records (up to 20) for visualization
        $chartQuery = ClientPerformance::where('user_id', $user->id)
            ->orderBy('recorded_date', 'asc');
        if ($request->has('date_from') && $request->date_from) {
            $chartQuery->where('recorded_date', '>=', $request->date_from);
        }
        if ($request->has('date_to') && $request->date_to) {
            $chartQuery->where('recorded_date', '<=', $request->date_to);
        }
        $chartRecords = $chartQuery->take(20)->get();

        $chartData = [
            'labels' => $chartRecords->map(fn ($r) => $r->recorded_date->format('M d'))->toArray(),
            'weight' => $chartRecords->map(fn ($r) => $r->weight)->toArray(),
            'bmi' => $chartRecords->map(fn ($r) => $r->bmi)->toArray(),
            'body_fat' => $chartRecords->map(fn ($r) => $r->body_fat_percentage)->toArray(),
            'muscle_mass' => $chartRecords->map(fn ($r) => $r->muscle_mass)->toArray(),
            'fitness_score' => $chartRecords->map(fn ($r) => $r->fitness_score)->toArray(),
            'bench_press' => $chartRecords->map(fn ($r) => $r->bench_press_max)->toArray(),
            'squat' => $chartRecords->map(fn ($r) => $r->squat_max)->toArray(),
            'deadlift' => $chartRecords->map(fn ($r) => $r->deadlift_max)->toArray(),
        ];

        return view('client.performances', compact('user', 'performances', 'chartData'));
    }

    /**
     * Display a single performance record for the client.
     */
    public function showMyPerformance(ClientPerformance $performance)
    {
        // Ensure the user can only view their own records
        if ($performance->user_id !== auth()->id()) {
            abort(403);
        }

        $performance->load(['gym']);

        // Get previous records for comparison
        $previousRecord = ClientPerformance::where('user_id', $performance->user_id)
            ->where('id', '!=', $performance->id)
            ->where('recorded_date', '<', $performance->recorded_date)
            ->orderBy('recorded_date', 'desc')
            ->first();

        // Chart data - get up to 10 most recent records including this one
        $chartRecords = ClientPerformance::where('user_id', $performance->user_id)
            ->where('recorded_date', '<=', $performance->recorded_date)
            ->orderBy('recorded_date', 'asc')
            ->take(10)
            ->get();

        $chartData = [
            'labels' => $chartRecords->map(fn ($r) => $r->recorded_date->format('M d'))->toArray(),
            'weight' => $chartRecords->map(fn ($r) => $r->weight)->toArray(),
            'bmi' => $chartRecords->map(fn ($r) => $r->bmi)->toArray(),
            'body_fat' => $chartRecords->map(fn ($r) => $r->body_fat_percentage)->toArray(),
            'muscle_mass' => $chartRecords->map(fn ($r) => $r->muscle_mass)->toArray(),
            'fitness_score' => $chartRecords->map(fn ($r) => $r->fitness_score)->toArray(),
            'bench_press' => $chartRecords->map(fn ($r) => $r->bench_press_max)->toArray(),
            'squat' => $chartRecords->map(fn ($r) => $r->squat_max)->toArray(),
            'deadlift' => $chartRecords->map(fn ($r) => $r->deadlift_max)->toArray(),
        ];

        return view('client.performance-details', compact('performance', 'previousRecord', 'chartData'));
    }
}
