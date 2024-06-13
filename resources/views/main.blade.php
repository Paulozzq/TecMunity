@extends('layouts.layoutsMain')

@section('title', 'Tecmunity')

@section('content')
<div class="navbar">
    <div class="navbar_menuicon" id="navicon">
        <i class="fa fa-navicon"></i>
    </div>
    <div class="navbar_logo">
        <a href="{{ route('publicaciones.index') }}">
        <img src="{{ asset('img/logotec.png') }}" alt="" />
        </a>
    </div>
    <div class="navbar_search">
        <form method="" action="/">
            <input type="text" placeholder="  Search people.." />
            <button><i class="fa fa-search"></i></button>
        </form>
    </div>
    <div class="navbar_icons">
        <ul>
            <li id="friendsmodal"><i class="fa fa-user-o"></i><span id="notification">5</span></li>
            <li id="messagesmodal"><i class="fa fa-comments-o"></i><span id="notification">2</span></li>
            <a href="" style="color:white"><li><i class="fa fa-globe"></i></li></a>
        </ul>
    </div>
    <div class="navbar_user" id="profilemodal" style="cursor:pointer">
        @if(auth()->user()->avatar)
            <img src="{{ auth()->user()->avatar }}" />
        @else
            <img src="{{ asset('img/default-avatar.jpg') }}" />
        @endif
        <span id="navbar_user_top">{{ auth()->user()->nombre}} {{ auth()->user()->apellido }}<br><p>User</p></span><i class="fa fa-angle-down"></i>
    </div>
</div>

<div class="all">

    <div class="rowfixed"></div>
    <div class="left_row"> 
        <div class="rowmenu">
            <ul>
                <li><a href="index.html"><i class="fa fa-globe"></i>Home</a></li>
                <li><a href="profile.html"><i class="fa fa-user"></i>Profile</a></li>
                <li><a href="friends.html"><i class="fa fa-users"></i>Friends</a></li>
                <li><a href="index.html"><i class="fa fa-globe"></i>Home</a></li>
                <li><a href="profile.html"><i class="fa fa-user"></i>Profile</a></li>
                <li><a href="friends.html"><i class="fa fa-users"></i>Friends</a></li>
                <li><a href="index.html"><i class="fa fa-globe"></i>Home</a></li>
                <li><a href="profile.html"><i class="fa fa-user"></i>Profile</a></li>
                <li><a href="friends.html"><i class="fa fa-users"></i>Friends</a></li>
            </ul>
        </div>
        <div class="left_row_profile">
            @if(auth()->user()->portada)
                <img id="portada" src="{{ auth()->user()->portada }}" />
            @else
                <img id="portada" src="{{ asset('img/bl.jpg') }}" />
            @endif
            <div class="left_row_profile">
                @if(auth()->user()->avatar)
                    <img id="profile_pic" src="{{ auth()->user()->avatar }}" />
                @else
                    <img id="profile_pic" src="{{ asset('img/default-avatar.jpg') }}" />
                @endif
                <span>{{ auth()->user()->nombre}} {{ auth()->user()->apellido }}<br><p>150k followers / 50 follow</p></span>
            </div>
        </div> 
    </div>


    
 @yield('contenido')   

<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-arrow-up"></i></button>



<!-- Modal Messages -->
<div class="modal modal-comments">
    <div class="modal-icon-select"><i class="fa fa-sort-asc" aria-hidden="true"></i></div>
    <div class="modal-title">
        <span>CHAT / MESSAGES</span>
         <a href="messages.html"><i class="fa fa-ellipsis-h"></i></a>
    </div>
    <div class="modal-content">
        <ul>
            <li>
                <a href="#">
                    <img src="images/user-7.jpg" alt="" />
                    <span><b>Diana Jameson</b><br>Hi James! It’s Diana, I just wanted to let you know that we have to reschedule...<p>4 hours ago</p></span>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="images/user-6.jpg" alt="" />
                    <span><b>Elaine Dreyfuss</b><br>We’ll have to check that at the office and see if the client is on board with...<p>Yesterday at 9:56pm</p></span>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="images/user-3.jpg" alt="" />
                    <span><b>Jake Parker</b><br>Great, I’ll see you tomorrow!.<p>4 hours ago</p></span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- Modal Friends -->
<div class="modal modal-friends">
    <div class="modal-icon-select"><i class="fa fa-sort-asc" aria-hidden="true"></i></div>
    <div class="modal-title">
        <span>FRIEND REQUESTS</span>
         <a href="friends.html"><i class="fa fa-ellipsis-h"></i></a>
    </div>
    <div class="modal-content">
        <ul>
            <li>
                <a href="#">
                    <img src="images/user-2.jpg" alt="" />
                    <span><b>Tony Stevens</b><br>4 Friends in Common</span>
                    <button class="modal-content-accept">Accept</button><button class="modal-content-decline">Decline</button>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="images/user-6.jpg" alt="" />
                    <span><b>Tamara Romanoff</b><br>2 Friends in Common</span>
                    <button class="modal-content-accept">Accept</button><button class="modal-content-decline">Decline</button>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="images/user-4.jpg" alt="" />
                    <span><b>Nicholas Grissom</b><br>1 Friend in Common</span>
                    <button class="modal-content-accept">Accept</button><button class="modal-content-decline">Decline</button>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- Modal Profile -->
<div class="modal modal-profile">
    <div class="modal-icon-select"><i class="fa fa-sort-asc" aria-hidden="true"></i></div>
    <div class="modal-title">
        <span>YOUR ACCOUNT</span>
         <a href="#"><i class="fa fa-cogs"></i></a>
    </div>
    <div class="modal-content">
        <ul>
            <li>
                <a href="{{ route('account') }}">
                    <i class="fa fa-tasks" aria-hidden="true"></i>
                    <span><b>Profile Settings</b><br>Yours profile settings</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                    <span><b>Create a page</b><br>Create your page</span>
                </a>
            </li>
            <li>
                <a href="login.html">
                    <i class="fa fa-power-off" aria-hidden="true"></i>
                    <span><b>Log Out</b><br>Close your session</span>
                </a>
            </li>
        </ul>
    </div>
</div>

@yield('contentpublic')


<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-arrow-up"></i></button>



<!-- Modal Messages -->
<div class="modal modal-comments">
<div class="modal-icon-select"><i class="fa fa-sort-asc" aria-hidden="true"></i></div>
<div class="modal-title">
    <span>CHAT / MESSAGES</span>
     <a href="messages.html"><i class="fa fa-ellipsis-h"></i></a>
</div>
<div class="modal-content">
    <ul>
        <li>
            <a href="#">
                <img src="images/user-7.jpg" alt="" />
                <span><b>Diana Jameson</b><br>Hi James! It’s Diana, I just wanted to let you know that we have to reschedule...<p>4 hours ago</p></span>
            </a>
        </li>
        <li>
            <a href="#">
                <img src="images/user-6.jpg" alt="" />
                <span><b>Elaine Dreyfuss</b><br>We’ll have to check that at the office and see if the client is on board with...<p>Yesterday at 9:56pm</p></span>
            </a>
        </li>
        <li>
            <a href="#">
                <img src="images/user-3.jpg" alt="" />
                <span><b>Jake Parker</b><br>Great, I’ll see you tomorrow!.<p>4 hours ago</p></span>
            </a>
        </li>
    </ul>
</div>
</div>
<!-- Modal Friends -->
<div class="modal modal-friends">
<div class="modal-icon-select"><i class="fa fa-sort-asc" aria-hidden="true"></i></div>
<div class="modal-title">
    <span>FRIEND REQUESTS</span>
     <a href="friends.html"><i class="fa fa-ellipsis-h"></i></a>
</div>
<div class="modal-content">
    <ul>
        <li>
            <a href="#">
                <img src="images/user-2.jpg" alt="" />
                <span><b>Tony Stevens</b><br>4 Friends in Common</span>
                <button class="modal-content-accept">Accept</button><button class="modal-content-decline">Decline</button>
            </a>
        </li>
        <li>
            <a href="#">
                <img src="images/user-6.jpg" alt="" />
                <span><b>Tamara Romanoff</b><br>2 Friends in Common</span>
                <button class="modal-content-accept">Accept</button><button class="modal-content-decline">Decline</button>
            </a>
        </li>
        <li>
            <a href="#">
                <img src="images/user-4.jpg" alt="" />
                <span><b>Nicholas Grissom</b><br>1 Friend in Common</span>
                <button class="modal-content-accept">Accept</button><button class="modal-content-decline">Decline</button>
            </a>
        </li>
    </ul>
</div>
</div>

<!-- NavMobile -->
<div class="mobilemenu">
    
    <div class="mobilemenu_profile">
        <img id="mobilemenu_portada" src="images/portada.jpg" />
        <div class="mobilemenu_profile">
            <img id="mobilemenu_profile_pic" src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('img/default-avatar.jpg') }}" /><br>
            <span>{{ auth()->user()->nombre}}<br><p>150k followers / 50 follow</p></span>
        </div>
        <div class="mobilemenu_menu">
            <ul>
                <li><a href="index.html"><i class="fa fa-globe"></i>Newsfeed</a></li>
                <li><a href="profile.html"><i class="fa fa-user"></i>Profile</a></li>
                <li><a href="friends.html"><i class="fa fa-users"></i>Friends</a></li>
                <li><a href="messages.html"><i class="fa fa-comments-o"></i>messages</a></li>
                <li class="primarymenu"><i class="fa fa-compass"></i>Explore</li>
                <ul class="mobilemenu_child">
                    <li style="border:none"><a href="#"><i class="fa fa-globe"></i>Activity</a></li>
                    <li style="border:none"><a href="#"><i class="fa fa-file"></i>Friends</a></li>
                    <li style="border:none"><a href="#"><i class="fa fa-file"></i>Groups</a></li>
                    <li style="border:none"><a href="#"><i class="fa fa-file"></i>Pages</a></li>
                    <li style="border:none"><a href="#"><i class="fa fa-file"></i>Saves</a></li>
                </ul>
                <li class="primarymenu"><i class="fa fa-user"></i>Rapid Access</li>
                <ul class="mobilemenu_child">
                    <li style="border:none"><a href="#"><i class="fa fa-star-o"></i>Your-Page.html</a></li>
                    <li style="border:none"><a href="#"><i class="fa fa-star-o"></i>Your-Group.html</a></li>
                </ul>
            </ul>
                <hr>
            <ul>
                <li><a href="#">Terms & Conditions</a></li>
                <li><a href="#">FAQ's</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="login.html">Logout</a></li>
            </ul>
        </div>
    </div>
</div
@endsection