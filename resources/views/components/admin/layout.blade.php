<div>
<!doctype html>
<html lang="en">  
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SeoDash Free Bootstrap Admin Template by Adminmart</title>
        <x-admin.css></x-admin.css>
    </head>
    <body>
        <!--  Body Wrapper -->
        <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    
            <x-admin.sidebar></x-admin.sidebar>
        
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