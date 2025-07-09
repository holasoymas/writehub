<html>
    <head>
        <title> Thisis title </title>
    </head>
    <body>
        <h2> FOrm data </user>
            <form method="POST" action="{{ route('user.update',  $user->id) }}">
                <input type="hidden" name="_method" value="PATCH" />
@csrf
<input type="text" name="name" value="{{ $user->name }}" placeholder="Enter a name" />

<br />
<input type="text" name="username" value="{{ $user->username }}" placeholder="Enter a username" />

<br />
<input type="email" name="email" value="{{ $user->email }}" placeholder="Enter a email" />
<br />
<input type="date" name="dob" value="{{ $user->dob }}"  />
<br />
<input type="text" name="bio" value="{{ $user->bio }}" placeholder="Enter a bio" />
<br />
<input type="password" name="password" {{ $user->password }} placeholder="Pass" />
<br />
<input type="submit" value="Update" />

            </form>

    </body>

</html>
