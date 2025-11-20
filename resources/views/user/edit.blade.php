<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit profile | Writehub</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.4/css/bulma.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <link rel="stylesheet" href="{{ asset('css/show.profile.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/signup.css') }}">
        <link rel="stylesheet" href="{{ asset('css/profile.dropdown.css') }}">
        <script type="module" src="{{ asset('js/navbar.js') }}"></script>

        @vite(['resources/js/searchInput.js'])
        @vite(['resources/js/dropdown.js'])
    </head>
    <body>

        <x-navbar user="Auth::user()" />

            <section class="hero is-fullheight">
                <div class="hero-body">
                    <div class="container">
                        <div class="signup-box box p-5">
                            <div class="has-text-centered mb-5">
                                <h1 class="title is-3">Edit profile</h1>
                            </div>
                            <!-- Registration Form -->
                            <form id="registerForm" method="POST" action="{{ route('user.update', Auth::user()) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <!-- Profile Picture Upload -->
                                <div class="field has-text-centered mb-5">
                                    <div class="control">
                                        <div class="profile-pic-container">
                                            <img id="profilePreview" src="{{ Auth::user()?->profile_pic }}"
                                                                     alt="Profile Picture" class="profile-preview">
                                                                     <div class="upload-button" onclick="document.getElementById('profilePicInput').click()">
                                                                         <i class="fas fa-camera"></i>
                                                                     </div>
                                        </div>
                                        <input type="file" name="profile_pic" id="profilePicInput" accept="image/*" style="display: none;">
                                        @if ($errors->has('profile_pic'))
                                            <p class="help mt-2 has-text-danger"> {{ $errors->first('profile_pic') }} </p>
                                        @else
                                            <p class="help has-text-grey mt-2">Click to upload your profile picture</p>
                                        @endif
                                    </div>
                                </div>

                                <!-- Name Field -->
                                <div class="field">
                                    <label class="label">Full Name</label>
                                    <div class="control has-icons-left">
                                        <input class="input" type="text" name="name" value="{{ Auth::user()->name }}"  placeholder="Enter your full name" required>
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                    @error('name')
                                    <p class="help has-text-danger">{{ $message }} </p>
                                @enderror
                                </div>

                                <!-- Bio Field (Optional) -->
                                <div class="field">
                                    <label class="label">Bio <span class="has-text-grey">(Optional)</span></label>
                                    <div class="control">
                                        <textarea class="textarea" name="bio" placeholder="Tell us a bit about yourself..." rows="3">{{ Auth::user()->bio }}</textarea>
                                    </div>
                                    @if ($errors->has('bio'))
                                        <p class="help has-text-danger">{{ $errors->first('bio') }}</p>
                                    @else
                                        <p class="help">Write a short bio to help others understand who you are</p>
                                    @endif
                                </div>


                                <!-- Submit Button -->
                                <div class="field">
                                    <div class="control">
                                        <button class="button is-success is-fullwidth is-medium" type="submit">
                                            Update
                                        </button>
                                    </div>
                                </div>
                            </form>
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
            </script>
    </body>
</html>
