<div>
    <!DOCTYPE html>
    <html lang="en">

        <head>
            <meta charset="utf-8">
            <title>{{ $title ?? 'Default Title' }}</title>
            <meta content="width=device-width, initial-scale=1.0" name="viewport">
            <meta content="" name="keywords">
            <meta content="" name="description">
            <x-layout.css-main></x-layout.css-main>
        </head>

        <body>
            <x-layout.spinner-main></x-layout.spinner-main>
            
            <x-layout.navbar-main></x-layout.navbar-main>

            @isset($header)
                {{ $header }}
            @endisset

            {{ $slot }}

            <x-layout.footer-main></x-layout.footer-main>
            
            <x-layout.js-main></x-layout.js-main>
        </body>

    </html>
</div>
