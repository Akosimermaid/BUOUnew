<?php

namespace App\Filament\Resources;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use App\Filament\Resources\ResearchResource\Pages;
use App\Filament\Resources\ResearchResource\RelationManagers;
use App\Models\Research;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ResearchResource extends Resource
{
    protected static ?string $model = Research::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
                Card::make()
                    ->schema([
                    DatePicker::make('Date')->required(),

                    TextInput::make('Title')
                    ->dehydrateStateUsing(fn ($state) => ucwords($state))
                    ->required(),

                    TextInput::make('Research_Name' )
                    ->dehydrateStateUsing(fn ($state) => ucwords($state))
                    ->required(),

                    TextInput::make('Partner_Agency')
                    ->dehydrateStateUsing(fn ($state) => ucwords($state))
                    ->required(), 

                    TextInput::make('Designation')
                    ->dehydrateStateUsing(fn ($state) => ucwords($state))
                    ->required(),

                    DatePicker::make('Start_Date')->required(),

                    DatePicker::make('Target_Date')->required(),

                    TextInput::make('CREC')
                    ->dehydrateStateUsing(fn ($state) => ucwords($state))
                    ->required(),

                    TextInput::make('URECOM')
                    ->dehydrateStateUsing(fn ($state) => ucwords($state))
                    ->required(),
                
                    Select::make('Fund')->required()
                        ->options([
                            'Internal' => 'Internal',
                            'External' => 'External',
                            'Others' => 'Others',
                        ]),
                 
                    TextInput::make('Budget')->required()
                        ->numeric()
                        ->mask(fn (TextInput\Mask $mask) => $mask
                        ->numeric()
                        ->decimalPlaces(2) // Set the number of digits after the decimal point.
                        ->minValue(1) // Set the minimum value that the number can be.
                        ->thousandsSeparator(','), // Add a separator for thousands.
                    ),
                    
                    Textarea::make('Remarks')
                    ->dehydrateStateUsing(fn ($state) => ucwords($state))
                    ->required(),

                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('Date')->label('DATE'),
                TextColumn::make('Title')->label('TITLE'),
                TextColumn::make('Research_Name')->label('RESEARCHERS NAME'),
                TextColumn::make('Partner_Agency')->label('PARTNER AGENCY'),
                TextColumn::make('Designation')->label('DESIGNATION'),
                TextColumn::make('Start_Date')->label('START DATE'),
                TextColumn::make('Target_Date')->label('TARGET DATE'),
                TextColumn::make('CREC')->label('CREC'),
                TextColumn::make('URECOM')->label('URECOM'),
                TextColumn::make('Fund')->label('FUND'),
                TextColumn::make('Budget')->label('BUDGET'),
                TextColumn::make('Remarks')->label('REMARKS'),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListResearch::route('/'),
            'create' => Pages\CreateResearch::route('/create'),
            'edit' => Pages\EditResearch::route('/{record}/edit'),
        ];
    }    
}
