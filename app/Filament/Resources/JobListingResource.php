<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobListingResource\Pages;
use App\Filament\Resources\JobListingResource\RelationManagers;
use App\Models\JobListing;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JobListingResource extends Resource
{
    protected static ?string $model = JobListing::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::Make('title'),
                Forms\Components\Textarea::Make('description'),
                Forms\Components\Select::Make('status')
                ->options([
                    'pending'=> 'Pending',
                    'approved'=>'Approved',
                    'rejected'=>'Rejected'
                ]),
                Forms\Components\Select::Make('user_id')
                ->options(User::where('role', 'employer')->pluck('name', 'id')),
//                Forms\Components\Select::Make('user_id')
//                ->relationship('user', 'name')
//                ->searchable()->preload()->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('user.name')->label('Employer Name')->searchable(),
                Tables\Columns\TextColumn::make('work_type')->sortable(),
                Tables\Columns\TextColumn::make('location')->searchable(),
                Tables\Columns\TextColumn::make('application_deadline')->searchable(),
                Tables\Columns\TextColumn::make('status')->sortable(),
                Tables\Columns\TextColumn::make('description')->searchable(),

            ])
            ->filters([
                Tables\Filters\SelectFilter::make('work_type')->options([
                    'remote'=>'Remote',
                    'on_site'=>'On Site',
                    'hybrid' => 'Hybrid'
                ]),
                Tables\Filters\SelectFilter::make('status')->options([
                    'pending'=> 'Pending',
                    'approved'=>'Approved',
                    'rejected'=>'Rejected'
                ])
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
            'index' => Pages\ListJobListings::route('/'),
            'create' => Pages\CreateJobListing::route('/create'),
            'edit' => Pages\EditJobListing::route('/{record}/edit'),
        ];
    }
}
