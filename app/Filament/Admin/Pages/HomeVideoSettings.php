<?php

namespace App\Filament\Admin\Pages;

use App\Models\SiteSetting;
use BackedEnum;
use UnitEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Concerns\InteractsWithFormActions;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Schema;

/**
 * @property-read Schema $form
 */
class HomeVideoSettings extends Page
{
    use InteractsWithFormActions;

    /** @var array<string, mixed>|null */
    public ?array $data = [];

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-film';

    protected static ?string $navigationLabel = 'Видео (начало)';

    protected static ?string $title = 'Видео в началната страница';

    protected static string|UnitEnum|null $navigationGroup = 'Съдържание';

    public function mount(): void
    {
        $this->form->fill(
            SiteSetting::current()->only([
                'home_video_path',
                'home_video_poster',
                'home_video_button_enabled',
                'home_video_button_label',
                'home_video_button_url',
            ])
        );
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('home_video_path')
                    ->label('Видеоклип (MP4)')
                    ->disk('public')
                    ->directory('videos')
                    ->acceptedFileTypes(['video/mp4'])
                    ->maxSize(102400)
                    ->helperText('MP4, формат 16:9. Препоръчително до ~100 MB. Клипът се пуска автоматично, без звук, в цикъл.'),

                FileUpload::make('home_video_poster')
                    ->label('Постер изображение (по избор)')
                    ->disk('public')
                    ->directory('videos')
                    ->image()
                    ->maxSize(4096)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->helperText('Показва се докато клипът се зарежда. Препоръчително 1920x1080 (16:9).'),

                Toggle::make('home_video_button_enabled')
                    ->label('Показвай бутон върху видеото')
                    ->default(true)
                    ->live(),

                TextInput::make('home_video_button_label')
                    ->label('Текст на бутона')
                    ->placeholder(SiteSetting::DEFAULT_VIDEO_BUTTON_LABEL)
                    ->maxLength(60)
                    ->visible(fn ($get) => $get('home_video_button_enabled'))
                    ->helperText('Ако се остави празно, се показва „'.SiteSetting::DEFAULT_VIDEO_BUTTON_LABEL.'“.'),

                TextInput::make('home_video_button_url')
                    ->label('Линк на бутона')
                    ->url()
                    ->placeholder(SiteSetting::DEFAULT_VIDEO_BUTTON_URL)
                    ->maxLength(255)
                    ->visible(fn ($get) => $get('home_video_button_enabled'))
                    ->helperText('Пълен адрес, напр. https://tools.viscctv.com'),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        SiteSetting::current()->update($data);

        Notification::make()
            ->success()
            ->title('Видеото е запазено')
            ->send();
    }

    public function content(Schema $schema): Schema
    {
        return $schema->components([
            $this->getFormContentComponent(),
        ]);
    }

    public function getFormContentComponent(): Form
    {
        return Form::make([EmbeddedSchema::make('form')])
            ->id('form')
            ->livewireSubmitHandler('save')
            ->footer([
                Actions::make($this->getFormActions())
                    ->alignment($this->getFormActionsAlignment())
                    ->fullWidth($this->hasFullWidthFormActions())
                    ->key('form-actions'),
            ]);
    }

    /**
     * @return array<Action>
     */
    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Запази')
                ->submit('save')
                ->keyBindings(['mod+s']),
        ];
    }
}
