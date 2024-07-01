var header = `
<div class="navbar navbar-expand navbar-dark border-bottom-2" id="default-navbar" data-primary>
<!-- Navbar toggler -->
<button class="navbar-toggler w-auto mr-16pt d-block d-lg-none rounded-0"
       type="button"
       data-toggle="sidebar">
   <span class="material-icons">short_text</span>
</button>

<!-- Navbar Brand -->
<a href="index.html"
  class="navbar-brand mr-16pt d-lg-none">
   <!-- <img class="navbar-brand-icon" src="../../public/images/logo/white-100@2x.png" width="30" alt="Luma"> -->

   <span class="avatar avatar-sm navbar-brand-icon mr-0 mr-lg-8pt">

       <span class="avatar-title rounded bg-primary"><img src="../../public/images/illustration/student/128/white.svg"
                alt="logo"
                class="img-fluid" /></span>

   </span>

   <span class="d-none d-lg-block">Online Learning Platform</span>
</a>

<ul class="nav navbar-nav d-none d-sm-flex flex justify-content-start ml-8pt">
   <li class="nav-item active">
       <a href="index.html"
          class="nav-link">Home</a>
   </li>
   <li class="nav-item active">
       <a href="CoursesPortal.html"
          class="nav-link">Portals</a>
   </li>
   <li class="nav-item active">
       <a href="TrainersList.html"
          class="nav-link">Trainers</a>
   </li>
   
   <li class="nav-item">
       <a href="traineesList.html"
          class="nav-link">Trainees</a>
   </li>
  
   
</ul>

<ul class="nav navbar-nav ml-auto mr-0">
   <li class="nav-item">
       <a href="login.html"
          class="nav-link"
          data-toggle="tooltip"
          data-title="Login "
          data-placement="bottom"
          data-boundary="window"><i class="material-icons">lock_open</i></a>
   </li>
   
</ul>
</div>
`
document.getElementById('myHeader').innerHTML = header