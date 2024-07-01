var sidebar = `
<div class="d-flex align-items-center navbar-height">
<form action="index.html" class="search-form search-form--black mx-16pt pr-0 pl-16pt">
    <input type="text" class="form-control pl-0" placeholder="Search">
    <button class="btn" type="submit"><i class="material-icons">search</i></button>
</form>
</div>

<a href="index.html" class="sidebar-brand ">
<!-- <img class="sidebar-brand-icon" src="public/images/illustration/student/128/white.svg" alt="Luma"> -->

<span class="avatar avatar-xl sidebar-brand-icon h-auto">

    <span class="avatar-title rounded bg-primary"><img
            src="public/images/illustration/student/128/white.svg" class="img-fluid"
            alt="logo" /></span>

</span>

<span>منصة تمكين</span>
</a>


<ul class="sidebar-menu">
<li class="sidebar-menu-item">
    <a class="sidebar-menu-button"
        href="index.html">
        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">home</span>
        <span class="sidebar-menu-text">Home</span>
    </a>
</li>
<li class="sidebar-menu-item">
    <a class="sidebar-menu-button" href="CoursesPortal.html">
        <span
            class="material-icons sidebar-menu-icon sidebar-menu-icon--left">local_library</span>
        <span class="sidebar-menu-text">Portals</span>
    </a>
</li>
<li class="sidebar-menu-item">
    <a class="sidebar-menu-button" href="TrainersList.html">
        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">school</span>
        <span class="sidebar-menu-text">Trainers</span>
    </a>
</li>
<li class="sidebar-menu-item">
    <a class="sidebar-menu-button" href="traineesList.html">
        <span
            class="material-icons sidebar-menu-icon sidebar-menu-icon--left">account_box</span>
        <span class="sidebar-menu-text">Trainees</span>
    </a>
</li>


<li class="sidebar-menu-item">
    <a class="sidebar-menu-button" href="student-take-quiz.html">
        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">people_outline</span>
        <span class="sidebar-menu-text">Users</span>
    </a>
</li>

</ul>



<!-- // END Sidebar Content -->

</div>
`
document.getElementById('mySidebar').innerHTML = sidebar;