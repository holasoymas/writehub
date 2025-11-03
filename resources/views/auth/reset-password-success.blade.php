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

        </style>
    </head>
    <body>
        <section class="hero is-fullheight">
            <div class="hero-body">
                <div class="container">
                    <div class="signup-box box p-5">
                        <div class="has-text-centered mb-5">
                            <h1 class="title is-3">Writehub</h1>
                            <h2 class="text-success mb-3">Password Reset Link Sent!</h2>
                            <p class="subtitle is-6 has-text-grey">
                            We’ve sent a password reset link to <strong>{{ session('email') }}</strong>.
                            </p>
                            <p>
                            Please check your inbox (and spam folder) for the reset link.
                            </p>
                        </div>
                        <div class="has-text-centered mt-4">
                            <p class="has-text-grey">Don't receive an email ?
                            <a href="{{ route('password.request') }}" class="has-text-success">Send code again</a>
                            </p>
                        </div>
                        <div class="has-text-centered mt-4">
                            <p class="has-text-grey">Don't an account?
                            <a href="{{ route('user.create') }}" class="has-text-success">Sign up</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
