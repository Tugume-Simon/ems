const lists = document.querySelectorAll('li.view');
const divs = document.querySelectorAll('section');
const employee_form = document.getElementById('employee-form');
const depEditForm = document.getElementById('edit-dep');
const depAddForm = document.getElementById('add-dep');
const empEditForm = document.querySelector('#edit-employee');
const overlay = document.querySelector('.overlay');
const cancelBtn = document.querySelector('i.fa-times');
const logoutBtn = document.querySelector('.fa-power-off');
const profUpBtn = document.querySelector('#prof-update');
const profEditForm = document.querySelector('#edit-profile');
const makeAnnouncementForm = document.querySelector('#mk-annou');
const board = document.querySelector('#notice');
const msgView = document.querySelector('section#msg');
const sort = document.querySelector('#sort');
const searchbar = document.querySelector('#search');

fetchData('emps');
getOpts();
getAnnouncements();

for (let li of lists) {
    li.addEventListener('click', () => {
        let id = li.getAttribute('id');
        let active_list = document.querySelector('li.active');
        if (li == active_list) {
            return;
        }
        active_list.classList.remove('active');
        li.classList.add('active');
        activateDiv(id);
    });
}

function activateDiv(id) {
    let activeDiv = document.querySelector('section.show');
    activeDiv.classList.remove('show');

    document.querySelector(`section#${id}`).classList.add('show');
    fetchData(id);
}

function fetchData(_id){
    let xhr = new XMLHttpRequest();
    let url_join = '';
    if(_id == 'emps')
        url_join = 'fetch-employees';
    else if(_id == 'deps')
        url_join = 'fetch-departments';
    else if(_id == 'prof')
        return;
    else if(_id == 'annou')
        url_join = 'fetch-groups';
    else if(_id == 'msg'){
        getMessages();
        return;
    }
    xhr.open('GET', `controllers/${url_join}.php`, true);
    
    xhr.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            if(_id != 'annou')
                document.querySelector(`section#${_id}`).querySelector('tbody').innerHTML = this.responseText;
            else{
                document.querySelector(`section#${_id}`).querySelector('#to').innerHTML = this.responseText;
            }
        }
    };

    xhr.send(); 
}

function getAnnouncements(){
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'controllers/fetch-announcements.php', true);
    xhr.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            board.innerHTML = this.responseText;
        }
    }

    xhr.send();
}

function getMessages(){
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'controllers/fetch-messages.php', true);
    xhr.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            msgView.innerHTML = this.responseText;
        }
    }

    xhr.send();
}

employee_form.addEventListener('submit', (event) => {
    event.preventDefault();

    let t = document.getElementById('title').value;
    let name = document.getElementById('fullname').value.trim();
    let dob = document.getElementById('dob').value;
    let gen = document.getElementById('gender').value;
    let e = document.getElementById('email').value.trim();
    let adr = document.getElementById('address').value.trim();
    let tel = document.getElementById('telephone').value.trim();
    let dep = document.getElementById('department').value;
    let s = document.getElementById('salary').value;
    let pa = document.getElementById('password').value;
    
    if (!name){
        alert('Fullname field is empty!');
        return;
    }
    if (!dob){
        alert('Date of birth field is empty!');
        return;
    }
    if (!e){
        alert('Email field is empty!');
        return;
    }
    if (!adr){
        alert('Address field is empty!');
        return;
    }
    if (!tel){
        alert('Telephone number is empty!');
        return;
    }
    if (!pa){
        alert('Password is invalid!');
        return;
    }
    if (!s){
        alert('Salary provided is invalid!');
        return;
    }

    let params = `t=${t}&n=${name}&d=${dob}&g=${gen}&e=${e}&a=${adr}&dp=${dep}&l=${tel}&s=${s}&p=${pa}`;
            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'controllers/insert_employee.php', true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200){
                    if (this.responseText == 'exists'){
                        alert('Email already exists in the database!!');
                    }
                    else if(this.responseText == 'success'){
                        fetchData('emps');
                        alert('Employee submitted successfully');
                    }
                    else{
                        alert('Insertion of record failed!');
                    }
                }
            };
            xhr.send(params);

            employee_form.reset();
});

function editDep(e){
    let row = e.target.parentElement.parentElement;
    let _id = row.getAttribute('id');
    let toedit = row.querySelector('td').innerText;

    depEditForm.querySelector('#edp').value = toedit;
    depEditForm.setAttribute('data-id', _id);
    depEditForm.style.display = 'block';
}

depEditForm.addEventListener('submit', (e) => {
    e.preventDefault();
    let editValue = e.target.querySelector('input').value.trim();
    let id = e.target.getAttribute('data-id');

    if(!editValue){
        alert("Cannot be empty!");
        return;
    }

    let params = `e=${editValue}&i=${id}`;
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'controllers/edit-department.php', true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            if(this.responseText == 'success'){
                fetchData('deps');
                alert('Updated successfully');
                getOpts();
            }
        }
    };

    xhr.send(params);

    depEditForm.reset();
    depEditForm.style.display = 'none';
});

depAddForm.addEventListener('submit', (e) => {
    e.preventDefault();
    let value = e.target.querySelector('#adp').value.trim();

    if(!value){
        alert("Cannot be empty!");
        return;
    }

    let params = `a=${value}`;
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'controllers/add-department.php', true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            if(this.responseText == 'success'){
                fetchData('deps');
                alert('Inserted successfully');
                getOpts();
            }
        }
    };

    xhr.send(params);
    depAddForm.reset();
});

function getOpts(){
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'controllers/getoptions.php', true);

    xhr.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            empEditForm.querySelector('#dpt').innerHTML = this.responseText;
            employee_form.querySelector('#department').innerHTML = this.responseText;
        }
    };

    xhr.send();
}

function delDep(e){
    let row = e.target.parentElement.parentElement;
    let _id = row.getAttribute('id');
    
    if(confirm('Are you sure?')){
        let params = `i=${_id}`;
        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'controllers/del-department.php', true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                if(this.responseText == 'deleted'){
                    fetchData('deps');
                    alert('Deleted successfully');
                    getOpts();
                }
                if(this.responseText == 'cannot'){
                    alert('Cannot delete department. Still has members!');
                }
            }
        }

        xhr.send(params);
    }
}

cancelBtn.addEventListener('click', () => {
    overlay.style.display = 'none';
    empEditForm.style.display = 'none';
});

function editEmp(e){
    let row = e.target.parentElement.parentElement;
    let id = row.getAttribute('id');
    
    overlay.style.display = 'block';
    empEditForm.style.display = 'block';
    empEditForm.setAttribute('data-id', id);

    let params = `i=${id}`;
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'controllers/getcurrent.php', true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
    xhr.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            let result = this.responseText.split('|');
            empEditForm.querySelector('#tit').value = result[0];
            empEditForm.querySelector('#fullnm').value = result[1];
            empEditForm.querySelector('#DOB').value = result[2];
            empEditForm.querySelector('#gen').value = result[3];
            empEditForm.querySelector('#em').value = result[4];
            empEditForm.querySelector('#add').value = result[5];
            empEditForm.querySelector('#dpt').value = result[6];
            empEditForm.querySelector('#telp').value = result[7];
            empEditForm.querySelector('#sal').value = result[8];
        }
    }

    xhr.send(params);
}

empEditForm.addEventListener('submit', (event) => {
    event.preventDefault();
    
    let t = document.getElementById('tit').value;
    let name = document.getElementById('fullnm').value.trim();
    let dob = document.getElementById('DOB').value;
    let gen = document.getElementById('gen').value;
    let e = document.getElementById('em').value.trim();
    let adr = document.getElementById('add').value.trim();
    let tel = document.getElementById('telp').value.trim();
    let dep = document.getElementById('dpt').value;
    let s = document.getElementById('sal').value;
    
    if (!name){
        alert('Fullname field is empty!');
        return;
    }
    if (!dob){
        alert('Date of birth field is empty!');
        return;
    }
    if (!e){
        alert('Email field is empty!');
        return;
    }
    if (!adr){
        alert('Address field is empty!');
        return;
    }
    if (!tel){
        alert('Telephone number is empty!');
        return;
    }
    if (!s){
        alert('Salary provided is invalid!');
        return;
    }

    let id = empEditForm.getAttribute('data-id');

    let params = `i=${id}&t=${t}&n=${name}&d=${dob}&g=${gen}&e=${e}&a=${adr}&dp=${dep}&l=${tel}&s=${s}`;
            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'controllers/edit_employee.php', true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200){
                    if (this.responseText == 'updated'){
                        fetchData('emps');
                        alert('Employee updated successfully');
                    }
                }
            };
            xhr.send(params);

            // empEditForm.reset();
            empEditForm.style.display = 'none';
            overlay.style.display = 'none';
});

function delEmp(e){
    let row = e.target.parentElement.parentElement;
    let _id = row.getAttribute('id');

    if(confirm('Are you sure?')){
        let params = `i=${_id}`;
        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'controllers/del-employees.php', true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                if(this.responseText == 'deleted'){
                    fetchData('emps');
                    alert('Deleted successfully');
                }
                else{
                    alert('Failed to delete employee!!');
                }
            }
        }

        xhr.send(params);
    }
}

logoutBtn.addEventListener('click', () => {
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'controllers/logout.php', true);

    xhr.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            window.location.href = 'login.php';
        }
    }

    xhr.send();
});

profUpBtn.addEventListener('click', () => {
    profEditForm.style.display = 'block';
})

profEditForm.addEventListener('submit', (e) => {
    e.preventDefault();
    let id = e.target.getAttribute('data-id');
    let email = e.target.querySelector('#ade').value.trim();
    let uname = e.target.querySelector('#username').value.trim();
    let pass = e.target.querySelector('#pss').value.trim();

    if(!email){
        alert('Email field is empty');
        return;
    }
    if(!uname){
        alert('Username field is empty');
        return;
    }
    if(!pass){
        alert('Password field is empty');
        return;
    }

    let params = `i=${id}&e=${email}&u=${uname}&p=${pass}`;
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'controllers/update-profile.php', true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            if(this.responseText == 'updated'){
                alert('Profile updated successfully');
                profEditForm.style.display = 'none';
            }
        }
    }

    xhr.send(params);
});

makeAnnouncementForm.addEventListener('submit', (e) => {
    e.preventDefault();
    let title = e.target.querySelector('#a-title').value.trim();
    let grp = e.target.querySelector('#to').value;
    let msg = e.target.querySelector('#a-ancmt').value.trim();

    if(!title){
        alert('Title must not be empty!');
        return;
    }

    if(!msg){
        alert('Title must not be empty!');
        return;
    }
    
    let params = `t=${title}&g=${grp}&m=${msg}`;
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'controllers/add-announcement.php', true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            if(this.responseText == 'posted'){
                alert('Posted successfully');
                getAnnouncements();
            }
        }
    }

    xhr.send(params);
    makeAnnouncementForm.reset();
});

sort.addEventListener('change', (e) => {
    if(e.target.value == 'all'){
        fetchData('emps');
    }
    if(e.target.value == 'dept'){
        let xhr = new XMLHttpRequest();
        xhr.open('GET', 'controllers/getSortedDept.php', true);

        xhr.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                document.querySelector('section#emps').querySelector('tbody').innerHTML = this.responseText;
            }
        }

        xhr.send();
    }
});

searchbar.addEventListener('keyup', (e) => {
    let substr = e.target.value;
    let param = `s=${substr}`;
    
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'controllers/handle-search.php', true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            document.querySelector('section#emps').querySelector('tbody').innerHTML = this.responseText;
        }
    };

    xhr.send(param);
});