<?php

namespace App\Filament\Resources\Schedules\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ScheduleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('doctor_id')
                ->label('Doctor')
                ->relationship('doctor', 'name')
                ->required(),
                // ->visible(fn() => auth()->user()->hasRole('admin')), // doctors can't change other doctor
            Select::make('day')
                ->label('Day of Week')
                ->options([
                    'monday' => 'Monday',
                    'tuesday' => 'Tuesday',
                    'wednesday' => 'Wednesday',
                    'thursday' => 'Thursday',
                    'friday' => 'Friday',
                    'saturday' => 'Saturday',
                    'sunday' => 'Sunday',
                ])
                ->required(),
            TimePicker::make('start_time')->required(),
            TimePicker::make('end_time')->required(),
            TextInput::make('slot_duration')
                ->numeric()
                ->label('Slot Duration (min)')
                ->default(fn($record) => $record?->doctor->slot_duration ?? 30),
            ]);
    }
}
