<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ArticleResource\Pages\CreateArticle;
use App\Filament\Admin\Resources\ArticleResource\Pages\EditArticle;
use App\Filament\Admin\Resources\ArticleResource\Pages\ListArticles;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\FormsComponent;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Support\Str;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Content Management';
    protected static ?int $navigationSort = 100;

    public static function form(Form $form): Form
    {
        // Get the current user and check if they have the Writer role
        $user = auth()->user();
        $isWriter = $user->hasRole('Writer');

        return $form
            ->schema([
                Forms\Components\Section::make('Article Details')
                ->schema([
                    Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (string $state, Forms\Set $set) {
                        // Auto-generate slug from title
                        $set('slug', Str::slug($state));
                    }),
                    Forms\Components\TextInput::make('slug')
                        ->required()
                        ->maxLength(255)
                        ->unique(Article::class, 'slug', ignoreRecord: true)
                        ->disabled(fn () => !$user->can('edit_slug'))
                        ->dehydrated(),
                    Forms\Components\Textarea::make('excerpt')
                    ->maxLength(255)
                    ->rows(3)
                    ->helperText('Brief summary of the article (max 255 characters)'),
                    Forms\Components\RichEditor::make('content')
                    ->required(),
                    Forms\Components\FileUpload::make('thumbnail')
                        ->image()
                        ->required(),
                    Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $state, Forms\Set $set) {
                                $set('slug', Str::slug($state));
                            }),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique('categories', 'slug', ignoreRecord: true),
                    ]),

                    Forms\Components\Select::make('tags')
                        ->relationship('tags', 'name')
                        ->multiple()
                        ->preload()
                        ->createOptionForm([
                            Forms\Components\TextInput::make('name')
                                ->required()
                                ->maxLength(255)
                                ->live(onBlur: true)
                                ->afterStateUpdated(function (string $state, Forms\Set $set) {
                                    $set('slug', Str::slug($state));
                                }),
                            Forms\Components\TextInput::make('slug')
                                ->required()
                                ->maxLength(255)
                                ->unique('tags', 'slug', ignoreRecord: true),
                        ]),
                ]),
                // Publishing details section - hidden from Writer role
                Forms\Components\Section::make('Publishing Details')
                ->schema([
                    Forms\Components\Toggle::make('is_featured')
                        ->label('Featured Article')
                        ->helperText('Display this article in featured sections'),
                    Forms\Components\Toggle::make('is_breaking')
                        ->label('Breaking News Article')
                        ->helperText('Display this article in breaking news sections'),
                    Forms\Components\DateTimePicker::make('published_at')
                        ->label('Publish Date')
                        ->required(fn (Forms\Get $get) => $get('status') === 'scheduled')
                        ->default(now()),
                    Forms\Components\Select::make('status')
                        ->options([
                            'draft' => 'Draft',
                            'published' => 'Published',
                            'archived' => 'Archived',
                        ])
                        ->default('draft')
                        ->required(),
                ])
                ->hidden($isWriter), // Hide entire section for Writer role

            // SEO section
            Forms\Components\Section::make('SEO')
                ->schema([
                    Forms\Components\TextInput::make('meta_title')
                        ->maxLength(60)
                        ->helperText('Recommended: 50-60 characters')
                        ->placeholder('Leave blank to use article title'),
                    Forms\Components\Textarea::make('meta_description')
                        ->maxLength(160)
                        ->rows(2)
                        ->helperText('Recommended: 150-160 characters'),
                ])
                ->collapsible(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('author.name')->label('Author')->sortable(),
                Tables\Columns\TextColumn::make('category.name')->label('Category')->sortable(),
                Tables\Columns\BooleanColumn::make('is_featured')->label('Featured'),
                Tables\Columns\TextColumn::make('published_at')->dateTime()->sortable(),
                Tables\Columns\TextColumn::make('views_count')->label('Views')->sortable(),
                Tables\Columns\TextColumn::make('status')->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'archived' => 'Archived',
                    ]),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => ListArticles::route('/'),
            'create' => CreateArticle::route('/create'),
            'edit' => EditArticle::route('/{record}/edit'),
        ];
    }
}