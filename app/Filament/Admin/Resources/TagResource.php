<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\TagResource\Pages;
use App\Filament\Admin\Resources\TagResource\RelationManagers;
use App\Models\Tag;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class TagResource extends Resource
{
   protected static ?string $model = Tag::class;

   protected static ?string $navigationIcon = 'heroicon-o-hashtag';
   
   protected static ?string $navigationGroup = 'Content Management';
   
   protected static ?int $navigationSort = 3;
   
   protected static ?string $recordTitleAttribute = 'name';

   public static function form(Form $form): Form
   {
       return $form
           ->schema([
               Forms\Components\Card::make()
                   ->schema([
                       Forms\Components\TextInput::make('name')
                           ->required()
                           ->maxLength(255)
                           ->live(onBlur: true)
                           ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => 
                               $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                       
                       Forms\Components\TextInput::make('slug')
                           ->required()
                           ->maxLength(255)
                           ->unique(Tag::class, 'slug', ignoreRecord: true),
                           
                       Forms\Components\ColorPicker::make('color')
                           ->label('Tag Color (Optional)')
                           ->rgba(),
                   ])
                   ->columns(2),
           ]);
   }

   public static function table(Table $table): Table
   {
       return $table
           ->columns([
               Tables\Columns\TextColumn::make('name')
                   ->searchable()
                   ->sortable(),
                   
               Tables\Columns\TextColumn::make('slug')
                   ->searchable()
                   ->toggleable(isToggledHiddenByDefault: true),
                   
               Tables\Columns\ColorColumn::make('color')
                   ->toggleable(),
                   
               Tables\Columns\TextColumn::make('articles_count')
                   ->counts('articles')
                   ->label('Articles')
                   ->sortable(),
                   
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
               Tables\Filters\Filter::make('articles_count')
                   ->form([
                       Forms\Components\TextInput::make('min_articles')
                           ->numeric()
                           ->label('Minimum Articles')
                           ->placeholder('0'),
                           
                       Forms\Components\TextInput::make('max_articles')
                           ->numeric()
                           ->label('Maximum Articles')
                           ->placeholder('100'),
                   ])
                   ->query(function (Builder $query, array $data): Builder {
                       return $query
                           ->when(
                               $data['min_articles'],
                               fn (Builder $query, $min): Builder => $query->has('articles', '>=', (int) $min),
                           )
                           ->when(
                               $data['max_articles'],
                               fn (Builder $query, $max): Builder => $query->has('articles', '<=', (int) $max),
                           );
                   })
                   ->indicateUsing(function (array $data): array {
                       $indicators = [];
                       
                       if ($data['min_articles'] ?? null) {
                           $indicators['min_articles'] = 'Min articles: ' . $data['min_articles'];
                       }
                       
                       if ($data['max_articles'] ?? null) {
                           $indicators['max_articles'] = 'Max articles: ' . $data['max_articles'];
                       }
                       
                       return $indicators;
                   }),
           ])
           ->actions([
               Tables\Actions\ViewAction::make(),
               Tables\Actions\EditAction::make(),
               Tables\Actions\DeleteAction::make()
                   ->before(function (Tag $record) {
                       // Detach the tag from all articles before deleting
                       $record->articles()->detach();
                   }),
           ])
           ->bulkActions([
               Tables\Actions\BulkActionGroup::make([
                   Tables\Actions\DeleteBulkAction::make()
                       ->before(function ($records) {
                           // Detach all selected tags from articles before bulk deleting
                           foreach ($records as $record) {
                               $record->articles()->detach();
                           }
                       }),
                       
                   Tables\Actions\BulkAction::make('mergeTags')
                       ->label('Merge Selected Tags')
                       ->icon('heroicon-o-arrow-path')
                       ->requiresConfirmation()
                       ->form([
                           Forms\Components\TextInput::make('new_tag_name')
                               ->label('New Tag Name')
                               ->required(),
                       ])
                       ->action(function (Collection $records, array $data) {
                           // Create a new tag
                           $newTag = Tag::create([
                               'name' => $data['new_tag_name'],
                               'slug' => Str::slug($data['new_tag_name']),
                           ]);
                           
                           // Get all article IDs from the selected tags
                           $articleIds = [];
                           foreach ($records as $tag) {
                               $articleIds = array_merge($articleIds, $tag->articles()->pluck('article_id')->toArray());
                               $tag->articles()->detach();
                           }
                           
                           // Attach all articles to the new tag (with unique values)
                           $newTag->articles()->attach(array_unique($articleIds));
                           
                           // Delete the old tags
                           $records->each->delete();
                           
                           return $newTag;
                       }),
               ]),
           ])
           ->defaultSort('name');
   }

   public static function getRelations(): array
   {
       return [
           RelationManagers\ArticlesRelationManager::make(),
       ];
   }

   public static function getPages(): array
   {
       return [
           'index' => Pages\ListTags::route('/'),
           'create' => Pages\CreateTag::route('/create'),
           'view' => Pages\ViewTag::route('/{record}'),
           'edit' => Pages\EditTag::route('/{record}/edit'),
       ];
   }
   
   public static function getGloballySearchableAttributes(): array
   {
       return ['name', 'slug'];
   }
   
   public static function getNavigationBadge(): ?string
   {
       return (string) Tag::count();
   }
}