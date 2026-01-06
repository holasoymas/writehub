@extends('admin.layout')

@section('title', 'Analytics')
@section('page-title', 'Analytics Dashboard')

@section('content')
<div class="columns is-multiline">
    <!-- Stat Cards -->
    <div class="column is-3-desktop is-6-tablet">
        <div class="card stat-card is-primary">
            <div class="card-content">
                <div class="is-flex is-justify-content-space-between is-align-items-center">
                    <div>
                        <p class="heading">Total Users</p>
                        <p class="title">1,247</p>
                        <p class="has-text-success">
                            <span class="icon"><i class="fas fa-arrow-up"></i></span>
                            <span>12% from last month</span>
                        </p>
                    </div>
                    <span class="icon is-large has-text-primary">
                        <i class="fas fa-users fa-2x"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="column is-3-desktop is-6-tablet">
        <div class="card stat-card is-success">
            <div class="card-content">
                <div class="is-flex is-justify-content-space-between is-align-items-center">
                    <div>
                        <p class="heading">Total Posts</p>
                        <p class="title">3,842</p>
                        <p class="has-text-success">
                            <span class="icon"><i class="fas fa-arrow-up"></i></span>
                            <span>8% from last month</span>
                        </p>
                    </div>
                    <span class="icon is-large has-text-success">
                        <i class="fas fa-newspaper fa-2x"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="column is-3-desktop is-6-tablet">
        <div class="card stat-card is-warning">
            <div class="card-content">
                <div class="is-flex is-justify-content-space-between is-align-items-center">
                    <div>
                        <p class="heading">Active Users</p>
                        <p class="title">892</p>
                        <p class="has-text-grey">
                            <span class="icon"><i class="fas fa-minus"></i></span>
                            <span>2% from last month</span>
                        </p>
                    </div>
                    <span class="icon is-large has-text-warning">
                        <i class="fas fa-user-check fa-2x"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="column is-3-desktop is-6-tablet">
        <div class="card stat-card is-danger">
            <div class="card-content">
                <div class="is-flex is-justify-content-space-between is-align-items-center">
                    <div>
                        <p class="heading">Reported Posts</p>
                        <p class="title">24</p>
                        <p class="has-text-danger">
                            <span class="icon"><i class="fas fa-arrow-up"></i></span>
                            <span>5 pending review</span>
                        </p>
                    </div>
                    <span class="icon is-large has-text-danger">
                        <i class="fas fa-flag fa-2x"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="columns">
    <!-- Recent Activity -->
    <div class="column is-8">
        <div class="card">
            <header class="card-header">
                <p class="card-header-title">Recent Activity</p>
            </header>
            <div class="card-content">
                <div class="content">
                    <div class="mb-4">
                        <div class="is-flex is-align-items-center mb-2">
                            <span class="icon has-text-primary mr-2">
                                <i class="fas fa-user-plus"></i>
                            </span>
                            <strong>New user registered:</strong>&nbsp;john.doe@example.com
                        </div>
                        <small class="has-text-grey">2 hours ago</small>
                    </div>

                    <div class="mb-4">
                        <div class="is-flex is-align-items-center mb-2">
                            <span class="icon has-text-success mr-2">
                                <i class="fas fa-newspaper"></i>
                            </span>
                            <strong>New post published:</strong>&nbsp;"10 Tips for Better Writing"
                        </div>
                        <small class="has-text-grey">4 hours ago</small>
                    </div>

                    <div class="mb-4">
                        <div class="is-flex is-align-items-center mb-2">
                            <span class="icon has-text-danger mr-2">
                                <i class="fas fa-flag"></i>
                            </span>
                            <strong>Post reported:</strong>&nbsp;"Controversial Topic Discussion"
                        </div>
                        <small class="has-text-grey">6 hours ago</small>
                    </div>

                    <div class="mb-4">
                        <div class="is-flex is-align-items-center mb-2">
                            <span class="icon has-text-info mr-2">
                                <i class="fas fa-comments"></i>
                            </span>
                            <strong>High engagement:</strong>&nbsp;"The Future of AI" reached 500 comments
                        </div>
                        <small class="has-text-grey">8 hours ago</small>
                    </div>

                    <div class="mb-4">
                        <div class="is-flex is-align-items-center mb-2">
                            <span class="icon has-text-warning mr-2">
                                <i class="fas fa-bullhorn"></i>
                            </span>
                            <strong>Broadcast sent:</strong>&nbsp;"Weekly Newsletter" to 1,247 users
                        </div>
                        <small class="has-text-grey">1 day ago</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Authors -->
    <div class="column is-4">
        <div class="card">
            <header class="card-header">
                <p class="card-header-title">Top Authors This Month</p>
            </header>
            <div class="card-content">
                <div class="content">
                    <div class="is-flex is-justify-content-space-between is-align-items-center mb-3">
                        <div class="is-flex is-align-items-center">
                            <figure class="image is-32x32 mr-3">
                                <img class="is-rounded" src="https://via.placeholder.com/64" alt="Author">
                            </figure>
                            <div>
                                <strong>Jane Smith</strong>
                                <br><small>42 posts</small>
                            </div>
                        </div>
                        <span class="tag is-primary">🏆 #1</span>
                    </div>

                    <div class="is-flex is-justify-content-space-between is-align-items-center mb-3">
                        <div class="is-flex is-align-items-center">
                            <figure class="image is-32x32 mr-3">
                                <img class="is-rounded" src="https://via.placeholder.com/64" alt="Author">
                            </figure>
                            <div>
                                <strong>Mike Johnson</strong>
                                <br><small>38 posts</small>
                            </div>
                        </div>
                        <span class="tag is-info">#2</span>
                    </div>

                    <div class="is-flex is-justify-content-space-between is-align-items-center mb-3">
                        <div class="is-flex is-align-items-center">
                            <figure class="image is-32x32 mr-3">
                                <img class="is-rounded" src="https://via.placeholder.com/64" alt="Author">
                            </figure>
                            <div>
                                <strong>Sarah Wilson</strong>
                                <br><small>35 posts</small>
                            </div>
                        </div>
                        <span class="tag is-info">#3</span>
                    </div>

                    <div class="is-flex is-justify-content-space-between is-align-items-center">
                        <div class="is-flex is-align-items-center">
                            <figure class="image is-32x32 mr-3">
                                <img class="is-rounded" src="https://via.placeholder.com/64" alt="Author">
                            </figure>
                            <div>
                                <strong>Tom Brown</strong>
                                <br><small>28 posts</small>
                            </div>
                        </div>
                        <span class="tag is-light">#4</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Growth Chart -->
<div class="card">
    <header class="card-header">
        <p class="card-header-title">User Growth (Last 6 Months)</p>
    </header>
    <div class="card-content">
        <div class="content">
            <div style="display: flex; align-items: flex-end; justify-content: space-around; height: 200px; border-left: 2px solid #dbdbdb; border-bottom: 2px solid #dbdbdb; padding: 10px;">
                <div style="display: flex; flex-direction: column; align-items: center;">
                    <div style="width: 60px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); height: 80px; border-radius: 4px 4px 0 0;"></div>
                    <small class="mt-2">Jan</small>
                </div>
                <div style="display: flex; flex-direction: column; align-items: center;">
                    <div style="width: 60px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); height: 110px; border-radius: 4px 4px 0 0;"></div>
                    <small class="mt-2">Feb</small>
                </div>
                <div style="display: flex; flex-direction: column; align-items: center;">
                    <div style="width: 60px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); height: 95px; border-radius: 4px 4px 0 0;"></div>
                    <small class="mt-2">Mar</small>
                </div>
                <div style="display: flex; flex-direction: column; align-items: center;">
                    <div style="width: 60px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); height: 140px; border-radius: 4px 4px 0 0;"></div>
                    <small class="mt-2">Apr</small>
                </div>
                <div style="display: flex; flex-direction: column; align-items: center;">
                    <div style="width: 60px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); height: 160px; border-radius: 4px 4px 0 0;"></div>
                    <small class="mt-2">May</small>
                </div>
                <div style="display: flex; flex-direction: column; align-items: center;">
                    <div style="width: 60px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); height: 185px; border-radius: 4px 4px 0 0;"></div>
                    <small class="mt-2">Jun</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
