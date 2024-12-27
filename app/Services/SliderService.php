<?php

namespace App\Services;

use App\Models\Document;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class SliderService
{
    public function getSlides(Document $document): array
    {
        $slides = [];

        foreach ($document->images as $image) {
            $slides[] = asset('storage'
                . DS . $document->images_relative_path
                . DS . $image->filename
            );
        }

        return $slides;
    }

    public function writeIndexHtmlFile(Document $document): void
    {
        Storage::disk('public')->put(
            $document->slider_relative_path . DS . 'index.html',
            $this->getContentForIndexHtml($document),
        );
    }

    private function getContentForIndexHtml(Document $document): string
    {
        $slides = implode("',\n" . str_repeat(' ', 16) . '\''
            , Arr::map($this->getSlides($document), function (string $slide): string {
                return config('images.directory') . DS . basename($slide);
            }),
        );

        $appName = __('app.name');

        return <<<EOD
            <!DOCTYPE html>
            <html lang="en">
                <head>
                    <meta charset="utf-8">
                    <title>Slider</title>
                </head>
                <style>
                    body { margin: 0; font-family: Arial, serif; font-size: 1em; }
                    header { background: #EEE; height: 50px; }
                    h1 { margin: 0; font-size: 1.2em; text-align: center; line-height: 50px; }
                    main { min-height: 1000px; }
                    #slider { margin: 50px auto; width: 640px; text-align: center; }
                    #slide { width: 620px; border: 2px solid #818cf8; -moz-box-shadow: 1px 1px 1px #CCC; -o-box-shadow: 1px 1px 1px #CCC; -webkit-box-shadow: 1px 1px 1px #CCC; box-shadow: 1px 1px 1px #CCC; }
                    button { margin: 10px 5px; padding: 3px; }
                    footer { background: #EEE; height: 50px; line-height: 50px; text-align: center; }
                </style>
                <script>
                    const slider = {
                        slides: [
                            '{$slides}',
                        ],
                        index: 0,
                        set(slide) { document.getElementById('slide').setAttribute('src', slide); },
                        init() { this.set(this.slides[0]); },
                        prev() {
                            this.index--;
                            if (this.index < 0) { this.index = this.slides.length - 1; }
                            this.set(this.slides[this.index]);
                        },
                        next() {
                            this.index++;
                            if (this.index === this.slides.length) { this.index = 0; }
                            this.set(this.slides[this.index]);
                        },
                    };
                    window.addEventListener('load', () => slider.init());
                </script>
                <body>
                    <header><h1>Slider</h1></header>
                    <main>
                        <figure id="slider">
                            <img id="slide" src="" alt="Slide">
                            <button id="prev" onclick="slider.prev()">&lt;</button>
                            <button id="next" onclick="slider.next()">&gt;</button>
                        </figure>
                    </main>
                    <footer><small>&copy; {$appName}</small></footer>
                </body>
            </html>
            EOD;
    }
}
