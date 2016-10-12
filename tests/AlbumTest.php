<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Validators\ImageUrlValidator;


class AlbumTest extends TestCase
{

    public function testRoutes()
    {
        $response = $this->action('GET', 'AlbumsController@index');
        $this->assertEquals(200, $response->status());

        $response = $this->action('GET', 'AlbumsController@create');
        $this->assertEquals(200, $response->status());

        $response = $this->action('GET', 'ImagesController@store');
        $this->assertEquals(405, $response->status());

        $response = $this->action('GET', 'AlbumsController@store');
        $this->assertEquals(405, $response->status());

        $response = $this->action('GET', 'AlbumsController@update', ['id' => 'nonumeric']);
        $this->assertEquals(404, $response->status());

        $response = $this->action('GET', 'ImagesController@update', ['id'=> 'nonnumeric']);
        $this->assertEquals(404, $response->status());

    }

    
    public function testImageUrlValidator(){
        $urlToImageValidator = new ImageUrlValidator();
        $notValid = $urlToImageValidator->isValid('image_url', 'tets.pl', null, null);
        $notValidHttp = $urlToImageValidator->isValid('image_url', 'http://tets.pl', null, null);
        $notValidWithExtension = $urlToImageValidator->isValid('image_url', 'http://tets.pl/img.png', null, null);
        $valid = $urlToImageValidator->isValid('image_url', 'http://placehold.it/350x150', null, null);

        $this->assertFalse($notValid);
        $this->assertFalse($notValidHttp);
        $this->assertFalse($notValidWithExtension);
        $this->assertTrue($valid);
    }


    public function testImageCounterCache(){
        $this->refreshApplication();
        $album = factory(App\Album::class)->create();
        $this->assertEquals(0, $album->images_count);

        $images = factory(App\Image::class, 3)->create([
            'album_id' => $album->id,
        ]);

        $albumRefresh = $album->fresh();

        $this->assertEquals(3, $albumRefresh->images_count);

        $images->first()->delete();

        $albumRefresh = $albumRefresh->fresh();

        $this->assertEquals(2, $albumRefresh->images_count);

    }

}
