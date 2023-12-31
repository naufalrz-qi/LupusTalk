<nav class="sidebar">
    <div class="sidebar-header">
        <a href="/admin/dashboard" class="sidebar-brand">
            Lupus<span>Talk</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item nav-category">Data Master</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#categories" role="button" aria-expanded="false"
                    aria-controls="emails">
                    <i class="link-icon" data-feather="layout"></i>
                    <span class="link-title">Game Categories</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="categories">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('add.category') }}" class="nav-link">Add Category</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('view.categories') }}" class="nav-link">View Categories</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#topics" role="button" aria-expanded="false"
                    aria-controls="emails">
                    <i class="link-icon" data-feather="layout"></i>
                    <span class="link-title">Game Topics</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="topics">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('add.topic') }}" class="nav-link">Add Topic</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('view.topics') }}" class="nav-link">View Topics</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#posts" role="button" aria-expanded="false"
                    aria-controls="emails">
                    <i class="link-icon" data-feather="layout"></i>
                    <span class="link-title">Posts</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="posts">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('add.post') }}" class="nav-link">Add Post</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('view.posts') }}" class="nav-link">View Posts</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a href="pages/apps/calendar.html" class="nav-link">
                    <i class="link-icon" data-feather="calendar"></i>
                    <span class="link-title">Calendar</span>
                </a>
            </li>
            <li class="nav-item nav-category">Components</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#uiComponents" role="button" aria-expanded="false"
                    aria-controls="uiComponents">
                    <i class="link-icon" data-feather="feather"></i>
                    <span class="link-title">UI Kit</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="uiComponents">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="pages/ui-components/accordion.html" class="nav-link">Accordion</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/ui-components/alerts.html" class="nav-link">Alerts</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#advancedUI" role="button" aria-expanded="false"
                    aria-controls="advancedUI">
                    <i class="link-icon" data-feather="anchor"></i>
                    <span class="link-title">Advanced UI</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="advancedUI">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="pages/advanced-ui/cropper.html" class="nav-link">Cropper</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/advanced-ui/owl-carousel.html" class="nav-link">Owl carousel</a>
                        </li>
                    </ul>
                </div>
            </li>


            <li class="nav-item nav-category">Docs</li>
            <li class="nav-item">
                <a href="https://www.nobleui.com/html/documentation/docs.html" target="_blank" class="nav-link">
                    <i class="link-icon" data-feather="hash"></i>
                    <span class="link-title">Documentation</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
