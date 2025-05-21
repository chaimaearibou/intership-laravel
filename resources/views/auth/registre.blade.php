<!-- Register Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="registerModalLabel">Create Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <!-- Error Container for both AJAX and backend -->
                <div id="registerError">
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

                <form method="POST" action="{{ route('register') }}" id="registerForm">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">First Name</label>
                        <input type="text" name="nom" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="prenom" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </form>

                <p class="text-center mt-3 text-muted">
                    Already have an account?
                    <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">Login
                        here</a>
                </p>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript Section -->
@push('scripts')
    <script>
        $(document).ready(function() {

            // Reset form and clear errors on modal close
            $('#registerModal').on('hidden.bs.modal', function() {
                $('#registerError').html('');
                $('#registerForm')[0].reset();
            });

            $('#registerForm').on('submit', function(e) {
                e.preventDefault();

                const form = $(this);
                const actionUrl = form.attr('action');
                const formData = form.serialize();

                const nom = $('input[name="nom"]').val().trim();
                const prenom = $('input[name="prenom"]').val().trim();
                const email = $('input[name="email"]').val().trim();
                const password = $('#registerForm input[name="password"]').val().trim();
                const password_confirmation = $('#registerForm input[name="password_confirmation"]').val()
                    .trim();

                console.log('Password:', password);
                console.log('Confirm:', password_confirmation);

                let errors = [];

                if (!nom) errors.push("First name is required.");
                if (!prenom) errors.push("Last name is required.");
                if (!email) {
                    errors.push("Email address is required.");
                } else if (!validateEmail(email)) {
                    errors.push("Invalid email address.");
                }
                if (!password) errors.push("Password is required.");
                if (!password_confirmation) errors.push("Password confirmation is required");
                if (password !== password_confirmation) {
                    errors.push("Passwords do not match.");
                }

                if (errors.length > 0) {
                    let errorHtml = '<div class="alert alert-danger"><ul>';
                    errors.forEach(msg => errorHtml += `<li>${msg}</li>`);
                    errorHtml += '</ul></div>';
                    $('#registerError').html(errorHtml);
                    return;
                }

                $('#registerError').html('');
                $.ajax({
                    type: 'POST',
                    url: actionUrl,
                    data: formData,
                    success: function(response) {
                        if (response.redirect) {
                            window.location.href = response.redirect;
                        } else {
                            location.reload(); // fallback
                        }
                    },
                    error: function(xhr) {
                        let errorHtml = '<div class="alert alert-danger"><ul>';
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            $.each(xhr.responseJSON.errors, function(key, messages) {
                                messages.forEach(msg => errorHtml += `<li>${msg}</li>`);
                            });
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorHtml += `<li>${xhr.responseJSON.message}</li>`;
                        } else {
                            errorHtml += '<li>An error has occurred.</li>';
                        }
                        errorHtml += '</ul></div>';
                        $('#registerError').html(errorHtml);
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

@if ($errors->any())
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#registerModal').modal('show');
            });
        </script>
    @endpush
@endif

<!-- Include jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
