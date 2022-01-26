<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Image;
use App\Models\Thumbnail;
use Image as ImageLibrary;


class ProcessImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $image;
    protected $url;

    public function __construct(Image $image, String $url)
    {
        $this->image = $image;
        $this->url = $url;
    }

    
    public function handle()
    {
        $thumbnail = new Thumbnail([
            "image_id" => $this->image->id,
            "file_path" => 'Thumbnail' . $this->image->file_path
        ]);

        $thumbnail->save();

        $imgFile = ImageLibrary::make($this->url);

        $imgFile->resize(100, 100, function ($constraint) {
            $constraint->aspectRatio();
        });

        $imgFile->save(storage_path('app/public/images/' . 'Thumbnail' . $this->image->file_path));

        var_dump("Done");
    }
}
