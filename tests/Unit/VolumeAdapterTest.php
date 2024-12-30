<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\Adapter\VolumeAdapter;

final class VolumeAdapterTest extends \Codeception\Test\Unit
{
    public function testSomeFeature(): void
    {
        $id = 'djG552fTNb8C';
        $title = 'O Programador Pragmático: De Aprendiz a Mestre';
        $authors = ['Andrew Hunt', 'David Thomas'];
        $description = 'Publicado pela primeira vez em 1968, é um clássico e esclarecedor estudo sobre a história da política contemporânea.Escrito por Peter Calvocoressi, uma figura de destaque mundial no campo das relações internacionais, participante do Julgamento de Nuremberg e professor de Relações Internacionais na Universidade de Sussex, Grã-Bretanha, este livro é essencial para a formação de historiadores, cientistas políticos, sociólogos, jornalistas e leitores em geral.';

        $item = [
            'id' => $id,
            'volumeInfo' => [
                'title' => $title,
                'authors' => $authors,
                'description' => $description,
            ],
        ];

        $volumeAdapter = new VolumeAdapter();
        $volume = $volumeAdapter->fromGoogleClientItem($item);

        $this->assertSame($id, $volume->id);
        $this->assertSame($title, $volume->title);
        $this->assertSame($authors, $volume->authors);
        $this->assertSame($description, $volume->description);
    }
}
