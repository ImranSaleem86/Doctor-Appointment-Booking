<?php

namespace App\Filament\Resources\Doctors\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;

class DoctorsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')->square()->label('Photo'),
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('specialization')->label('Specialty')->searchable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('phone'),
                TextColumn::make('fees')->money('PKR', true),
                TextColumn::make('slot_duration')->label('Slot Duration (min)'),
                TextColumn::make('user.name')->label('User Account')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')->dateTime()->label('Added On')->sortable(),
            
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make()->visible(fn() => auth()->user()->hasAnyRole(['admin', 'doctor'])),
                DeleteAction::make()->visible(fn() => auth()->user()->hasRole('admin')),
            
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
