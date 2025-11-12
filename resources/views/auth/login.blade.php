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

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            color: #6b7280;
            margin: 1.5rem 0;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid #e5e7eb;
        }

        .divider::before {
            margin-right: 1rem;
        }

        .divider::after {
            margin-left: 1rem;
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
                        <p class="subtitle is-6 has-text-grey">Start reading and writing on Medium today</p>
                    </div>

                    <!-- Social Login Options -->
                    <div class="buttons is-flex is-flex-direction-column">
                       <a style="width:100%;" href="{{ route('oauth.redirect', 'google') }}">
                        <button class="button social-btn is-outlined">
                            <span class="icon">
                                <i class="fab fa-google"></i>
                            </span>
                            <span> Continue with Google </span>
                        </button>
                       </a>
                    </div>

                    <div class="divider">or</div>

                    @error('error')
                    <p style="text-align: center; color: red;">{{ $message }} </p>
                    @enderror
                    <!-- Registration Form -->
                    <form id="registerForm" method="POST" action="{{ route('login') }}">
                    @csrf
                        <!-- Email Field -->
                        <div class="field">
                            <label class="label">Email</label>
                            <div class="control has-icons-left">
                                <input class="input" type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" required>
                                <span class="icon is-small is-left">
                                    <i class="fas fa-envelope"></i>
                                </span>
                            </div>
                        </div>

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

                        <!-- Submit Button -->
                        <div class="field">
                            <div class="control">
                                <button class="button is-success is-fullwidth is-medium" type="submit">
                                   Login
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="has-text-centered mt-4">
                        <p class="has-text-grey">Forgot Password ?
                            <a href="{{ route('password.request') }}" class="has-text-success">Forgot Password</a>
                        </p>
                    </div>
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
