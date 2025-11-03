<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign Up - Medium</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.4/css/bulma.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <style>
.hero.is-fullheight {
    min-height: 100vh;
    background-color: #fafafa;
}


        .signup-box {
            max-width: 500px;
            width: 100%;
            margin: 0 auto;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .social-btn {
            width: 100%;
            justify-content: flex-start;
        }

        </style>
    </head>
    <body>
        <section class="hero is-fullheight">
            <div class="hero-body">
                <div class="container">
                    <div class="signup-box box p-5">
                        <div class="has-text-centered mb-5">
                            <h1 class="title is-3">Join Medium</h1>
                            <p class="subtitle is-6 has-text-grey">Please type new password</p>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li style="color:red;">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <!-- Registration Form -->
                        <form id="registerForm" method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <!-- Email Field -->

                            <input type="hidden" name="token" value="{{ request('token') }}">

                            <input type="hidden" name="email" value="{{ request('email') }}">

                            <!-- Password Field -->
                            <div class="field">
                                <label class="label">Password</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="password" name="password" value="{{ old('password') }}" placeholder="Create a password" required>
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Confirm Password</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Create a password" required>
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="field">
                                <div class="control">
                                    <button class="button is-success is-fullwidth is-medium" type="submit">
                                        Reset Password
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!-- Sign In Link -->
                        <div class="has-text-centered mt-4">
                            <p class="has-text-grey">Don't an account?
                            <a href="{{ route('user.create') }}" class="has-text-success">Sign up</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script>
        </script>
    </body>
</html>
