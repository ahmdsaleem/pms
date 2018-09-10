<nav class="side-menu side-menu-big-icon">
    <ul class="side-menu-list">
        <li
                @if(url()->full()== route('dashboard'))
                class="opened"
                @endif
                >
            <a href="{{ route('dashboard') }}">
                <i class="font-icon font-icon-home"></i>
                <span class="lbl">Home</span>
            </a>
        </li>

        <li
                @if(url()->full()== route('products'))
                class="opened"
                @endif
        >
            <a href="{{ route('products') }}">
                <i class="glyphicon glyphicon-briefcase"></i>
                <span class="lbl">Products</span>
            </a>
        </li>

        @if(auth()->user()->role->id==1)
            <li
                    @if(url()->full()== route('users'))
                    class="opened"
                    @endif
            >
                <a href="{{ route('users') }}">
                    <i class="font-icon font-icon-users"></i>
                    <span class="lbl">Users</span>
                </a>
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
            <a href="#">
                <i class="glyphicon glyphicon-cog"></i>
                <span class="lbl">Settings</span>
            </a>
        </li>


    </ul>
</nav><!--.side-menu-->
