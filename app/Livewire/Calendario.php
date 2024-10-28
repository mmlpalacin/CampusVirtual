<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use App\Models\Asistencia;
use Livewire\Component;
use Carbon\Carbon;

class Calendario extends Component
{
    public $user;
    public $monthOffset = 0; 
    public function mount()
    {
        $this->user = Auth::user();
    }
    
    public function previousWeek()
    {
        $this->monthOffset--; // Retroceder una semana
    }

    public function nextWeek()
    {
        $this->monthOffset++; // Avanzar una semana
    }

    public function render()
    {
        $today = now();
        $currentMonth = $today->copy()->addMonths($this->monthOffset);
        $year = $currentMonth->year;
        $month = $currentMonth->month;
    
        $firstDayOfMonth = Carbon::create($year, $month, 1);
        $lastDayOfMonth = $firstDayOfMonth->copy()->endOfMonth();
    
        $firstDayOfWeek = $firstDayOfMonth->copy()->startOfWeek(Carbon::SUNDAY);
        $lastDayOfWeek = $lastDayOfMonth->copy()->endOfWeek();
    
        $calendar = [];
        $day = $firstDayOfWeek->copy();
    
        while ($day->lte($lastDayOfWeek)) {
            $week = [];
    
            for ($i = 0; $i < 7; $i++) {
                if ($day->month == $month) {
                    $week[] = $day->copy();
                } else {
                    $week[] = null;
                }
                $day->addDay();
            }
    
            if (array_filter($week)) { 
                $calendar[] = $week;
            }
        }
        
        $asistencias = Asistencia::whereHas('user', function ($query) {
            $query->where('user_id', $this->user->id);
        })
        ->whereMonth('date', $month)
        ->whereYear('date', $year)
        ->get();
            $ausencias = $asistencias->filter(function ($asistencia) {
                return $asistencia->estado === 'ausente';
            })->count();
            
            $tardanzas = $asistencias->filter(function ($asistencia) {
                return $asistencia->estado === 'tarde';
            })->count();
            
            $totalFaltas = $ausencias + ($tardanzas * 0.5);
            $totalAsistencias = $asistencias->count();
            
            $promedio = $totalAsistencias > 0 ? round(($totalFaltas / $totalAsistencias) * 100, 2) : 0;
        $monthName = $currentMonth->locale('es')->translatedFormat('F Y');
        return view('livewire.calendario', compact('calendar', 'asistencias', 'monthName', 'promedio'));
    }
}