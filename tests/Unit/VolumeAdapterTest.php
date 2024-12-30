<?php

namespace App\Tests\Unit;

use App\Adapter\VolumeAdapter;

class VolumeAdapterTest extends \Codeception\Test\Unit
{
    public function testSomeFeature()
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

        $adapter = new VolumeAdapter();
        $volume = $adapter->fromGoogleClientItem($item);

        $this->assertEquals($id, $volume->id);
        $this->assertEquals($title, $volume->title);
        $this->assertEquals($authors, $volume->authors);
        $this->assertEquals($description, $volume->description);
    }
}
