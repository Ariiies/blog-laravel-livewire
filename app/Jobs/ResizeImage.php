<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Intervention\image\laravel\Facades\Image;

/**
 * Job to resize an image and save it back to storage.
 *
 * This job retrieves an image from storage, resizes it to a width of 1200 pixels,
 * encodes it with the original file extension at 75% quality, and saves it back
 * to the same storage path.
 *
 * @property string $image_path The path to the image file in storage.
 *
 * @method void __construct(string $image_path) Create a new job instance.
 * @method void handle() Execute the job to resize and save the image.
 */
class ResizeImage implements ShouldQueue
{
    use Queueable;
    public $image_path;
    /**
     * Create a new job instance.
     */
    public function __construct($image_path)
    {
        $this->image_path = $image_path;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $upload = Storage::get($this->image_path);
        $extencion = pathinfo($this->image_path, PATHINFO_EXTENSION);
        $image = Image::read($upload)
        ->scale(1200)
        ->encodeByExtension($extencion, quality: 75);

        Storage::put($this->image_path, $image, 'public');
    }
}
