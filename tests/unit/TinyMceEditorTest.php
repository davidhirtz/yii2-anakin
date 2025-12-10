<?php

declare(strict_types=1);

namespace Hirtz\Anakin\tests\unit;

use Codeception\Test\Unit;
use Hirtz\Anakin\assets\AnakinAsset;
use Hirtz\Skeleton\Codeception\Traits\AssetDirectoryTrait;
use Hirtz\Skeleton\Widgets\Forms\TinyMceEditor;
use Yii;

class TinyMceEditorTest extends Unit
{
    use AssetDirectoryTrait;

    public function _before(): void
    {
        $this->createAssetDirectory();
    }

    public function _after(): void
    {
        $this->removeAssetDirectory();
    }

    public function testEditorConfig(): void
    {
        $asset = AnakinAsset::register(Yii::$app->getView());

        $editor = Yii::$container->get(TinyMceEditor::class, [], [
            'name' => 'test',
        ]);

        $this->assertEquals($editor->clientOptions['content_css'], "$asset->baseUrl/css/tinymce.min.css");
    }
}
