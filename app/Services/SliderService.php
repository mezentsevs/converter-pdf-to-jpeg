<?php

namespace App\Services;

use App\Helpers\StringHelper;
use App\Models\Document;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class SliderService
{
    public function getSlides(Document $document): array
    {
        $slides = [];

        foreach ($document->images as $image) {
            $slides[] = asset(
                'storage'
                . DS . $document->images_relative_path
                . DS . $image->filename,
            );
        }

        return $slides;
    }

    public function writeIndexHtml(Document $document): void
    {
        Storage::disk('public')->put(
            $document->slider_relative_path . DS . 'index.html',
            $this->getContentForIndexHtml($document),
        );
    }

    protected function getContentForIndexHtml(Document $document): string
    {
        $slides = implode(
            "',\n" . str_repeat(' ', 20) . '\'',
            Arr::map($this->getSlides($document), function (string $slide): string {
                return config('images.directory') . DS . basename($slide);
            }),
        );

        $appName = __('app.name');
        $year = date('Y');

        return <<<EOD
            <!DOCTYPE html>
            <html lang="en">
                <head>
                    <meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <title>{$appName}</title>
                    <style>
                        * {
                            margin: 0;
                            padding: 0;
                            box-sizing: border-box;
                        }
                        
                        :root {
                            --color-bg-light: #f3f4f6;
                            --color-bg-dark: #111827;
                            --color-header-bg-light: #ffffff;
                            --color-header-bg-dark: #1f2937;
                            --color-text-light: #111827;
                            --color-text-dark: #f9fafb;
                            --color-border-light: #e5e7eb;
                            --color-border-dark: #374151;
                            --color-slider-bg-light: #ffffff;
                            --color-slider-bg-dark: #1f2937;
                            --color-button-bg-light: #374151;
                            --color-button-bg-dark: #e5e7eb;
                            --color-button-text-light: #ffffff;
                            --color-button-text-dark: #111827;
                            --color-button-hover-light: #4b5563;
                            --color-button-hover-dark: #ffffff;
                            --color-indigo-light: #6366f1;
                            --color-indigo-dark: #4f46e5;
                            --color-shadow-light: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
                            --color-shadow-dark: 0 1px 3px 0 rgba(0, 0, 0, 0.3), 0 1px 2px 0 rgba(0, 0, 0, 0.2);
                            --transition-default: all 0.2s ease-in-out;
                        }
                        
                        body {
                            font-family: 'Figtree', -apple-system, BlinkMacSystemFont, sans-serif;
                            background-color: var(--color-bg-light);
                            color: var(--color-text-light);
                            min-height: 100vh;
                            transition: var(--transition-default);
                            display: flex;
                            flex-direction: column;
                        }
                        
                        @media (prefers-color-scheme: dark) {
                            body {
                                background-color: var(--color-bg-dark);
                                color: var(--color-text-dark);
                            }
                        }
                        
                        .container {
                            max-width: 768px;
                            min-width: 320px;
                            margin: 0 auto;
                            padding: 0 1rem;
                        }
                        
                        header {
                            background-color: var(--color-header-bg-light);
                            box-shadow: var(--color-shadow-light);
                            padding: 1.5rem 0;
                            transition: var(--transition-default);
                        }
                        
                        @media (prefers-color-scheme: dark) {
                            header {
                                background-color: var(--color-header-bg-dark);
                                box-shadow: var(--color-shadow-dark);
                            }
                        }
                        
                        .header-content {
                            display: flex;
                            align-items: center;
                            gap: 0.75rem;
                        }
                        
                        .logo {
                            width: 2.5rem;
                            height: 2.5rem;
                            color: var(--color-indigo-light);
                            transition: var(--transition-default);
                        }
                        
                        @media (prefers-color-scheme: dark) {
                            .logo {
                                color: var(--color-indigo-dark);
                            }
                        }
                        
                        .app-name {
                            font-size: 1.25rem;
                            font-weight: 700;
                            letter-spacing: -0.025em;
                        }
                        
                        main {
                            flex: 1;
                            padding-bottom: 2rem;
                        }
                        
                        .slider-container {
                            background-color: var(--color-slider-bg-light);
                            border-radius: 0.5rem;
                            box-shadow: var(--color-shadow-light);
                            margin: 2rem auto;
                            overflow: hidden;
                            transition: var(--transition-default);
                            min-width: 320px;
                        }
                        
                        @media (prefers-color-scheme: dark) {
                            .slider-container {
                                background-color: var(--color-slider-bg-dark);
                                box-shadow: var(--color-shadow-dark);
                            }
                        }
                        
                        .slider-content {
                            padding: 1rem;
                        }
                        
                        .slide-figure {
                            margin-bottom: 1.5rem;
                        }
                        
                        .slide-image {
                            width: 100%;
                            border-radius: 0.5rem;
                            border: 2px solid var(--color-border-light);
                            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
                            transition: var(--transition-default);
                        }
                        
                        @media (prefers-color-scheme: dark) {
                            .slide-image {
                                border-color: var(--color-border-dark);
                                box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.2);
                            }
                        }
                        
                        .controls-container {
                            margin-bottom: 1.5rem;
                        }
                        
                        .controls-wrapper {
                            display: flex;
                            flex-direction: column;
                            align-items: center;
                            gap: 1rem;
                        }
                        
                        @media (min-width: 640px) {
                            .controls-wrapper {
                                flex-direction: row;
                                justify-content: center;
                            }
                        }
                        
                        .controls-group {
                            display: flex;
                            width: 100%;
                            gap: 1rem;
                        }
                        
                        @media (min-width: 640px) {
                            .controls-group {
                                width: auto;
                            }
                        }
                        
                        .control-button {
                            flex: 1;
                            height: 3rem;
                            display: inline-flex;
                            align-items: center;
                            justify-content: center;
                            border: 1px solid var(--color-border-light);
                            border-radius: 0.5rem;
                            background-color: var(--color-slider-bg-light);
                            color: var(--color-text-light);
                            font-weight: 500;
                            text-transform: uppercase;
                            letter-spacing: 0.05em;
                            cursor: pointer;
                            transition: var(--transition-default);
                            font-size: 0.875rem;
                            padding: 0 1rem;
                        }
                        
                        @media (prefers-color-scheme: dark) {
                            .control-button {
                                background-color: var(--color-slider-bg-dark);
                                border-color: var(--color-border-dark);
                                color: var(--color-text-dark);
                            }
                        }
                        
                        .control-button:hover {
                            transform: scale(1.05);
                            background-color: rgba(0, 0, 0, 0.05);
                        }
                        
                        @media (prefers-color-scheme: dark) {
                            .control-button:hover {
                                background-color: rgba(255, 255, 255, 0.1);
                            }
                        }
                        
                        .control-button:active {
                            transform: scale(0.95);
                        }
                        
                        .control-button:focus {
                            outline: 2px solid transparent;
                            outline-offset: 2px;
                            box-shadow: 0 0 0 2px var(--color-indigo-light);
                        }
                        
                        @media (prefers-color-scheme: dark) {
                            .control-button:focus {
                                box-shadow: 0 0 0 2px var(--color-indigo-dark);
                            }
                        }
                        
                        @media (min-width: 640px) {
                            .control-button {
                                flex: none;
                                width: 8rem;
                            }
                        }
                        
                        @media (min-width: 768px) {
                            .control-button {
                                width: 10rem;
                            }
                        }
                        
                        .button-text {
                            font-size: 1.125rem;
                            margin-right: 0.5rem;
                        }
                        
                        @media (max-width: 639px) {
                            .button-text-long {
                                display: none;
                            }
                        }
                        
                        footer {
                            background-color: var(--color-header-bg-light);
                            box-shadow: var(--color-shadow-light);
                            padding: 1.5rem 0;
                            text-align: center;
                            transition: var(--transition-default);
                            margin-top: auto;
                        }
                        
                        @media (prefers-color-scheme: dark) {
                            footer {
                                background-color: var(--color-header-bg-dark);
                                box-shadow: var(--color-shadow-dark);
                            }
                        }
                        
                        .copyright {
                            font-size: 0.875rem;
                            color: var(--color-text-light);
                            opacity: 0.7;
                        }
                        
                        @media (prefers-color-scheme: dark) {
                            .copyright {
                                color: var(--color-text-dark);
                            }
                        }
                    </style>
                </head>
                <body>
                    <header>
                        <div class="container">
                            <div class="header-content">
                                <div class="logo">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 316 316">
                                        <circle fill="currentColor" r="158" cy="158" cx="158" />
                                        <path stroke="#fff" stroke-width="10" fill="#fff" d="M168.987 60.254c-9.255-9.104-19.238-16.397-27.427-17.391a11.476 11.476 0 0 0-1.396-.113H86.269c-.86 0-1.709.339-2.314.967A3.395 3.395 0 0 0 83 46.066V184.45c0 .87.334 1.704.955 2.338.621.623 1.439.962 2.314.962h97.462c.86 0 1.682-.333 2.303-.962s.966-1.462.966-2.338V92.364c-.191-10.689-8.46-22.346-18.013-32.11zm11.464 120.87H89.528V49.36h50.641v.011c2.208-.134 4.113 2.074 5.573 7.126 1.327 4.81 1.66 11.082 1.656 15.43.01 3.186-.144 5.325-.144 5.325l-.26 3.504 3.482.038c.016 0 8.046.096 15.921 1.907 7.569 1.656 13.486 4.955 14.038 8.69.021.334.027.667.021.979v88.754h-.005z" />
                                        <path stroke="#fff" stroke-width="16" fill="#fff" d="M133 133.25h100v140H133z" />
                                        <path stroke="currentColor" stroke-width="10" fill="currentColor" d="M158 174.5c-9.116 0-16.5-7.384-16.5-16.5s7.384-16.5 16.5-16.5 16.5 7.384 16.5 16.5-7.384 16.5-16.5 16.5z" />
                                        <path stroke="currentColor" stroke-width="10" fill="currentColor" d="m168.5 259.11 26.5-65 26.5 65h-53z" />
                                        <path stroke="currentColor" stroke-width="10" fill="currentColor" d="m144.5 259.11 14.5-22.158 14.5 22.159h-29z" />
                                    </svg>
                                </div>
                                <h1 class="app-name">{$appName}</h1>
                            </div>
                        </div>
                    </header>
                    
                    <main>
                        <div class="container">
                            <section class="slider-container">
                                <div class="slider-content">
                                    <figure class="slide-figure">
                                        <img id="slide" class="slide-image" src="" alt="Slide">
                                    </figure>
                                    
                                    <div class="controls-container">
                                        <div class="controls-wrapper">
                                            <div class="controls-group">
                                                <button id="prev" class="control-button" onclick="slider.prev()">
                                                    <span class="button-text">&lsaquo;</span>
                                                    <span class="button-text-long">Previous</span>
                                                </button>
                                                <button id="next" class="control-button" onclick="slider.next()">
                                                    <span class="button-text-long">Next</span>
                                                    <span class="button-text">&rsaquo;</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </main>
                    
                    <footer>
                        <div class="container">
                            <small class="copyright">
                                &copy; {$year} {$appName}. All rights reserved.
                            </small>
                        </div>
                    </footer>
                    
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
                </body>
            </html>
            EOD;
    }

    public function makeSliderArchiveFullPath(Document $document, string $archiveFileExtension): string
    {
        return $document->slider_archive_absolute_path
            . DS . StringHelper::trimHashAndExt($document->filename)
            . SD
            . $archiveFileExtension;
    }
}
