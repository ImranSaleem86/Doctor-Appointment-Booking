<?php

namespace App\Filament\Resources\Patients\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class PatientsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('email')->sortable()->searchable(),
                TextColumn::make('phone')->sortable(),
                TextColumn::make('dob')->date(),
                TextColumn::make('created_at')->label('Registered On')->dateTime(),
            
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
