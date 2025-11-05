<?php

namespace App\Filament\Resources\Appointments\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use App\Models\Schedule;

class AppointmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('patient_id')
                ->relationship('patient', 'name')
                ->searchable()
                ->required(),
            Select::make('doctor_id')
                ->relationship('doctor', 'name')
                ->searchable()
                ->required()
                ->reactive()
                ->afterStateUpdated(fn($state, $set) => $set('schedule_id', null)),
            DatePicker::make('date')
                ->required()
                ->reactive()
                ->afterStateUpdated(fn($state, $set) => $set('schedule_id', null)),
            Select::make('schedule_id')
                ->label('Available Slot')
                ->options(function (callable $get) {
                    $doctorId = $get('doctor_id');
                    $date = $get('date');
                    
                    if (!$doctorId || !$date) {
                        return [];
                    }
                    
                    if (method_exists(Schedule::class, 'availableSlots')) {
                        return Schedule::availableSlots($doctorId, $date);
                    }
                    
                    // Fallback implementation if availableSlots method doesn't exist
                    return Schedule::where('doctor_id', $doctorId)
                        ->where('day', strtolower(now()->parse($date)->format('l')))
                        ->pluck('start_time', 'id')
                        ->map(fn($time) => $time->format('H:i'));
                })
                ->searchable()
                ->required()
                ->visible(fn(callable $get) => $get('doctor_id') && $get('date')),
            Select::make('status')
                ->options([
                    'Pending' => 'Pending',
                    'Confirmed' => 'Confirmed',
                    'Completed' => 'Completed',
                    'Cancelled' => 'Cancelled',
                ])
                ->default('Pending'),
            Textarea::make('notes')->rows(3),
            ]);
    }
}
