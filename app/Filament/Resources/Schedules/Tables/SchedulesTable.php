<?php

namespace App\Filament\Resources\Schedules\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class SchedulesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('doctor.name')->label('Doctor')->sortable()->searchable(),
                TextColumn::make('day')->sortable(),
                TextColumn::make('start_time')->label('Start Time')->time(),
                TextColumn::make('end_time')->label('End Time')->time(),
                TextColumn::make('slot_duration')->label('Slot Duration (min)'),
                TextColumn::make('created_at')->label('Added On')->dateTime()->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
