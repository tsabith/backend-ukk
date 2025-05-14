<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IndustriResource\Pages;
use App\Filament\Resources\IndustriResource\RelationManagers;
use App\Models\Industri;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;



class IndustriResource extends Resource
{
    protected static ?string $model = Industri::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')
                    ->required()
                    ->label('Nama'),
                TextInput::make('bidang_usaha')
                    ->required()
                    ->label('Bidang Usaha'),
                TextInput::make('alamat')
                    ->required()
                    ->label('Alamat'),
                TextInput::make('kontak')
                    ->required()
                    ->label('Kontak'),
                TextInput::make('email')
                    ->required()
                    ->label('Email')
                    ->email(),
                TextInput::make('website')  
                    ->label('Website')
                    ->url(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama'),
                Tables\Columns\TextColumn::make('bidang_usaha')
                    ->label('Bidang Usaha'),
                Tables\Columns\TextColumn::make('alamat')
                    ->label('Alamat'),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email'),
                Tables\Columns\TextColumn::make('website')
                    ->label('Website'),
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
            'index' => Pages\ListIndustris::route('/'),
            'create' => Pages\CreateIndustri::route('/create'),
            'edit' => Pages\EditIndustri::route('/{record}/edit'),
        ];
    }
}
