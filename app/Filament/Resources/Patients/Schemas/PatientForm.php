<?php

namespace App\Filament\Resources\Patients\Schemas;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PatientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->required()->maxLength(255),
                TextInput::make('email')->email()->required()->maxLength(255),
                TextInput::make('phone')->tel()->maxLength(20),
                DatePicker::make('dob')->label('Date of Birth'),
                Textarea::make('address')->rows(3),
            // Forms\Components\Select::make('user_id')
            //     ->relationship('user', 'name')
            //     ->visible(fn() => auth()->user()->hasRole('admin'))
            //     ->required(),
            ]);
    }
}
