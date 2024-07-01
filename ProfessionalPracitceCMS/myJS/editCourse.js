var url = "../../api/";
async function fillSelect(selectElement, api, value) {
    await fetch(api)
        .then(response => response.json())
        .then(data => {
            // console.log(data);
            selectElement.innerHTML = '';
            data.forEach(item => {
                const option = document.createElement('option');
                // option.value = item.CourseID;
                // option.textContent = item.Description;
                values = Object.values(item);
                option.value = values[0];
                option.textContent = values[1];
                selectElement.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });

    if (value) {
        selectElement.value = value;
    } else {
        var initOption = document.createElement('option');
        initOption.value = ""
        initOption.textContent = "-إختر الباب التدريبي-";
        initOption.disabled = true;
        initOption.selected = true;
        initOption.style.display = "none";
        selectElement.appendChild(initOption);
    }


}
async function fetchData(api) {
    var myData;
    await fetch(api)
        .then(response => {
            // Check if the response status is OK (status code 200-299)
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            // console.log(data);
            myData = data;

        })
        .catch(error => {
            console.error('Error fetching data:', error.message);
        });
    return myData;
}
function getChapter(chapterIndex) {
    // console.log(chapter);
    return `
    
    <div class="accordion__item">
        <a href="#" class="accordion__toggle collapsed" data-toggle="collapse"
            data-target="#chapter${chapters[chapterIndex].ChapterID}" data-parent="#parent">
            <span class="flex">${chapters[chapterIndex].ChapNum}) ${chapters[chapterIndex].ChapterTitle}</span>
            <span class="accordion__toggle-icon material-icons">keyboard_arrow_down</span>
        </a>
        <div class="accordion__menu collapse" id="chapter${chapters[chapterIndex].ChapterID}">
        <div class="d-flex justify-content-end">
        <button type="button" onclick="handleEditChapter(${chapterIndex})"
            class="btn btn-primary btn-rounded mr-2 pt-0 pb-0" data-bs-toggle="modal" data-bs-target="#chaptersModal">تعديل
        </button>
        <button type="button" onclick="handleDeleteChapter(${chapterIndex})"
            class="btn btn-accent btn-rounded mr-2 pt-0 pb-0">حذف</button>
        </div>
    `


}

function handleAddPart(chapterId) {

    document.getElementById('PartID').value = -1
    document.getElementById('partStatus').value = "new"
    document.getElementById('partChapterID').value = chapterId
    document.getElementById('PartNum').value = 0
    document.getElementById('PeriodMinutes').value = 0
    document.getElementById('PeriodSeconds').value = 0
    document.getElementById('PartTitle').value = ""
    document.getElementById('FilePath').value = ""
}

function handleEditChapter(chapterIndex) {
    console.log(chapters[chapterIndex]);
    chapter = chapters[chapterIndex];
    for (let key in chapter) {
        if (chapter.hasOwnProperty(key)) {
            const value = chapter[key];
            document.getElementById(`${key}`).value = value;

        }
    }
    document.getElementById('status').value = 'update';
}

function handleEditPart(partId) {
    part = parts.find(obj => obj.PartID == partId)
    for (let key in part) {
        if (part.hasOwnProperty(key)) {
            const value = part[key];
            var fld = document.getElementById(`${key}`);
            if (fld != null) {
                fld.value = value;
            }

        }
    }
    document.getElementById('partStatus').value = 'update';
    document.getElementById('partChapterID').value = part.ChapterID;
}

async function handleDeleteChapter(chapterIndex) {
    chapter = chapters[chapterIndex]

    await ManipulateData(url + 'webChapter.php?status=delete&id=' + chapter.ChapterID, {})
    location.reload();

}

async function handleDeletePart(partId) {
    await ManipulateData(url + 'webParts.php?status=delete&id=' + partId, {})
    location.reload();

}


function getPart(part) {
    // console.log(part);
    return `
    <div class="accordion__menu-link">
        <span
            class="icon-holder icon-holder--small icon-holder--primary rounded-circle d-inline-flex icon--left">
            <i class="material-icons icon-16pt">play_circle_outline</i>
        </span>
        <a class="flex" href="#">${part.PartNum}) ${part.PartTitle}</a>
        <span class="text-muted">${calcTime(0, part.PeriodMinutes, part.PeriodSeconds)}</span>
        <div class="d-flex justify-content-end">
            <button type="button" onclick="handleEditPart(${part.PartID})"
                class="btn btn-outline-secondary btn-rounded mr-2 pt-0 pb-0" data-bs-toggle="modal" data-bs-target="#partsModal">تعديل
            </button>
            <button type="button" onclick="handleDeletePart(${part.PartID})"
                class="btn btn-outline-secondary btn-rounded mr-2 pt-0 pb-0">حذف</button>
        </div>
    </div>
    `
}
function calcTime(hours, mins, secs) {
    var courseTime = ''
    if (hours != null && hours > 0) {
        courseTime += hours + 'h '
    }
    if (mins != null && mins > 0) {
        courseTime += mins + 'm '
    }
    if (secs != null && secs > 0) {
        courseTime += secs + 's'
    }
    return courseTime;
}
async function displayData(id, url, selectElement) {
    data = {
        status: 'one',
        id: id,
    }
    $.ajax({
        type: "post",
        url: url + "webCourse.php",
        data: data,
        dataType: "json",
        success: function (response) {

            x = response[0];
            // console.log(x);
            for (var key in x) {
                if (x.hasOwnProperty(key)) {
                    // Check if the field value matches the expected date format
                    fieldValue = x[key];
                    control = $("#" + key);
                    // console.log(control.prop('type'));
                    if (fieldValue) {
                        if (fieldValue.hasOwnProperty("date")) {
                            // console.log(fieldValue.date);
                            originalDate = fieldValue.date;
                            formattedDate = convertSqlDateToHtml(originalDate)
                            // console.log(formattedDate);
                            control.val(formattedDate)
                        } else if (control.is(':checkbox')) {
                            control.prop('checked', fieldValue);
                        } else if (control.prop('type') === 'file') {
                            imgUrl = url + fieldValue;
                            $('#profileImg').attr('src', imgUrl)
                        } else {

                            control.val(fieldValue)
                        }
                    }

                }
            }

            // the code is not working for this checkbox, so I will set it value here
            $('#IsActive').prop('checked', x.IsActive);
            fillSelect(selectElement, url + 'webCoursePortal.php?status=select', x.CoursePortalID)
        }
    });

    parts = await fetchData(url + 'vwChaptersParts.php?status=courseChapParts&id=' + id)
    console.log(parts);
    chapters = Array.from(new Set(parts.map(element => JSON.stringify({
        ChapterID: element.ChapterID,
        ChapNum: element.ChapNum,
        ChapterTitle: element.ChapterTitle,
        ChapDescr: element.ChapDescr,
        CourseID: element.CourseID,


    })))).map(tupleString => JSON.parse(tupleString));
    console.log(chapters);
    var str = '';

    chapters.forEach(function (chapter, index) {
        strChapter = `${getChapter(index)}`
        var filteredParts = parts.filter(part => part.ChapterID === chapter.ChapterID && part.PartID != null);
        filteredParts.forEach(function (part, index) {
            console.log(index);
            strChapter += `${getPart(part)}`
        })
        var divEnds = `
        <div class="d-flex justify-content-end">
            <button type ="button" onclick="handleAddPart(${chapter.ChapterID})" data-bs-toggle="modal" data-bs-target="#partsModal" class="btn btn-outline-secondary btn-rounded mr-2 pt-0 pb-0 mb-2 mt-2">إضافة جزء</button>
        </div>
                </div>
                </div>
            `
        str += strChapter + divEnds;
    })
    document.getElementById('parent').innerHTML = str;
}


function validData() {
    // console.log($('#Title').val())
    if ($('#Title').val().trim() === '') {
        alert('يجب تعبئة عنوان الدورة')
        return false;
    }
    if ($('#CoursePortalID').val() == null) {
        alert('يجب اختيار الباب التدريبي')
        return false
    }
    if ($('#CoursePrice').val() == '') {
        $('#CoursePrice').val(0)
    }
    return true;
}

async function ManipulateData(urlFetch, data) {
    const options = {
        method: 'POST',
        // headers: {
        //     'Content-Type': 'application/json',
        // },
        body: data
    };
    console.log(JSON.stringify(data));
    console.log(urlFetch);

    await fetch(urlFetch, options)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            console.log('Response data:', data);
        })
        .catch(error => {
            console.error('Fetch error:', error);
        });
    return
}
$(document).ready(function () {

    $('#btnAddChapter').on('click', function () {
        document.getElementById('ChapterID').value = -1
        document.getElementById('status').value = "new"
        document.getElementById('CourseID').value = CourseID
        document.getElementById('ChapNum').value = 0
        document.getElementById('Title').value = ""
        document.getElementById('ChapDescr').value = ""

    })

    $('#btnDelete').on('click', function () {
        // if (confirm('متاكد كم حذف الدورة')) {
        //     $.ajax({
        //         type: "post",
        //         url: url + "webUser.php?status=rmvImg&id=" + ID,
        //         dataType: "json",
        //         success: function (response) {
        //             setAvatarImg(url);
        //             $('#Photo').val('')
        //             alert('لقد تم حذف الصورة')
        //         },
        //         error: function () {
        //             alert('Error deleting image')
        //         }
        //     });
        // }


    })

    $('#btnSave').on('click', function (e) {
        e.preventDefault();
        if (!validData()) {
            return
        }
        var form = $('#frm')[0];
        var formData = new FormData(form);
        formData.append('CoursePortalID', $('#CoursePortalID').val())
        formData.append('CoursePrice', $('#CoursePrice').val())
        formData.append('IsActive', $('#IsActive').prop('checked'))
        formData.append('TrainerID', TrainerID)
        // formData.append('userType', 'tr')
        if (CourseID == -1) {
            formData.append('status', 'new')

        } else {
            formData.append('id', CourseID)
            formData.append('status', 'update')
        }

        for (var [key, value] of formData.entries()) {
            console.log(key, value);
        }

        // console.log(formData);
        $.ajax({
            type: "POST",
            url: url + "webCourse.php",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function (response) {
                alert('لقد تم حفظ التغييرات');
                // alert(response.CourseID);
                if (CourseID == -1) {
                    newURL = location.href + '&courseId' + '=' + response.CourseID
                    history.pushState(null, null, newURL);
                    document.getElementById('btnAddChapter').disabled = false;
                    CourseID = response.CourseID
                }

            },
            error: function (err) {
                alert('Error occured');
            }
        });
    })

    $('#chaptersModal').on('shown.bs.modal', function () {
        // Set focus to the input when the modal is shown and select the text
        $('#ChapNum').focus();
        $('#ChapNum').select();
    });



    $('#btnSaveChapter').on('click', async function () {
        var myForm = document.getElementById('chaptersForm');
        var formData = new FormData(myForm);

        for (var pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }

        response = await ManipulateData(url + 'webChapter.php', formData)
        console.log(response);
        $('#chaptersModal').modal('hide');
        location.reload();
    })

    $('#btnSavePart').on('click', async function () {
        var myForm = document.getElementById('partsForm');
        var formData = new FormData(myForm);

        for (var pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }

        response = await ManipulateData(url + 'webParts.php', formData)
        console.log(response);
        $('#partsModal').modal('hide');
        location.reload();
    })
    var url;
    var chapters;
    var parts;
    url = "../../api/";
    var CourseID
    ///////////////////
    var courseId = getParameterByName('courseId', window.location.href);
    var TrainerID = getParameterByName('trainerId', window.location.href);
    const selectElementPortalID = $('#CoursePortalID').get(0);
    if (courseId == null) {
        CourseID = -1
        fillSelect(selectElementPortalID, url + 'webCoursePortal.php?status=select', null)
        document.getElementById('btnAddChapter').disabled = true;
    } else {
        CourseID = courseId
        displayData(CourseID, url, selectElementPortalID)
    }
})

