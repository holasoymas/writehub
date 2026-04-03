<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Medium Blog</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.2);
            max-width: 450px;
            width: 100%;
            margin: 1rem;
        }

        .login-header {
            background: white;
            padding: 2rem;
            text-align: center;
            border-radius: 12px 12px 0 0;
        }

        .login-header i {
            font-size: 3rem;
            color: #667eea;
            margin-bottom: 1rem;
        }

        .login-body {
            background: white;
            padding: 2rem;
            border-radius: 0 0 12px 12px;
        }

        .field label {
            font-weight: 600;
            color: #363636;
        }

        .input:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.125em rgba(102, 126, 234, 0.25);
        }

        .button.is-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            font-weight: 600;
            transition: transform 0.2s;
        }

        .button.is-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            <i class="fas fa-blog"></i>
            <h1 class="title is-4 mb-0">Admin Login</h1>
            <p class="subtitle is-6 mt-2">Welcome back! Please login to continue</p>
            @if ($errors->any())
                <div class="notification is-danger is-light mb-4">
                    {{ $errors->first() }}
                </div>
            @endif
        </div>

        <div class="login-body">
            <form action="/admin/login" method="POST">
                @csrf

                <div class="field">
                    <label class="label">Email</label>
                    <div class="control has-icons-left">
                        <input class="input" type="email" name="email" placeholder="admin@example.com" required>
                        <span class="icon is-small is-left">
                            <i class="fas fa-envelope"></i>
                        </span>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Password</label>
                    <div class="control has-icons-left">
                        <input class="input" type="password" name="password" placeholder="••••••••" required>
                        <span class="icon is-small is-left">
                            <i class="fas fa-lock"></i>
                        </span>
                    </div>
                </div>


                <div class="field">
                    <button class="button is-primary is-fullwidth" type="submit">
                        <span class="icon">
                            <i class="fas fa-sign-in-alt"></i>
                        </span>
                        <span>Login</span>
                    </button>
                </div>

            </form>
        </div>
    </div>
</body>
</html>
