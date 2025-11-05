<?php

namespace App\Filament\Resources\Notifications\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class NotificationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                ->relationship('user', 'name')
                ->required(),
                // ->visible(fn() => auth()->user()->hasRole('admin')),
                TextInput::make('type')->required(),
                Textarea::make('message')->required(),
                Toggle::make('is_read')->label('Read')->default(false),
            ]);
    }
}
