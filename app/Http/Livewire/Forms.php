<?php

namespace App\Http\Livewire;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Select;
use Livewire\Component;

class Forms extends Component implements HasForms
{
    use InteractsWithForms;

    public $Date;
    public $Title;
    public $Research_Name;
    public $Partner_Agency;
    public $Designation;
    public $Start_Date;
    public $Target_Date;
    public $CREC;
    public $URECOM;
    public $Fund;
    public $Budget;
    public $Remarks;

    protected function getFormSchema(): array{

        return[
            DatePicker::make('Date')
                ->minDate(now()->subYears(150))
                ->maxDate(now()),

            TextInput::make('Title'),

            TextInput::make('Research_Name'),

            TextInput::make('Partner_Agency'),

            TextInput::make('Designation'),

            DatePicker::make('Start_Date')
                ->minDate(now()->subYears(150))
                ->maxDate(now()),

            DatePicker::make('Target_Date')
                ->minDate(now()->subYears(150))
                ->maxDate(now()),

            TextInput::make('CREC'),

            TextInput::make('URECOM'),

            Select::make('status')
                ->options([
                    'Internal' => 'Internal',
                    'External' => 'External',
                    'Others' => 'Others',
                ]),

                TextInput::make('Budget')
                    ->numeric()
                    ->mask(fn (TextInput\Mask $mask) => $mask
                        ->numeric()
                        ->decimalPlaces(2) // Set the number of digits after the decimal point.
                        ->minValue(1000) // Set the minimum value that the number can be.
                        ->thousandsSeparator(','), // Add a separator for thousands.
                    ),
                
                TextInput::make('Remarks'),

        ];
    }
    public function render()
    {
        return view('livewire.forms');
    }
}
