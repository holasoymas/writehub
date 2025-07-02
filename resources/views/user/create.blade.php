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

        .profile-pic-container {
            position: relative;
            display: inline-block;
        }

        .profile-preview {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            cursor: pointer;
            border: 3px solid #e5e7eb;
        }

        .upload-button {
            position: absolute;
            bottom: 0;
            right: 0;
            background: #059669;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .upload-button i {
            color: white;
            font-size: 0.8rem;
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
                        <h1 class="title is-3">Join Writehub</h1>
                        <p class="subtitle is-6 has-text-grey">Start reading and writing on Medium today</p>
                    </div>

                    <!-- Social Login Options -->
                    <div class="buttons is-flex is-flex-direction-column">
                        <button class="button social-btn is-outlined">
                            <span class="icon">
                                <i class="fab fa-google"></i>
                            </span>
                            <span>Continue with Google</span>
                        </button>
                        <button class="button social-btn is-outlined">
                            <span class="icon">
                                <i class="fab fa-github"></i>
                            </span>
                            <span>Continue with GitHub</span>
                        </button>
                        <button class="button social-btn is-outlined">
                            <span class="icon">
                                <i class="fab fa-facebook"></i>
                            </span>
                            <span>Continue with Facebook</span>
                        </button>
                    </div>

                    <div class="divider">or</div>

                    <!-- Registration Form -->
                    <form id="registerForm" method="POST" action="{{ route('user.store') }}">
                    @csrf
                        <!-- Profile Picture Upload -->
                        <div class="field has-text-centered mb-5">
                            <div class="control">
                                <div class="profile-pic-container">
                                    <img id="profilePreview" src="https://picsum.photos/200/300"
                                         alt="Profile Picture" class="profile-preview">
                                    <div class="upload-button" onclick="document.getElementById('profilePicInput').click()">
                                        <i class="fas fa-camera"></i>
                                    </div>
                                </div>
                                <input type="file" id="profilePicInput" accept="image/*" style="display: none;">
                                <p class="help has-text-grey mt-2">Click to upload your profile picture</p>
                            </div>
                        </div>

                        <!-- Name Field -->
                        <div class="field">
                            <label class="label">Full Name</label>
                            <div class="control has-icons-left">
                                <input class="input" type="text" name="name" value="{{ old('name') }}"  placeholder="Enter your full name" required>
                                <span class="icon is-small is-left">
                                    <i class="fas fa-user"></i>
                                </span>
                            </div>
                            @error('name')
                            <p class="help" style="color:red;">{{ $message }} </p>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div class="field">
                            <label class="label">Email</label>
                            <div class="control has-icons-left">
                                <input class="input" type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" required>
                                <span class="icon is-small is-left">
                                    <i class="fas fa-envelope"></i>
                                </span>
                            </div>
                            @error('email')
                                <p class="help" style="color: red;">{{ $message }}</p>
                            @enderror
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
                            @error('password')
                                 <p class="help" style="color: red;">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Bio Field (Optional) -->
                        <div class="field">
                            <label class="label">Bio <span class="has-text-grey">(Optional)</span></label>
                            <div class="control">
                                <textarea class="textarea" name="bio" placeholder="Tell us a bit about yourself..." rows="3">{{ old('bio') }}</textarea>
                            </div>
                                @if ($errors->has('bio'))
                                    <p class="help" style="color:red;">{{ $errors->first('bio') }}</p>
                                @else
                                    <p class="help">Write a short bio to help others understand who you are</p>
                                @endif
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="field">
                            <div class="control">
                                <label class="checkbox">
                                    <input type="checkbox" required>
                                    I agree to Medium's <a href="#" class="has-text-success">Terms of Service</a> and <a href="#" class="has-text-success">Privacy Policy</a>
                                </label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="field">
                            <div class="control">
                                <button class="button is-success is-fullwidth is-medium" type="submit">
                                    Create Account
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Sign In Link -->
                    <div class="has-text-centered mt-4">
                        <p class="has-text-grey">Already have an account?
                            <a href="{{ route('login') }}" class="has-text-success">Sign in</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Profile picture upload handling
        document.getElementById('profilePicInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profilePreview').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // Form submission
        {{-- document.getElementById('registerForm').addEventListener('submit', function(e) { --}}
        {{--     e.preventDefault(); --}}
        {{--     alert('Registration successful! (This is just a demo)'); --}}
        {{-- }); --}}
    </script>
</body>
</html>
