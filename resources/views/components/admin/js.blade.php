<div>
    <script src="{{ asset('/admin/libs/jquery/dist/jquery.min.js ') }}"></script>
    <script src="{{ asset('/admin/libs/bootstrap/dist/js/bootstrap.bundle.min.js ') }}"></script>
    <script src="{{ asset('/admin/libs/simplebar/dist/simplebar.js ') }}"></script>
    <script src="{{ asset('/admin/js/sidebarmenu.js ') }}"></script>
    <script src="{{ asset('/admin/js/app.min.js ') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>

    {{-- logout --}}
    <script>
        document.getElementById('logout-link').addEventListener('click', function(event) {
            event.preventDefault();
            
            fetch("{{ route('logout') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(response => {
                if (response.ok) {
                    window.location.href = '/';
                }
            }).catch(error => {
                console.error('Error:', error);
            });
        });
    </script>
</div>