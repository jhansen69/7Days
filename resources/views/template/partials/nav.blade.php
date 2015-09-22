
    <div class="container">

        <nav class="navbar navbar-inverse">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">7D2D Modding</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Home</a></li>
                        <li><a href="/pages/about">About</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Browse Mods <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="/modpacks">Mod Packs</a></li>
                                <li><a href="/entites">Entities</a></li>
                                <li><a href="/blocks/">Blocks</a></li>
                                <li><a href="/items/">Items</a></li>
                                <li><a href="/recipes/">Recipes</a></li>
                                <li><a href="/biomes/">Biomes</a></li>
                                <li><a href="/materials/">Biomes</a></li>
                            </ul>
                        </li>
                        <li><a href="/mods/submit">Submit Your Mod</a></li>
                        <li><a href="/mods/creats">Create a Mod</a></li>
                        @if (isset($currentUser))
                            @if ($currentUser->admin)
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="/import">Import XML Files</a></li>
                                        <li><a href="/users">Show Users</a></li>
                                    </ul>
                                </li>
                            @endif
                        @endif
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        @if (isset($currentUser))
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ $currentUser->name  }} <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="/auth/logout">Logout</a></li>
                            </ul>
                        </li>
                        @else
                        <li><a href="/auth/login">Login</a></li>
                        <li><a href="/auth/register">Register</a></li>
                        @endif


                    </ul>
                </div>

        </nav>
        @include('flash::message')
    </div>

