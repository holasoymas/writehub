@extends('admin.layout')

@section('title', 'Broadcast')
@section('page-title', 'Broadcast Message')

@section('content')
<div class="columns">
    <div class="column is-8">
        <div class="card">
            <header class="card-header">
                <p class="card-header-title">
                    <span class="icon has-text-primary mr-2">
                        <i class="fas fa-bullhorn"></i>
                    </span>
                    Send Broadcast Message
                </p>
            </header>
            <div class="card-content">
                <form action="{{ route('admin.broadcast.send') }}" method="POST">
                    @csrf
                    <div class="field">
                        <label class="label">Title</label>
                        <div class="control has-icons-left">
                            <input class="input" type="text" name="title" placeholder="Enter message subject" required>
                            <span class="icon is-small is-left">
                                <i class="fas fa-heading"></i>
                            </span>
                        </div>
                        <p class="help">Keep it short and descriptive (max 100 characters)</p>
                    </div>
                    @if ($errors->any())
                        <div class="notification is-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="notification is-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="field">
                        <label class="label">Message</label>
                        <div class="control">
                            <textarea class="textarea" name="message" rows="8" placeholder="Enter your message here..." required></textarea>
                        </div>
                        <p class="help">Write your broadcast message</p>
                    </div>

                    <hr>

                    <div class="field is-grouped">
                        <div class="control">
                            <button class="button is-primary is-medium" type="submit">
                                <span class="icon">
                                    <i class="fas fa-paper-plane"></i>
                                </span>
                                <span>Send Broadcast</span>
                            </button>
                        </div>

                        <div class="control">
                            <button class="button is-light is-medium" type="reset">
                                <span class="icon">
                                    <i class="fas fa-redo"></i>
                                </span>
                                <span>Reset</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

        <div class="notification is-info is-light mt-4">
            <p class="has-text-weight-semibold mb-2">
                <span class="icon"><i class="fas fa-lightbulb"></i></span>
                Tips for Effective Broadcasting
            </p>
            <ul style="margin-left: 1.5rem;">
                <li>Keep messages concise and clear</li>
                <li>Use engaging subject lines</li>
                <li>Schedule during peak hours</li>
                <li>Segment your audience appropriately</li>
            </ul>
        </div>
    </div>
</div>
@endsection
