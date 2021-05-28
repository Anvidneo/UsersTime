$(document).ready(function() {
    check_user();
});

// FUNCTION TO VALIDATE IF SESSION EXIST
function check_user() {
    let location = window.location.pathname;
    if (location != "/UsersTime/" && location != "/UsersTime/views/auth/register.php") {
        let id = localStorage.getItem('id');
        let user = localStorage.getItem('user');
        
        if(id == undefined) {
            if (user == undefined) {
                window.location.href = "/UsersTime";
            }
        }
    }
}

// FUNCTIONS FOR LOGIN 
$("#login").click(function() {
    let user = $('#user_login').val();
    let pass = $('#password_login').val();
    get_user(user, pass);
})

function get_user(user, pass) {
    let location = window.location.origin;
    $.ajax({
        type: 'POST',
        url: 'index.php',
        data: {
            request: 'get_user',
            user: user,
            pass: pass
        },
        dataType: 'json',
        success: function(data){
            if (data.state == 1) {
                localStorage.setItem('id', data.data[0].id);
                localStorage.setItem('user', data.data[0].user);
                window.location.href = location + "/UsersTime/views/pages/dashboard.php";
            }
        },
        error : function(xhr, status) {
            console.log('Error');
        },
    });
}

// FUNCTIONS FOR LOGOUT
$("#logout").click(function() {
    logout();
});

function logout() {
    localStorage.removeItem('id');
    localStorage.removeItem('user');
    window.location.href = "/UsersTime";
}

// FUNCTIONS FOR REGISTER
$("#register").click(function() {
    let user = $('#user_register').val();
    let pass = $('#password_register').val();
    insert_user(user, pass);
})

function insert_user(user, pass) {
    let location = window.location.origin;
    $.ajax({
        type: 'POST',
        url: `${location}/UsersTime/index.php`,
        data: {
            request: 'new_user',
            user: user,
            pass: pass
        },
        dataType: 'json',
        success: function(data){
            if (data.state == 1) {
                let msg = `<div class='alert alert-success' role='alert'>${data.message}</div>`
                document.getElementById("msg").innerHTML = msg;
                document.getElementById("msg").style.display = 'block';
            } else {
                let msg = `<div class='alert alert-danger' role='alert'>${data.message}</div>`
                document.getElementById("msg").innerHTML = msg;
                document.getElementById("msg").style.display = 'block';
            }
        },
        error : function(xhr, status) {
            console.log('Error');
            let msg = "<div class='alert alert-danger' role='alert'>Sorry, not possible register the user</div>"
            document.getElementById("msg").innerHTML = msg;
            document.getElementById("msg").style.display = 'block';
        },
    });
}

// FUNCTIONS TO ACTIVITIES

// NEW
$("#new_activity").click(function() {
    let id = localStorage.getItem('id');
    let data = {
        request: 'new_activity',
        description: $('#description_activity').val(),
        id: id
    }
    new_activity(data);
    create_table_activities();
});

function new_activity(data) {
    let location = window.location.origin;
    $.ajax({
        type: 'POST',
        url: `${location}/UsersTime/index.php`,
        data: data,
        dataType: 'json',
        success: function(data){
            console.log(data)
            if (data.state === 1) {
                create_table_activities()
            } else {
                console.log('Error');
            }
        },
        error : function(xhr, status) {
            console.log('Error');
        },
    });
}

// CONSULT FOR ACTIVITIES OF USER
function create_table_activities() {
    let location = window.location.origin;
    let id_user = localStorage.getItem('id');
    $.ajax({
        type: 'POST',
        url: `${location}/UsersTime/index.php`,
        data: {
            request: 'activities',
            id: '',
            id_user: id_user,
        },
        dataType: 'json',
        success: function(data){
            let table = '';
            data['data'].forEach(element => {
                table = table + `<tr class="text-white">
                    <td>${element.id}</td>
                    <td>${element.description}</td>
                    <td><button id="btn_times" value="${element.id}" class='new'><i class='material-icons' data-toggle='tooltip' title='' data-original-title='Times'>alarm_on</i></button></td>
                    <td><a id="btn_edit" value="${element.id}" href='#editActivityModal' class='edit' data-toggle='modal'><i class='material-icons' data-toggle='tooltip' title='' data-original-title='Edit'></i></a></td>
                    <td><a id="btn_delete" value="${element.id}" href='#deleteActivityModal' class='delete' data-toggle='modal'><i class='material-icons' data-toggle='tooltip' title='' data-original-title='Delete'></i></a></td>
                </tr>`

                document.getElementById("content_activities").innerHTML = table;
                document.getElementById("table_content").style.display = 'block';
            });

            
        },
        error : function(xhr, status) {
            console.log('Error')
            let msg = "<div class='alert alert-danger' role='alert'>Sorry, not possible charge the activities</div>"
            document.getElementById("msg").innerHTML = msg;
            document.getElementById("msg").style.display = 'block';
            document.getElementById("table_content").style.display = 'none';
        },
    });
}

// DELETE
$("#content_activities").on("click", "#btn_delete", function() {
    let id = $(this).attr('value');
    $('#id_delete').attr('value', id);
    console.log(id);
})

$("#id_delete").click(function() {
    let id = $(this).attr('value');
    delete_activity(id);
    create_table_activities();
})

function delete_activity(id_activity) {
    let location = window.location.origin;
    $.ajax({
        type: 'POST',
        url: `${location}/UsersTime/index.php`,
        data: {
            request: 'delete_activity',
            id: id_activity,
        },
        dataType: 'json',
        success: function(data){
            console.log(data)
            if (data.state === 1) {
                console.log('Success')
                let msg = "<div class='alert alert-success' role='alert'>The activity delted</div>"
                document.getElementById("msg").innerHTML = msg;
                document.getElementById("msg").style.display = 'block';
            } else {
                console.log('Error')
                let msg = "<div class='alert alert-danger' role='alert'>Sorry, not possible delete the activity</div>"
                document.getElementById("msg").innerHTML = msg;
                document.getElementById("msg").style.display = 'block';
            }
        },
        error : function(xhr, status) {
            console.log('Error')
            let msg = "<div class='alert alert-danger' role='alert'>Sorry, not possible delete the activity</div>"
            document.getElementById("msg").innerHTML = msg;
            document.getElementById("msg").style.display = 'block';
        },
    });
}

// UPDATE
$("#content_activities").on("click", "#btn_edit", function() {
    let location = window.location.origin;
    let id = $(this).attr('value');
    let id_user = localStorage.getItem('id');
    $.ajax({
        type: 'POST',
        url: `${location}/UsersTime/index.php`,
        data: {
            request: 'activities',
            id: id,
            id_user: id_user,
        },
        dataType: 'json',
        success: function(data){
            console.log(data);
            $('#edit_description').attr('value', data.data[0].description);
        },
        error : function(xhr, status) {
            console.log('Error');
        },
    });
    $('#edit_activity').attr('value', id);
    console.log(id)
})

$("#edit_activity").click(function() {
    let id_user = localStorage.getItem('id');
    let data = {
        request: 'update_activity',
        description: $('#edit_description').val(),
        id: $(this).attr('value'),
        id_user: id_user
    }
    edit_activity(data)
})

function edit_activity(data) {
    let location = window.location.origin;
    $.ajax({
        type: 'POST',
        url: `${location}/UsersTime/index.php`,
        data: data,
        dataType: 'json',
        success: function(data){
            console.log(data)
            if (data.state === 1) {
                let msg = "<div class='alert alert-success' role='alert'>The activity updated</div>"
                document.getElementById("msg").innerHTML = msg;
                document.getElementById("msg").style.display = 'block';
                create_table_activities()
            } else {
                console.log('Error');
                let msg = "<div class='alert alert-danger' role='alert'>Sorry, not possible update the activity</div>"
                document.getElementById("msg").innerHTML = msg;
                document.getElementById("msg").style.display = 'block';
            }
        },
        error : function(xhr, status) {
            console.log('Error');
            let msg = "<div class='alert alert-danger' role='alert'>Sorry, not possible update the activity</div>"
            document.getElementById("msg").innerHTML = msg;
            document.getElementById("msg").style.display = 'block';
        },
    });
}

// FUNCTIONS TO TIMES
$("#content_activities").on("click", "#btn_times", function() {
    let id_activity = $(this).attr('value');
    localStorage.setItem('id_activity', id_activity);
    document.getElementById("times_activity").style.display = 'block';
    create_table_times(id_activity);
});

// NEW
$("#new_time").click(function() {
    let id_activity = localStorage.getItem('id_activity');
    let data = {
        request: 'new_time',
        time: $('#time').val(),
        date: $('#date').val(),
        id: id_activity
    }
    new_time(data)
    create_table_times(id_activity);
});

function new_time(data) {
    let location = window.location.origin;
    let id_activity = localStorage.getItem('id_activity');
    $.ajax({
        type: 'POST',
        url: `${location}/UsersTime/index.php`,
        data: data,
        dataType: 'json',
        success: function(data){
            console.log(data)
            if (data.state === 1) {
                let msg = "<div class='alert alert-success' role='alert'>The time inserted</div>"
                document.getElementById("msg_times").innerHTML = msg;
                document.getElementById("msg_times").style.display = 'block';
                create_table_times(id_activity);
            } else {
                console.log('Error');
                let msg = `<div class='alert alert-danger' role='alert'>${data.message}</div>`
                document.getElementById("msg_times").innerHTML = msg;
                document.getElementById("msg_times").style.display = 'block';
            }
        },
        error : function(xhr, status) {
            console.log('Error');
            let msg = `<div class='alert alert-danger' role='alert'>Sorry, not possible insert the time</div>`
            document.getElementById("msg_times").innerHTML = msg;
            document.getElementById("msg_times").style.display = 'block';
        },
    });
}

// CONSULT FOR TIMES OF ACTIVITIES
function create_table_times(id_activity) {
    let location = window.location.origin;
    $.ajax({
        type: 'POST',
        url: `${location}/UsersTime/index.php`,
        data: {
            request: 'times',
            id: '',
            id_activity: id_activity,
        },
        dataType: 'json',
        success: function(data){
            let table = '';
            data['data'].forEach(element => {
                table = table + `<tr class="text-white">
                    <td>${element.id}</td>
                    <td>${element.date}</td>
                    <td>${element.time}</td>
                    <td><a id="btn_delete_time" value="${element.id}" href='#deleteTimeModal' class='delete' data-toggle='modal'><i class='material-icons' data-toggle='tooltip' title='' data-original-title='Delete'></i></a></td>
                </tr>`;
            });
            document.getElementById("content_times").innerHTML = table;
            document.getElementById("table_content_times").style.display = 'block';
        },
        error : function(xhr, status) {
            console.log('Error')
            let msg = `<div class='alert alert-danger' role='alert'>Sorry, not possible consult the time</div>`
            document.getElementById("msg_times").innerHTML = msg;
            document.getElementById("msg_times").style.display = 'block';
            document.getElementById("table_content_times").style.display = 'none';
        },
    });
}

// DELETE
$("#content_times").on("click", "#btn_delete_time", function() {
    let id = $(this).attr('value');
    $('#id_delete_time').attr('value', id);
    console.log(id);
})

$("#id_delete_time").click(function() {
    let id_activity = localStorage.getItem('id_activity');
    let id = $(this).attr('value');
    delete_time(id)
    create_table_times(id_activity)
})

function delete_time(id) {
    let location = window.location.origin;
    $.ajax({
        type: 'POST',
        url: `${location}/UsersTime/index.php`,
        data: {
            request: 'delete_time',
            id: id,
        },
        dataType: 'json',
        success: function(data){
            console.log(data)
            if (data.state === 1) {
                console.log('Success')
                let msg = "<div class='alert alert-success' role='alert'>The time deleted</div>"
                document.getElementById("msg_times").innerHTML = msg;
                document.getElementById("msg_times").style.display = 'block';
            } else {
                console.log('Error')
                let msg = "<div class='alert alert-danger' role='alert'>Sorry, not possible delete the activity</div>"
                document.getElementById("msg_times").innerHTML = msg;
                document.getElementById("msg_times").style.display = 'block';
            }
        },
        error : function(xhr, status) {
            console.log('Error')
            let msg = "<div class='alert alert-danger' role='alert'>Sorry, not possible delete the time</div>"
            document.getElementById("msg_times").innerHTML = msg;
            document.getElementById("msg_times").style.display = 'block';
        },
    });
}


// SIDEBAR
// show navbar
const showNavbar = (toggleId, navId, bodyId, headerId) => {
    const toggle = document.getElementById(toggleId),
        nav = document.getElementById(navId),
        bodypd = document.getElementById(bodyId),
        headerpd = document.getElementById(headerId);

    // vvalidate that all variables
    if (toggle && nav && bodypd && headerpd) {
        toggle.addEventListener("click", () => {
        // show navbar
        nav.classList.toggle("show");
        // change icon
        toggle.classList.toggle("bx-x");
        // add padding to body
        bodypd.classList.toggle("body-pd");
        // add padding to header
        headerpd.classList.toggle("body-pd");
        });
    }
};
  
showNavbar("header-toggle", "nav-bar", "body-pd", "header");

// link active
const linkColor = document.querySelectorAll(".nav__link");

function colorLink() {
if (linkColor) {
    linkColor.forEach((lc) => lc.classList.remove("active"));
    this.classList.add("active");
}
}
  
linkColor.forEach((l) => l.addEventListener("click", colorLink));
  