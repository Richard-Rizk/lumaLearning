var footer = `<div class="border-bottom-2 py-16pt navbar-dark border-bottom-2">
<div class="container page__container">
    <div class="row align-items-center">
        <div
            class="d-flex col-md align-items-center border-bottom border-md-0 mb-16pt mb-md-0 pb-16pt pb-md-0">
            <div
                class="rounded-circle bg-primary w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                <i class="material-icons text-white">local_library</i>
            </div>
            <div class="flex">
                <div class="card-title mb-4pt">Number of portals</div>
                <p class="card-subtitle text-70" id="nbrOfPortals"></p>
            </div>
        </div>
        <div
            class="d-flex col-md align-items-center border-bottom border-md-0 mb-16pt mb-md-0 pb-16pt pb-md-0">
            <div
                class="rounded-circle bg-primary w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                <i class="material-icons text-white">school</i>
            </div>
            <div class="flex">
                <div class="card-title mb-4pt">Number </div>
                <p class="card-subtitle text-70"></p>
            </div>
        </div>
        <div class="d-flex col-md align-items-center">
            <div
                class="rounded-circle bg-primary w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                <i class="material-icons text-white">update</i>
            </div>
            <div class="flex">
                <div class="card-title mb-4pt">Number of courses</div>
                <p class="card-subtitle text-70"></p>
            </div>
        </div>
        <div class="d-flex col-md align-items-center">
            <div
                class="rounded-circle bg-primary w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                <i class="material-icons text-white">update</i>
            </div>
            <div class="flex">
                <div class="card-title mb-4pt">Number of trainees</div>
                <p class="card-subtitle text-70"></p>
            </div>
        </div>
    </div>
</div>
</div>

<div class=" border-top-2 mt-auto">
<div class="container page__container page-section d-flex flex-column">
    <p class="text-70 brand mb-24pt">
        <img class="brand-icon" src="public/images/logo/black-70@2x.png" width="30" alt="Luma">
        Learning Platform
    </p>
   
</div>
</div>
`
document.getElementById('myFooter').innerHTML = footer;