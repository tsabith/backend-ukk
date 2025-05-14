<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiswaResource\Pages;
use App\Filament\Resources\SiswaResource\RelationManagers;
use App\Models\Siswa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\IconColumn;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SiswaResource extends Resource
{
    protected static ?string $model = Siswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')->required(),
                Forms\Components\TextInput::make('nis')->required(),
                Forms\Components\Select::make('gender')->options([
                    'L' => 'Laki-laki',
                    'P' => 'Perempuan',
                ])->required(),
                Forms\Components\TextInput::make('alamat'),
                Forms\Components\TextInput::make('kontak'),
                Forms\Components\TextInput::make('email'),
                Forms\Components\FileUpload::make('foto'),
                Forms\Components\Toggle::make('status_lapor_pkl')
                    ->label('Sudah PKL?'),
                Forms\Components\Toggle::make('is_approved')
                    ->label('Disetujui Admin?')
                    ->default(false)
                    ->disabled(fn () => !auth()->user()?->hasRole('super_admin') && !auth()->user()?->hasRole('guru')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama'),
                Tables\Columns\TextColumn::make('nis'),
                Tables\Columns\TextColumn::make('gender'),
                IconColumn::make('status_lapor_pkl')
                    ->label('Status PKL')
                    ->boolean(),
                IconColumn::make('is_approved')
                    ->label('Disetujui')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('status_lapor_pkl')->label('Sudah PKL?'),
                Tables\Filters\TernaryFilter::make('is_approved')->label('Sudah Disetujui?'),
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
            'index' => Pages\ListSiswas::route('/'),
            'create' => Pages\CreateSiswa::route('/create'),
            'edit' => Pages\EditSiswa::route('/{record}/edit'),
        ];
    }
}
