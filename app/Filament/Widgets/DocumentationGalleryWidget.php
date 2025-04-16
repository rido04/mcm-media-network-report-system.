<?php
namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Documentation;

class DocumentationGalleryWidget extends Widget
{
    protected static ?int $sort = 15;
    protected static string $view = 'filament.widgets.documentation-gallery-widget';

    protected int | string | array $columnSpan = 'full';

    public function getViewData(): array
    {
        return [
            'docs' => Documentation::latest()->take(6)->get(), // Ambil 6 dokumen terbaru
        ];
    }
}
