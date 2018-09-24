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
        @if(auth()->user()->role->id==1)
        <li
                @if(url()->full()== route('projects'))
                class="opened"
                @endif
        >
            <a href="{{ route('projects') }}">
                <i class="glyphicon glyphicon-briefcase"></i>
                <span class="lbl">Projects</span>
            </a>
        </li>
        @endif
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

        <li
                @if(url()->full()== route('customers'))
                class="opened"
                @endif
        >
            <a href="{{ route('customers') }}">
                <i class="font-icon font-icon-wallet"></i>
                <span class="lbl">Customers</span>
            </a>
        </li>


        @if(auth()->user()->role->id==1)
        <li

        >
            <a href="#">
                <i class="glyphicon glyphicon-cog"></i>
                <span class="lbl">Settings</span>
            </a>
        </li>
        @endif




    </ul>
</nav><!--.side-menu-->
