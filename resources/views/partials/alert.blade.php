@if (Session::has('alert'))
    <script>
        Swal.fire({
            icon: '{{ Session::get('alert.icon') }}',
            title: '{{ Session::get('alert.title') }}',
            text: '{{ Session::get('alert.text') }}',
        });
    </script>
@endif
