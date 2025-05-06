<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\CommentResource\Pages;
use App\Filament\Admin\Resources\CommentResource\RelationManagers;
use App\Models\Comment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class CommentResource extends Resource
{
   protected static ?string $model = Comment::class;

   protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
   
   protected static ?string $navigationGroup = 'Content Management';
   
   protected static ?int $navigationSort = 4;
   
   protected static ?string $recordTitleAttribute = 'content';

   public static function form(Form $form): Form
   {
       return $form
           ->schema([
               Forms\Components\Card::make()
                   ->schema([
                       Forms\Components\Select::make('article_id')
                           ->relationship('article', 'title')
                           ->required()
                           ->searchable()
                           ->preload(),
                           
                       Forms\Components\Select::make('user_id')
                           ->relationship('user', 'name')
                           ->required()
                           ->searchable()
                           ->preload(),
                           
                       Forms\Components\Select::make('parent_id')
                           ->label('Reply To')
                           ->relationship('parent', 'content', function (Builder $query) {
                               return $query->where('parent_id', null);
                           })
                           ->getOptionLabelFromRecordUsing(fn (Comment $record) => 
                               Str::limit($record->content, 50) . ' (by ' . $record->user->name . ')')
                           ->searchable()
                           ->preload()
                           ->placeholder('This is a top-level comment'),
                   ])
                   ->columns(2),
                   
               Forms\Components\Card::make()
                   ->schema([
                       Forms\Components\MarkdownEditor::make('content')
                           ->required()
                           ->columnSpanFull(),
                           
                       Forms\Components\Toggle::make('is_approved')
                           ->label('Approved')
                           ->helperText('Unapproved comments will not be visible to users')
                           ->default(true),
                   ]),
           ]);
   }

   public static function table(Table $table): Table
   {
       return $table
           ->columns([
               Tables\Columns\TextColumn::make('id')
                   ->sortable()
                   ->toggleable(isToggledHiddenByDefault: true),
               
               Tables\Columns\TextColumn::make('content')
                   ->limit(50)
                   ->tooltip(function (Comment $record): string {
                       return $record->content;
                   })
                   ->searchable(),
                   
               Tables\Columns\TextColumn::make('article.title')
                   ->sortable()
                   ->searchable()
                   ->limit(30)
                   ->url(fn (Comment $record) => 
                       route('filament.admin.resources.articles.edit', ['record' => $record->article_id])),
                   
               Tables\Columns\TextColumn::make('user.name')
                   ->label('Author')
                   ->sortable()
                   ->searchable(),
                   
               Tables\Columns\IconColumn::make('is_approved')
                   ->label('Status')
                   ->boolean()
                   ->sortable()
                   ->trueIcon('heroicon-o-check-circle')
                   ->falseIcon('heroicon-o-x-circle')
                   ->trueColor('success')
                   ->falseColor('danger'),
               
               Tables\Columns\TextColumn::make('parent.content')
                   ->label('Reply To')
                   ->limit(20)
                   ->placeholder('Top-level comment')
                   ->toggleable(),
                   
               Tables\Columns\TextColumn::make('replies_count')
                   ->counts('replies')
                   ->label('Replies')
                   ->sortable(),
                   
               Tables\Columns\TextColumn::make('created_at')
                   ->dateTime()
                   ->sortable()
                   ->toggleable(),
                   
               Tables\Columns\TextColumn::make('updated_at')
                   ->dateTime()
                   ->sortable()
                   ->toggleable(isToggledHiddenByDefault: true),
           ])
           ->filters([
               Tables\Filters\SelectFilter::make('article')
                   ->relationship('article', 'title')
                   ->searchable()
                   ->preload(),
                   
               Tables\Filters\SelectFilter::make('user')
                   ->relationship('user', 'name')
                   ->searchable()
                   ->preload(),
                   
               Tables\Filters\TernaryFilter::make('is_approved')
                   ->label('Approval Status')
                   ->placeholder('All Comments')
                   ->trueLabel('Approved Comments')
                   ->falseLabel('Pending Comments'),
                   
               Tables\Filters\TernaryFilter::make('has_parent')
                   ->label('Comment Type')
                   ->placeholder('All Comments')
                   ->trueLabel('Replies Only')
                   ->falseLabel('Top-level Only')
                   ->queries(
                       true: fn (Builder $query) => $query->whereNotNull('parent_id'),
                       false: fn (Builder $query) => $query->whereNull('parent_id'),
                   ),
                   
               Tables\Filters\TrashedFilter::make(),
           ])
           ->actions([
               Tables\Actions\ActionGroup::make([
                   Tables\Actions\ViewAction::make(),
                   Tables\Actions\EditAction::make(),
                   Tables\Actions\Action::make('approve')
                       ->label('Approve')
                       ->icon('heroicon-o-check-circle')
                       ->color('success')
                       ->visible(fn (Comment $record) => !$record->is_approved)
                       ->action(fn (Comment $record) => $record->update(['is_approved' => true])),
                       
                   Tables\Actions\Action::make('unapprove')
                       ->label('Unapprove')
                       ->icon('heroicon-o-x-circle')
                       ->color('danger')
                       ->visible(fn (Comment $record) => $record->is_approved)
                       ->action(fn (Comment $record) => $record->update(['is_approved' => false])),
                       
                   Tables\Actions\DeleteAction::make(),
                   Tables\Actions\ForceDeleteAction::make(),
                   Tables\Actions\RestoreAction::make(),
               ]),
           ])
           ->bulkActions([
               Tables\Actions\BulkActionGroup::make([
                   Tables\Actions\DeleteBulkAction::make(),
                   Tables\Actions\ForceDeleteBulkAction::make(),
                   Tables\Actions\RestoreBulkAction::make(),
                   Tables\Actions\BulkAction::make('approveSelected')
                       ->label('Approve Selected')
                       ->icon('heroicon-o-check-circle')
                       ->color('success')
                       ->action(fn (Collection $records) => $records->each->update(['is_approved' => true]))
                       ->deselectRecordsAfterCompletion(),
                       
                   Tables\Actions\BulkAction::make('unapproveSelected')
                       ->label('Unapprove Selected')
                       ->icon('heroicon-o-x-circle')
                       ->color('danger')
                       ->action(fn (Collection $records) => $records->each->update(['is_approved' => false]))
                       ->deselectRecordsAfterCompletion(),
               ]),
           ])
           ->defaultSort('created_at', 'desc');
   }

   public static function getRelations(): array
   {
       return [
           RelationManagers\RepliesRelationManager::make(),
       ];
   }

   public static function getPages(): array
   {
       return [
           'index' => Pages\ListComments::route('/'),
           'create' => Pages\CreateComment::route('/create'),
           'view' => Pages\ViewComment::route('/{record}'),
           'edit' => Pages\EditComment::route('/{record}/edit'),
       ];
   }
   
   public static function getEloquentQuery(): Builder
   {
       return parent::getEloquentQuery()
           ->withoutGlobalScopes([
               SoftDeletingScope::class,
           ]);
   }
   
   public static function getGloballySearchableAttributes(): array
   {
       return ['content', 'user.name', 'article.title'];
   }
   
   public static function getNavigationBadge(): ?string
   {
       return static::getModel()::where('is_approved', false)->count() ?: null;
   }
   
   public static function getNavigationBadgeColor(): ?string
   {
       return static::getModel()::where('is_approved', false)->count() > 0 ? 'warning' : null;
   }
}