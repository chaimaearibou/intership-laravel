<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login to Your Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="loginError">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <form method="POST" action="{{ route('login') }}" id="loginForm">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>

                    <div class="text-center mt-3">
                        <p class="mb-0">Don't have an account?
                            <a href="{{ route('show.register') }}" class="text-decoration-none">
                                Register here
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {
            // Clear errors when the modal is closed
            $('#loginModal').on('hidden.bs.modal', function() {
                $('#loginError').html('');
                $('#loginForm')[0].reset();
            });

            $('#loginForm').on('submit', function(e) {
                e.preventDefault();

                // Client-side validation
                let email = $('#email').val().trim();
                let password = $('#password').val().trim();
                let errors = [];

                if (email === '') {
                    errors.push("Email is required.");
                } else if (!validateEmail(email)) {
                    errors.push("Please enter a valid email address.");
                }

                if (password === '') {
                    errors.push("Password is required.");
                }

                if (errors.length > 0) {
                    let errorHtml = '<div class="alert alert-danger"><ul>';
                    errors.forEach(function(msg) {
                        errorHtml += `<li>${msg}</li>`;
                    });
                    errorHtml += '</ul></div>';
                    $('#loginError').html(errorHtml);
                    return; // Don't send the request
                }

                // Proceed with AJAX if no client-side errors
                let form = $(this);
                let actionUrl = form.attr('action');
                let formData = form.serialize();

                $('#loginError').html('');

                $.ajax({
                    type: 'POST',
                    url: actionUrl,
                    data: formData,
                    success: function(response) {
                        window.location.href = response.redirect;
                    },
                    error: function(xhr) {
                        $('#loginError').html('');
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            let errors = xhr.responseJSON.errors;
                            let errorHtml = '<div class="alert alert-danger"><ul>';
                            $.each(errors, function(key, messages) {
                                messages.forEach(function(msg) {
                                    errorHtml += `<li>${msg}</li>`;
                                });
                            });
                            errorHtml += '</ul></div>';
                            $('#loginError').html(errorHtml);
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            $('#loginError').html(
                                `<div class="alert alert-danger">${xhr.responseJSON.message}</div>`
                                );
                        } else {
                            $('#loginError').html(
                                '<div class="alert alert-danger">Something went wrong.</div>'
                                );
                        }
                    }
                });
            });

            function validateEmail(email) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            }
        });
    </script>
@endpush


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
