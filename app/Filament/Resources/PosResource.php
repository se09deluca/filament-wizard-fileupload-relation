<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PosResource\Pages;
use App\Filament\Resources\PosResource\RelationManagers;
use App\Models\Pos;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PosResource extends Resource
{
    protected static ?string $model = Pos::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Wizard::make([
                    self::getWizardSteps()
                ])
            ]);
    }

    public static function getWizardSteps(): array {
        return [
            Wizard\Step::make('Pos')
                ->schema([
                    Forms\Components\TextInput::make('pos_name')
                ]),
            Wizard\Step::make('Doc data')
                ->schema([
                    Forms\Components\Group::make()
                        ->relationship('document')
                        ->schema([
                            FileUpload::make('file')
                                ->storeFileNamesIn('client_filename'),

                            Forms\Components\TextInput::make('name')
                        ])
                ]),
            Wizard\Step::make('Doc Description')
                ->schema([
                    Forms\Components\Group::make()
                        ->relationship('document')
                        ->schema([
                            Forms\Components\TextInput::make('description')
                        ])
                ])
        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListPos::route('/'),
            'create' => Pages\CreatePos::route('/create'),
            'edit' => Pages\EditPos::route('/{record}/edit'),
        ];
    }
}
