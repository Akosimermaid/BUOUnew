<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Illuminate\Support\Facades\Hash;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;

// I've imported the Class for the Export
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Here are the Data Columns For the User Table
                Card::make()
                    ->schema([
                        TextInput::make('name')
                            ->dehydrateStateUsing(fn ($state) => ucwords($state))
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->email()
                            ->label('Email Address')
                            ->maxLength(255),
                        TextInput::make('password')
                            ->password()
                            ->required()
                            ->minlength(8)
                            ->same('passwordConfirmation')
                            ->dehydrated(fn ($state) => filled($state))
                            ->dehydrateStateUsing(fn($state) => Hash::make($state)),
                        TextInput::make('passwordConfirmation')
                            ->password()
                            ->label('Password Confirmation')
                            ->required()
                            ->minlength(8)
                            ->dehydrated(false),
                    ])  
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        // Here are the specified function to be shown in the table ui 
            ->columns([
                TextColumn::make('id')
                ->label('ID')
                ->sortable(),
                TextColumn::make('name')
                ->label('NAME')
                ->searchable(),
                TextColumn::make('email')
                ->label('EMAIL')
                ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),

                //This is for the Export Function Plug in
                FilamentExportBulkAction::make('export')
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }    
}
