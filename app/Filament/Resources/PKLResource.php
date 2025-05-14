<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PKLResource\Pages;
use App\Filament\Resources\PKLResource\RelationManagers;
use App\Models\Pkl;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;

class PKLResource extends Resource
{
    protected static ?string $model = Pkl::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('siswa_id')
                    ->label('Siswa')
                    ->relationship('siswa', 'nama') // assuming you have a 'siswa' relationship
                    ->searchable()
                    ->required(),

                Select::make('guru_id')
                    ->label('Guru')
                    ->relationship('guru', 'nama') // assuming you have a 'guru' relationship
                    ->searchable()
                    ->required(),

                Select::make('industri_id')
                    ->label('Industri')
                    ->relationship('industri', 'nama') // assuming you have a 'industri' relationship
                    ->searchable()
                    ->required(),
                DatePicker::make('tanggal_mulai')
                    ->required()
                    ->label('Tanggal Mulai'),

                DatePicker::make('tanggal_selesai')
                    ->required()
                    ->label('Tanggal Selesai'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('siswa.nama')
                    ->label('Nama Siswa'),
                Tables\Columns\TextColumn::make('industri.nama')
                    ->label('Nama Industri'),
                Tables\Columns\TextColumn::make('guru.nama')
                    ->label('Nama Guru'),
                Tables\Columns\TextColumn::make('tanggal_mulai')
                    ->label('Tanggal Mulai'),
                Tables\Columns\TextColumn::make('tanggal_selesai')
                    ->label('Tanggal Selesai'),
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
            'index' => Pages\ListPKLS::route('/'),
            'create' => Pages\CreatePKL::route('/create'),
            'edit' => Pages\EditPKL::route('/{record}/edit'),
        ];
    }
}
