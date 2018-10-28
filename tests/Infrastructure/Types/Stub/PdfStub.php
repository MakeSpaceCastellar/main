<?php

declare(strict_types=1);

namespace MakeSpace\Tests\Infrastructure\Types\Stub;

use Dompdf\Dompdf;

final class PdfStub
{
    public static function random(): string
    {
        $content = '<h1>This is a test PDF</h1>';
        $dompdf  = new Dompdf();
        $dompdf->loadHtml($content);

        return $dompdf->output();
    }
}
