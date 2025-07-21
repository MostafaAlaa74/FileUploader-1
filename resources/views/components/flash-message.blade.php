@if (session('success'))
    <div id="flash-message" class="alert alert-success">
        {{ session('success') }}
    </div>

    <script>
        setTimeout(function() {
            var el = document.getElementById('flash-message');
            if (el) {
                el.style.transition = 'opacity 0.5s';
                el.style.opacity = 0;
                setTimeout(function() {
                    el.remove();
                }, 500);
            }
        }, 5000);
    </script>
@endif
<style>
    .alert {
        padding: 15px;
        margin: 10px 0;
        border: 1px solid #d4edda;
        background-color: #d4edda;
        color: #155724;
        border-radius: 4px;
        position: relative;
        transition: opacity 0.5s;
    }
</style>
