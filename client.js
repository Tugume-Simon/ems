const lists = document.querySelectorAll('li.view');
const divs = document.querySelectorAll('section');
const profUpBtn = document.querySelector('#prof-update');
const profEditForm = document.querySelector('#edit-profile');
const logoutBtn = document.querySelector('.fa-power-off');
const board = document.querySelector('section#ann');
const msgForm = document.querySelector('#mk-announ');

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

    let params = `i=${id}&e=${email}&u=${uname}&p=${pass}`;
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'controllers/update-profile.php', true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            console.log(this.responseText);
            if(this.responseText == 'updated'){
                alert('Profile updated successfully');
                profEditForm.style.display = 'none';
            }
        }
    }

    xhr.send(params);
});

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

msgForm.addEventListener('submit', (e) => {
    e.preventDefault();

    let subject = e.target.querySelector('#subject').value.trim();
    let msg = e.target.querySelector('#message').value.trim();

    if(!subject){
        alert('Subject must not be empty!');
        return;
    }

    if(!msg){
        alert('Message must not be empty!');
        return;
    }
    
    let params = `s=${subject}&m=${msg}`;
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'controllers/send-message.php', true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            console.log(this.responseText);
            if(this.responseText == 'posted'){
                alert('Sent successfully');
            }
        }
    }

    xhr.send(params);
    msgForm.reset();
})