<nav class="side-menu side-menu-big-icon">
    <ul class="side-menu-list">
        <li class="opened">
            <a href="{{ route('dashboard') }}">
                <i class="font-icon font-icon-home"></i>
                <span class="lbl">Home</span>
            </a>
        </li>

        <li class="with-sub">
	            <span>
	                <i class="glyphicon glyphicon-briefcase"></i>
	                <span class="lbl">Products</span>
	            </span>
            <ul>
                <li><a href="#"><span class="lbl">List</span></a></li>
                <li><a href="#"><span class="lbl">Add New</span></a></li>
            </ul>
        </li>

        @if(auth()->user()->role->id==1)
        <li class="with-sub">
	            <span>
	                <i class="font-icon font-icon-users"></i>
	                <span class="lbl">Users</span>
	            </span>
            <ul>
                <li><a href="{{ route('users') }}"><span class="lbl">List</span></a></li>
                <li><a href="{{ route('user.create') }}"><span class="lbl">Add New</span></a></li>
            </ul>
        </li>
        @endif
        <li class="with-sub">
	            <span>
	                <i class="font-icon font-icon-wallet"></i>
	                <span class="lbl">Customers</span>
	            </span>
            <ul>
                <li><a href="#"><span class="lbl">List</span></a></li>
                <li><a href="#"><span class="lbl">Add New</span></a></li>
            </ul>
        </li>

        <li>
            <a href="{{ route('user.profile',['id' => auth()->user()->id]) }}">
                <i class="glyphicon glyphicon-user"></i>
                <span class="lbl">Profile</span>
            </a>
        </li>

        <li>
            <a href="#">
                <i class="glyphicon glyphicon-cog"></i>
                <span class="lbl">Settings</span>
            </a>
        </li>


    </ul>
</nav><!--.side-menu-->
