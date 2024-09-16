<div>
    <div>
        <!doctype html>
        <html lang="en">  
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <title>{{ $title ?? 'Default Title' }}</title>
                <x-admin.css></x-admin.css>
            </head>
            <body>
                <!--  Body Wrapper -->
                <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
            
                    <x-seller.sidebar></x-seller.sidebar>
                
                    <!--  Main wrapper -->
                    <div class="body-wrapper">
                
                        <x-admin.header></x-admin.header>
                        
                        {{ $slot }}
        
                    </div>
                </div>
        
                <x-admin.js></x-admin.js>
        
            </body>
        </html>
        </div>
</div>