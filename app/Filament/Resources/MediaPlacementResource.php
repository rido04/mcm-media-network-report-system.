<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\AdminTraffic;
use App\Models\MediaPlacement;
use App\Models\MediaStatistic;
use App\Models\DailyImpression;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\MediaPlacementResource\Pages;
use App\Filament\Resources\MediaPlacementResource\RelationManagers;

class MediaPlacementResource extends Resource
{
    protected static ?string $model = MediaPlacement::class;

    protected static ?string $navigationIcon = 'heroicon-o-tv';

    protected static ?string $navigationGroup = 'Table Log';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->label('Client')
                    ->options(User::whereHas('roles', fn($q) => $q->where('name', 'company'))
                    ->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                Select::make('admin_traffic_id')
                    ->label('Category')
                    ->options(function (callable $get) {
                        $userId = $get('user_id');
                        if (!$userId) {
                            return [];
                        }
                        return AdminTraffic::query()
                    ->where('user_id', $userId)
                    ->get()
                    ->pluck('category', 'id')
                    ->toArray();
                    })
                    ->searchable()
                    ->required()
                    ->live(),
                Select::make('media_statistic_id')
                    ->label('Media Plan')
                    ->dehydrated(true)
                    ->options(function (callable $get) {
                        $userId = $get('user_id');
                        if (!$userId) {
                            return [];
                        }
                        return MediaStatistic::where('user_id', $userId)
                            ->select('id', 'media')
                            ->distinct()
                            ->pluck('media', 'id');
                        })
                    ->live()
                    ->required(),
                TextInput::make('media')
                    ->label('Media')
                    ->placeholder('XXX001')
                    ->required(),
                TextINput::make('size')
                    ->label('Size')
                    ->required(),
                Select::make('space_ads')
                    ->label('Space Ads')
                    ->options(function (callable $get) {
                        $category = AdminTraffic::find($get('admin_traffic_id'))?->category;

                        return match ($category) {
                            'Commuterline' => [
                                'Audio Land' => 'Audio Land',
                                'Cover Seat' => 'Cover Seat',
                                'Body Branding' => 'Body Branding',
                                'Wall Branding' => 'Wall Branding',
                                'Ceiling Panel' => 'Ceiling Panel',
                                'Hand Grips' => 'Hand Grips',
                                'Top Door' => 'Top Door',
                                'Standing Panel' => 'Standing Panel',
                                'Full Wrapping' => 'Full Wrapping',
                            ],
                            'Transjakarta' => [
                                'Halte Branding' => 'Halte Branding',
                                'Cover Seat' => 'Cover Seat',
                                'Hand Grips' => 'Hand Grips',
                                'Full Body' => 'Full Body',
                                'Body Branding' => 'Body Branding',
                            ],
                            default => [],
                        };
                    })
                    ->visible(function (callable $get) {
                        $category = AdminTraffic::find($get('admin_traffic_id'))?->category;
                        return in_array($category, ['Commuterline', 'Transjakarta']);
                    })
                    ->required(fn (callable $get) =>
                        in_array(AdminTraffic::find($get('admin_traffic_id'))?->category, ['Commuterline', 'Transjakarta'])
                    )
                    ->live(),
                TextInput::make('space_ads')
                    ->label('Space Ads')
                    ->visible(function (callable $get) {
                        $traffic = AdminTraffic::find($get('admin_traffic_id'));
                        return in_array(optional($traffic)->category, ['OOH', 'DOOH']);
                    }),
                TextInput::make('avg_daily_impression')
                    ->label('Total Impression')
                    ->numeric()
                    ->required()
                    ->minValue(0)
                    ->step(0.01)
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Client')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('mediaStatistic.media')
                    ->label('Media Plan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('media')
                    ->label('Media')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('adminTraffic.category')
                    ->label('Category')
                    ->searchable(),
                TextColumn::make('size')
                    ->label('Size')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('space_ads')
                    ->label('Space Ads')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('avg_daily_impression')
                    ->numeric(2)
                    ->label('Total Impression')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('user.name')
                    ->relationship('user', 'name')
                    ->label('Client'),
                SelectFilter::make('media')
                    ->options(function () {
                        return MediaPlacement::distinct()->pluck('media', 'media');
                    })
                    ->query(function (Builder $query, array $data) {
                        if (!$data['value']) {
                            return $query;
                        }

                        return $query->where('media', $data['value']);
                    })
                    ->label('Media'),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make()
            ])
            ->bulkActions([
                BulkActionGroup::make([
                DeleteBulkAction::make(),
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
            'index' => Pages\ListMediaPlacements::route('/'),
            'create' => Pages\CreateMediaPlacement::route('/create'),
            'edit' => Pages\EditMediaPlacement::route('/{record}/edit'),
        ];
    }
}
