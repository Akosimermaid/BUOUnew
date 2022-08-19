<?php

namespace App\Filament\Resources;
use Closure;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use App\Models\agency;
use App\Models\Research;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ResearchResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ResearchResource\RelationManagers;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;

class ResearchResource extends Resource
{
    protected static ?string $model = Research::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Heres the data shown in the Research Table
                //I used card in order to properly show the input fields in 2 columns
                Card::make()
                    ->schema([
                    DatePicker::make('Date')->required(),

                    TextInput::make('Title')
                    ->dehydrateStateUsing(fn ($state) => ucwords($state))
                    ->required(),

                    TextInput::make('Research_Name' )
                    ->dehydrateStateUsing(fn ($state) => ucwords($state))
                    ->required(),

                    Select::make('Partner_Agency')
                    ->options(agency::all()->pluck('Name'))
                    ->required(), 

                    TextInput::make('Designation')
                    ->dehydrateStateUsing(fn ($state) => ucwords($state))
                    ->required(),

                    DatePicker::make('Start_Date')->required(),

                    DatePicker::make('Target_Date')->required(),

                    Select::make('CREC')
                    ->label('CREC')
                    ->options([
                        'Approved' => 'Approved',
                        'Disapproved' => 'Disapproved',
                        'Rework' => 'Rework',
                    ])
                    ->required(),

                    Select::make('URECOM')
                    ->label('URECOM')
                    ->options([
                        'Approved' => 'Approved',
                        'Disapproved' => 'Disapproved',
                        'Rework' => 'Rework',
                    ])
                    ->required(),

                    TextInput::make('Fund')
                        ->label('Funds  (If Others Please Specify)')
                        ->datalist([
                            'Internal',
                            'External',
                        ])
                        ->required(),  

                    TextInput::make('Budget')->required()
                        ->numeric()
                        ->mask(fn (TextInput\Mask $mask) => $mask
                        ->numeric()
                        ->decimalPlaces(2) // Set the number of digits after the decimal point.
                        ->decimalSeparator('.') // Add a separator for decimal numbers.
                        ->mapToDecimalSeparator([',']) // Map additional characters to the decimal separator.
                        ->minValue(100) // Set the minimum value that the number can be.
                        ->normalizeZeros() // Append or remove zeros at the end of the number.
                        ->padFractionalZeros() // Pad zeros at the end of the number to always maintain the maximum number of decimal places.
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
        // Here are the data shown in the table ui, the columns with the "searchable" can be searched in the searching function
            ->columns([
                TextColumn::make('id')
                ->label('ID')
                ->sortable()
                ->searchable(),

                TextColumn::make('Date')
                ->label('DATE'),
                
                TextColumn::make('Title')
                ->label('TITLE')
                ->searchable(),

                TextColumn::make('Research_Name')
                ->label('RESEARCHERS NAME')
                ->searchable(),
                TextColumn::make('Partner_Agency')
                ->label('PARTNER AGENCY')
                ->searchable(),

                TextColumn::make('Designation')
                ->label('DESIGNATION')
                ->searchable(),

                TextColumn::make('Start_Date')
                ->label('START DATE'),

                TextColumn::make('Target_Date')
                ->label('TARGET DATE'),

                TextColumn::make('CREC')
                ->label('CREC'),

                TextColumn::make('URECOM')
                ->label('URECOM'),

                TextColumn::make('Fund')
                ->label('FUND'),

                TextColumn::make('Budget')
                ->label('BUDGET')
                ->money('php'),

                TextColumn::make('Remarks')
                ->label('REMARKS'),

            ])
            ->filters([
                Filter::make('Target_Date')
                    ->label('On-Going')
                    ->query(fn (Builder $query): Builder => $query->where('Target_Date','>', Carbon::now())),
                SelectFilter::make('CREC')
                    ->label('CREC')
                    ->options([
                        'Approved' => 'Approved',
                        'Disapproved' => 'Disapproved',
                        'Rework' => 'Rework',
                    ]),

                SelectFilter::make('URECOM')
                    ->label('URECOM')
                    ->options([
                        'Approved' => 'Approved',
                        'Disapproved' => 'Disapproved',
                        'Rework' => 'Rework',
                    ])
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                
                // This is for the export function
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
