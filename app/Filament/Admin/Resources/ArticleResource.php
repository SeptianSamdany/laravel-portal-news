<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ArticleResource\Pages;
use App\Filament\Admin\Resources\ArticleResource\RelationManagers;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Illuminate\Support\Collection;

class ArticleResource extends Resource
{
   protected static ?string $model = Article::class;

   protected static ?string $navigationIcon = 'heroicon-o-document-text';
   
   protected static ?string $navigationGroup = 'Content Management';
   
   protected static ?int $navigationSort = 1;
   
   protected static ?string $recordTitleAttribute = 'title';

   public static function form(Form $form): Form
   {
       return $form
           ->schema([
               Forms\Components\Tabs::make('Article')
                   ->tabs([
                       Forms\Components\Tabs\Tab::make('Basic Information')
                           ->schema([
                               Forms\Components\TextInput::make('title')
                                   ->required()
                                   ->maxLength(255)
                                   ->live(onBlur: true)
                                   ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => 
                                       $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                               
                               Forms\Components\TextInput::make('slug')
                                   ->required()
                                   ->maxLength(255)
                                   ->unique(Article::class, 'slug', ignoreRecord: true),
                               
                                Forms\Components\Select::make('category_id')
                                ->relationship('category', 'name')
                                ->searchable()
                                ->preload()
                                ->createOptionForm([
                                    Forms\Components\TextInput::make('name')
                                        ->required()
                                        ->maxLength(255)
                                        ->live(onBlur: true)
                                        ->afterStateUpdated(fn ($state, Forms\Set $set) => 
                                            $set('slug', Str::slug($state))),
                                    Forms\Components\TextInput::make('slug')
                                        ->required()
                                        ->maxLength(255),
                                ]),

                               Forms\Components\Select::make('author_id')
                                   ->relationship('author', 'name')
                                   ->searchable()
                                   ->required()
                                   ->default(auth()->id())
                                   ->visible(fn () => !auth()->user()->hasRole('Writer'))
                                   ->disabled(fn () => auth()->user()->hasRole('Writer')),
                               
                               Forms\Components\Select::make('status')
                                   ->options([
                                       'draft' => 'Draft',
                                       'published' => 'Published',
                                       'scheduled' => 'Scheduled',
                                   ])
                                   ->default('draft')
                                   ->required()
                                   ->visible(fn () => !auth()->user()->hasRole('Writer'))
                                   ->disabled(fn () => auth()->user()->hasRole('Writer')),
                               
                               Forms\Components\DateTimePicker::make('published_at')
                                   ->label('Publish Date')
                                   ->visible(fn (Forms\Get $get) => 
                                       $get('status') !== 'draft' && !auth()->user()->hasRole('Writer'))
                                   ->required(fn (Forms\Get $get) => $get('status') === 'scheduled')
                                   ->default(now())
                                   ->disabled(fn () => auth()->user()->hasRole('Writer')),
                               
                               Forms\Components\Toggle::make('is_featured')
                                   ->label('Featured Article')
                                   ->default(false)
                                   ->visible(fn () => !auth()->user()->hasRole('Writer'))
                                   ->disabled(fn () => auth()->user()->hasRole('Writer')),
                           ]),
                       
                       Forms\Components\Tabs\Tab::make('Content')
                           ->schema([
                               Forms\Components\Textarea::make('excerpt')
                                   ->rows(3)
                                   ->maxLength(500)
                                   ->helperText('A short summary of the article'),
                               
                               Forms\Components\RichEditor::make('content')
                                   ->required()
                                   ->fileAttachmentsDisk('public')
                                   ->fileAttachmentsDirectory('articles/attachments')
                                   ->columnSpanFull(),
                           ]),
                       
                       Forms\Components\Tabs\Tab::make('Media')
                           ->schema([
                               Forms\Components\FileUpload::make('featured_image')
                                   ->image()
                                   ->imageEditor()
                                   ->disk('public')
                                   ->directory('articles/featured')
                                   ->columnSpanFull(),
                           ]),
                       
                       Forms\Components\Tabs\Tab::make('SEO')
                           ->schema([
                               Forms\Components\TextInput::make('meta_title')
                                   ->maxLength(100)
                                   ->helperText('Leave empty to use the article title'),
                               
                               Forms\Components\Textarea::make('meta_description')
                                   ->rows(3)
                                   ->maxLength(160)
                                   ->helperText('Recommended: 150-160 characters for optimal SEO'),
                               
                               Forms\Components\Select::make('tags')
                                   ->relationship('tags', 'name')
                                   ->multiple()
                                   ->searchable()
                                   ->preload()
                                   ->createOptionForm([
                                       Forms\Components\TextInput::make('name')
                                           ->required()
                                           ->maxLength(255)
                                           ->live(onBlur: true)
                                           ->afterStateUpdated(fn ($state, Forms\Set $set) => 
                                               $set('slug', Str::slug($state))),
                                       Forms\Components\TextInput::make('slug')
                                           ->required()
                                           ->maxLength(255),
                                   ]),
                           ]),
                   ])
                   ->columnSpanFull(),
           ]);
   }

   public static function table(Table $table): Table
   {
       return $table
           ->columns([
               Tables\Columns\ImageColumn::make('featured_image')
                   ->disk('public')
                   ->defaultImageUrl(fn ($record) => $record->featured_image ? null : asset('images/placeholder.jpg'))
                   ->circular()
                   ->size(40),
               
               Tables\Columns\TextColumn::make('title')
                   ->searchable()
                   ->sortable()
                   ->wrap()
                   ->limit(50)
                   ->tooltip(fn (Article $record): string => $record->title),
               
               Tables\Columns\TextColumn::make('author.name')
                   ->sortable()
                   ->searchable(),
               
               Tables\Columns\TextColumn::make('category.name')
                   ->sortable()
                   ->searchable(),
               
               Tables\Columns\BadgeColumn::make('status')
                   ->colors([
                       'danger' => 'draft',
                       'success' => 'published',
                       'warning' => 'scheduled',
                   ]),
               
               Tables\Columns\TextColumn::make('published_at')
                   ->dateTime()
                   ->sortable(),
               
               Tables\Columns\IconColumn::make('is_featured')
                   ->boolean()
                   ->label('Featured')
                   ->sortable(),
               
               Tables\Columns\TextColumn::make('views_count')
                   ->label('Views')
                   ->sortable()
                   ->alignCenter(),
               
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
               Tables\Filters\SelectFilter::make('author')
                   ->relationship('author', 'name')
                   ->searchable()
                   ->preload(),
               
               Tables\Filters\SelectFilter::make('category')
                   ->relationship('category', 'name')
                   ->searchable()
                   ->preload(),
               
               Tables\Filters\SelectFilter::make('status')
                   ->options([
                       'draft' => 'Draft',
                       'published' => 'Published',
                       'scheduled' => 'Scheduled',
                   ]),
               
               Tables\Filters\TernaryFilter::make('is_featured')
                   ->label('Featured Status'),
               
               Tables\Filters\Filter::make('published_at')
                   ->form([
                       Forms\Components\DatePicker::make('published_from'),
                       Forms\Components\DatePicker::make('published_until'),
                   ])
                   ->query(function (Builder $query, array $data): Builder {
                       return $query
                           ->when(
                               $data['published_from'],
                               fn (Builder $query, $date): Builder => $query->whereDate('published_at', '>=', $date),
                           )
                           ->when(
                               $data['published_until'],
                               fn (Builder $query, $date): Builder => $query->whereDate('published_at', '<=', $date),
                           );
                   }),

               Tables\Filters\TrashedFilter::make(),
           ])
           ->actions([
               Tables\Actions\ViewAction::make(),
               Tables\Actions\EditAction::make(),
               Tables\Actions\Action::make('duplicate')
                   ->icon('heroicon-o-document-duplicate')
                   ->action(function (Article $record) {
                       $duplicate = $record->replicate();
                       $duplicate->title = "Copy of {$record->title}";
                       $duplicate->slug = Str::slug("Copy of {$record->title}");
                       $duplicate->views_count = 0;
                       $duplicate->save();
                       
                       // Copy tags
                       $duplicate->tags()->attach($record->tags->pluck('id'));
                       
                       return $duplicate;
                   })
                   ->successNotificationTitle('Article duplicated successfully'),
           ])
           ->bulkActions([
               Tables\Actions\BulkActionGroup::make([
                   Tables\Actions\DeleteBulkAction::make(),
                   Tables\Actions\ForceDeleteBulkAction::make(),
                   Tables\Actions\RestoreBulkAction::make(),
                   Tables\Actions\BulkAction::make('publishAll')
                       ->label('Publish Selected')
                       ->icon('heroicon-o-check-circle')
                       ->requiresConfirmation()
                       ->action(function (Collection $records) {
                           $records->each(function (Article $article) {
                               $article->update([
                                   'status' => 'published',
                                   'published_at' => now(),
                               ]);
                           });
                       })
                       ->deselectRecordsAfterCompletion(),
               ]),
           ])
           ->defaultSort('created_at', 'desc');
   }

   public static function getRelations(): array
   {
       return [
           RelationManagers\CommentsRelationManager::make(),
           RelationManagers\TagsRelationManager::make(),
       ];
   }

   public static function getPages(): array
   {
       return [
           'index' => Pages\ListArticles::route('/'),
           'create' => Pages\CreateArticle::route('/create'),
           'view' => Pages\ViewArticle::route('/{record}'),
           'edit' => Pages\EditArticle::route('/{record}/edit'),
       ];
   }
   
   public static function getEloquentQuery(): Builder
   {
       return parent::getEloquentQuery()
           ->when(auth()->user()->hasRole('Writer'), function (Builder $query) {
               $query->where('author_id', auth()->id());
           })
           ->withoutGlobalScopes([
               SoftDeletingScope::class,
           ]);
   }
   
   public static function getWidgets(): array
   {
       return [
        //    ArticleResource\Widgets\ArticleStatsOverview::class,
       ];
   }
   
   public static function getGloballySearchableAttributes(): array
   {
       return ['title', 'content', 'excerpt', 'author.name', 'category.name'];
   }

   public static function getNavigationBadge(): ?string
    {
        return (string) Article::count();
    }
}