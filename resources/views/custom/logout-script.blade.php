<script>
    document.addEventListener('filament-logout', () => {
        window.location.href = "{{ route('login') }}";
    });
</script>
