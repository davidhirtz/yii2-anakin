<?php

namespace davidhirtz\yii2\anakin\tests\unit;

use Codeception\Test\Unit;
use davidhirtz\yii2\anakin\assets\AnakinAsset;
use davidhirtz\yii2\skeleton\widgets\forms\TinyMceEditor;
use Yii;

class TinyMceEditorTest extends Unit
{
    public function testEditorConfig(): void
    {
        $asset = AnakinAsset::register(Yii::$app->getView());
        $editor = Yii::$container->get(TinyMceEditor::class, [], [
            'name' => 'test',
        ]);

        $this->assertEquals($editor->clientOptions['content_css'], "$asset->baseUrl/css/tinymce.min.css");
    }
}
