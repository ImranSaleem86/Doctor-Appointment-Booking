<?php

namespace App\Filament\Resources\Doctors\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Repeater;

class DoctorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                    TextInput::make('name')->required()->maxLength(255),
                    TextInput::make('email')->email()->required(),
                    TextInput::make('phone')->tel(),
                    TextInput::make('specialization')->label('Specialty'),
                    TextInput::make('fees')->numeric()->prefix('PKR'),
                    TextInput::make('slot_duration')->numeric()->label('Slot Duration (min)')->default(30),
                    FileUpload::make('photo')
                        ->image()
                        ->disk('public')
                        ->directory('doctors')
                        ->label('Profile Photo'),

                    Repeater::make('availability')
                        ->label('Available Days & Time Slots')
                        ->schema([
                    Select::make('day')
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
                    ]),
            ]);
    }
}
