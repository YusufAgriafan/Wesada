<div>
    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('/main/lib/wow/wow.min.js ') }}"></script>
    <script src="{{ asset('/main/lib/easing/easing.min.js ') }}"></script>
    <script src="{{ asset('/main/lib/waypoints/waypoints.min.js ') }}"></script>
    <script src="{{ asset('/main/lib/counterup/counterup.min.js  ') }}"></script>
    <script src="{{ asset('/main/lib/owlcarousel/owl.carousel.min.js ') }}"></script>
    <script src="{{ asset('/main/lib/lightbox/js/lightbox.min.js  ') }}"></script>
    

    <!-- Template Javascript -->
    <script src=" {{ asset('/main/js/main.js ') }}"></script>

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