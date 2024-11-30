<?php

declare(strict_types=1);

namespace davidhirtz\yii2\anakin\tests\unit;

use Codeception\Test\Unit;
use davidhirtz\yii2\anakin\assets\AnakinAsset;
use davidhirtz\yii2\skeleton\codeception\traits\AssetDirectoryTrait;
use davidhirtz\yii2\skeleton\widgets\forms\TinyMceEditor;
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
